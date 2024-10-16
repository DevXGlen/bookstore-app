<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Book::truncate();
        $faker = Faker::create();
        $instances = $faker->numberBetween(100, 200);
        for ($i = 0; $i < $instances; $i++) {
            Book::upsert([
                'name' => $faker->sentence(2),
                'author' => $faker->name(),
            ], ['name', 'author'], ['name', 'author', 'image']);
        }

    }
}
