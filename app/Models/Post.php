<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'content','status',
    ];

    public function scopeShowpost($query)
    {
        return $query->where('status', 'public');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    protected static function booted()
    {
        static::created(function ($post) {
            $post->content = $post->content;
            $post->status = $post->status;
        });
    }
}
