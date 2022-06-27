<?php
include '../management/include/functions.php';
$red_url = $_SESSION['redirect_url'];
########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
$google_client_id 		= '17689935821-3hn7ji8ctmi877jd6qmv11v7ofgqufui.apps.googleusercontent.com';
$google_client_secret 	= 'tDTngdTFAaMBRP45gQkBK_o4';
$google_redirect_url 	= 'http://www.onlinevandy.com/social/gplus-login.php'; //path to your script
$google_developer_key 	= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

########## MySql details (Replace with yours) #############
$db_username = "xxxxxxxxx"; //Database Username
$db_password = "xxxxxxxxx"; //Database Password
$hostname = "localhost"; //Mysql Hostname
$db_name = 'xxxxxxxxx'; //Database Name
###################################################################

//include google api files
require_once 'gplus/src/Google_Client.php';
require_once 'gplus/src/contrib/Google_Oauth2Service.php';

//start session
session_start();

$gClient = new Google_Client();
$gClient->setApplicationName('Login to Sanwebe.com');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset'])) 
{
  unset($_SESSION['token']);
  $gClient->revokeToken();
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) 
{ 
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
	return;
}


if (isset($_SESSION['token'])) 
{ 
	$gClient->setAccessToken($_SESSION['token']);
}


if ($gClient->getAccessToken()) 
{
	  //For logged in user, get details from google using access token
	  $user 				= $google_oauthV2->userinfo->get();
	  $user_id 				= $user['id'];
	  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
	  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
	  $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
	  $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
	  $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
	  $_SESSION['token'] 	= $gClient->getAccessToken();
}
else 
{
	//For Guest user, get google login url
	$authUrl = $gClient->createAuthUrl();
}

//HTML page start
echo '<!DOCTYPE HTML><html>';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
echo '<title>Login with Google</title>';
echo '</head>';
echo '<body>';

if(isset($authUrl)) //user is not logged in, show login button
{
?>
<script>window.location.href = '<?=$authUrl?>';</script>
<?
} 
else // user logged in 
{
$url = $site_url.'/index.html?email='.$user['email'].'&fname='.$user['given_name'].'&lname='.$user['family_name'].'&register_type=gp';
//$url = $red_url.'/home.html?email='.$user['email'].'&fname='.$user['given_name'].'&lname='.$user['family_name'].'&register_type=gp';

if($set->check_user($user['email'],$user['given_name'],$user['family_name'],'gp')){
?>
<script>window.location.href = '<?=$red_url?>';</script>

<? } else { ?>

<script>window.location.href = '<?=$url?>';</script>

<? unset($_SESSION['token']); } } echo '</body></html>'; ?>

