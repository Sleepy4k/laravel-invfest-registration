<?php

namespace App\Models;

use App\Traits\HasUUID;
use ElipZis\Cacheable\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory, HasUUID, Cacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'date',
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
            'date' => 'string',
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
            'prefix' => 'timeline.cache',
        ];

        return array_merge(config('cacheable'), $overrided);
    }

    /**
     * Get date attribute.
     */
    public function getDateAttribute($value)
    {
        return date('d F Y', strtotime($value));
    }

    /**
     * Set query to be sorted ascending by their date value
     */
    public function scopeOrderByDate($query)
    {
        return $query->orderBy('date', 'asc');
    }
}
