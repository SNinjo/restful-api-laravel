<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            ['id'=>1, 'name'=>'jo', 'age'=>20],
            ['id'=>2, 'name'=>'alan', 'age'=>22],
        ]);
    }
}
