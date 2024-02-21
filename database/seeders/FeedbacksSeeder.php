<?php

/*
Seeder to generate dummy feedback data for testing
*/

namespace Database\Seeders;

use App\Models\AppFeedbacks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppFeedbacks::create([
            "users_id" => 1,
            "feedbackData" => "This is dummy feedback data for this feedback",
            "feedbackRating"=>"5"
        ]);

        AppFeedbacks::create([
            "users_id" => 1,
            "feedbackData" => "This is dummy feedback data for this feedback second time",
            "feedbackRating"=>"3"
        ]);
    }
}
