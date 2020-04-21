<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ReferralSettings;
use App\ReferralsModel;
use Illuminate\Http\Request;
use DB;
class Referral extends Controller
{
    public function updateReferralTxn()
    {
        try {
        ReferralsModel::where('id', request()->referral_id)->update(['txn_id_ether'=>request()->txn_id_ether, 'status'=>'COMPLETED']);
        return redirect()->back()->with('success', 'Transaction status updated.');

        }
        catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


    }
    public function updateReferral()
    {
        try {
            request()->validate([
                'referral_offer_type' => 'string|required',
                'referral_offer_amount' => 'integer|required',
                'referral_offer_upto' => 'integer|nullable',
            ]);
            $refSettings = ReferralSettings::firstOrNew(['id' => 1]);
            $refSettings->referral_offer_type = request()->referral_offer_type;
            $refSettings->referral_offer_amount = request()->referral_offer_amount;
            $refSettings->referral_offer_upto = request()->referral_offer_upto;
            $refSettings->save();
            return redirect()->back()->with('success', 'Referral updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function getReferrals()
    {
        try {
            $referrals = DB::table('referrals')
                ->join('users as referrer', 'referrer.id', '=', 'referrals.referrer')
                ->join('users as user', 'user.id', '=', 'referrals.user')
                ->select('referrals.id as referral_id','user.name as user_name', 'referrer.ether as referrer_address', 'referrer.name as referrer_name', 'referrals.user_bought_amount', 'referrals.referer_earning_amount', 'referrals.referel_txn_id', 'referrals.status','txn_id_ether')->get();
            $refSettings = ReferralSettings::where('id', 1)->first();
            return view('admin.referrals', compact('referrals', 'refSettings'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function getSingleReferral($id)
    {
        try {
            $referral = ReferralsModel::where('id', $id)->first();
            return view('admin.referral', compact('referral'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
