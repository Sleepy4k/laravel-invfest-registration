<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Concerns\Loggable;
use App\Concerns\MakeCacheable;
use App\Concerns\UnIncreaseAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory, HasUuid, UnIncreaseAble, Loggable, MakeCacheable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_otp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'otp',
        'expired_at',
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
            'expired_at' => 'datetime:Y-m-d',
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
        return 'otp.cache';
    }

    /**
     * Define otp belong to user relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
