<?php

namespace App\Models;

use App\Enums\ActivityEventType;
use App\Observers\CompetitionObserver;
use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

#[ObservedBy(CompetitionObserver::class)]
class Competition extends Model
{
    use HasFactory, LogsActivity, Cacheable;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'level_id',
        'description',
        'poster',
        'guidebook',
        'registration_fee',
        'whatsapp_group',
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
            'prefix' => 'competition.cache',
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
     * Define level relationship
     */
    public function level()
    {
        return $this->belongsTo(CompetitionLevel::class, 'level_id', 'id');
    }

    /**
     * Define team relationship
     */
    public function team()
    {
        return $this->hasMany(Team::class, 'competition_id', 'id');
    }

    /**
     * Get the registration fee rupiah format.
     */
    public function getRegistrationFeeRupiahAttribute()
    {
        return 'Rp ' . number_format($this->registration_fee ?? 0, 0, ',', '.');
    }
}
