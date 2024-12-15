<?php

namespace App\Storage;

use App\Enums\ReportLogType;
use App\Facades\Format;
use App\Traits\SystemLog;
use Spatie\DbDumper\Databases\MySql;
use Illuminate\Support\Facades\File;

class DatabaseBackupManager
{
    use SystemLog;

    /**
     * Database backup log path.
     *
     * @var string
     */
    private static string $logPath = 'backup/db';

    /**
     * Database backup file name.
     *
     * @var string
     */
    private static string $fileName = 'db-backup';

    /**
     * Get file list from database backup directory.
     *
     * @param string $channel
     *
     * @return array
     */
    public function getFileList(): array
    {
        try {
            $logPath = storage_path(self::$logPath);

            $files = glob("{$logPath}/".self::$fileName."-*.sql");
            $files = collect($files);
            $files = $files->filter(function ($file) {
                return File::isFile($file);
            });

            return $files->map(function ($file) use ($logPath) {
                $name = basename($file);
                $filePath = "{$logPath}/{$name}";

                return [
                    'name' => $name,
                    'size' => Format::formatFileSize(File::size($filePath)),
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
     * Create backup from database.
     *
     * @return bool
     */
    public function createBackup(): bool
    {
        try {
            $logPath = storage_path(self::$logPath);
            $backupPath = "{$logPath}/".self::$fileName."-".date('YmdHis').".sql";

            MySql::create()
                ->setHost(config('database.connections.mysql.host'))
                ->setPort(config('database.connections.mysql.port'))
                ->setDbName(config('database.connections.mysql.database'))
                ->setUserName(config('database.connections.mysql.username'))
                ->setPassword(config('database.connections.mysql.password'))
                ->dumpToFile($backupPath);

            return true;
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            return false;
        }
    }

    /**
     * Delete file from database backup directory.
     *
     * @param string $date
     *
     * @return bool
     */
    public function deleteFile(string $date): bool
    {
        try {
            $logPath = storage_path(self::$logPath);
            $file = "{$logPath}/".self::$fileName."-{$date}.sql";

            if (!File::isFile($file)) return false;

            return File::delete($file);
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            return false;
        }
    }

    /**
     * Download file from database backup directory.
     *
     * @param string $date
     */
    public function downloadFile(string $date)
    {
        try {
            $logPath = storage_path(self::$logPath);
            $file = "{$logPath}/".self::$fileName."-{$date}.sql";

            if (!File::isFile($file)) return false;

            return response()->download($file);
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            return false;
        }
    }
}
