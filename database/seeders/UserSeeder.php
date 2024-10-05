<?php

/*

Class to seed users for testing

*/

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "firstName" => "John",
            "lastName" => "Carter",
            "email" => "john@example.com",
            "password" => bcrypt("123456"),
            "phoneNumber" => "1234567890",
            "isBlocked" => false,
        ]);


        User::create([
            "firstName" => "Alex",
            "lastName" => "Mason",
            "email" => "alex@example.com",
            "password" => bcrypt("123456"),
            "phoneNumber" => "1234567890",
            "isBlocked" => 0,
        ]);

        User::create([
            "firstName" => "Aatman",
            "lastName" => "Kacha",
            "email" => "aatmankacha@gmail.com",
            "password" => bcrypt("123456"),
            "phoneNumber" => "1234567890",
            "isBlocked" => 0,
        ]);
    }
}
