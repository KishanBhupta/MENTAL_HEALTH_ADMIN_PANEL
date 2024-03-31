<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        "users_id",
        "imageUrl",
        "postText",
        "postDescription",
        "isAnonymous",
        "likes",
        "comments",
        "postStatus",
    ];

    public function withLikes() : HasMany {
        return $this->hasMany(PostLikes::class, 'posts_id','id');
    }

    public function postUser() : BelongsTo {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function getSavedPost() : Hasmany{
        return $this->hasMany(SavedPosts::class,'posts_id','id');
    }

}
