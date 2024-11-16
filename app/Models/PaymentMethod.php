<?php

namespace App\Models;

use App\Observers\PaymentMethodObserver;
use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(PaymentMethodObserver::class)]
class PaymentMethod extends Model
{
    use HasFactory, Cacheable;

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
     * The cacheable properties that should be cached.
     *
     * @return array
     */
    public function getCacheableProperties(): array {
        $overrided = [
            'prefix' => 'payment.method.cache',
        ];

        return array_merge(config('cacheable'), $overrided);
    }

    /**
     * Define payment relationship
     */
    public function payment()
    {
        return $this->hasMany(Payment::class, 'method_id', 'id');
    }
}
