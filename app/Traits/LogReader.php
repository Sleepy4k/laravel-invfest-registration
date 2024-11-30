<?php

namespace App\Traits;

use App\Enums\LogReaderType;
use App\Enums\ReportLogType;
use Illuminate\Support\Facades\File;

trait LogReader
{
    use SystemLog;

    /**
     * Get file list from Laravel app log.
     *
     * @param LogReaderType $type
     * @param string $channel
     *
     * @return array
     */
    protected function getFileList(LogReaderType $type = LogReaderType::SINGLE, string $channel = 'laravel'): array
    {
        try {
            $logPath = storage_path('logs');

            $files = match ($type) {
                LogReaderType::DAILY => collect(glob("{$logPath}/{$channel}-*.log")),
                LogReaderType::SINGLE => collect(glob("{$logPath}/{$channel}.log")),
                default => collect(glob("{$logPath}/{$channel}.log")),
            };

            return $files->map(function ($file) use ($logPath) {
                $name = basename($file);
                $filePath = "{$logPath}/{$name}";

                return [
                    'name' => $name,
                    'size' => formatFileSize(File::size($filePath)),
                    'type' => File::type($filePath),
                    'content' => File::mimeType($filePath),
                    'last_updated' => date('Y-m-d H:i:s', File::lastModified($filePath)),
                ];
            })->toArray();
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            return [];
        }
    }

    /**
     * Read file content from Laravel app log.
     *
     * @param string $date
     *
     * @return array
     */
    protected function getFileContent(string $date): array
    {
        try {
            $logPath = storage_path("logs/{$date}.log");

            if (!File::exists($logPath)) {
                throw new \Exception('File not found in our storage, please double check it.');
            }

            $content = File::get($logPath);
            $pattern = "/^\[(?<date>.*)\]\s(?<env>\w+)\.(?<type>\w+):(?<message>.*)/m";

            preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

            return collect($matches)->map(function ($match) {
                return [
                    'env' => $match['env'],
                    'type' => $match['type'],
                    'timestamp' => $match['date'],
                    'message' => trim($match['message']),
                ];
            })->toArray();

        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            return [];
        }
    }

    /**
     * Read all file content from Laravel app log.
     *
     * @param LogReaderType $type
     * @param string $channel
     * @param string|null $date
     *
     * @return array
     */
    protected function getAllFileContent(LogReaderType $type = LogReaderType::SINGLE, string $channel = 'laravel', ?string $date = null): array
    {
        try {
            $logPath = match ($type) {
                LogReaderType::DAILY => storage_path("logs/{$channel}-" . ($date ?? now()->format('Y-m-d')) . '.log'),
                LogReaderType::SINGLE => storage_path("logs/{$channel}.log"),
                default => storage_path("logs/{$channel}.log"),
            };

            if (!File::exists($logPath)) {
                throw new \Exception('File not found in our storage, please double check it.');
            }

            $content = File::get($logPath);
            $pattern = "/^\[(?<date>.*)\]\s(?<env>\w+)\.(?<type>\w+):(?<message>.*)/m";

            preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

            return collect($matches)->map(function ($match) {
                return [
                    'timestamp' => $match['date'],
                    'env' => $match['env'],
                    'type' => $match['type'],
                    'date' => now()->format('Y-m-d'),
                    'message' => trim($match['message']),
                ];
            })->toArray();

        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            return [];
        }
    }
}
