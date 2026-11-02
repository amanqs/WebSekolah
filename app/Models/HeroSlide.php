<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'cta_text',
        'cta_url',
        'secondary_cta_text',
        'secondary_cta_url',
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

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
        }

        return 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=1600&auto=format&fit=crop';
    }

    public function getResolvedCtaUrlAttribute(): ?string
    {
        if (!$this->cta_text || !$this->cta_url) {
            return null;
        }

        return (str_starts_with($this->cta_url, 'http://') || str_starts_with($this->cta_url, 'https://') || str_starts_with($this->cta_url, '#'))
            ? $this->cta_url
            : url($this->cta_url);
    }

    public function getResolvedSecondaryCtaUrlAttribute(): ?string
    {
        if (!$this->secondary_cta_text || !$this->secondary_cta_url) {
            return null;
        }

        return (str_starts_with($this->secondary_cta_url, 'http://') || str_starts_with($this->secondary_cta_url, 'https://') || str_starts_with($this->secondary_cta_url, '#'))
            ? $this->secondary_cta_url
            : url($this->secondary_cta_url);
    }
}

