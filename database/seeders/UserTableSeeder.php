<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    public static function getArrayStubs()
    {
        return [
            ['id'=>1, 'name'=>'jo', 'age'=>20],
            ['id'=>2, 'name'=>'alan', 'age'=>22],
        ];
    }

    public static function getObjectStubs($addedStub = null)
    {
        $stubs = UserTableSeeder::getArrayStubs();
        foreach ($stubs as $key => $value)
        {
            $stubs[$key] = (object) $value;
        }
        if ($addedStub) array_push($stubs, (object) $addedStub);
        return $stubs;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert($this->getArrayStubs());
    }
}
