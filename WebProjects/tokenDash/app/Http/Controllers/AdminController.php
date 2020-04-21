<?php

namespace App\Http\Controllers;
require ('../vendor/autoload.php');
use Twilio\Rest\Client;
use Mailgun\Mailgun;
use App\Admin;
use App\Notification;
use Log;
use App\Transaction;
use App\User;
use App\ScheduleMail;
use App\MailCampaign;
use App\MessageCampaign;
use App\DraftMail;
use DB;
use Validator;
use App\Cookies;
use Mail;
use App\Expense;
use App\PaymentTypes;
use App\DividendSettings;
use App\DividendSettingsHistory;
use App\BankCodeMaster;
use App\AdminBankDetails;
use App\DividendPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class AdminController extends BaseController
{
    public function index()
    {
        //$Transactions = Transaction::whereNotNull('ether')->get();
        $Transactions = Transaction::orderBy('id', 'desc')->limit(30)->get();
        $tokenAmount = $this->getTokenValue();
        // $tokenAmount = 10;
         $tokenAmount=$tokenAmount/1000000000000000000;

        // echo $tokenAmount; exit;

        $month_array1=array('1'=>'"' .date("M Y", strtotime("-11 months")). '"', '2'=>'"' .date("M Y", strtotime("-10 months")). '"', '3'=>'"' .date("M Y", strtotime("-9 months")). '"', '4'=>'"' .date("M Y", strtotime("-8 months")). '"', '5'=>'"' .date("M Y", strtotime("-7 months")). '"', '6'=>'"' .date("M Y", strtotime("-6 months")). '"', '7'=>'"' .date("M Y", strtotime("-5 months")). '"', '8'=>'"' .date("M Y", strtotime("-4 months")). '"', '9'=>'"' .date("M Y", strtotime("-3 months")). '"', '10'=>'"' .date("M Y", strtotime("-2 months")). '"', '11'=>'"' .date("M Y", strtotime("-1 months")). '"', '12'=>'"' .date('M Y'). '"');

        $automatic=DB::table('transactions')
        ->where('pay_type',1)
        ->where('status','COMPLETED')
        ->whereBetween('transactions.created_at', array(date("Y-m", strtotime("-11 months")).'-01', date("Y-m-d")))
        ->select(DB::raw('sum(coins) as total_coins'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');
        
        $semiautomatic=DB::table('transactions')
        ->where('pay_type',2)
        ->where('status','COMPLETED')
        ->whereBetween('transactions.created_at', array(date("Y-m", strtotime("-11 months")).'-01', date("Y-m-d")))
        ->select(DB::raw('sum(coins) as total_coins'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');        
        
        $total_token_auto=[];
        $total_token_auto1=[];
        
        $total_token_sauto=[];
        $total_token_sauto1=[];

        foreach ($automatic as $key => $auto) {
            $total_token_auto1[$key] = $auto->total_coins;
        }
        
        foreach ($semiautomatic as $key => $sauto) {
            $total_token_sauto1[$key] = $sauto->total_coins;
        }

        for($i = 1; $i <= 12; $i++)
        {
            $month1[$i]=$month_array1[$i];

            if(!empty($total_token_auto1[$i])){
                $total_token_auto[$i] = $total_token_auto1[$i];    
            }else{
                $total_token_auto[$i] = 0;    
            }

            if(!empty($total_token_sauto1[$i])){
                $total_token_sauto[$i] = $total_token_sauto1[$i];    
            }else{
                $total_token_sauto[$i] = 0;    
            }
        }

        return view('admin.home', compact('Transactions', 'tokenAmount', 'total_token_auto', 'total_token_sauto', 'month1'));
    }

    public function Token_Request_Charts(Request $request)
    {
        $month_array=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');

        $automatic=DB::table('transactions')
        ->where('pay_type',1)
        ->where('status','COMPLETED')
        ->whereYear('created_at', '=', $request->year)
        ->select(DB::raw('sum(coins) as total_coins'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');
        
        $semiautomatic=DB::table('transactions')
        ->where('pay_type',2)
        ->where('status','COMPLETED')
        ->whereYear('created_at', '=', $request->year)
        ->select(DB::raw('sum(coins) as total_coins'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');
        
        $total_token_auto=[];
        $total_token_auto1=[];
        
        $total_token_sauto=[];
        $total_token_sauto1=[];

        foreach ($automatic as $key => $auto) {
            $total_token_auto1[$key] = $auto->total_coins;
        }
        
        foreach ($semiautomatic as $key => $sauto) {
            $total_token_sauto1[$key] = $sauto->total_coins;
        }

        for($i = 1; $i <= 12; $i++)
        {
            $month[$i]=$month_array[$i];

            if(!empty($total_token_auto1[$i])){
                $total_token_auto[] = $total_token_auto1[$i];    
            }else{
                $total_token_auto[] = 0;    
            }

            if(!empty($total_token_sauto1[$i])){
                $total_token_sauto[] = $total_token_sauto1[$i];    
            }else{
                $total_token_sauto[] = 0;    
            }
        }

        $ret_arr= array('total_token_auto'=>$total_token_auto,'total_token_sauto'=>$total_token_sauto);
        return $ret_arr;
    }

    public function addon()
    {
        $Transactions = Transaction::whereNotNull('ether')->get();
        $tokenAmount = $this->getTokenValue();
        $tokenAmount=$tokenAmount/1000000000000000000;
        // $tokenAmount = 10;
        return view('admin.addon', compact('Transactions', 'tokenAmount'));
    }
    public function dashboard()
    {
        $PendingTransactionCount = Transaction::where('status', 'PENDING')->count();
        $PendingTransactionAmount = Transaction::where('status', 'PENDING')->sum('coins');
        $transactions = Transaction::orderBy('id', 'desc')->limit(5)->get();
        $TotalUsers = User::count();
        $admin = Admin::first();
        $ToatalSupply = $admin->total_supply;   
        
        $month_array=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');     
        
        $incomes=DB::table('expense')
        ->where('type',1)
        ->whereBetween('expense.created_at', array(date("Y-m-d", strtotime("-1 months")), date("Y-m-d")))
        ->select(DB::raw('sum(total_amount) as total_amount'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');
        
        $expenses=DB::table('expense')
        ->where('type',2)
        ->whereBetween('expense.created_at', array(date("Y-m-d", strtotime("-1 months")), date("Y-m-d")))
        ->select(DB::raw('sum(total_amount) as total_amount'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');

        $incomeexp_percent=DB::table('expense')
        ->whereBetween('expense.created_at', array(date("Y-m-d", strtotime("-1 months")), date("Y-m-d")))
        ->select(DB::raw('count(*) as total'), DB::raw('category as category'))
        ->groupBy('category')
        ->get();
        
        $total_amount_income=[];
        $total_amount_income1=[];
        
        $total_amount_expense=[];
        $total_amount_expense1=[];
        
        foreach ($incomes as $key => $income) {
            $total_amount_income[$key] = $income->total_amount;
        }
        
        foreach ($expenses as $key => $expense) {
            $total_amount_expense[$key] = $expense->total_amount;
        }

        for($i = 1; $i <= 12; $i++)
        {
            $month[$i]=$month_array[$i];

            if(!empty($total_amount_income[$i])){
                $total_amount_income1[$i] = $total_amount_income[$i];    
            }else{
                $total_amount_income1[$i] = 0;    
            }

            if(!empty($total_amount_expense[$i])){
                $total_amount_expense1[$i] = $total_amount_expense[$i];    
            }else{
                $total_amount_expense1[$i] = 0;    
            }
        }
        $sum=[];
        foreach($incomeexp_percent as $key=>$percent) {
        $sum[$key]=$percent->total;
        }
        $total_category=array_sum($sum);

        $month_array1=array('1'=>'"' .date("M Y", strtotime("-11 months")). '"', '2'=>'"' .date("M Y", strtotime("-10 months")). '"', '3'=>'"' .date("M Y", strtotime("-9 months")). '"', '4'=>'"' .date("M Y", strtotime("-8 months")). '"', '5'=>'"' .date("M Y", strtotime("-7 months")). '"', '6'=>'"' .date("M Y", strtotime("-6 months")). '"', '7'=>'"' .date("M Y", strtotime("-5 months")). '"', '8'=>'"' .date("M Y", strtotime("-4 months")). '"', '9'=>'"' .date("M Y", strtotime("-3 months")). '"', '10'=>'"' .date("M Y", strtotime("-2 months")). '"', '11'=>'"' .date("M Y", strtotime("-1 months")). '"', '12'=>'"' .date('M Y'). '"');

        $automatic=DB::table('transactions')
        ->where('pay_type',1)
        ->where('status','COMPLETED')
        ->whereBetween('transactions.created_at', array(date("Y-m", strtotime("-11 months")).'-01', date("Y-m-d")))
        ->select(DB::raw('sum(coins) as total_coins'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');
        
        $semiautomatic=DB::table('transactions')
        ->where('pay_type',2)
        ->where('status','COMPLETED')
        ->whereBetween('transactions.created_at', array(date("Y-m", strtotime("-11 months")).'-01', date("Y-m-d")))
        ->select(DB::raw('sum(coins) as total_coins'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');
        
        $total_token_auto=[];
        $total_token_auto1=[];
        
        $total_token_sauto=[];
        $total_token_sauto1=[];

        foreach ($automatic as $key => $auto) {
            $total_token_auto1[$key] = $auto->total_coins;
        }
        
        foreach ($semiautomatic as $key => $sauto) {
            $total_token_sauto1[$key] = $sauto->total_coins;
        }

        for($i = 1; $i <= 12; $i++)
        {
            $month[$i]=$month_array[$i];
            $month1[$i]=$month_array1[$i];

            if(!empty($total_token_auto1[$i])){
                $total_token_auto[$i] = $total_token_auto1[$i];    
            }else{
                $total_token_auto[$i] = 0;    
            }

            if(!empty($total_token_sauto1[$i])){
                $total_token_sauto[$i] = $total_token_sauto1[$i];    
            }else{
                $total_token_sauto[$i] = 0;    
            }
        }
        return view('admin.dashboard', compact('PendingTransactionAmount', 'PendingTransactionCount', 'TotalUsers', 'ToatalSupply', 'transactions','month','total_amount_income1','total_amount_expense1','incomeexp_percent','total_category','total_token_auto','total_token_sauto','month1'));
    }
    public function transaction($id)
    {
        try {
            $Txn = Transaction::findOrFail($id);
            $tokenAmount = $this->getTokenValue();
            $user =User::find($Txn->user_id);
            $tokenAmount=$tokenAmount/1000000000000000000;
          	//print_r($tokenAmount);exit;
            return view('admin.transaction', compact('Txn', 'tokenAmount','user'));
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function update_expense_report_status(Request $request)
    {
         try {
                    $status = $request->status;

                    $data = DB::table('settings')->where('param','expense_report_show_to_investor')->first();

                    if($status==1)
                    {
                        DB::table('settings')->where('id',$data->id)->update(['value'=>0]);
                    }else
                    {
                         DB::table('settings')->where('id',$data->id)->update(['value'=>1]);
                    }
                   

                    return redirect('/admin/expense')->with('success', 'Expense visible status updated');
            }catch (Exception $e) {
            abort(404);
        }
    }

    public function completeTransaction($id)
    {
        try {
              $transaction = Transaction::where(['id' => $id])->first();
             $referrer = DB::table('users')->where(['users.id' => $transaction->user_id])
                ->join('users as referrer', 'referrer.referral_code', '=', 'users.referred_by')
                ->select('referrer.id as referrer_id', 'users.id as user_id','users.ether as user_ether','referrer.ether as referrer_ether')
                ->first();
          
            $user=DB::table('users')->where(['users.id' => $transaction->user_id])->first();
            $res=$this->token_transfer($user->ether,$transaction->coins);


            if($res['status']){
                $txHash=$res['data'];
                $hash = $txHash->result->hash;
                $transaction->txhash=$hash;
                $transaction->new_transaction_id=$hash;
                $transaction->status='COMPLETED';
            // save data to expense table 
                $exp= new Expense();
                $exp->date=date('Y-m-d');
                $exp->amount=$transaction->amount;
                $exp->country=$user->country;
                $exp->purpose="Token sold to ".$user->name. ' and  Coins : '. $transaction->coins.' Hash : '.$hash;
                $exp->pay_type=$transaction->pay_mode;
                $exp->customer_name=$user->name;
                $exp->category='Token Sold';
                  // type 1- > Revenue  ,  2- >Expense ;
                $exp->type=1;
                $exp->save();

            }else{
                $transaction->status='PENDING';
            }
            $transaction->save();
            // $re->update(['status' => 'COMPLETED', 'new_transaction_id' => request()->get('new_transaction_id')]);
            
            if($transaction->status!="PENDING")
            {
                DB::enableQueryLog();
               
                $referralSettings = DB::table('referral_settings')->first();

                 $referrer = DB::table('users')->where('referral_code',$user->referred_by)->first();
                 // print_r($referrer); exit;
                 if($referrer)
                 {
                        $referrer_earning_amount = 0;
                        if ($referralSettings->referral_offer_type === 'PERCENT' && $referralSettings->referral_offer_amount > 0) {
                            $offer_amount = round(($transaction->coins / $referralSettings->referral_offer_amount) * 100);

                            if ($referralSettings->referral_offer_upto > 0 || $referralSettings->referral_offer_upto !== null) {
                                $referrer_earning_amount = $referralSettings->referral_offer_upto > $offer_amount ? $offer_amount : $referralSettings->referral_offer_upto;
                            } else {
                                $referrer_earning_amount = $offer_amount;
                            }
                        }else
                        {
                            $offer_amount = $referralSettings->referral_offer_amount;

                            $referrer_earning_amount = $referralSettings->referral_offer_upto > $offer_amount ? $offer_amount : $referralSettings->referral_offer_upto;
                        }
                        // print_r($referrer);exit;
                        if($referrer_earning_amount!=0){
                         $rest=$this->token_transfer($referrer->ether,$referrer_earning_amount);
                       

                        if($rest['status'])
                        {

                            if ($referrer_earning_amount > 0&& isset($referrer->referrer_id)) {
                                $referralObj = [
                                    'referrer' => $referrer->referrer_id,
                                    'user' => $referrer->user_id,
                                    'user_bought_amount' => $transaction->coins,
                                    'referer_earning_amount' => $referrer_earning_amount,
                                    'referel_txn_id' => $transaction->id,
                                ];
                                DB::table('referrals')->insert($referralObj);
                            }
                        }
                         }
                        //ReferralsModel
                }
            }else
            {
                return redirect("admin/txn/$id")->with('error', 'Transaction not completed. Please try again later');
            }
            return redirect("admin/txn/$id")->with('success', 'Transaction status has been changed');

        } catch (Exception $e) {
            abort(404);
        }
    }
    public function user()
    {
        $Users = User::all();
        return view('admin.users.index', compact('Users'));
    }

    public function user_details($id)
    {
        try {
            $user = User::where("id", $id)->first();
            return view('admin.users.show', compact('user'));
        } catch (Exception $e) {
            abort(404);
        }
    }
    public function dividend_user_details($userid)
    {
        try {
            $user = User::where("id", $userid)->first();
            return view('admin.users.showdividend', compact('user'));
        } catch (Exception $e) {
            abort(404);
        }
    }
    
    public function getTokenValue()
    {
        $admin = Admin::first();    
        $client = new \GuzzleHttp\Client();
        $token_uri = env('TOKEN_BALANCE_ENDPOINT');
        $token_uri = str_replace("||contractaddress||", $admin->contract_address, $token_uri);
        $token_uri = str_replace("||address||", $admin->ether, $token_uri);
        // echo $token_uri; exit;
        $token = $client->request('GET', $token_uri);

        return json_decode($token->getBody())->result;
    }
    public function account()
    {
        $AdminBankDetails = AdminBankDetails::get();
        $BankCodeMaster = BankCodeMaster::get();
        $admin = Admin::first();
        
        $tokenAmount = $this->getTokenValue();
        $tokenAmount=$tokenAmount/1000000000000000000;
        $admin = Admin::first();
        $pk_key=DB::table('settings')->where('param','stripe_pk_key')->select('value')->first();
        $sk_key=DB::table('settings')->where('param','stripe_pk_key')->select('value')->first();
        $client_id=DB::table('settings')->where('param','client_id')->select('value')->first();
        $secret=DB::table('settings')->where('param','secret')->select('value')->first();
        $mode=DB::table('settings')->where('param','mode')->select('value')->first();
        $tax=DB::table('tax')->get();
        $payment_types=DB::table('payment_types')->get();
        
        
        $google2fa = app('pragmarx.google2fa');
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $admin->email,
            $admin->google2fa_secret
        );

        return view('admin.account')->with(compact('tokenAmount', 'QR_Image','pk_key','sk_key','mode','client_id','secret','tax','payment_types','BankCodeMaster','AdminBankDetails'));
    }

    public function updateStripe(Request $request){
        DB::table('settings')->where(['param' => 'stripe_pk_key'])->update(['value' => $request->pk_key]);
        DB::table('settings')->where(['param' => 'stripe_sk_key'])->update(['value' => $request->sk_key]);
        return back()->with('success', 'Stripe updated');

    }
    public function UpdatePaypal(Request $request){
        DB::table('settings')->where(['param' => 'client_id'])->update(['value' => $request->client_id]);
        DB::table('settings')->where(['param' => 'secret'])->update(['value' => $request->secret]);
        DB::table('settings')->where(['param' => 'mode'])->update(['value' => $request->mode]);
        return back()->with('success', 'Paypal Details updated');

    }
    public function updateDefaultCoin(Request $request){

        $update=Admin::first();
        $update->default_token_price=$request->default_token_price;
        $update->save();
      
        return back()->with('success', 'Default Token price is updated');

    }
    public function google2fa()
    {
        $admin = Admin::first();
        $admin->google2fa_on = request()->get('google2fa_on') ? 1 : 0;
        $admin->save();
        return back()->with('success', 'Google 2 Factor status updated');
    }
    public function notifications()
    {
        $notifications = Notification::latest()->get();
        return view('admin.notifications', compact('notifications'));
    } 
    public function message()
    {
        $users = User::all();
        return view('admin.message',compact('users'));
    }
    public function mail()
    {
        $users = User::all();
        return view('admin.mail',compact('users'));
    }
    public function updateScripts(Request $request)
    {
        $request->validate([
            'chat_script' => 'string|nullable',
            'google_analytics_script' => 'string|nullable',
        ]);
        $admin = Admin::first();
        $admin->chat_script = $request->chat_script;
        $admin->analytics_script = $request->analytics_script;
        $admin->save();
        return back()->with('success', 'Scripts updated successfully');
    }
    public function account_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_to_be_launched' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users,email,' . request()->user()->id,
            'site_logo' => 'image|dimensions:width=200,height=34',
            'fav_ico' => 'image|dimensions:width=32,height=32',
             'white_paper' => 'file|mimes:pdf',
        ]);
        // print_r($request->all());exit;
        $admin = Admin::first();
        $admin->email = $request->email;
        $admin->name = $request->name;
        $admin->site_title = $request->site_title;
        $admin->site_title = $request->site_title;
        $admin->coin_value = $request->coin_value;
        $admin->total_supply = $request->total_supply;
        $admin->date_to_be_launched = $request->date_to_be_launched;
        if ($request->site_logo) {
            $admin->site_logo = $this->image_upload_admin($request,'site_logo','logo.png'); //$request->site_logo->storeAs('images', 'logo.png');
        }
        if ($request->fav_ico) {
            $admin->fav_ico = $this->image_upload_admin($request,'fav_ico','fav_ico.png'); //$request->fav_ico->storeAs('images', 'fav_ico.png');
        }

        if ($request->white_paper) {
            $admin->white_paper = $this->image_upload($request,'white_paper');// $request->white_paper->store('white_papers');   
        }

        $admin->save();
        // request()->user()->update($input);

        return back();
    }

    public function account_password()
    {
        $this->validate(request(), [
            'password' => 'required|confirmed',
            'password_old' => 'required',
        ]);

        $User = auth()->user();

        if (Hash::check(request()->password_old, request()->user()->password)) {
            $User->password = bcrypt(request()->password);
            $User->save();
            return back()->with('success', 'password updated successfully');
        } else {

            return back()->with('error', 'old password is wrong');

        }

    }

    public function saveTransactionId(Request $request)
    {
        $transaction = Transaction::where('ether', $request->wallet_address)->first();
        $transaction->new_transaction_id = $request->transaction_id;
        $transaction->save();
        return response()->json($request->wallet_address);
    }
    public function updateBankDetails(Request $request)
    {        
        DB::table('admin_bank_details')->truncate();
        $i=0;
        foreach ($request->account_name as  $bankd) {
            if($request->account_name[$i]!='')
            {
            $account_name=$request->account_name[$i];
            $account_number=$request->account_number[$i];
            $bank_code=$request->bank_code[$i];
            $account_ifsc=$request->account_ifsc[$i];
            if(!isset($request->default_flag[$i])) { $default_flag=0; }
            else { $default_flag=$request->default_flag[$i]; }
            $id=$request->id[$i];
            $table=DB::table('admin_bank_details')->where('id',$id)->count();
                if($table==0){
                    DB::table('admin_bank_details')->insert(['account_name'=>$account_name,'account_number'=>$account_number,'bank_code'=>$bank_code,'account_ifsc'=>$account_ifsc,'default_flag'=>$default_flag]);
                }else{
                    DB::table('admin_bank_details')->where('id',$id)->update(['account_name'=>$account_name,'account_number'=>$account_number,'bank_code'=>$bank_code,'account_ifsc'=>$account_ifsc,'default_flag'=>$default_flag]);
                }
            }
            $i++;
         }
        return back()->with('success','Admin Bank Details Saved successfully!');
    }
    public function add_notification(Request $request)
    {

        $request->validate([

            'title' => 'required',

            'description' => 'required|min:10',

        ]);

        Notification::create([

            'title' => $request->title,

            'description' => $request->description,

        ]);

        return redirect('admin/notifications')->with('success', 'Notification Added successfully');

    }

    public function delete_notification(Notification $notification)
    {

        $notification->delete();

        return redirect('admin/notifications')->with('success', 'Notification deleted successfully');

    }

    public function delete_user(User $user)
    {

        $user->delete();

        return redirect('admin/user')->with('success', 'User Deleted successfully');

    }

    public function admin_wallet_address(Request $request)
    {
// dd($request);
        $request->validate([
            'ether' => 'required',
            'private_key' => 'required',
            'bitcoin' => 'required',
            'contract_address' => 'required',
            'white_paper' => 'file|mimes:pdf',
            'coin_value' => 'required|integer',
            'total_supply' => 'required|integer',
        ]);

        $admin = auth()->guard('admin')->user();

        $admin->ether = $request->ether;
        $admin->private_key = $request->private_key;
        $admin->contract_address = $request->contract_address;
        $admin->bitcoin = $request->bitcoin;
        $admin->transaction_hash = $request->transaction_hash;
        $admin->contract_abi = $request->contract_abi;
        $admin->contract_network = $request->contract_network;
        $admin->total_supply = $request->total_supply;
        $admin->selling_coin_name = $request->selling_coin_name;
        $admin->coin_value = $request->coin_value;
        $admin->transaction_hash = $request->transaction_hash;
        if ($request->white_paper) {
            $admin->white_paper = $this->image_upload($request,'white_paper');// $request->white_paper->store('white_papers');
        }
        $admin->save();

        return redirect()->back()->with('success', 'Wallet Address updated successfully');

    }

    public function change_captcha(Request $request)
    {

        $request->validate([

            'captcha_key' => 'nullable',
            'public_key' => 'nullable',
            'private_key' => 'nullable',

        ]);

        $admin = auth()->guard('admin')->user();

        $admin->captcha_key = $request->captcha_key;
        $admin->recaptcha_public_key = $request->public_key;
        $admin->recaptcha_private_key = $request->private_key;
        $admin->save();

        return redirect()->back()->with('success', 'Captcha is updated successfully');

    }

    public function send_message(Request $request){
        if($request->category == 1){
            $receivers = DB::table('users')->select('phone')->get();

        }
        
        if($request->category == 2){
            $receivers = $receivers = DB::table('users')->where("is_token", 1)->select('phone')->get();
        }
        
        if($request->category == 3){
            $receivers = $receivers = DB::table('users')->where("is_token", 0)->select('phone')->get();
        }
        
        if($request->category == 4){
           $receivers = DB::table('transactions')
                       ->where('users.is_token', 1)
                       ->whereBetween('transactions.date', array($request->form_date, $request->to_date))
                       ->join('users','transactions.user_id','=','users.id')
                       ->select('users.phone')
                       ->get();
            
        }
        $to=array();
        foreach ($receivers as $data) {
           $to[]=$data->phone;
        }
        //print_r($to);exit;
        $message = $request->message;
        for($i=0;$i<count($to);$i++){

            $this->sendSms($to[$i],$message);
        }
        
        $numbers=implode(",",$to);
        $msg=new MessageCampaign();
        $msg->request_type=$request->category;
        $msg->numbers=$numbers;
        $msg->message_content=$message;
        $msg->user_count=count($to);
        $msg->delivered_count=count($to);
        $msg->sent_count=count($to);

        if($request->category == 4){
            $msg->req_from_date=$request->form_date;
            $msg->req_to_date=$request->to_date;
        }

        $msg->save();
        return redirect()->back()->with('success', 'Message sent successfully');
    }

    public function sms_events(){
        $msg=MessageCampaign::get();
        $user_count = DB::table('users')->count();
        $campaign_count = DB::table('message_campaign')->count();
        $campaign_sent = DB::table('message_campaign')->where('status',1)->count();
        return view('admin.sms_campaign_list',compact('msg'),['user_count'=>$user_count,'campaign_count'=>$campaign_count,'campaign_sent'=>$campaign_sent]);
    }

    public function send_mail(Request $request){
        //print_r($request->all());exit;
        $request->validate([

            'category' => 'required',
            'subject' => 'required',
            'message' => 'required',

        ]);
        if($request->draft){
            if($request->draft_id){
                $draft= DraftMail::find($request->draft_id);
            }else{
                $draft= new DraftMail();
            }
        	
        	$draft->request_type=$request->category;
            $draft->subject=$request->subject;
            $draft->mail_content=$request->message;
           	if($request->category == 4){
                $draft->req_from_date =$request->form_date;
                $draft->req_to_date=$request->form_date;
           }
           $draft->save();
           return redirect()->back()->with('success', 'Mail Saved as Draft successfully');
        }else{
        	if($request->scheduled_date){
	            $schedule= new ScheduleMail();
	            $schedule->request_type=$request->category;
	            $schedule->subject=$request->subject;
	            $schedule->mail_content=$request->message;
	            $schedule->date=$request->scheduled_date;
	           if($request->category == 4){
	                $schedule->req_from_date =$request->form_date;
	                $schedule->req_to_date=$request->form_date;
	           }
	           $schedule->save();
	           return redirect()->back()->with('success', 'Mail Scheduled successfully');
        
        	}else{
	            if($request->category == 1){
	                $receivers = DB::table('users')->select('email')->get();
	            }
	            
	            if($request->category == 2){
	                $receivers = $receivers = DB::table('users')->where("is_token", 1)->select('email')->get();
	            }
	            
	            if($request->category == 3){
	                $receivers = $receivers = DB::table('users')->where("is_token", 0)->select('email')->get();
	            }
	            
	            if($request->category == 4){
	               $receivers = DB::table('transactions')
	                           ->where('users.is_token', 1)
	                           ->whereBetween('transactions.date', array($request->form_date, $request->to_date))
	                           ->join('users','transactions.user_id','=','users.id')
	                           ->select('users.email')
	                           ->get();
	                
	            }
	            $to=array();
	            foreach ($receivers as $data) {
	               array_push($to,$data->email);
	            }

	            $sub=$request->subject;
	            $message=$request->message;
	            

	            //print_r($mail);exit;

	            Mail::send('emails.send_mail', array('body' => $message), function($message) use ($to,$sub)
	            {    
	                $message->to($to)->subject($sub);    
	            });

                if($request->draft_id){
                    $draft= DraftMail::find($request->draft_id)->delete();
                }

	            $emails=implode(",",$to);
	            $mail=new MailCampaign();
	            $mail->request_type=$request->category;
	            $mail->emails=$emails;
	            $mail->subject=$sub;
	            $mail->mail_content=$message;
	            $mail->user_count=count($to);

	            if($request->category == 4){
		            $mail->req_from_date=$request->form_date;
		            $mail->req_to_date=$request->to_date;
	            }

	            $mail->save();
	            // var_dump( Mail:: failures());
	            // exit;
	            return redirect()->back()->with('success', 'Mail sent successfully');
			}
        }
        
        
    }

    public function mail_events(){
        // $mgClient = new Mailgun('key-e7526f682bab9286642c023a677f591d');
        // $domain = 'stodash.levelten.org';
        // $queryString = array(
        //     'begin'        => 'Thu, 15 November 2018 09:00:00 -0000',
        //     'ascending'    => 'yes',
        //     // 'limit'        =>  25,
        //     'pretty'       => 'yes',
        //     'subject'      => 'test',
        //     // 'event'      => 'opened',

        // );

        // # Make the call to the client.
        // $result = $mgClient->get("$domain/events", $queryString);
        // print_r($result);exit;
        // $array = json_decode(json_encode($result), True);
        // $final['0']['subject']=$result->http_response_body->items[0]->message->headers->subject;
        // $final['0']['event']=$result->http_response_body->items[0]->event;
        // $final['0']['date']=date("d-m-Y",$result->http_response_body->items[0]->timestamp);
        // $final['0']['date']=date("d-m-Y",$result->http_response_body->items[0]->timestamp);

        // $subject=array(
        //     '0' =>  $result->http_response_body->items[0]->message->headers->subject
        //     );
        // $i=1;
        // foreach ($result->http_response_body->items as $key => $value) {
        //     if(!in_array($value->message->headers->subject, $subject)){
        //         $subject[]=$value->message->headers->subject;
        //         $final[$i]['subject']=$value->message->headers->subject;
        //         $final[$i]['event']=$value->event;
        //         $final[$i]['date']=date("d-m-Y",$value->timestamp);
        //         $i++;
        //     }
        // }
        $mail = MailCampaign::all();
        $user_count = DB::table('users')->count();
        $campaign_count = DB::table('mail_campaign')->count();
        $campaign_draft = DB::table('draft_mails')->count();
        $campaign_sent = DB::table('mail_campaign')->where('status',1)->count();
        $campaign_chart = DB::table('mail_campaign')->select('mail_campaign.*',DB::raw('MONTH(created_at) month'),DB::raw('count(*) total_campaign'))
                    ->groupBy('month')
                    ->get();
        $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
        foreach($campaign_chart as $val){
            $val->month =$months[$val->month];
        }
        //print_r($campaign_chart);exit;
        return view('admin.campaign_list',compact('mail'),['user_count'=>$user_count,'campaign_count'=>$campaign_count,'campaign_sent'=>$campaign_sent,'campaign_draft'=>$campaign_draft,'campaign_chart'=>$campaign_chart]);
    }

    public function get_mail_details($sub){
        $key = (string)env('MAILGUN_SECRET');
       $mgClient = new Mailgun($key);
        //$domain = 'sandbox6a762b27699f4cebabf88f46ee21ff66.mailgun.org';
       $date_timestamp = mktime(0,0,0,date('m'),date('d')-5,date('Y'));

        $begin = date('D, d F Y h:i:s',$date_timestamp);
        $domain = (string)env('MAILGUN_DOMAIN');
        $queryString = array(
            'begin'        => $begin.' -0000',
            'ascending'    => 'yes',
            // 'limit'        =>  25,
            'pretty'       => 'yes',
            'subject'      => $sub,
        );

        # Make the call to the client.
        $result = $mgClient->get("$domain/events", $queryString);
        // print_r($result);exit;
        $user_count=0;
        $sent_count=0;
        $delivered_count=0;
        $rejected_count=0;
        $failed_count=0;
        $array = json_decode(json_encode($result), True);
        // print_r($array);exit;
        $i=0;
        $final=array();
        
        foreach ($result->http_response_body->items as $key => $value) {
            // echo $value->message->headers->subject; 
        	if($value->message->headers->subject == $sub){
        		if($value->event != "accepted"){
        			$final[$i]['subject']=$value->message->headers->subject;
	                if($value->event == 'rejected'){
	                	$final[$i]['recipient']=$value->message->headers->to;
	                }else{
	                	$final[$i]['recipient']=$value->recipient;
	                }
	                $final[$i]['event']=$value->event;
	                if($value->event == 'delivered'){
	                	$delivered_count++;
	                }
	                if($value->event == 'rejected'){
	                	$rejected_count++;
	                }
	                if($value->event == 'failed'){
	                	$failed_count++;
	                }
	                $final[$i]['date']=date("d-m-Y",$value->timestamp);
	                $user_count++;
	                $i++;
        		}


	        }
        }
       $mail_content=DB::table('mail_campaign')->where('subject',$sub)->first();
        if($mail_content!=""){
            // echo "hi"; exit;
            // $re = MailCampaign::where('subject',$sub)->first();
            // print_r($mail_content); exit;
            DB::table('mail_campaign')->where('subject',$sub)->update(['sent_count' => $sent_count, 'delivered_count' => $delivered_count,'rejected_count'=>$rejected_count,'failed_count'=>$failed_count,'is_updated'=>1]);
        }
        	
        
        //print_r($mail_content);exit;    
        //print_r($final);exit;
        return view('admin.detailed_campaign_list',compact('final'),['rejected_count'=>$mail_content->rejected_count,'delivered_count'=>$mail_content->delivered_count,'user_count'=>$mail_content->user_count,'mail_content'=>$mail_content->mail_content,'failed_count'=>$mail_content->failed_count]);
    }

    public function draft_mails(){
        $draft= DraftMail::get();
        $draft_count = DB::table('draft_mails')->count();     
        $mailnot_sent = DB::table('draft_mails')->where('status',1)->count();
        $mail_sent = DB::table('draft_mails')->where('status',2)->count();
        return view('admin.draft_mails',compact('draft'),['draft_count'=>$draft_count,'mailnot_sent'=>$mailnot_sent,'mail_sent'=>$mail_sent]);
    }

    public function delete_draft_mail($id){
        DraftMail::find($id)->delete();
        return back()->with('success','Draft Deleted successfully.');
    }
    public function get_draft_mail($id){
       $draft = DB::table('draft_mails')->where('id',$id)->first();
       return view('admin.mail',compact('draft'));
       //print_r($draft);exit;  
    }

    private function sendSms($to, $message)
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE_NUMBER');

        $client = new Client($accountSid, $authToken);

        try {
            $client->messages->create(
                $to,
                [
                    "body" => $message,
                    "from" => $twilioNumber
                    //   On US phone numbers, you could send an image as well!
                    //  'mediaUrl' => $imageUrl
                ]
            );
            return true;
            Log::info('Message sent to ' . $twilioNumber);
            
        } catch (TwilioException $e) {
            Log::error(
                'Could not send SMS notification.' .
                ' Twilio replied with: ' . $e
            );
            return false;
        }
    }
     public function show_cookies_page (Request $request)
    {
        $data=Cookies::first();
        return view('admin.cookies',['data'=>$data]);
    }

    public function store_cookies(Request $request)
    {
        if($request->id){
            $cookie=Cookies::find($request->id);
        }else{
            $cookie=new Cookies();
        }
        $cookie->message=$request->message;
        $cookie->action=$request->action;
        $cookie->save();

        return back()->with('success','Cookies Messages are Updated successfully.');
    }

    public function show_payments_page(Request $request)
    {
    $data = DB::table('admins')->select('payments_types')->first();
      $semi=0;$automatic=0;
    if($data->payments_types){
        $types=explode(',',$data->payments_types);
            $semi=0;
         $automatic=0;
         if(isset($types[0])){
            if($types[0]==1){
             $semi=1;   
            }elseif ($types[0]==2) {
               $automatic=1;
            }
         }

         if(isset($types[1])){
            if($types[1]==2){
             $automatic=1;   
            }elseif ($types[1]==1) {
               $semi=1;
            }
         }
    }

    return view('admin.manage-payments',['semi'=>$semi,'automatic'=>$automatic]);
}
    public function store_payments_methods(Request $request)
    {
        // print_r($request->all()); exit;
        if($request->type){
            $values= implode(',',$request->type);
            $admin = Admin::first();
            $admin->payments_types=$values;
            $admin->save();
            return back()->with('success','Payment Methods Updated successfully.');
        }else{
            return back()->with('error','Please choose any payments Types.');
        }
    }

    public function store_expense(Request $request){

        // print_r($request->all());exit;

         $request->validate([

            'date' => 'required',
            'payee_name' => 'required',
            'amount' => 'required',
            'category' => 'required',
        ]);

         
       
        try {
            $exp= new Expense();
            $type=2;
            if($request->id){
                $exp=Expense::find($request->id);
                $type=$exp->type;
            }
            $exp->date=$request->date;

            if($request->voucher){

                  $validator = Validator::make(
                                $request->all(), array(
                            'voucher' => 'mimes:jpeg,jpg,bmp,png',
                                )
                        );

                if ($validator->fails()) {
                        $error_messages = implode(',', $validator->messages()->all());
                        return back()->with('error', $error_messages);
                }

                $exp->voucher=$this->image_upload($request,'voucher');
            }

            $exp->purpose=$request->purpose;
            $exp->ref_no=$request->ref_no;
            $exp->customer_name=$request->payee_name;
            $exp->tax_type=$request->tax_type;
            $exp->pay_type=$request->pay_type;
            $exp->tax=$request->tax;
            $exp->tax_amount=$request->tax_amount;
            $exp->amount=$request->amount;
            $exp->category=$request->category;
            $exp->total_amount=$request->tax_amount+$request->amount;

              // type 1- > Revenue  ,  2- >Expense ;
            $exp->type=$type;
         
            $exp->save();
        } catch (Exception $e) {
                abort(404);
        }

         return back()->with('success',"You've successfully added your expense details.");
    }
    public function add_payment_type(Request $request){
        
        $request->validate([
            'payment_type' => 'required',
        ]);
        //print_r($request->all());exit;   
        $i=0;
        foreach ($request->payment_type as  $type) {

            $payment_type=$request->payment_type[$i];
            $id=$request->id[$i];
            $table=DB::table('payment_types')->where('id',$id)->count();
                if($table==0){
                    DB::table('payment_types')->insert(['payment_type'=>$type]);
                }else{
                    DB::table('payment_types')->where('id',$id)->update(['payment_type'=>$payment_type]);
                }
            $i++;
        }
           
             return back()->with('success','Payment Type Saved successfully.');
    }

    public function expense(Request $request)
    {
        $expense_visible_status = DB::table('settings')->where('param','expense_report_show_to_investor')->first();
        $d=DB::table('expense'); // define for filter

         $from_date=""; $to_date="";
        if($request->from_date!=""){
            // $Fdate=str_replace("/","-",$request->from_date);
            $from_date =Date('Y-m-d',strtotime($request->from_date));  
        }
        if($request->to_date !=""){
            // $Tdate=str_replace("/","-",$request->to_date);
            $to_date =Date('Y-m-d',strtotime($request->to_date));   
        }
       

        if($from_date!="" && $to_date!=""){
            $d->whereBetween('date',[$from_date,$to_date]); 
        }
        $type=0;
        if($request->type!=""){
            $d->where('type',$request->type); 
            $type=$request->type;
        }
        $category="";
        if($request->category!=""){
            $d->where('category',$request->category); 
            $category=$request->category;
        }

        $month_array=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');     
        
        $incomes=DB::table('expense')
        ->where('type',1)
        ->select(DB::raw('sum(total_amount) as total_amount'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');
        
        $expenses=DB::table('expense')
        ->where('type',2)
        ->select(DB::raw('sum(total_amount) as total_amount'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');

        $incomeexp_percent=DB::table('expense')
        ->select(DB::raw('count(*) as total'), DB::raw('category as category'))
        ->groupBy('category')
        ->get();
        
        $total_amount_income=[];
        $total_amount_income1=[];
        
        $total_amount_expense=[];
        $total_amount_expense1=[];
        
        foreach ($incomes as $key => $income) {
            $total_amount_income[$key] = $income->total_amount;
        }
        
        foreach ($expenses as $key => $expense) {
            $total_amount_expense[$key] = $expense->total_amount;
        }

        for($i = 1; $i <= 12; $i++)
        {
            $month[$i]=$month_array[$i];

            if(!empty($total_amount_income[$i])){
                $total_amount_income1[$i] = $total_amount_income[$i];    
            }else{
                $total_amount_income1[$i] = 0;    
            }

            if(!empty($total_amount_expense[$i])){
                $total_amount_expense1[$i] = $total_amount_expense[$i];    
            }else{
                $total_amount_expense1[$i] = 0;    
            }
        }
        $incomeexp_percent=DB::table('expense')
        ->select(DB::raw('count(*) as total'), DB::raw('category as category'))
        ->groupBy('category')
        ->get();
        $sum=[];
        foreach($incomeexp_percent as $key=>$percent) {
        $sum[$key]=$percent->total;
        }
        $total_category=array_sum($sum);
        $data=$d->orderBy('id','desc')->get();
          $autocomplete=Expense::distinct('category')->select('category')->get();
         return view('admin.expense',['data'=>$data,'from_date'=>$from_date,'to_date'=>$to_date,'type'=>$type,'autocomplete'=>$autocomplete,'category'=>$category,'month'=>$month,'total_amount_income1'=>$total_amount_income1,'total_amount_expense1'=>$total_amount_expense1,'incomeexp_percent'=>$incomeexp_percent,'total_category'=>$total_category])->with('status',$expense_visible_status->value);
    } 

    public function IncomeNExpense_Charts(Request $request)
    {        
        $from_date=""; $to_date="";
        if($request->fromdate!=""){
            $from_date =Date('Y-m-d',strtotime($request->fromdate));  
        }
        if($request->todate !=""){
            $to_date =Date('Y-m-d',strtotime($request->todate));   
        }

        $month_array=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');     
        
        $in=DB::table('expense');
        if($from_date!="" && $to_date!=""){
            $in->whereBetween('date',[$from_date,$to_date]); 
        }
        $incomes=$in->where('type',1)
        ->select(DB::raw('sum(total_amount) as total_amount'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');        
        
        $ex=DB::table('expense');
        if($from_date!="" && $to_date!=""){
            $ex->whereBetween('date',[$from_date,$to_date]); 
        }
        $expenses=$ex->where('type',2)
        ->select(DB::raw('sum(total_amount) as total_amount'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');


        $inper=DB::table('expense');
        if($from_date!="" && $to_date!=""){
            $inper->whereBetween('date',[$from_date,$to_date]); 
        }
        $incomeexp_percent=$inper->select(DB::raw('count(*) as total'), DB::raw('category as category'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('category','month')
        ->get();
        
        $total_amount_income=[];
        $total_amount_income1=[];
        
        $total_amount_expense=[];
        $total_amount_expense1=[];
        
        foreach ($incomes as $key => $income) {
            $total_amount_income[$key] = $income->total_amount;
        }
        
        foreach ($expenses as $key => $expense) {
            $total_amount_expense[$key] = $expense->total_amount;
        }

        for($i = 1; $i <= 12; $i++)
        {
            $month[]=$month_array[$i];

            if(!empty($total_amount_income[$i])){
                $total_amount_income1[] = $total_amount_income[$i];    
            }else{
                $total_amount_income1[] = 0;    
            }

            if(!empty($total_amount_expense[$i])){
                $total_amount_expense1[] = $total_amount_expense[$i];    
            }else{
                $total_amount_expense1[] = 0;    
            }
        }
        $sum=[];
        foreach($incomeexp_percent as $key=>$percent) {
        $sum[$key]=$percent->total;
        }
        $total_category=array_sum($sum);

        $percent_var=[];
        if(count($incomeexp_percent)>0)
        {
        foreach($incomeexp_percent as $percent) { 
        $percent_var['name'][]=$percent->category;
        $percent_var['y'][]=$percent->total*100/$total_category;
        }
        }
        else
        {
        $percent_var['name'][]="None";
        $percent_var['y'][]=0;  
        }        

        $ret_arr= array('month'=>$month,'total_amount_income1'=>$total_amount_income1,'total_amount_expense1'=>$total_amount_expense1,'incomeexp_percent'=>$incomeexp_percent,'total_category'=>$total_category,'percent_name'=>$percent_var['name'],'percent_y'=>$percent_var['y']);
        return $ret_arr;
    }

    public function add_expense(Request $request)
    {
       
        $tax=DB::table('tax')->get();
        $payment_types=DB::table('payment_types')->get();
        $category=Expense::distinct('category')->select('category')->get();
        $customer_name=Expense::distinct('customer_name')->select('customer_name')->get();
         return view('admin.add_expense',['tax'=>$tax,'category'=>$category,'customer_name'=>$customer_name,'payment_types'=>$payment_types]);
    }
    public function edit_exp($id)
    {
        $data=Expense::find($id);
        $category=Expense::distinct('category')->select('category')->get();
        $customer_name=Expense::distinct('customer_name')->select('customer_name')->get();
         $payment_types=DB::table('payment_types')->get();
        $tax=DB::table('tax')->get();
         return view('admin.add_expense',['data'=>$data,'tax'=>$tax,'category'=>$category,'customer_name'=>$customer_name,'payment_types'=>$payment_types]);
    }
    public function delete_exp($id){
        Expense::find($id)->delete();
        return back()->with('success','Expense Deleted successfully.');
    }
    public function delete_payment_type($id){
        PaymentTypes::find($id)->delete();
        return back()->with('success','Payment Type Deleted successfully.');
    }
    public function delete_tax($id){
        DB::table('tax')->where('id',$id)->delete();
        return back()->with('success','Tax Deleted successfully.');
    }

    public function tax_update(Request $request)
    {
        $i=0;
        foreach ($request->type as  $type) {

            $value=$request->value[$i];
            $id=$request->id[$i];
            $table=DB::table('tax')->where('id',$id)->count();
                if($table==0){
                    DB::table('tax')->insert(['type'=>$type,'value'=>$value]);
                }else{
                    DB::table('tax')->where('id',$id)->update(['value'=>$value,'type'=>$type]);
                }
            $i++;
         }
        return back()->with('success','Tax details Saved successfully.');
    }

    public function dividendSettings()
    {
        $settings = DividendSettings::first();
        return view('admin.dividendSettings')->with(compact('settings'));
    }

    public function DividendPayouts()
    {
        $AdminBankDetails = AdminBankDetails::get();
        $settings = DividendSettings::first();
        $transactions=DB::table('users')
            ->leftjoin('transactions','transactions.user_id','users.id')
            ->leftjoin('dividend_payment','dividend_payment.user_id','users.id')
            ->where('transactions.created_at','>=',$settings->from_date)
            ->where('transactions.created_at','<=',$settings->to_date)            
            ->select('transactions.*', 'users.*', 'dividend_payment.next_payment_date', DB::raw('sum(transactions.coins) as dividendcoins'))            
            ->groupBy('transactions.user_id')
            ->get();
        $DividendPayment=DB::table('users')
        ->leftjoin('transactions','transactions.user_id','users.id')
        ->leftjoin('dividend_payment','dividend_payment.user_id','users.id')
        ->where('transactions.created_at','>=',$settings->from_date)
        ->where('transactions.created_at','<=',$settings->to_date)
        ->select('transactions.*', 'users.*', 'dividend_payment.*', DB::raw('sum(transactions.coins) as dividendcoins'), DB::raw('dividend_payment.id as payment_id'))
        ->groupBy('transactions.user_id')
        ->get();

        $month_array=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');     
        
        $payouts=DB::table('dividend_payment')
        ->select(DB::raw('sum(term_amt) as total_paid'), DB::raw('MONTH(payment_date) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');
        $total_paid_amount=[];
        $total_amount_paid1=[];
        foreach ($payouts as $key => $payout) {
            $total_amount_paid1[$key] = $payout->total_paid;
        }
        for($i = 1; $i <= 12; $i++)
        {
            $month[$i]=$month_array[$i];

            if(!empty($total_amount_paid1[$i])){
                $total_paid_amount[$i] = $total_amount_paid1[$i];    
            }else{
                $total_paid_amount[$i] = 0;    
            }            
        }
        return view('admin.DividendPayouts')->with(compact('settings','transactions','AdminBankDetails','DividendPayment','total_paid_amount'));
    }    

    public function update_dividend_settings(Request $request)
    {
        $dividend=DividendSettings::first();
        $dividend->status = $request->viewdashboard;
        $dividend->note = $request->note;
        $dividend->save();
        return redirect()->back()->with('success', 'Dividend Settings Updated Successfully!');
    }

    public function update_dividend_structure_settings(Request $request)
    {           

        // old details
        $dividend_old=DividendSettings::first();
        if($dividend_old->updated_at=='' || $dividend_old->updated_at==NULL)
        {
            $date_from=$dividend_old->created_at;
        }
        else
        {
            $date_from=$dividend_old->updated_at;   
        }

        $history= new DividendSettingsHistory();
        $history->date_from=$date_from;
        $history->date_to=date('Y-m-d H:i:s');
        $history->note=$dividend_old->note;        
        $history->status=$dividend_old->status;        
        $history->dividend_type=$dividend_old->dividend_type;        
        $history->payment_schedule=$dividend_old->payment_schedule;        
        $history->dividend_amt=$dividend_old->dividend_amt;        
        $history->from_date=$dividend_old->from_date;        
        $history->to_date=$dividend_old->to_date;        
        $history->ex_dividend_date=$dividend_old->ex_dividend_date;        
        $history->created_at=$dividend_old->created_at;        
        $history->updated_at=$dividend_old->updated_at;        
        $history->save();
        // End of old details

        $dividend=DividendSettings::first();
        $dividend->dividend_type = $request->dividend_type;
        $dividend->payment_schedule = $request->payment_schedule;
        $dividend->dividend_amt = $request->dividend_amt;
        $dividend->from_date = date('Y-m-d',strtotime($request->from_date));
        $dividend->to_date = date('Y-m-d',strtotime($request->to_date));
        $dividend->ex_dividend_date = date('Y-m-d',strtotime($request->ex_dividend_date));
        $dividend->save();
        return redirect()->back()->with('success', 'Dividend Structure Settings Updated Successfully!');
    }

    public function BankCodeMaster()
    {
        $masters = BankCodeMaster::orderBy('id', 'desc')->get();
        return view('admin.BankCodeMaster')->with(compact('masters'));
    }

    public function add_bank_code(Request $request)
    {        
        $request->validate([
            'bank_code' => 'required',
            'status' => 'required',
        ]);
        try 
        {
        $bankcode= new BankCodeMaster();
        if($request->update_id){
        $bankcode=BankCodeMaster::find($request->update_id);
        }
        $bankcode->bank_code=$request->bank_code;
        $bankcode->status=$request->status;        
        $bankcode->save();
        } catch (Exception $e) {
        abort(404);
        }        
        if($request->update_id){
        return redirect('admin/BankCodeMaster')->with('success', 'Bank Code Updated successfully!');
        }
        else
        {
        return redirect('admin/BankCodeMaster')->with('success', 'Bank Code Added successfully!');
        }
    }

    public function edit_bankcode($bankid)
    {
        $masters = BankCodeMaster::orderBy('id', 'desc')->get();
        $master_edit = BankCodeMaster::where(['id'=>$bankid])->first();
        return view('admin.BankCodeMaster')->with(compact('master_edit','masters'));
    }

    public function delete_bankcode($bankid)
    {
        BankCodeMaster::find($bankid)->delete();
        return redirect()->back()->with('success', 'Bank Code Deleted Successfully!');
    }

    public function add_transaction(Request $request)
    {   
        $settings = DividendSettings::first();                     

        if($settings->payment_schedule=='Quarterly')
        {            
            $next_due_date=date('Y-m-d', strtotime("+3 months", strtotime($settings->ex_dividend_date)));
        }
        if($settings->payment_schedule=='Half yearly')
        {            
            $next_due_date=date('Y-m-d', strtotime("+6 months", strtotime($settings->ex_dividend_date)));
        }        

        $dpay= new DividendPayment();
        $dpay->user_id=$request->user_id;
        $dpay->transid=$request->transid;        
        $dpay->bank=$request->adminbank;        
        $dpay->dividend_type=$settings->dividend_type;        
        $dpay->payment_schedule=$settings->payment_schedule;        
        $dpay->dividend_amt=$request->total_dividend_amount;        
        $dpay->term_amt=$request->term_dividend_amount;        
        $dpay->from_date=$settings->from_date;        
        $dpay->to_date=$settings->to_date;        
        $dpay->ex_dividend_date=$settings->ex_dividend_date;
        $dpay->payment_date=date('Y-m-d');
        $dpay->next_payment_date=$next_due_date;
        $dpay->status=0;        
        $dpay->term_status=1;
        $dpay->save();                
        return redirect()->back()->with('success', 'Transaction Details Saved Successfully!');
    }

    public function dividend_userpayment_details($userid,$paymentid)
    {
        try {
            $user = User::where("id", $userid)->first();
            $payment = DividendPayment::where("dividend_payment.id", $paymentid)
            ->join('admin_bank_details','admin_bank_details.id','=','dividend_payment.bank')
            ->select('dividend_payment.*', DB::raw('admin_bank_details.account_name as bank_name'))
            ->first();
            return view('admin.users.showdividendpayment', compact('user','payment'));
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function dividend_payment_chart(Request $request)
    {        
        $month_array=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');

        $dividend_payment=DB::table('dividend_payment')
        ->whereYear('payment_date', '=', $request->year)
        ->select(DB::raw('sum(term_amt) as paid_amount'), DB::raw('MONTH(payment_date) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');

        $total_paid1=[];
        $total_paid=array();

        foreach ($dividend_payment as $key => $dpayment) {
            $total_paid1[$key] = $dpayment->paid_amount;
        }

        for($i = 1; $i <= 12; $i++)
        {
            $month[$i]=$month_array[$i];

            if(!empty($total_paid1[$i])){
                $total_paid[] = $total_paid1[$i];    
            }else{
                $total_paid[] = 0;    
            }            
        }
        $ret_arr= array('status'=>'success','Data'=>$total_paid);
        return $ret_arr;
    }

    public function createToken()
    {
        return view('admin.createToken');
    }

}
