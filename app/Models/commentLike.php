<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commentLike extends Model
{
    use HasFactory;

        public $fillable = [
        "comment_id",
        "users_id"
    ];
}
