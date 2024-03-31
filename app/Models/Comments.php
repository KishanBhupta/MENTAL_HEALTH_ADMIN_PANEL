<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;


class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        "posts_id",
        "users_id",
        "isAnonymous",
        "commentDescription",
        "likes",
        "commentStatus",
    ];

    public function withLikes() : HasMany {
        return $this->hasMany(commentLike::class, 'posts_id','id');
    }
    public function commentUser() : BelongsTo {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
