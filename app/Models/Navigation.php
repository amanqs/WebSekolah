<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Navigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'url',
        'route_name',
        'target',
        'type',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Navigation::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Navigation::class, 'parent_id')->orderBy('order', 'asc');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeHeader(Builder $query): Builder
    {
        return $query->where('type', 'header');
    }

    public function scopeFooter(Builder $query): Builder
    {
        return $query->where('type', 'footer');
    }

    public function scopeRoots(Builder $query): Builder
    {
        return $query->whereNull('parent_id')->orderBy('order', 'asc');
    }

    public function getResolvedUrlAttribute(): string
    {
        if ($this->route_name && \Illuminate\Support\Facades\Route::has($this->route_name)) {
            return route($this->route_name);
        }

        if ($this->url) {
            if (str_starts_with($this->url, 'http://') || str_starts_with($this->url, 'https://') || str_starts_with($this->url, '#')) {
                return $this->url;
            }
            return url($this->url);
        }

        return '#';
    }

    public function getIsActiveUrlAttribute(): bool
    {
        if ($this->route_name && \Illuminate\Support\Facades\Route::has($this->route_name)) {
            return request()->routeIs($this->route_name) || request()->routeIs(explode('.', $this->route_name)[0] . '.*');
        }

        if ($this->url) {
            $currentPath = trim(request()->getPathInfo(), '/');
            $targetPath = trim(parse_url($this->url, PHP_URL_PATH) ?? '', '/');
            return !empty($targetPath) && $currentPath === $targetPath;
        }

        return false;
    }

    public function getHasActiveChildAttribute(): bool
    {
        if ($this->relationLoaded('children')) {
            return $this->children->contains(fn ($child) => $child->is_active_url);
        }

        return $this->children()->get()->contains(fn ($child) => $child->is_active_url);
    }
}

