<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

use App\Models\News;
use App\Models\Teacher;
use App\Models\Extracurricular;

class GenerateSlugs extends Command
{
    protected $signature   = 'slugs:generate';
    protected $description = 'Generate slug untuk data lama yang belum punya slug';

    public function handle()
    {
        $this->info('Generating slugs...');
        $this->newLine();

        // News
        $news = News::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($news as $item) {
            $item->slug = $this->uniqueSlug(News::class, $item->judul, $item->id);
            $item->save();
        }
        $this->info("News           : {$news->count()} slug generated");

        // Teacher
        $teachers = Teacher::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($teachers as $item) {
            $item->slug = $this->uniqueSlug(Teacher::class, $item->nama_guru, $item->id);
            $item->save();
        }
        $this->info("Guru           : {$teachers->count()} slug generated");

        // Extracurricular
        $ekskul = Extracurricular::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($ekskul as $item) {
            $item->slug = $this->uniqueSlug(Extracurricular::class, $item->nama_ekskul, $item->id);
            $item->save();
        }
        $this->info("Ekstrakurikuler: {$ekskul->count()} slug generated");

        $this->newLine();
        $this->info('Done. Semua slug sudah terisi.');
    }

    // Generate slug unik, hindari duplikat dengan baris lain
    private function uniqueSlug(string $model, string $source, int $ignoreId): string
    {
        $slug     = Str::slug($source);
        $original = $slug;
        $count    = 1;

        while ($model::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = $original . '-' . ++$count;
        }

        return $slug;
    }
}