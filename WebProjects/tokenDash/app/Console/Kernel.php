<?php

namespace App\Console;
use DB;
use Mail;
use Mailgun\Mailgun;
use Log;
use App\MailCampaign;
use App\CurrentDividend;
use App\DividendSettings;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $date=date("Y-m-d H:i".":00");

            $mails = DB::table('schedule_mails')->where('date', 'like', '%' . $date . '%')->where('status',1)->get();
            // $mails = DB::table('schedule_mails')->where('date',$date)->where('status',1)->get();

            // Log::info(print_r($mails, true));
            Log::info('today datetime '. $date);
         

            if(count($mails)>0){
                foreach ($mails as $key => $data) {
                    // if($data->date == $date){
                           Log::info('schedule datetime '. $data->date);
                        if($data->request_type == 1){
                            $receivers = DB::table('users')->select('email')->get();
                        }
                        
                        if($data->request_type == 2){
                            $receivers = $receivers = DB::table('users')->where("is_token", 1)->select('email')->get();
                        }
                        
                        if($data->request_type == 3){
                            $receivers = $receivers = DB::table('users')->where("is_token", 0)->select('email')->get();
                        }
                        
                        if($data->request_type == 4){
                           $receivers = DB::table('transactions')
                                       ->where('users.is_token', 1)
                                       ->whereBetween('transactions.date', array($data->form_date, $data->to_date))
                                       ->join('users','transactions.user_id','=','users.id')
                                       ->select('users.email')
                                       ->get();
                            
                        }
                        $to=array();
                        foreach ($receivers as $data1) {
                           array_push($to,$data1->email);
                        }

                        $subject=$data->subject;
                        $message=$data->mail_content;

                        Mail::send('emails.send_mail', array('body' => $message), function($message) use ($to,$subject)
                        {    
                            $message->to($to)->subject($subject);    
                        });
                        Log::info('Mail Sent');

		                $mail=new MailCampaign(); 
			            $mail->request_type=$data->request_type;
			            $mail->emails='';
			            $mail->subject=$data->subject;
			            $mail->mail_content=$data->mail_content;
			            $mail->user_count=0;
				        $mail->req_from_date=$data->req_from_date;
				        $mail->req_to_date=$data->req_to_date;
			            $mail->save();

			            Log::info('Mail Saved to Mail Campaign table');
			            
                        DB::table('schedule_mails')->where('id',$data->id)->delete();

                         Log::info('Mail Deleted from schedule_mails Table');
                    }
                // }
            }else{
                Log::info('NO Mails Today');
            }
            
        })->everyMinute();


        // storing current dividend
        $schedule->call(function () {
        
        $settings = DividendSettings::first();
        $transactions=DB::table('users')
            ->leftjoin('transactions','transactions.user_id','users.id')->where('transactions.created_at','>=',$settings->from_date)
            ->where('transactions.created_at','<=',$settings->to_date)
            ->select('transactions.*', 'users.*', DB::raw('sum(transactions.coins) as dividendcoins'))
            ->groupBy('transactions.user_id')
            ->get();
        if($settings->ex_dividend_date==date('Y-m-d'))
        {
        $curdividendupt= CurrentDividend::where('status',1)->update(['status'=>0]);
        Log::info('Current Dividend Status Changed');
        foreach($transactions as $key => $trans)
        {
            $curdividend= new CurrentDividend();
            $curdividend->user_id=$trans->user_id;
            $curdividend->dividend_type=$settings->dividend_type;
            $curdividend->payment_schedule=$settings->payment_schedule;
            $curdividend->dividend_coins=$trans->dividendcoins;
            $curdividend->from_date=$settings->from_date;        
            $curdividend->to_date=$settings->to_date;
            $curdividend->ex_dividend_date=$settings->ex_dividend_date;        
            $curdividend->status=1;            
            $curdividend->save();
        }
        Log::info('Inserted new dividends details');
        }
        else
        {
        Log::info('Ex dividend date matching');   
        }   
            
        })->twiceDaily(1, 13);
        // End of storing current dividend
    }

//everyMinute
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
