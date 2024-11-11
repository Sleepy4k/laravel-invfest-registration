<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use App\Enums\StorageBaseType;
use App\Enums\UploadFileType;
use App\Traits\HasUUID;
use App\Traits\UploadFile;
use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, HasUUID, Cacheable, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'method_id',
        'proof',
        'status',
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
            'status' => PaymentStatus::class,
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
            'prefix' => 'payment.cache',
        ];

        return array_merge(config('cacheable'), $overrided);
    }

    /**
     * Define team relationship
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    /**
     * Define method relationship
     */
    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'method_id', 'id');
    }

    /**
     * Set proof attribute.
     */
    public function setProofAttribute($value)
    {
        $this->attributes['proof'] = $this->saveSingleFile(UploadFileType::IMAGE, $value, StorageBaseType::PRIVATE);
    }
}
