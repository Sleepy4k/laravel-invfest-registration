<?php

namespace App\Concerns;

use App\Enums\ActivityEventType;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait Loggable
{
    use LogsActivity;

    /**
     * The spatie log name.
     *
     * @var string
     */
    protected static $logName = ActivityEventType::MODEL->value;

    /**
     * The parse description for the spatie log.
     *
     * @param string $eventName
     *
     * @return string
     */
    private function parseDescription(string $eventName): string
    {
        return sprintf('%s the %s %s', $eventName, $this->name, static::$logName);
    }

    /**
     * The spatie log that setting log option.
     *
     * @var bool
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable)
            ->useLogName(static::$logName)
            ->setDescriptionForEvent(fn (string $eventName) => $this->parseDescription($eventName))
            ->dontSubmitEmptyLogs();
    }
}
