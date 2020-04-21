<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::GET('/db/setup',function()
{
  
 if(View::exists('install'))
  {
    return view('install');
  }else
  {
    return view('errors.404');
  // echo View::exists('setup'); exit;
  // if(View::exists('setup'))
  // {
  //   return view('setup');
  // }else
  // {
  //   return view('errors.404');
    // return redirect('/');
  }
  
});

Route::GET('/db/install',function()
{
  if(View::exists('install'))
  {
    return view('install');
  }else
  {
    return view('errors.404');
    // return redirect('/');
  }
  //return view('install');
});

Route::GET('/db/configure',function()
{
  return view('configure');
});
// Route::POST('/db/save','SetupController@db_setup');
Route::POST('/db/setup','SetupController@db_setup');
Route::GET('/db/success_install',function()
{
  return view('success_install');
});

Route::get('/', 'welcome@index')->middleware('guest');
Route::get('/survey',function()
{
    return view('survey');
})->name('survey');


Route::get('/unverified', function () {
    return view('unverified');
})->name('unverified');
Route::get('/oauth/social/{provider}', 'Auth\LoginController@redirectToProvider')->middleware('guest')->name('oauth_social');
Route::get('/oauth/redirect/{provider}', 'Auth\LoginController@handleProviderCallback')->middleware('guest');
Route::group(['middleware' => ['isVerified']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/account', 'HomeController@account');
    Route::post('/account', 'HomeController@account_update');
    Route::post('/bank_account_update', 'HomeController@bank_account_update');
    Route::get('/transactions', 'HomeController@getTransactions')->name('transactions');
    Route::get('/readNotification/{id}', 'HomeController@readNotification');
    Route::post('/account/password', 'HomeController@account_password');
    Route::get('step-2', 'HomeController@step_2')->name('step_2');
    Route::post('step-3', 'HomeController@step_3')->name('step_3');
    Route::post('thank-you', 'HomeController@step_4')->name('step_4');
    Route::get('/step_3/{transaction}', 'HomeController@step3page');
    Route::get('/final-page', 'HomeController@final_page')->name('step_5');
    Route::post('/update_wallet_address', 'HomeController@update_wallet_address');
    Route::post('/updateKYCDetails', 'HomeController@updateKYCDetails')->name('update_kyc_details');
    Route::get('/viewKYCDetails', 'HomeController@viewKYCDetails')->name('view_kyc_details');
    Route::get('/notifications', 'HomeController@notifications')->name('notifications');
    Route::get('/stripe', 'PaymentController@show_stripe_page')->name('show_stripe_page');

    Route::POST('/stripe_done', 'PaymentController@stripe_done')->name('stripe_done');
    Route::POST('/init_payment_paypal', 'PaymentController@init_payment_paypal')->name('init_payment_paypal');
    
    Route::GET('/paypal_done', 'PaymentController@paypal_done')->name('paypal_done');

      Route::get('/update-cookies', 'HomeController@update_cookies')->name('update_cookies');
      Route::get('/update-alert', 'HomeController@update_alert')->name('update_alert');
      Route::get('/analytics', 'HomeController@analytics')->name('analytics');
      Route::get('/get-token-data', 'HomeController@get_token_data')->name('get_token_data');
      Route::GET('/survey','SurveyController@index');
      Route::GET('/single_survey/{id}','SurveyController@single_survey');
      Route::get('/dividend_dashboard', 'HomeController@dividend_dashboard');
      Route::get('/dividend_payment', 'HomeController@dividend_payment');
      Route::get('/Dividend_Payment_Chart', 'HomeController@dividend_payment_chart');
      Route::get('/userpayment_details/{userid}/{transid}', 'HomeController@userpayment_details');
      Route::get('/expense', 'HomeController@expense')->name('user_expense_report');
      Route::get('/IncomeNExpense_Charts', 'HomeController@IncomeNExpense_Charts')->name('IncomeNExpense_Charts');
      Route::post('/filter_expense', 'HomeController@expense')->name('filter_expense');
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.request');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('admin.password.email');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Route::auth();



Route::group(['middleware' => 'auth'], function () {
    // Route::get('/link1', function ()    {
    //     // Uses Auth Middleware
    // });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    Route::get('addon', function ()    {
        $data = [];
        return view('addon',$data);
    })->name('addon');

});



//<?php
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/unverified', function () {
//    return view('unverified');
//})->name('unverified');
//
//Route::group(['middleware' => ['isVerified']], function () {
//    Route::get('/home', 'HomeController@index')->name('home');
//    Route::get('/account', 'HomeController@account');
//    Route::post('/account', 'HomeController@account_update');
//    Route::post('/account/password', 'HomeController@account_password');
//
//    Route::get('step-2', 'HomeController@step_2')->name('step_2');
//    Route::post('step-3', 'HomeController@step_3')->name('step_3');
//    Route::post('thank-you', 'HomeController@step_4')->name('step_4');
//
//    Route::get('/notifications', 'HomeController@notifications')->name('notifications');
//});
//
//Route::group(['prefix' => 'admin'], function () {
//    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
//    Route::post('/login', 'AdminAuth\LoginController@login');
//    Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
//
//    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.request');
//    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('admin.password.email');
//    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
//    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
//});
//
//Route::auth();
//
//Route::group(['middleware' => 'auth'], function () {
//    // Route::get('/link1', function ()    {
//    //     // Uses Auth Middleware
//    // });
//
//    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
//    #adminlte_routes
    Route::get('addon', function ()    {
        $data = [];
        return view('addon',$data);
    })->name('addon');

//});



Route::get('email-test', function(){

    Mail::raw('test mail', function($message){
        $message->to('gamasome.amrendra@gmail.com');
    });
});
