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

class SponsorshipTier extends Model
{
    use HasFactory, HasUuid, UnIncreaseAble, LogsActivity, Cacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tier',
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
            'prefix' => 'sponsorship.tier.cache',
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
     * Define sponsorship relationship
     */
    public function sponsorship()
    {
        return $this->hasMany(Sponsorship::class, 'tier_id', 'id');
    }
}
