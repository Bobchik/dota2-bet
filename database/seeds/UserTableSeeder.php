<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'bobka',
            'email' => 'bobka@test.com',
            'password' => bcrypt('123456'),
            'player_id' => '111111',
            'coins' => 555,
            'rate' => '4500'
        ]);

        DB::table('users')->insert([
            'name' => 'valik',
            'email' => 'valik@test.com',
            'password' => bcrypt('123456'),
            'player_id' => '222222',
            'coins' => 777,
            'rate' => '3500'
        ]);

        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@test.com',
            'password' => bcrypt('123456'),
            'player_id' => '333333',
            'coins' => 820,
            'rate' => '5800'
        ]);

        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@test.com',
            'password' => bcrypt('123456'),
            'player_id' => '444444',
            'coins' => 675,
            'rate' => '4200'
        ]);

        DB::table('users')->insert([
            'name' => 'user3',
            'email' => 'user3@test.com',
            'password' => bcrypt('123456'),
            'player_id' => '555555',
            'coins' => 910,
            'rate' => '5800'
        ]);

        DB::table('users')->insert([
            'name' => 'user4',
            'email' => 'user4@test.com',
            'password' => bcrypt('123456'),
            'player_id' => '666666',
            'coins' => 500,
            'rate' => '5800'
        ]);

        DB::table('users')->insert([
            'name' => 'user5',
            'email' => 'user5@test.com',
            'password' => bcrypt('123456'),
            'player_id' => '777777',
            'coins' => 740,
            'rate' => '5800'
        ]);

        DB::table('users')->insert([
            'name' => 'user6',
            'email' => 'user6@test.com',
            'password' => bcrypt('123456'),
            'player_id' => '888888',
            'coins' => 790,
            'rate' => '5800'
        ]);

        DB::table('users')->insert([
            'name' => 'user7',
            'email' => 'user7@test.com',
            'password' => bcrypt('123456'),
            'player_id' => '999999',
            'coins' => 630,
            'rate' => '4500'
        ]);
    }
}
