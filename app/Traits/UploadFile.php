<?php

namespace App\Traits;

use App\Enums\ReportLogType;
use App\Enums\UploadFileType;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

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
     * Optimize image
     *
     * @param string $file
     *
     * @return bool
     */
    protected function optimizeImage($file)
    {
        try {
            ImageOptimizer::optimize($file);

            return true;
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
            $name = request()->getSchemeAndHttpHost() . '/storage';

            $name .= match ($type) {
                UploadFileType::IMAGE => '/' . UploadFileType::IMAGE->value . '/' . $file,
                UploadFileType::FILE => '/' . UploadFileType::FILE->value . '/' . $file,
                UploadFileType::SETTING => '/' . UploadFileType::SETTING->value . '/' . $file,
                default => '/' . $this->unkownPath . '/' . $file,
            };

            return $name;
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
            $parse = parse_url($file);
            $pathSegments = explode('/', $parse['path'] ?? '');
            $name = null;

            $total = count($pathSegments);
            if ($total > 0 && isset($pathSegments[$total - 1])) {
                $name = $pathSegments[$total - 1];
            }

            return $name;
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
            if (auth('web')->check()) {
                $user = auth('web')->user();
                $clientCode = $user->id . '_' . $user->created_at->format('dmY');
            } else {
                $clientCode = rand(1, 999) . '_' . date('His');
            }

            $fileName = preg_replace('/\s+/', '_', uniqid() . '_' . date('dmY') . '_' . $clientCode . '.' . $file->getClientOriginalExtension());

            if ($this->checkFile($type, $fileName, true)) {
                return $this->putFile($type, $file);
            }

            $file->storeAs($this->storageDisk($type), $fileName);

            if ($type !== UploadFileType::FILE->value) {
                $this->optimizeImage(storage_path('app\\public\\' . $this->storageDisk($type) . $fileName));
            }

            $fileName = $this->transformName($type, $fileName);

            return $fileName;
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
            if ($this->checkFile($type, $file)) {
                $parsedFile = $this->parseImage($file);

                Storage::delete($this->storageDisk($type) . $parsedFile);

                return true;
            }

            return false;
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
            if ($save) {
                $parsedFile = $file;
            } else {
                $parsedFile = $this->parseImage($file);
            }

            if (Storage::exists($this->storageDisk($type) . $parsedFile)) {
                return true;
            }

            return false;
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
            if (is_null($file)) {
                return null;
            }

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
