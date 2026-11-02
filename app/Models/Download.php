<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'file_path',
        'file_extension',
        'file_size',
        'download_count',
        'description',
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
                $item->slug = Str::slug($item->title);
            }
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('created_at', 'desc');
    }

    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . ($units[$i] ?? 'B');
    }
}

