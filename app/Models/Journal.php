<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

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
}
