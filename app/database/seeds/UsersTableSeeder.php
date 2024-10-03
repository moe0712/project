<?php  
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'image' => 'default.png',
                'prfile' => 'Profile of John Doe',
                'role' => 1,
                'del_fig' => 0,
                'reset_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'image' => 'default.png',
                'prfile' => 'Profile of Jane Doe',
                'role' => 0,
                'del_fig' => 0,
                'reset_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

