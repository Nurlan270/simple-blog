<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'user_id',
        'comment',
    ];

    public function author()
    {
        return User::query()->where('id', $this->user_id)->value('name')
            ?? 'Unknown author';
    }

    public function post_title()
    {
        return Post::query()->where('id', $this->post_id)->value('title')
            ?? 'Unknown post';
    }

    public function post_id()
    {
        return Post::query()->where('id', $this->post_id)->value('id');
    }
}
