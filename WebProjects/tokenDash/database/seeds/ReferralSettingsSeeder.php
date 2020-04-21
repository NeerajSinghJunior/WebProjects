<?php

use Illuminate\Database\Seeder;
use App\ReferralSettings;
class ReferralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ReferralSettings::truncate();
        ReferralSettings::create([
            'referral_offer_type' => 'PERCENT',
            'referral_offer_amount' => 0,
            'referral_offer_upto' => 0,
            'status' => 1
        ]);

    }
}
