<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Concerns\Loggable;
use App\Concerns\MakeCacheable;
use App\Concerns\UnIncreaseAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory, HasUuid, UnIncreaseAble, Loggable, MakeCacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'title',
        'file',
        'is_reviewed',
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
            'is_reviewed' => 'boolean',
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
        return 'submission.cache';
    }

    /**
     * Define team relationship
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
