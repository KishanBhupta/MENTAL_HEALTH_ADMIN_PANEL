<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppFeedbacks extends Model
{
    use HasFactory;

    protected $fillable = [
        "firstName",
        "feedbackData",
        "feedbackRating"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

}
