<?php

namespace App\Http\Controllers;

use App\Transaction as TransactionTbl ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use App\User;
use App\Expense;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
/* All Paypal Details class */
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaymentController extends BaseController
{
    //
        public function __construct()
    {
/** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);;
}

    public function show_stripe_page(Request $request)
    {
    	return view('stripe');
    }
    public function stripe_done(Request $request)
    {
    	
    	$stripe_transaction=new TransactionTbl();
    	$stripe_transaction->txn_id=$request->stripeToken;
    	$stripe_transaction->amount=$request->amount/100;
    	$stripe_transaction->user_id=Auth::user()->id;
    	$stripe_transaction->wallet_type='others';
    	$stripe_transaction->pay_status='COMPLETED';
        $stripe_transaction->pay_mode='Stripe';
        $stripe_transaction->coins=$request->no_of_token;
        $stripe_transaction->date=date('Y-m-d H:i:s');
        $stripe_transaction->currency='USD';
    	$stripe_transaction->pay_type=2;
    	$stripe_transaction->save();

        $user=User::find(Auth::user()->id);
        $user->is_token=1;
        $user->save();

        $res=$this->token_transfer($user->ether,$stripe_transaction->coins);
        // print_r($res);exit;


        if($res['status']==1){

            $referred = DB::table('users')->where('referral_code',$user->referred_by)->first();

                   $referralSettings = DB::table('referral_settings')->first();
                $referer_earning_amount = 0;
                if($referred){
                if ($referralSettings->referral_offer_type === 'PERCENT' && $referralSettings->referral_offer_amount > 0) {
                    $offer_amount = round(($stripe_transaction->coins / 100) * $referralSettings->referral_offer_amount);

                    if ($referralSettings->referral_offer_upto > 0 || $referralSettings->referral_offer_upto !== null) {
                        $referer_earning_amount = $referralSettings->referral_offer_upto > $offer_amount ? $offer_amount : $referralSettings->referral_offer_upto;
                    } else {
                        $referer_earning_amount = $offer_amount;
                    }
                }else
                {
                    $offer_amount = $referralSettings->referral_offer_amount;

                    $referer_earning_amount = $referralSettings->referral_offer_upto > $offer_amount ? $offer_amount : $referralSettings->referral_offer_upto;
                }
                // print_r($referred);exit;
                //  echo $referer_earning_amount; 
                // echo $referred->ether; exit;
                // print_r($res);
                if($referer_earning_amount!=0){
                $rest=$this->token_transfer($referred->ether,$referer_earning_amount);
                // print_r($rest); exit;
                if($rest['status'])
                {

                    // echo $referer_earning_amount; exit;
                    if ($referer_earning_amount > 0 && isset($referred->id)) {
                          // echo $referer_earning_amount; exit;
                          $referralObj = array();
                        $referralObj = array(
                            'referrer' => $referred->id,
                            'user' => $user->id,
                            'user_bought_amount' => $stripe_transaction->coins,
                            'referer_earning_amount' => $referer_earning_amount,
                            'referel_txn_id' => $stripe_transaction->id,
                        );

                        // print_r($referralObj); exit;
                        DB::table('referrals')->insert($referralObj);
                    }
                }
                }
                }

             $txHash=$res['data'];
                $hash = $txHash->result->hash;
            $stripe_transaction->txhash=$hash;
            $stripe_transaction->new_transaction_id=$hash;
            $stripe_transaction->status='COMPLETED';
        // save data to expense table 
            $exp= new Expense();
            $exp->date=date('Y-m-d');
            $exp->amount=$request->amount/100;
            $exp->purpose="Token sold to ".$user->name. ' and  Coins : '. $stripe_transaction->coins.' Hash : '.$hash;
            $exp->pay_type='Stripe';
            $exp->country=$user->country;
            $exp->category='Token sold';
            $exp->customer_name=$user->name;
              // type 1- > Revenue  ,  2- >Expense ;
            $exp->type=1;
            $exp->save();

        }else{
            $stripe_transaction->status='PENDING';
        }

         $stripe_transaction->save();

            


    	return redirect()->back()->with('success', 'Payment Received successfully.');
    }
    public function init_payment_paypal(Request $request)
      {
       // print_r(Session::all()); exit;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
      
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount);
           
        $redirect_urls = new RedirectUrls();
   
        $redirect_urls->setReturnUrl(URL::route('paypal_done')) /* Specify return URL */
        ->setCancelUrl(URL::route('paypal_done'));
         
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
          
        try {
            // var_dump($this->_api_context);
            $payment->create($this->_api_context);

            // fiat_transaction insertion

               


            \Session::put('amount',$request->amount);
            \Session::put('no_of_token',$request->no_of_token);
            

            // End of fiat_transaction insertion


        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // echo '<pre>';print_r(json_decode($ex->getData()));exit;
            if (\Config::get('app.debug')) {
                 return back()->with('error','Connection timeout');
                
            } else {
                 return back()->with('error','Some error occur, sorry for inconvenient');
                // \Session::put('error','Some error occur, sorry for inconvenient');
                                return back();
                /* die('Some error occur, sorry for inconvenient'); */
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /* add payment ID to session */
        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            /* redirect to paypal */
            return Redirect::away($redirect_url);
        }
         return back()->with('error','Payment failed Please try agian');
    }
    public function paypal_done(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');
        $no_of_token = Session::get('no_of_token');
        $amount = Session::get('amount');
       
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            return back()->with('error','Payment failed');
            // return back();
        }
        $payment = Payment::get($payment_id, $this->_api_context);
    
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
    
        $result = $payment->execute($execution, $this->_api_context);
       
        if ($result->getState() == 'approved') { 

            $trans_update=new TransactionTbl();
            $trans_update->amount=$amount;
            $trans_update->user_id=Auth::user()->id;
            $trans_update->wallet_type='others';
            $trans_update->pay_status='COMPLETED';
            $trans_update->pay_mode='Paypal';
            $trans_update->coins=$no_of_token;
            $trans_update->currency='USD';
            $trans_update->pay_type=2;
            $trans_update->date=date('Y-m-d H:i:s');
            $trans_update->save();
            $trans_update->txn_id=$request->paymentId;
            $trans_update->trans_token=$request->token;
            $trans_update->status='COMPLETED';
            $trans_update->payer_id=$request->PayerID;
            $trans_update->save();
            Session::forget('trans_id');
            Session::forget('paypal_payment_id');

            $user=User::find(Auth::user()->id);
            $user->is_token=1;
            $user->save();

            $res=$this->token_transfer($user->ether,$trans_update->coins);

        if($res['status']){

                  $referrer = DB::table('users')->where('referral_code',$user->referred_by)->first();
                  $referrer_earning_amount=0;
            if($referrer)
            {
                   $referralSettings = DB::table('referral_settings')->first();
            
              
                if ($referralSettings->referral_offer_type === 'PERCENT' && $referralSettings->referral_offer_amount > 0) {
                    $offer_amount = round(($trans_update->coins / 100) * $referralSettings->referral_offer_amount);

                    if ($referralSettings->referral_offer_upto > 0 || $referralSettings->referral_offer_upto !== null) {
                        $referer_earning_amount = $referralSettings->referral_offer_upto > $offer_amount ? $offer_amount : $referralSettings->referral_offer_upto;
                    } else {
                        $referer_earning_amount = $offer_amount;
                    }
                }else
                {
                    $offer_amount = $referralSettings->referral_offer_amount;

                    $referer_earning_amount = $referralSettings->referral_offer_upto > $offer_amount ? $offer_amount : $referralSettings->referral_offer_upto;
                }
                // print_r($referrer);exit;
                if($referrer_earning_amount!=0){
                    $rest=$this->token_transfer($referrer->ether,$referrer_earning_amount);
               
                if($rest['status'])
                {


                    if ($referer_earning_amount > 0&& isset($referrer->id)) {
                        $referralObj = array();
                        $referralObj[] = array(
                            'referrer' => $referrer->id,
                            'user' => $user->id,
                            'user_bought_amount' => $trans_update->coins,
                            'referer_earning_amount' => $referer_earning_amount,
                            'referel_txn_id' => $trans_update->id,
                        );
                        DB::table('referrals')->insert($referralObj);
                    }
                }
                 }
            }

             $txHash=$res['data'];
                $hash = $txHash->result->hash;
            $trans_update->txhash=$hash;
            $trans_update->new_transaction_id=$hash;
            $trans_update->status='COMPLETED';
        // save data to expense table 
            $exp= new Expense();
            $exp->date=date('Y-m-d');
            $exp->amount=$amount;
             $exp->purpose="Token sold to ".$user->name. ' and  Coins : '. $trans_update->coins.' Hash : '.$hash;
            $exp->pay_type='Paypal';
            $exp->country=$user->country;
            $exp->category='Token sold';
            $exp->customer_name=$user->name;
              // type 1- > Revenue  ,  2- >Expense ;
            $exp->type=1;
            $exp->save();
            
        }else{
             $trans_update->status='PENDING';
        }
        $trans_update->save();


            // \Session::put('success','Payment success');
            return back()->with('success','Payment success');
        }else{
            $trans_update=new TransactionTbl();
            $trans_update->amount=$amount;
            $trans_update->user_id=Auth::user()->id;
            $trans_update->wallet_type='others';
            $trans_update->status='FAILED';
            $trans_update->pay_mode='Paypal';
            $trans_update->coins=$no_of_token;
            $trans_update->currency='USD';
            $trans_update->pay_type=2;
            $trans_update->date=date('Y-m-d H:i:s');
            $trans_update->txn_id=$request->paymentId;
            $trans_update->trans_token=$request->token;
            $trans_update->payer_id=$request->PayerID;
            $trans_update->save();
            Session::forget('trans_id');
            Session::forget('paypal_payment_id');

        return back()->with('error','Payment failed');
        }
    }
}
