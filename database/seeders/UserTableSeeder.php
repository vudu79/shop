<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        DB::table('users')->insert( [
            'name'=>'admin2',
            'email'=>'admin2@mail.ru',
            'password'=>bcrypt('12345'),
            'is_admin'=>1
        ]);
    }
}
