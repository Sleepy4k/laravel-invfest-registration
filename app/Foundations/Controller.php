<?php

namespace App\Foundations;

use App\Enums\ReportLogType;
use App\Traits\SystemLog;

abstract class Controller
{
    use SystemLog;

    /**
     * Handler try catch error.
     *
     * @param \Throwable $error
     *
     * @return \Illuminate\Http\Response
     */
    protected function redirectError(\Throwable $error)
    {
        $this->sendReportLog(ReportLogType::ERROR, $error->getMessage());

        return abort(403, $error->getMessage());
    }
}
