<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        \DB::table('roles')->insert(array(
            [
                'name' => 'user',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci explicabo quam fugit eos id nobis, error maiores ipsam ut eaque, corporis, perspiciatis temporibus nihil magnam ea quibusdam voluptate obcaecati. Magnam!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'admin',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident facilis qui nemo totam hic aliquid possimus corrupti eum non quaerat eaque, sapiente adipisci nostrum quas neque delectus voluptate, fugit esse!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ));
    }
}
