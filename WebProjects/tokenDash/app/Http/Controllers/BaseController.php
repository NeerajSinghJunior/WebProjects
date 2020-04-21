<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\DividendSettings;
use File;

define('BASE_URL', env('APP_URL').'/');
define('API_TOKEN_URL', 'http://18.191.111.236:8545');

  $admin=Admin::first();
define('API_KEY_SURVEY', $admin->survey_api_key);
define('LOGIN_ID_SURVEY', $admin->survey_login_id);
define('SURVEY_ACTION', $admin->survey_action);

$dividend_settings=DividendSettings::first();
define('DIVIDEND_ACTIVE', $dividend_settings->status);

class BaseController extends Controller
{
     public function image_upload_admin($request,$key,$image_name){
        $image = $request->$key;
        $ext = $image->getClientOriginalExtension();
        // $imageName = $image_name;
        $imageName = self::generate_random_string().'.'.$ext;
        $request->file($key)->move(
                'admin_images/', $imageName
        );
        return $image_url = BASE_URL."admin_images/" . $imageName;
    }
    

     public function image_upload($request,$key){
        // var_dump($request->$key);exit; keepers_logo.png
        $image = $request->$key;
        //$imageName = $request->file($key)->getClientOriginalName();
        $ext = $image->getClientOriginalExtension();
        $imageName = self::generate_random_string().'.'.$ext;
        $request->file($key)->move(
                'uploads/', $imageName
        );
        return $image_url = BASE_URL."uploads/" . $imageName;
    }
    public function generate_random_string() {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }

    public function token_transfer($to_address,$amount){
    	$url =API_TOKEN_URL;
    	$ch = curl_init($url);
    	$admin=Admin::first();

    	// define variables here

    	$contract_address = $admin->contract_address;
    	$from_address =$admin->ether;
    	$password=$admin->private_key;

      // $amount = 0.2;

        $sub_params = array($contract_address,$from_address, $password, $to_address, $amount, $admin->coin_value);
          $params = array(
              'jsonrpc' => '2.0', 
              'method' => 'sendTokens', 
              'params' => $sub_params, 
              'id' => 1, 
          );
          // echo "hello3<br>";
          $payload = json_encode($params);
           // var_dump($payload);
          curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
          curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
          # Return response instead of printing.
          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
          // echo "hello12<br>";
          # Send request.
          $result = curl_exec($ch);
          $err = curl_error($ch);
            $res=json_decode($result);
            // echo $res->result->hash; exit;
                    
            if(isset($res->error->code))
            {
              $failed = 1;
            }else{
              $failed = 0;
            }
            
         if ($result == false || $failed == 1) {
            $ret_arr=array('status'=>false ,'data'=>$res );
         }
         if($result==true && $failed == 0){
          $ret_arr=array('status'=>true,'data'=>$res);
         }

         // print_r($ret_arr['data']); exit;


          curl_close($ch);
          return $ret_arr;
    }
}
