<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    use HasFactory;

    public $fillable = [
        "users_id",
        "followerId",
        "isFollowing",
        "isRequested"
    ];
}
