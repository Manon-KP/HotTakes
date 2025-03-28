<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaucesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sauces')->insert([
            [
                'userId' => 1,
                'name' => 'Test Sauce',
                'manufacturer' => 'Test Company',
                'description' => 'Ceci est un test',
                'mainPepper' => 'Test Pepper',
                'imageUrl' => 'images/1742842094.jpg',
                'heat' => 1,
                'likes' => 0,
                'dislikes' => 0,
                'usersLiked' => '[]',
                'usersDisliked' => '[]',

            ],
        ]);

    }
}
