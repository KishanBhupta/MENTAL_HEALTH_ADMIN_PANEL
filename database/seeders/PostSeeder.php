<?php

/*

Seeder class for generating random Posts

*/

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Posts::create([
            "users_id"=>1,
            "isAnonymous"=>0,
            "imageUrl"=>"https://www.littlethings.info/wp-content/uploads/2014/04/dummy-image-green-e1398449160839-300x214.jpg",
            "postText"=>"This is dummy post text.",
            "postDescription"=>"This is generated description of the post you submitted to the database and will be displayed in the database when submitted  to the database server and when submitted to the database server again and will be displayed in the database when submitted to the database server again.",
            "likes"=>789,
            "comments"=>10,
            "postStatus"=>1,
        ]);

        Posts::create([
            "users_id"=>1,
            "isAnonymous"=>0,
            "imageUrl"=>"https://www.littlethings.info/wp-content/uploads/2014/04/dummy-image-green-e1398449160839-300x214.jpg",
            "postText"=>"This is dummy post text.",
            "postDescription"=>"This is generated description of the post you submitted to the database and will be displayed in the database when submitted  to the database server and when submitted to the database server again and will be displayed in the database when submitted to the database server again.",
            "likes"=>789,
            "comments"=>10,
            "postStatus"=>1,
        ]);
    }
}
