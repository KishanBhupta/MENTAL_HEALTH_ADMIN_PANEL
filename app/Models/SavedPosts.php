<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SavedPosts extends Model
{
    use HasFactory;

    public $fillable = [
        "users_id",
        "posts_id",
    ];

    public function savedPost() : BelongsTo {
        return $this->belongsTo(Posts::class, 'posts_id','id');
    }

    public function savedPostUser() : BelongsTo {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
