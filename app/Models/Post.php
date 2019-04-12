<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;
use App\Models\Comment;

class Post extends Model
{
    protected $fillable = ['title', 'content'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo('User');
    }

}
