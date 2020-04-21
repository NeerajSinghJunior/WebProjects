<?php

$host = $_GET['host'];
$username = $_GET['username'];
$password = $_GET['password'];
$db_name = $_GET['db_name'];
$conn = new mysqli($host,$username,$password,$db_name);
$temp = array();
if (!$conn->connect_error) {
	$data['status'] = true;
	$temp[]=$data;
	echo '{ "Data" : '.json_encode($temp).'}';
}else{
	$data['status'] = false;
	$temp[]=$data;
	echo '{ "Data" : '.json_encode($temp).'}';
}

$mysqlDatabaseName =$db_name;
$mysqlUserName =$username;
$mysqlPassword =$password;
$mysqlHostName =$host;
$mysqlImportFilename ='ico_update.sql';
//DONT EDIT BELOW THIS LINE
//Export the database and output the status to the page
$command='mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
exec($command,$output=array(),$worked);
?>