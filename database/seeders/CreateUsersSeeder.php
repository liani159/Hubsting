<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* DB::table('users')->insert([
            'name'=>'lian',
            'email'=>'lianimopi@outlook.fr',
            'is_admin'=>1,
            'as_paid'=>1,
            'password' => Hash::make('underscore'),
        ]); */

        DB::table('users')->insert([
            'name' => 'jordan',
            'email' => 'jordandavy600@gmail.com',
            'is_admin'=>1,
            'as_paid'=>1,
            'password' => Hash::make('genie2021'),
        ]);

        /* $users = [
            [
               'name'=>'lian',
               'email'=>'lianimopi@outlook.fr',
               'is_admin'=>1,
               'password'=> bcrypt('underscore'),
            ],
            [
               'name'=>'liani',
               'email'=>'lianimopiz@gmail.com',
               'is_admin'=> 0,
               'password'=> bcrypt('hubsting'),
            ]     
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        } */
    }
}
