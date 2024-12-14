<?php

namespace App\Traits;

use App\Enums\ReportLogType;
use Illuminate\Support\Facades\Log;

trait SystemLog
{
    /**
     * Send report to system log
     *
     * @param ReportLogType $type
     * @param string $message
     *
     * @return void
     */
    protected function sendReportLog(ReportLogType $type, string $message): void
    {
        match ($type) {
            ReportLogType::DEBUG => Log::debug($message),
            ReportLogType::ERROR => Log::error($message),
            ReportLogType::ALERT => Log::alert($message),
            ReportLogType::INFO => Log::info($message),
            ReportLogType::WARNING => Log::warning($message),
            default => Log::info($message),
        };
    }
}
