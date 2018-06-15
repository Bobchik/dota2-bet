<?php

use Illuminate\Database\Seeder;

class GameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'title' => 'Dota 2',
            'service_id' => '1'
        ]);
        DB::table('games')->insert([
            'title' => 'CS:GO',
            'service_id' => '1'
        ]);
        DB::table('games')->insert([
            'title' => 'Warframe',
            'service_id' => '2'
        ]);
        DB::table('games')->insert([
            'title' => 'Team Fortress 2',
            'service_id' => '3'
        ]);
    }
}
