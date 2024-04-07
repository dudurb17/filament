<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'eduardo',
            'email' => 'eduardo@gmail.com',
            'password' => '12345678',
            'avatar'=>'https://avatars.githubusercontent.com/u/114515828?s=96&v=4'
        ]);
         User::factory(10)->create();
         $this->call([
         \Database\Seeders\AddressSeeder::class
         ]);

    }
}
