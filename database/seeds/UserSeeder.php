<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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

        # Run through this loop 200 times (create 200 users) with the password as 'tester'
        for ($i = 0; $i < 1000; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->email, # Generate random email
                'username' => strtolower($faker->unique()->userName), # Generate random username
                'password' => bcrypt('tester'), # Make the password 'tester'
                'first_name' => $faker->unique()->firstNameMale, # Generate random first name
                'last_name' => $faker->unique()->lastName, # Generate random last name
                'location' => $faker->unique()->country, # Generate random country
                'biography' => $faker->unique()->catchPhrase, # Generate random biography
                'ip' => $faker->unique()->ipv4, # Generate random IPv4 address
            ]);
        }
    }
}
