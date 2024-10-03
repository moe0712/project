<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('reports')->insert([
            [
                'user_id' => 1,
                'post_id' => 2,
                'reason_type' => 'Spam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'post_id' => 1,
                'reason_type' => 'Inappropriate content',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
