<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Notification;
use App\Transaction;
use App\ReferralsModel;
use App\ProgressBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;
use Validator;
use App\DividendSettings;
use App\BankCodeMaster;
use App\AdminBankDetails;
use App\DividendPayment;
use App\User;
use App\Expense;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $notification = Notification::latest()->where('is_read', '0')->first();
        $settings = Admin::first();
        $amount = Transaction::where('status', 'COMPLETED')->where('user_id', Auth::user()->id)->sum('coins');
        $referral_settings = DB::table('referral_settings')->first();

        $referer_earning_amount= ReferralsModel::where('status', 'COMPLETED')->where('referrer', Auth::user()->id)->sum('referer_earning_amount');
       
        $today_date=date('Y-m-d');
        $date=DB::select(DB::raw('SELECT * FROM progress_bar WHERE  progress_bar_date <= "'.$today_date.'" and coin_price IS NOT NULL and is_completed = 0')); 

        $check_notify=DB::select(DB::raw('SELECT * FROM progress_bar WHERE  progress_bar_date >= "'.$today_date.'" and coin_price IS NOT NULL and is_completed = 0')); 
       
        if(count($check_notify)>0){
            $date_minus=$check_notify[0]->notify_before;
            $start_date= $check_notify[0]->progress_bar_date;
            $alert_date_str=mktime(0,0,0,date('m',strtotime($start_date)),date('d',strtotime($start_date))-$date_minus,date('Y',strtotime($start_date)));
            $alert_date= date('Y-m-d',$alert_date_str);
            $minus_date=strtotime($start_date)-strtotime($today_date);
            $diff=date_diff(date_create($start_date),date_create($today_date));
            $date_diff=$diff->format("%R%a Days");
            $notify=$request->session()->get('show_notify');
            // print_r($start_date);
            // echo "<br>";
            // print_r($alert_date);exit;
            if($notify==""){
                   $request->session()->forget('notify_message');
                    $request->session()->forget('upcomming_coin_price');
                    $request->session()->forget('upcomming_date');
                if((strtotime($alert_date)<strtotime($start_date) || strtotime($alert_date)>=strtotime($today_date )) && strtotime($start_date)!=strtotime($today_date)){
                    $request->session()->put('notify_message','The price will increases in '.abs($date_diff).' Days 
                        ');
                    $request->session()->put('upcomming_coin_price',$check_notify[0]->coin_price);
                    $request->session()->put('upcomming_date',$check_notify[0]->progress_bar_date);
                }elseif (strtotime($start_date)==strtotime($today_date)) {
                    $request->session()->put('notify_message','Price has increase today!.');
                    $request->session()->put('upcomming_coin_price',$check_notify[0]->coin_price);
                    $request->session()->put('upcomming_date',$check_notify[0]->progress_bar_date);
                }
                  
               
            }
        }
   
        if(count($date)>0){
            $settings->coin_value= $date[0]->coin_price;
        }else{
            $settings->coin_value=$settings->default_token_price;// default price..
        }
        $settings->save();
        
      
        $stripe=DB::table('settings')->where('param','stripe_pk_key')->first();
        $stripe_key=$stripe->value;;
         $semi=0;
         $automatic=0;
        
        $types=explode(',',$settings->payments_types);
        
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

         $join_data=DB::table('survey_list')
            ->leftjoin('survey_notify','survey_notify.survey_id','survey_list.id')->where('survey_list.status','live')->
            select('survey_notify.status as Stat')->get();
            $count=0;
            foreach ($join_data as $key => $value) {
                if($value->Stat==""){
                    $count +=1;
                }
            }

            
                $request->session()->put('survey_notify_count',$count);
          
        $AdminBankDetails = AdminBankDetails::where('default_flag','1')
        ->join('bank_code_master','bank_code_master.id','=','admin_bank_details.bank_code')
        ->get();
        
        return view('home', compact('notification', 'settings','amount','referer_earning_amount','referral_settings','semi','automatic','stripe_key','AdminBankDetails'));
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */

    public function expense(Request $request)
    {

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
        ->where('customer_name',request()->user()->name)
        ->select(DB::raw('sum(total_amount) as total_amount'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');

        
        $expenses=DB::table('expense')
        ->where('type',2)
        ->where('customer_name',request()->user()->name)
        ->select(DB::raw('sum(total_amount) as total_amount'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');

        $incomeexp_percent=DB::table('expense')
        ->where('customer_name',request()->user()->name)
        ->select(DB::raw('count(*) as total'), DB::raw('category as category'), DB::raw('MONTH(created_at) as month'))
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

        $data=$d->orderBy('id','desc')->get();
          $autocomplete=Expense::distinct('category')->select('category')->get();
         return view('user_expense_report',['data'=>$data,'from_date'=>$from_date,'to_date'=>$to_date,'type'=>$type,'autocomplete'=>$autocomplete,'category'=>$category,'month'=>$month,'total_amount_income1'=>$total_amount_income1,'total_amount_expense1'=>$total_amount_expense1,'incomeexp_percent'=>$incomeexp_percent,'total_category'=>$total_category]);
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


    public function account()
    {
        $BankCodeMaster = BankCodeMaster::get();
        return view('account')->with(compact('BankCodeMaster'));;
    }
    public function readNotification($id)
    {
        $notification = Notification::where('id', $id)->first();
        $explodes = explode(",", $notification->user_read);
        $key = array_search(request()->user()->id, $explodes);
        if ($key === false) {
            array_push($explodes, request()->user()->id);
            $notification->user_read = implode(",", $explodes);
            $notification->save();
        }
        return back();
    }
    public function notifications()
    {

        Notification::where('is_read', '0')->update(['is_read' => '1']);
        $notifications = Notification::limit(5)->orderBy('id', 'desc')->get();
        return view('notifications', compact('notifications'));
    }

    /**
     * Show the Transactions.
     *
     * @return Response
     */
    public function getTransactions()
    {
        $transactions = Transaction::where('user_id', request()->user()->id)->get();

        $amount = Transaction::where('status', 'COMPLETED')->where('user_id', Auth::user()->id)->sum('coins');
        $referer_earning_amount = ReferralsModel::where('status', 'COMPLETED')->where('referrer', Auth::user()->id)->sum('referer_earning_amount');

        return view('transactions', compact('transactions','amount', 'referer_earning_amount'));
    }
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function account_update()
    {
        $user = Auth::user();
        
        $input = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . request()->user()->id,
            'phone' => 'required|string|max:255|unique:users,phone,' . request()->user()->id,
            'password' => 'nullable|string|min:6|confirmed',
            'password_old' => 'nullable|string|min:6',
            'profile_picture' => 'nullable|image'
        ]);
        // var_dump($input['profile_picture'] );exit;
        if(request()->profile_picture) {
            $input['profile_picture'] = $this->image_upload(request(),'profile_picture');//request()->profile_picture->store('profile_pictures');
            // $input->profile_picture = $picture;
        }
        if (empty($input['password'])) {
            unset($input['password']);
        } else {
            if (Hash::check(request()->password_old, request()->user()->password)) {
                $input['password'] = bcrypt($input['password']);
            }
        }
        request()->user()->update($input);

        return back();
    }

    /**
     * Change Password.
     *
     * @return \Illuminate\Http\Response
     */
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
            return back()->with('success', 'password updated');
        } else {

            return back()->with('error', 'old password is wrong');

        }

    }

    /**
     * Change Password.
     *
     * @return \Illuminate\Http\Response
     */
    public function step_2()
    {
        return view('step-2');
    }

    /**
     * Change Password.
     *
     * @return \Illuminate\Http\Response
     */
    public function step_3(Request $request)
    {
        // dd($request);
        // dd(request()->all());

// echo Auth::id();
        // exit;
        $input = $request->validate([
            'amount' => 'required|string|max:255',
            'coins' => 'required|string|max:255',
            'txn_id' => 'required|string|max:255',
            // 'description' => 'required|string|max:255',
            'screenshot' => 'required|image|max:2048',
            'cash_type' => 'required|string|max:255',

        ]);

        $request->validate([
            'fiat_currency' => 'nullable|required_if:fiat_cash,null',
            'crypto_currency' => 'nullable|required_if:fiat_currency,null',
        ]);
        $Transaction = new Transaction();
        $Transaction->amount = $request->amount;
        $Transaction->coins = $request->coins;
        $Transaction->txn_id = $request->txn_id;
        $Transaction->description = $request->description;
         $Transaction->pay_status ='COMPLETED';
        $Transaction->screenshot = $this->image_upload($request,'screenshot'); //$request->screenshot->store('screenshots');
        $Transaction->cash_type = $request->cash_type;
        $Transaction->user_id = Auth::id();

        if ($request->cash_type == "Fiat Cash") {
            // echo "fiat currency";exit;
            $Transaction->cash_type = $request->cash_type;
            $Transaction->currency = $request->fiat_currency;
            // $Transaction->user_id=Auth::id();
            $Transaction->save();
        } else {
            // echo "crypto currency";exit;
            $Transaction->cash_type = $request->cash_type;
            $Transaction->currency = $request->crypto_currency;
            // $Transaction->user_id=Auth::id();
            if ($request->crypto_currency != 'Others') {

                $Transaction->currency = $request->crypto_currency;

            }

            if ($request->crypto_currency == 'Others') {

                $Transaction->currency = $request->crypto_currency;

                $Transaction->others = $request->other_currency;

            }
            $Transaction->save();
        }

        $Transaction->save();

// // dump(isset(request()->fiat_currency));
        // //         dd(request()->crypto_currency);
        //         $input['screenshot'] = request()->screenshot->store('screenshots');

//         $input['user_id'] = request()->user()->id;

//         $Transaction =new Transaction();

        // $Transaction = Transaction::create($input);
        //         // $Transaction = Transaction::find(1);

//         }

        return redirect('/step_3/' . $Transaction->id);

//        return view('step-3', compact('Transaction'));

    }

    public function step3page(Transaction $transaction)
    {

        return view('step-3', compact('transaction'));

    }

    /**
     * Change Password.
     *
     * @return \Illuminate\Http\Response
     */
    public function step_4()
    {
        $input = request()->validate([
            'txn_id' => 'required|string|max:255',
            'wallet_address' => 'nullable|string|max:255',
            'wallet_name' => 'nullable|string|max:255',
            'ether' => 'required_without_all:wallet_address,wallet_name|max:255',
        ]);

        $auth = Auth::user();

        try {
            $Transaction = Transaction::find(request()->txn_id);
            $Transaction->ether = request()->ether;
            $Transaction->wallet_type = request()->wallet_type;
            $auth->ether = request()->ether;
            $auth->wallet_address = request()->wallet_address;
            $Transaction->wallet_address = request()->wallet_address;
            $auth->wallet_name = request()->wallet_name;
            $Transaction->wallet_name = request()->wallet_name;
            $auth->save();
            $Transaction->save();
        } catch (Exception $e) {
            abort(404);
        }

        return view('step-4');
    }

    public function final_page()
    {
        return view('step-4');
    }
    public function viewKYCDetails() {
        return view('kyc');
    }
    public function updateKYCDetails(Request $request)
    {

          $validator = Validator::make(
                                $request->all(), array(
                            'address_proof' => 'mimes:jpeg,jpg,bmp,png',
                            'id_proof' => 'mimes:jpeg,jpg,bmp,png',
                            'photo_proof' => 'mimes:jpeg,jpg,bmp,png',
                                // 'gender' => 'in:male,female,others',
                                )
                );

                if ($validator->fails()) {
                        $error_messages = implode(',', $validator->messages()->all());
                        return back()->with('error', $error_messages);
                }
                 else {

                            try {

                                $auth = Auth::user();
                                if ($request->address_proof) {
                                    $auth->address_proof = $this->image_upload($request,'address_proof'); //$request->address_proof->store('kyc');
                                }
                                if ($request->id_proof) {
                                    $auth->id_proof = $this->image_upload($request,'id_proof');//$request->id_proof->store('kyc');
                                }
                                if ($request->photo_proof) {

                                    $auth->photo_proof = $this->image_upload($request,'photo_proof');//$request->photo_proof->store('kyc');
                                }
                                // dd('hi');
                                if(
                                    !$request->address_proof && !$request->id_proof && !$request->photo_proof && 
                                    !$auth->address_proof && !$auth->id_proof && !$auth->photo_proof
                                ) {
                                    // dd('hiddd');
                                    return redirect()->back()->with('error', 'Please upload atleast one document, to start your verification process.');
                                }
                                $auth->save();
                                return redirect()->back()->with('success', 'KYC details have been uploaded successfully.');
                            } catch (Exeception $e) {
                                return redirect()->back()->with('error', 'KYC details not updated.');
                            }
                        }
    }
    public function update_wallet_address(Request $request)
    {

        $request->validate([
            'wallet_address' => 'string|max:255',
            'wallet_name' => 'string|max:255',
            'ether' => 'required_without_all:wallet_address,wallet_name|max:255',
        ]);
        $user = Auth::user();
        $user->ether = $request->ether;
        $user->wallet_address = request()->wallet_address;
        $user->wallet_name = request()->wallet_name;
        $user->save();
        Transaction::where('user_id', $user->id)->update([
            'ether' => $request->ether,
        ]);
        return redirect()->back()->with('success', 'Wallet Address updated successfully');

    }
    public function update_cookies(Request $request)
    {

          if($request->status==1){
              $user = Auth::user();
              $user->is_accept_cookie=$request->status;
              $user->save();
              $request->session()->put('is_cookie',1);
          }else{
             $request->session()->put('is_cookie',2);
          }

      
      return 1;
    }
    public function update_alert(Request $request)
    {
    	$request->session()->forget('notify_message');
    	$request->session()->put('show_notify','0');	
    	return 1;
    }
    public function analytics(Request $reqeust)
    {
    	return view('analytics');
    }
    public function get_token_data(Request $request) 
    {
    	
    	 $data = Transaction::where('status', 'COMPLETED')->where('user_id', Auth::user()->id)->get();
    	 return $data;
    }

    public function dividend_dashboard()
    {
        $dividend_settings = DividendSettings::first();
        return view('dividend_dashboard', ['dividend_settings'=>$dividend_settings]);
    }

    public function bank_account_update()
    {
        $user = Auth::user();
        $input = request()->validate([
            'bankname' => 'required|string|max:255',
            'account_number' => 'required',
            'bank_code' => 'required',
            'bankcodevalue' => 'required'
        ]);   
        request()->user()->where('id',$user->id)->update($input);
        return back()->with('success', 'Bank Details Updated successfully!');
    }

    public function dividend_payment()
    {
        $settings = DividendSettings::first();
        $transactions = DB::table('dividend_payment')
        ->leftjoin('users','users.id','dividend_payment.user_id')
        ->where('user_id', request()->user()->id)
        ->select('dividend_payment.*','users.name as username',DB::raw('sum(dividend_payment.term_amt) as paid_amount'),DB::raw('dividend_payment.id as transid'))
        ->orderBy('payment_date','DESC')
        ->get();             
        $last_date=DividendPayment::where('user_id', request()->user()->id)
        ->select('dividend_payment.payment_date')
        ->orderBy('payment_date','DESC')
        ->first(); 

        $month_array=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');

        $dividend_payment=DB::table('dividend_payment')
        ->where('user_id', request()->user()->id)
        ->select(DB::raw('sum(term_amt) as paid_amount'), DB::raw('MONTH(payment_date) as month'))
        ->groupBy('month')
        ->get()
        ->keyBy('month');

        $total_paid1=[];
        $total_paid=[];

        foreach ($dividend_payment as $key => $dpayment) {
            $total_paid1[$key] = $dpayment->paid_amount;
        }

        for($i = 1; $i <= 12; $i++)
        {
            $month[$i]=$month_array[$i];

            if(!empty($total_paid1[$i])){
                $total_paid[$i] = $total_paid1[$i];    
            }else{
                $total_paid[$i] = 0;    
            }            
        }
        return view('dividend_payment', compact('transactions','last_date','settings','total_paid'));
    }

    public function dividend_payment_chart(Request $request)
    {        
        $month_array=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');

        $dividend_payment=DB::table('dividend_payment')
        ->where('user_id', request()->user()->id)
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

    public function userpayment_details($userid,$transid)
    {
        try {
            $settings = DividendSettings::first();
            $user = User::where("id", $userid)->first();
            $payment = DividendPayment::where("dividend_payment.id", $transid)
            ->join('admin_bank_details','admin_bank_details.id','=','dividend_payment.bank')
            ->join('bank_code_master','bank_code_master.id','=','admin_bank_details.bank_code')
            ->select('dividend_payment.*', 'admin_bank_details.account_number', 'admin_bank_details.account_ifsc', 'bank_code_master.bank_code as bankcodename', DB::raw('admin_bank_details.account_name as bank_name'))
            ->first();
            return view('showuserpayment', compact('user','payment','settings'));
        } catch (Exception $e) {
            abort(404);
        }
    }
}
