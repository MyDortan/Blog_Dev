<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [
      'id'
    ];

    public function tags()
    {
        $this->hasMany('App\Models\Tag');
    }

    public function comments()
    {
        $this->hasMany('App\Models\Comment');
    }
}
