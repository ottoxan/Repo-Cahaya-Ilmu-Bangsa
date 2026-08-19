<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    protected $connection = 'loa';
    protected $table = 'submissions';

    protected $casts = [
        'user_id' => 'integer',
        'journal_id' => 'integer',
        'date_of_loa' => 'date',
        'submission_date' => 'date',
        'approved_date' => 'date',
        'rejected_date' => 'date',
        'authors' => 'array',
    ];

    public function journal(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessor to map status category dynamically based on journal slug
    public function getCategoryAttribute()
    {
        $slug = $this->journal?->slug ?? '';
        
        switch ($slug) {
            case 'sindoro':
            case 'argopuro':
                return 'Pendidikan';
            case 'trigonometri':
            case 'kohesi':
            case 'hibrida':
            case 'medicnutricia':
            case 'jayabama':
                return 'Sains & Teknologi';
            case 'musytari':
            case 'panorama':
            case 'ijefi':
                return 'Ekonomi';
            default:
                return 'Kebudayaan';
        }
    }

    // Accessor for dynamic published date compatibility
    public function getPublishedDateAttribute()
    {
        return $this->approved_date ?: $this->date_of_loa;
    }

    // Accessor to return virtual slug
    public function getSlugAttribute()
    {
        return 'submission-' . $this->id;
    }

    // Accessor for authors clean name list compatibility
    public function getAuthorsAttribute($value)
    {
        $authorsArray = is_string($value) ? json_decode($value, true) : $value;
        return collect($authorsArray ?? [])
            ->map(fn($author) => $author['name'] ?? '')
            ->filter()
            ->values()
            ->toArray();
    }

    // Read-only safeguards
    public function save(array $options = [])
    {
        throw new \Exception('Model Submission is read-only in Repository.');
    }

    public function delete()
    {
        throw new \Exception('Model Submission is read-only in Repository.');
    }
}
