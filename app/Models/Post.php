<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'posts';

    public $translatable = ['title', 'content', 'excerpt'];

    protected $fillable = ['title', 'content', 'excerpt', 'status'];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'excerpt' => 'array',
    ];
}