<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $posts = factory(\App\Post::class, 20)->create();

        $posts = factory(\App\Post::class, 5)->create([
            'user_id' => 1
        ]);
    }
}
