<?php

namespace App\Models;

use App\Enums\UploadFileType;
use App\Traits\HasUUID;
use App\Traits\UploadFile;
use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Competition extends Model
{
    use HasFactory, HasUUID, Cacheable, UploadFile;

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
     * Set poster attribute.
     */
    public function setPosterAttribute($value)
    {
        $this->attributes['poster'] = $value ? $this->saveSingleFile(UploadFileType::IMAGE, $value) : null;
    }

    /**
     * Set guidebook attribute.
     */
    public function setGuidebookAttribute($value)
    {
        $this->attributes['guidebook'] = $value ? $this->saveSingleFile(UploadFileType::FILE, $value) : null;
    }

    /**
     * Set the competition's slug.
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get the registration fee rupiah format.
     */
    public function getRegistrationFeeRupiahAttribute()
    {
        return 'Rp ' . number_format($this->registration_fee || 0, 0, ',', '.');
    }
}
