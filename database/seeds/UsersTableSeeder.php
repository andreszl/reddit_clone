<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        \DB::table('users')->insert(array(
            [
                'id' => 1,
                'role_id' => 1,
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('user'),
                'remember_token' => str_random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'role_id' => 2,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'remember_token' => str_random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ));
    }
}
