<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reports extends Model
{
    use HasFactory;


    protected $fillable = [
        "users_id",
        "reportedUserId",
        "reportedPostId",
        "reportedCommentId",
        "reportReason",
        "reportStatus",
    ];


    public function user() : BelongsTo {
        return $this->belongsTo(User::class,"users_id","id");
    }

    public function reportedUser() : BelongsTo {
        return $this->belongsTo(User::class,"reportedUserId","id");
    }

    public function reportedPosts() : BelongsTo {
        return $this->belongsTo(Posts::class,"reportedPostId","id");
    }

    public function reportedComment() : BelongsTo {
        return $this->belongsTo(Comments::class,"reportedCommentId","id");
    }

}
