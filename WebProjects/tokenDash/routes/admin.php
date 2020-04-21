<?php

Route::get('/home', 'AdminController@index')->name('home');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
Route::post('/txn/complete/{id}', 'AdminController@completeTransaction')->name('transaction');

Route::get('/txn/{id}', 'AdminController@transaction')->name('transaction');
Route::post('/account/update_bank_details', 'AdminController@updateBankDetails');
Route::post('/google2fa', 'AdminController@google2fa')->name('google2fa');


Route::get('/account', 'AdminController@account')->name('account');
Route::get('/dividendSettings', 'AdminController@dividendSettings')->name('dividendSettings');
Route::get('/createToken', 'AdminController@createToken')->name('createToken');
Route::get('/DividendPayouts', 'AdminController@DividendPayouts')->name('DividendPayouts');
Route::get('/Dividend_Payment_Chart', 'AdminController@dividend_payment_chart')->name('dividend_payment_chart');
Route::post('/account', 'AdminController@account_update')->name('account_update');
Route::post('/account/password', 'AdminController@account_password')->name('account_password');
Route::post('/updateScripts', 'AdminController@updateScripts');
Route::post('/updateStripe', 'AdminController@updateStripe');
Route::post('/updatePaypal', 'AdminController@updatePaypal');
Route::post('/updateDefaultCoin', 'AdminController@updateDefaultCoin');
Route::get('/BankCodeMaster', 'AdminController@BankCodeMaster')->name('BankCodeMaster');

Route::get('/addon', 'AdminController@addon')->name('addon');

Route::get('/user', 'AdminController@user')->name('user');
Route::get('/user/{id}', 'AdminController@user_details')->name('user_details');
Route::get('/get_mail_details/{id}', 'AdminController@get_mail_details')->name('get_mail_details');
Route::get('/dividend_user_details/{userid}', 'AdminController@dividend_user_details')->name('dividend_user_details');
Route::get('/dividend_userpayment_details/{userid}/{paymentid}', 'AdminController@dividend_userpayment_details')->name('dividend_userpayment_details');

Route::get('/notifications', 'AdminController@notifications')->name('notifications');

Route::get('/message', 'AdminController@message')->name('message');
Route::get('/sms_events', 'AdminController@sms_events')->name('sms_events');
Route::post('/send_message','AdminController@send_message');

Route::get('/mail', 'AdminController@mail')->name('mail');
Route::get('/mail_events', 'AdminController@mail_events')->name('mail_events');
Route::get('/draft_mails', 'AdminController@draft_mails')->name('draft_mails');
Route::get('/delete_draft_mail{id}', 'AdminController@delete_draft_mail')->name('delete_draft_mail');
Route::get('/get_draft_mail/{id}', 'AdminController@get_draft_mail')->name('get_draft_mail');
Route::post('/send_mail','AdminController@send_mail');

Route::post('/add_notification','AdminController@add_notification');
Route::get('/edit_bankcode/{bankid}','AdminController@edit_bankcode');
Route::post('/add_bank_code','AdminController@add_bank_code');
Route::post('/add_transaction','AdminController@add_transaction')->name('add_transaction');

Route::post('/saveTransactionId','AdminController@saveTransactionId');

Route::get('/delete_notification/{notification}','AdminController@delete_notification');
Route::get('/delete_bankcode/{bankid}','AdminController@delete_bankcode');

Route::get('/delete_user/{user}','AdminController@delete_user');
Route::post('/cms/store','Admin\CmsController@store')->name('storeCms');

//admin wallet address
Route::post('/admin_wallet','AdminController@admin_wallet_address');

Route::post('/change_captcha','AdminController@change_captcha');
Route::post('/update_dividend_settings','AdminController@update_dividend_settings');
Route::post('/update_dividend_structure_settings','AdminController@update_dividend_structure_settings');

Route::post('/cms/store','Admin\CmsController@store')->name('storeCms');
Route::post('/cms/update/{id}','Admin\CmsController@update')->name('updateCms');
Route::get('/cms/add','Admin\CmsController@add')->name('addCms');
Route::get('/cms/delete/{id}','Admin\CmsController@delete')->name('deleteCms');
Route::get('/cms/edit/{id}','Admin\CmsController@edit')->name('editCmsForm');
Route::get('/cms/view/{id}','Admin\CmsController@view')->name('viewCms');
Route::get('/cms/viewAll','Admin\CmsController@viewAll')->name('viewAllCms');

Route::post('/progressBar/store','Admin\ProgressBarController@store')->name('storeProgressBar');
Route::post('/progressBar/update/{id}','Admin\ProgressBarController@update')->name('updateProgressBar');
Route::get('/progressBar/delete/{id}','Admin\ProgressBarController@delete')->name('deleteProgressBar');
Route::get('/progressBar/viewAll','Admin\ProgressBarController@viewAll')->name('viewAllProgressBar');

Route::get('/referrals', 'Admin\Referral@getReferrals')->name('viewReferrals');
Route::post('/referrals/update', 'Admin\Referral@updateReferral')->name('updateReferral');
Route::post('/referrals/updateReferralTxn', 'Admin\Referral@updateReferralTxn')->name('updateReferralTxn');


Route::get('/admin/cookies', 'AdminController@show_cookies_page')->name('show_cookies_page');
Route::get('/admin/store_cookies', 'AdminController@store_cookies')->name('store_cookies');
    // paymenst
Route::get('/admin/manage-payments-type', 'AdminController@show_payments_page')->name('manage-payments-type');

Route::get('/admin/store_payments_methods', 'AdminController@store_payments_methods')->name('store_payments_methods');

Route::post('/store_expense', 'AdminController@store_expense')->name('store_expense');
Route::get('/expense', 'AdminController@expense')->name('expense');
Route::get('/IncomeNExpense_Charts', 'AdminController@IncomeNExpense_Charts')->name('IncomeNExpense_Charts');
Route::get('/Token_Request_Charts', 'AdminController@Token_Request_Charts')->name('Token_Request_Charts');
Route::post('/filter_expense', 'AdminController@expense')->name('filter_expense');
Route::post('/update_expense_report_status', 'AdminController@update_expense_report_status')->name('update_expense_report_status');
Route::get('/add_expense', 'AdminController@add_expense')->name('add_expense');
Route::get('/exp/{id}', 'AdminController@edit_exp')->name('edit_exp');
Route::get('/exp_delete/{id}', 'AdminController@delete_exp')->name('delete_exp');
Route::post('tax_update', 'AdminController@tax_update')->name('tax_update');
Route::post('add_payment_type', 'AdminController@add_payment_type')->name('add_payment_type');
// 
Route::get('survey_list', 'SurveyController@survey_list')->name('survey_list');
Route::get('survey_settings', 'SurveyController@survey_settings')->name('survey_settings');
Route::post('save_survey_settings', 'SurveyController@save_survey_settings')->name('save_survey_settings');
Route::get('enable_survey/{id}/{status}', 'SurveyController@enable_survey')->name('enable_survey');

Route::get('/delete_tax/{id}', 'AdminController@delete_tax')->name('delete_tax');
Route::get('/delete_payment_type/{id}', 'AdminController@delete_payment_type')->name('delete_payment_type');