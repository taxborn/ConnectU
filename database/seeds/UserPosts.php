<?php

use Illuminate\Database\Seeder;
use ConnectU\Models\User;

class UserPosts extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        # Initialize Faker
        $faker = Faker\Factory::create();

        # Run through this loop 50 times (create 50 posts)
        for ($i = 0; $i < 50; $i++) {
            DB::table('statuses')->insert([
                'user_id' =>  $random_user = User::orderByRaw("RAND()")->first()->id, # Generate random user id with existing user ids
                'body' => $faker->unique()->realText($maxNbChars = 200), # Generate random text block
            ]);
        }
    }
}
