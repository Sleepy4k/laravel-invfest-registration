<?php

namespace App\Models;

use App\Observers\OtpObserver;
use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(OtpObserver::class)]
class Otp extends Model
{
    use HasFactory, Cacheable;

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
     * The cacheable properties that should be cached.
     *
     * @return array
     */
    public function getCacheableProperties(): array {
        $overrided = [
            'prefix' => 'otp.cache',
        ];

        return array_merge(config('cacheable'), $overrided);
    }

    /**
     * Define otp belong to user relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
