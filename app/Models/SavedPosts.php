<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedPosts extends Model
{
    use HasFactory;

    public $fillable = [
        "users_id",
        "posts_id",
    ];
}
