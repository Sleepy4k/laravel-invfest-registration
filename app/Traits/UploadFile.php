<?php

namespace App\Traits;

use App\Enums\ReportLogType;
use App\Enums\StorageBaseType;
use App\Enums\UploadFileType;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;

trait UploadFile
{
    use SystemLog;

    /**
     * Set path root when unkown file.
     */
    protected $unkownPath = 'unkown';

    /**
     * Set path for storage when upload file.
     *
     * @param string $type
     * @param StorageBaseType $baseDisk
     *
     * @return string
     */
    protected function storageDisk(UploadFileType $type = UploadFileType::IMAGE, StorageBaseType $baseDisk = StorageBaseType::PUBLIC)
    {
        try {
            $path = match ($type) {
                UploadFileType::IMAGE => '/' . $baseDisk . '/' . UploadFileType::IMAGE->value . '/',
                default => '/' . $baseDisk . '/' . $this->unkownPath . '/',
            };

            if (!Storage::exists(explode('/', $path)[2])) {
                Storage::copy($baseDisk . '/index.html', $path . 'index.html');
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
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($file);

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
            $name = explode('/', $parse['path'])[3];

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
     * @param StorageBaseType $baseDisk
     *
     * @return string
     */
    protected function putFile(UploadFileType $type, $file, StorageBaseType $baseDisk = StorageBaseType::PUBLIC)
    {
        try {
            if (auth('web')->check()) {
                $user = auth('web')->user();
                $clientCode = $user->id . '_' . $user->created_at->format('dmY');
            } else {
                $clientCode = rand(1, 999) . '_' . date('His');
            }

            $fileName = preg_replace('/\s+/', '_', uniqid() . '_' . date('dmY') . '_' . $clientCode . '.' . $file->getClientOriginalExtension());

            if ($this->checkFile($type, $fileName, true, $baseDisk)) {
                return $this->putFile($type, $file, $baseDisk);
            }

            $file->storeAs($this->storageDisk($type, $baseDisk), $fileName);

            if ($type != UploadFileType::FILE) {
                $this->optimizeImage(storage_path('app/' . $this->storageDisk($type, $baseDisk) . $fileName));
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
     * @param StorageBaseType $baseDisk
     *
     * @return bool
     */
    protected function deleteFile(UploadFileType $type, $file, StorageBaseType $baseDisk = StorageBaseType::PUBLIC)
    {
        try {
            if ($this->checkFile($type, $file, $baseDisk)) {
                $parsedFile = $this->parseImage($file);

                Storage::delete($this->storageDisk($type, $baseDisk) . $parsedFile);

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
     * @param StorageBaseType $baseDisk
     *
     * @return bool
     */
    protected function checkFile(UploadFileType $type, $file, $save = false, StorageBaseType $baseDisk = StorageBaseType::PUBLIC)
    {
        try {
            $parsedFile = $save ? $file : $this->parseImage($file);

            return Storage::exists($this->storageDisk($type, $baseDisk) . $parsedFile);
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
     * @param StorageBaseType $baseDisk
     *
     * @return string
     */
    protected function saveSingleFile(UploadFileType $type, $file, StorageBaseType $baseDisk = StorageBaseType::PUBLIC)
    {
        try {
            return is_null($file) ? null : $this->putFile($type, $file, $baseDisk);
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
     * @param StorageBaseType $baseDisk
     *
     * @return string
     */
    protected function updateSingleFile(UploadFileType $type, $file, $old_file, StorageBaseType $baseDisk = StorageBaseType::PUBLIC)
    {
        try {
            if (is_null($file)) {
                return null;
            }

            if (!$this->checkFile($type, $old_file, $baseDisk)) {
                return $this->putFile($type, $file, $baseDisk);
            }

            $this->deleteFile($type, $old_file, $baseDisk);

            return $this->updateSingleFile($type, $file, $old_file, $baseDisk);
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            throw $th;
        }
    }
}
