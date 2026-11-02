<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuNonTeks extends Model
{
    use HasFactory;

    protected $table = 'buku_non_teks';

    protected $fillable = [
        'title',
        'slug',
        'category',
        'author',
        'publisher',
        'published_year',
        'isbn',
        'cover_image',
        'file_path',
        'file_extension',
        'file_size',
        'download_count',
        'synopsis',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'download_count' => 'integer',
        'file_size' => 'integer',
    ];

    public static function boot(): void
    {
        parent::boot();
        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->title) . '-' . Str::random(5);
            }
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_image && Storage::disk('public')->exists($this->cover_image)) {
            return asset('storage/' . $this->cover_image);
        }

        if ($this->cover_image && filter_var($this->cover_image, FILTER_VALIDATE_URL)) {
            return $this->cover_image;
        }

        return 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&auto=format&fit=crop&q=80';
    }

    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes <= 0) {
            return 'E-Book PDF';
        }
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}

