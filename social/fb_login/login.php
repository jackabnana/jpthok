<?
session_start();
require_once __DIR__ . '/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1613911315525371',
  'app_secret' => 'a0841709fda0e840502db1cf4f7a0ab0',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://zoovi.in/property/social/fb_login/Facebook/fb-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

?>