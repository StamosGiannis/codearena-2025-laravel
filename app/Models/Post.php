<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'title',
        'description',
        'body',
        'image',
        'slug',
        'published_at',
        'user_id',
        'promoted',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
