<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Teacher extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'nip',
        'nuptk',
        'position',
        'subject',
        'type',
        'photo',
        'phone',
        'email',
        'bio',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order', 'asc');
    }

    public function scopeGuru(Builder $query): Builder
    {
        return $query->where('type', 'guru');
    }

    public function scopeTendik(Builder $query): Builder
    {
        return $query->where('type', 'tendik');
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->getFirstMediaUrl('photo')) {
            return $this->getFirstMediaUrl('photo');
        }

        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=1e40af&color=fff&size=256';
    }
}

