<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SonSeeder::class);
        $this->call(GrandsonSeeder::class);

        Post::factory(100)->create();

        
    }
}
