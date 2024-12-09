<?php

namespace App\Traits;

use App\Enums\ReportLogType;
use App\Enums\UploadFileType;
use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    use SystemLog;

    /**
     * Set path root when upload file.
     */
    protected $baseDisk = 'public';

    /**
     * Set path root when unkown file.
     */
    protected $unkownPath = 'unkown';

    /**
     * Set path for storage when upload file.
     *
     * @param string $type
     *
     * @return string
     */
    protected function storageDisk(UploadFileType $type = UploadFileType::IMAGE)
    {
        try {
            $path = match ($type) {
                UploadFileType::IMAGE => '' . UploadFileType::IMAGE->value . '/',
                UploadFileType::FILE => '/' . UploadFileType::FILE->value . '/',
                UploadFileType::SETTING => '/' . UploadFileType::SETTING->value . '/',
                default => '/' . $this->unkownPath . '/',
            };

            if (!Storage::exists(explode('/', $path)[1])) {
                Storage::disk('public')->copy('index.html', rtrim($path, '/') . '/index.html');
            }

            return $path;
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            throw $th;
        }
    }

    /**
     * Transform name file
     *
     * @param string $type
     * @param string $file
     *
     * @return string
     */
    protected function transformName($type, $file)
    {
        try {
            $baseUrl = request()->getSchemeAndHttpHost() . '/storage';
            return match ($type) {
                UploadFileType::IMAGE => $baseUrl . '/' . UploadFileType::IMAGE->value . '/' . $file,
                UploadFileType::FILE => $baseUrl . '/' . UploadFileType::FILE->value . '/' . $file,
                UploadFileType::SETTING => $baseUrl . '/' . UploadFileType::SETTING->value . '/' . $file,
                default => $baseUrl . '/' . $this->unkownPath . '/' . $file,
            };
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            throw $th;
        }
    }

    /**
     * Parse image name
     *
     * @param string $file
     *
     * @return string
     */
    protected function parseImage($file)
    {
        try {
            $parsedUrl = parse_url($file);
            return basename($parsedUrl['path'] ?? '');
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            throw $th;
        }
    }

    /**
     * Save file in storage app
     *
     * @param UploadFileType $type
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function putFile(UploadFileType $type, $file)
    {
        try {
            $user = auth('web')->user();
            $clientCode = $user ? $user->id . '_' . $user->created_at->format('dmY') : rand(1, 999) . '_' . date('His');
            $fileName = preg_replace('/\s+/', '_', uniqid() . '_' . date('dmY') . '_' . $clientCode . '.' . $file->getClientOriginalExtension());

            if ($this->checkFile($type, $fileName, true)) {
                return $this->putFile($type, $file);
            }

            $file->storeAs($this->storageDisk($type), $fileName);

            return $this->transformName($type, $fileName);
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            throw $th;
        }
    }

    /**
     * Delete file in storage app
     *
     * @param UploadFileType $type
     * @param string $file
     *
     * @return bool
     */
    protected function deleteFile(UploadFileType $type, $file)
    {
        try {
            if (!$this->checkFile($type, $file)) return false;

            $parsedFile = $this->parseImage($file);
            Storage::delete($this->storageDisk($type) . $parsedFile);

            return true;
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            throw $th;
        }
    }

    /**
     * Check file in storage app
     *
     * @param UploadFileType $type
     * @param string $file
     * @param bool $save
     *
     * @return bool
     */
    protected function checkFile(UploadFileType $type, $file, $save = false)
    {
        try {
            $parsedFile = $save ? $file : $this->parseImage($file);
            return Storage::exists($this->storageDisk($type) . $parsedFile);
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            throw $th;
        }
    }

    /**
     * Save single file to storage app
     *
     * @param UploadFileType $type
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function saveSingleFile(UploadFileType $type, $file)
    {
        try {
            if (is_null($file)) {
                return null;
            }

            return $this->putFile($type, $file);
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            throw $th;
        }
    }

    /**
     * Update old file with the new one
     *
     * @param UploadFileType $type
     * @param UploadedFile $file
     * @param string $old_file
     *
     * @return string
     */
    protected function updateSingleFile(UploadFileType $type, $file, $old_file)
    {
        try {
            if (is_null($file)) return null;

            if (!$this->checkFile($type, $old_file)) {
                return $this->putFile($type, $file);
            }

            $this->deleteFile($type, $old_file);

            return $this->updateSingleFile($type, $file, $old_file);
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            throw $th;
        }
    }
}
