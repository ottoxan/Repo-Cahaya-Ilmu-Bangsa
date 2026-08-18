<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $table = 'repository_articles';

    protected $fillable = [
        'user_id',
        'journal_id',
        'title',
        'slug',
        'abstract',
        'authors',
        'keywords',
        'publisher',
        'doi',
        'volume',
        'issue',
        'pages',
        'published_date',
        'pdf_path',
        'ojs_url',
        'category',
        'status',
    ];

    protected $casts = [
        'authors' => 'array',
        'published_date' => 'date',
    ];

    // Boot method to generate unique slug if not set
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $slug = Str::slug($article->title);
                $originalSlug = $slug;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $article->slug = $slug;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }

    public function downloadLogs()
    {
        return $this->hasMany(DownloadLog::class);
    }

    // Get DOI URL helper
    public function getDoiUrlAttribute()
    {
        if (empty($this->doi)) {
            return null;
        }
        return Str::startsWith($this->doi, 'http') ? $this->doi : 'https://doi.org/' . $this->doi;
    }

    // Get PDF URL helper (Using Symlink storage path)
    public function getPdfUrlAttribute()
    {
        if (empty($this->pdf_path)) {
            return null;
        }
        return asset('storage/' . $this->pdf_path);
    }
}
