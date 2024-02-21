<?php

/*



*/

namespace Database\Seeders;

use App\Models\Comments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comments::create([
            "posts_id"=>1,
            "users_id"=>1,
            "isAnonymous"=>0,
            "commentDescription"=>"This is a comment about a comment on a comment for testing purposes and for testing purposes",
            "commentStatus"=>0,
        ]);


        Comments::create([
            "posts_id"=>2,
            "users_id"=>2,
            "isAnonymous"=>1,
            "commentDescription"=>"This is a comment about a comment on a comment for testing purposes and for testing purposes for anonymous purposes",
            "commentStatus"=>1,
        ]);
    }
}
