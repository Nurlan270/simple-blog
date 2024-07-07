<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title', 'content',
        'views',
        'image'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
         return User::query()
             ->where('id', $this->author_id)
             ->value('name')
             ?? 'Unknown author';
    }
}
