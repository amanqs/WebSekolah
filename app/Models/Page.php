<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'banner_image',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function boot(): void
    {
        parent::boot();
        static::saving(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
            if (empty($page->meta_title)) {
                $page->meta_title = $page->title;
            }
            if (empty($page->meta_description)) {
                $page->meta_description = Str::limit(strip_tags($page->content), 160);
            }
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}

