<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Daniel Méndez',
            'email' => 'dmendez@admin.com',
            'password' => bcrypt('123456')
        ]);

        Post::factory()->count(10)->create();
        Product::factory()->count(10)->create();
    }

}

// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         // \App\Models\User::factory(10)->create();
//     }
// }
