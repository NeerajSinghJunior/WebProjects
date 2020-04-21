<?php

use Illuminate\Database\Seeder;
use App\Settings;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::truncate();
        
        Settings::create([
            'param' => 'stripe_pk_key',
            'value' => ''
        ]);
	    Settings::create([
	            'param' => 'stripe_sk_key',
	            'value' => '',
	    ]);
	    Settings::create([
	            'param' => 'client_id',
	            'value' => ''
	    ]);
	    Settings::create([
	            'param' => 'secret',
	            'value' => ''
	    ]);
	    Settings::create([
	            'param' => 'mode',
	            'value' => 'sandbox'
	    ]);
    }

}
