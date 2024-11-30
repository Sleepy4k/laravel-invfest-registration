<?php

namespace App\Models;

use App\Observers\TeamObserver;
use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

#[ObservedBy(TeamObserver::class)]
class Team extends Model
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
        'competition_id',
        'name',
        'institution',
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
            'prefix' => 'team.cache',
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
            ->useLogName('model')
            ->setDescriptionForEvent(fn (string $eventName) => sprintf('Model %s berhasil %s', $this->table, $eventName))
            ->dontSubmitEmptyLogs();
    }

    /**
     * Define competition relationship
     */
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'id');
    }

    /**
     * Define payment relationship
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'team_id', 'id');
    }

    /**
     * Define leader relationship
     */
    public function leader()
    {
        return $this->hasOne(TeamLeader::class, 'team_id', 'id');
    }

    /**
     * Define member relationship
     */
    public function member()
    {
        return $this->hasMany(TeamMember::class, 'team_id', 'id');
    }

    /**
     * Define companion relationship
     */
    public function companion()
    {
        return $this->hasOne(TeamCompanion::class, 'team_id', 'id');
    }

    /**
     * Get the submission for the team.
     */
    public function submission()
    {
        return $this->hasOne(Submission::class, 'team_id', 'id');
    }
}
