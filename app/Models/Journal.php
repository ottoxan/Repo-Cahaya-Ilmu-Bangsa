<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $connection = 'loa';

    protected $fillable = [
        'name',
        'slug',
        'identifier',
        'image',
        'link',
        'template_link',
        'ojs_base_url',
        'ojs_secret_key',
    ];

    public function save(array $options = [])
    {
        throw new \Exception('Model Journal is read-only in Repository.');
    }

    public function delete()
    {
        throw new \Exception('Model Journal is read-only in Repository.');
    }
}
