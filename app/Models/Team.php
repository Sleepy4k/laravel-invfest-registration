<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Concerns\Loggable;
use App\Concerns\MakeCacheable;
use App\Concerns\UnIncreaseAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory, HasUuid, UnIncreaseAble, Loggable, MakeCacheable;

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
     * Set the cache prefix.
     *
     * @return string
     */
    public function setCachePrefix(): string {
        return 'team.cache';
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
    public function members()
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
