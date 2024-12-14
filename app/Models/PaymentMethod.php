<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Concerns\Loggable;
use App\Concerns\MakeCacheable;
use App\Concerns\UnIncreaseAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory, HasUuid, UnIncreaseAble, Loggable, MakeCacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'logo',
        'number',
        'owner',
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
        return 'payment.method.cache';
    }

    /**
     * Define payment relationship
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'method_id', 'id');
    }
}
