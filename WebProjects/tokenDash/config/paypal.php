<?php 
return array(
/** set your paypal credential **/
'client_id' =>'Aa89qYycvh_kjyqPu631D95AtEEd_tGk2l-WV3mFwZdrQS7EWZHrszkB9KeNvJn9v35bRq_O8fusE_Ef',
'secret' => 'EBS0Z4_cj9UQaFgDtbVVaYuVP3gMfFN-Xek7ZUr9NtsMNeMvP2BMrwsw3SEvjVRAGC8BRIVEbenWhsyz',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 30,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);