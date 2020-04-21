<?php

use Illuminate\Database\Seeder;
use App\Cookies;

class CookieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Cookies::truncate();
        
        Cookies::create([
            'message' => 'Enter the GDPR legal compliance text that is required by the EU regulation',
            'action' => 1
        ]);
    }
}
