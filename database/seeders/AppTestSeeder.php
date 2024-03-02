<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // create faq user with posts
        User::factory(5)->hasPosts(5)->create();

        // create Custom user To use it
        User::factory()->hasPosts(5)->create([
            'name' => 'User',
            'email' => 'user@tadafuq.com',
            'password' => bcrypt('password@123'),
            'phone' => '1234567891',
            'user_name' => 'User 1'
        ]);

        // create Admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@tadafuq.com',
            'password' => bcrypt('password@123'),
            'phone' => '1234567890',
            'user_name' => 'admin',
            'is_admin' => true
        ]);
    }
}
