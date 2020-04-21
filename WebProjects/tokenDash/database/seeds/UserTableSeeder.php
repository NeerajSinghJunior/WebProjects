<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            "name" => "User",
            "email" => "user@email.com",
            "password" => bcrypt("123456"),
            "phone" => "9999999999",
            "verified" => 1
        ]);
    }
}
