<?php

include_once 'dbconfig.php';
include_once 'set-functions.php';
include_once 'get-functions.php';

$admin = new Admin();
$set = new Set();
$get = new Get();

$start = 0;
$limit = $get->get_admin_per_page();

$site_url = SITE_URL;

class Admin
{
/******************Admin Details*****************************/
//Database connect 
public function __construct() 
{
	$db = new DB_Class();
}


// Login process
public function check_login($user,$password) 
{
	$result = mysql_query("SELECT id,vendor_id from admin_login WHERE username = '$user' and password = '$password'");
	$user_data = mysql_fetch_array($result);
	$no_rows = mysql_num_rows($result);
	if ($no_rows == 1) 
	{
	$_SESSION['checkadmin'] = $user;
	$_SESSION['vendor_id'] = $user_data['vendor_id'];
	return TRUE;
	}
	else
	{
	return FALSE;
	}
}

// Getting session 
public function get_session() 
{
	return $_SESSION['checkadmin'];
}


//Logout
public function logout(){
	session_destroy();
	header('location:index.php');
}





//class End



}















?>