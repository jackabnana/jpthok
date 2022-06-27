<?
session_start();
require_once __DIR__ . '/fb_login/autoload.php';

 $_SESSION['redirect_url'] =$_REQUEST['currenturl'];
$fb = new Facebook\Facebook([
  'app_id' => '218087965259470',
  'app_secret' => '877f383484cd4612c30d4bde4b507595',
  'default_graph_version' => 'v2.7',
  ]);


$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://www.onlinevandy.com/social/fb-callback.php', $permissions);

//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
header ("Location: $loginUrl");
?>