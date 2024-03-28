<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins'; // Specify the table name if it's different from the default naming convention

    protected $fillable = [
        'user_id', // Add other fields here as needed
        'adminEmail',
        'adminPassword'
        // Add other fields here as needed
    ];
    

    // You can define relationships, accessors, mutators, and other methods here if needed
}