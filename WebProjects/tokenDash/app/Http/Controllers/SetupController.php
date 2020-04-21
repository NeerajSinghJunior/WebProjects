<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SetupController extends Controller
{
    //
    public function db_setup(Request $request)
    {
    	$updates = array();
        if ($request->app_url) {
            $updates['APP_URL'] = $request->app_url;         
        }
    	if ($request->host) {
    		$updates['DB_HOST'] = $request->host;    		
    	}
    	if ($request->username) {
    		$updates['DB_USERNAME'] = $request->username;    		
    	}
        if ($request->password) {
            $updates['DB_PASSWORD'] = $request->password;           
        }
        if ($request->db) {
            $updates['DB_DATABASE'] = $request->db;         
        }


        if ($request->mail_driver) {
            $updates['MAIL_DRIVER'] = $request->mail_driver;           
        }
        if ($request->mail_host) {
            $updates['MAIL_HOST'] = $request->mail_host;           
        }
        if ($request->mail_port) {
            $updates['MAIL_PORT'] = $request->mail_port;           
        }
        if ($request->mail_username) {
            $updates['MAIL_USERNAME'] = $request->mail_username;           
        }
        if ($request->mail_password) {
            $updates['MAIL_PASSWORD'] = $request->mail_password;           
        }
        if ($request->mailgun_domain) {
            $updates['MAILGUN_DOMAIN'] = $request->mailgun_domain;           
        }
        if ($request->mailgun_secret) {
            $updates['MAILGUN_SECRET'] = $request->mailgun_secret;           
        }


        if ($request->twilio_account_sid) {
            $updates['TWILIO_ACCOUNT_SID'] = $request->twilio_account_sid;           
        }
        if ($request->twilio_auth_token) {
            $updates['TWILIO_AUTH_TOKEN'] = $request->twilio_auth_token;           
        }
        if ($request->twilio_phone_number) {
            $updates['TWILIO_PHONE_NUMBER'] = $request->twilio_phone_number;           
        }


        if ($request->google_client_id) {
            $updates['GOOGLE_CLIENT_ID'] = $request->google_client_id;           
        }
        if ($request->google_client_secret) {
            $updates['GOOGLE_CLIENT_SECRET'] = $request->google_client_secret;           
        }
        if ($request->google_redirect_url) {
            $updates['GOOGLE_REDIRECT'] = $request->google_redirect_url;           
        }


        // if ($request->token_balance_endpoint) {
        //     $updates['TOKEN_BALANCE_ENDPOINT'] = $request->token_balance_endpoint;           
        // }
        // if ($request->test_token_balance_endpoint) {
        //     $updates['TEST_TOKEN_BALANCE_ENDPOINT'] = $request->test_token_balance_endpoint;           
        // }
    	$env_update = $this->changeEnv($updates); 

        if($env_update == 1)
        {
            $APPURL=$request->app_url;
             // echo $APPURL; exit;
            return view('success_install', compact('APPURL'));
            // return redirect('/');
        }else
        {
            return back();
        }
    } 
    
    protected function changeEnv($data = array()){
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);
            \Artisan::call("config:cache");
            \Artisan::call("config:clear");

            return true;
        } else {
            return false;
        }
    }
    
}
