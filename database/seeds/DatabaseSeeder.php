<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullname' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make("admini123"),
            'level' => 'Admin'
        ]);
        DB::table('users')->insert([
            'fullname' => 'Budi Sudarsono',
            'username' => 'budisudars',
            'password' => Hash::make("lolipop1902"),
            'level' => 'Member'
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
