<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Concerns\UnIncreaseAble;
use App\Enums\ActivityEventType;
use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CompetitionLevel extends Model
{
    use HasFactory, HasUuid, UnIncreaseAble, LogsActivity, Cacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'level',
        'display_as'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'created_at' => 'datetime:Y-m-d',
            'updated_at' => 'datetime:Y-m-d',
        ];
    }

    /**
     * The cacheable properties that should be cached.
     *
     * @return array
     */
    public function getCacheableProperties(): array {
        $overrided = [
            'prefix' => 'competition.level.cache',
        ];

        return array_merge(config('cacheable'), $overrided);
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
            ->useLogName(ActivityEventType::MODEL->value)
            ->setDescriptionForEvent(fn (string $eventName) => sprintf('Model %s berhasil %s', $this->table, $eventName))
            ->dontSubmitEmptyLogs();
    }

    /**
     * Define competition relationship
     */
    public function competition()
    {
        return $this->hasMany(Competition::class, 'level_id', 'id');
    }
}
