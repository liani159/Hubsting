<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
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
        }
    }
}
