<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reports;

class ReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // user
         Reports::create([
            "users_id"=>1,
            "reportedUserId"=>2,
            "reportReason"=>"Testing Report For User",
            "reportStatus"=>"Waiting for approval",
        ]);

        // post
        Reports::create([
            "users_id"=>1,
            "reportedPostId"=>1,
            "reportReason"=>"Testing Report For Post",
            "reportStatus"=>"Waiting for approval",
        ]);

        // comment
        Reports::create([
            "users_id"=>1,
            "reportedCommentId"=>1,
            "reportReason"=>"Testing Report For Comment",
            "reportStatus"=>"Waiting for approval",
        ]);
    }
}
