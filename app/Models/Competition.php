<?php

namespace App\Models;

use App\Concerns\HasUuid;
use App\Concerns\Loggable;
use App\Concerns\MakeCacheable;
use App\Concerns\UnIncreaseAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory, HasUuid, UnIncreaseAble, Loggable, MakeCacheable;

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
     * Set the cache prefix.
     *
     * @return string
     */
    public function setCachePrefix(): string {
        return 'competition.cache';
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
        return 'Rp '.number_format($this->registration_fee ?? 0, 0, ',', '.');
    }
}
