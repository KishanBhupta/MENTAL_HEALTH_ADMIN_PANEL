<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins'; // Specify the table name if it's different from the default naming convention

    protected $fillable = [
        'adminName', // Add other fields here as needed
        'adminEmail',
        // Add other fields here as needed
    ];

    // You can define relationships, accessors, mutators, and other methods here if needed
}