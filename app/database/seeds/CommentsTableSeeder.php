<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            [
                'user_id' => 1,
                'post_id' => 1,
                'text' => 'This is a comment on the first post.',
                'comment_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'post_id' => 2,
                'text' => 'This is a comment on the second post.',
                'comment_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}


