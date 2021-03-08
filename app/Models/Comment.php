<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function posts()
    {
        return $this->belongsTo('App\Post');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    protected $fillable = [
        'post_id','content',
    ];
}
