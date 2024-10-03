<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => 1,
                'title' => 'First Post',
                'date' => now(),
                'image' => 'post1.png',
                'episode' => 'This is the first post.',
                'del_flag' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Second Post',
                'date' => now(),
                'image' => 'post2.png',
                'episode' => 'This is the second post.',
                'del_flag' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
