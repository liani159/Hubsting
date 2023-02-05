<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //admin_1 seed
        $user = new User();
        $user->name = 'lian';
        $user->email = 'lianimopi@outlook.fr';
        $user->is_admin = 1;
        $user->as_paid = 1;
        $user->password = Hash::make('underscore');
        $user->created_at = date("Y-m-d H:i:s");
        $user->updated_at = date("Y-m-d H:i:s");
        $user->save();

        //admin_2 seed
        $user = new User();
        $user->name = 'jordan';
        $user->email = 'jordandavy600@gmail.com';
        $user->is_admin = 1;
        $user->as_paid = 1;
        $user->password = Hash::make('genie2021');
        $user->created_at = date("Y-m-d H:i:s");
        $user->updated_at = date("Y-m-d H:i:s");
        $user->save();

    }
}
