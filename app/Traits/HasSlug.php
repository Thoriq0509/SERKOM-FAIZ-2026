<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Boot trait — auto-generate slug saat create
     */
    public static function bootHasSlug()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug();
            }
        });
    }

    /**
     * Generate slug unik (auto-handle duplikat)
     */
    public function generateUniqueSlug(): string
    {
        $source = $this->{$this->slugSource()};
        $slug   = Str::slug($source);

        $original = $slug;
        $count    = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . ++$count;
        }

        return $slug;
    }

    /**
     * Field sumber slug — override di model
     */
    public function slugSource(): string
    {
        return 'judul';
    }
}