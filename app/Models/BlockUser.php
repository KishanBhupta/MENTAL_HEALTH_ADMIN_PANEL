<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class BlockUser extends Model
{
    use HasFactory;

    public $fillable = [
        "users_id",
        "block_users_id",
        "status",
    ];

    public function blockedUser() : BelongsTo {
        return $this->belongsTo(User::class,'block_users_id','id');
    }
}
