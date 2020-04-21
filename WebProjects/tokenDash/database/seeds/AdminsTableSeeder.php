<?php

use Illuminate\Database\Seeder;

use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $google2fa = app('pragmarx.google2fa');
        Admin::truncate();
        Admin::create([
            "name" => "Admin",
            "email" => "admin@mailinator.com",
            "password" => bcrypt("123456"),
            "ether"=>"0x3faA543fEdf1532e101ac6cF39Ba32406b97645D",
            "bitcoin"=>"2N8hwP1WmJrFF5QWABn38y63uYLhnJYJYTF",
            "site_title"=>"ICODash",
            "coin_value" => 1,
            "site_logo"=>"images/logo.png",
            "fav_ico"=>"images/fav_ico.png",
            "account_name" => "account_name",
            "account_number" => "account_number",
            "selling_coin_name" => "ICO Coin",
            "account_ifsc" => "account_ifsc",
            "captcha_key"=>"6LfkZlcUAAAAAGrES_YISMZ8Xfz33NKFFWoxtzaC",
            "recaptcha_public_key"=>"6LfkZlcUAAAAAGrES_YISMZ8Xfz33NKFFWoxtzaC",
            "recaptcha_public_key"=>"6LfkZlcUAAAAAHc8UiYZMfoc-TDIR1llPfEYtZ_C",
            "google2fa_secret" => $google2fa->generateSecretKey()
        ]);
    }
}
