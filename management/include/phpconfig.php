<?php
error_reporting(0);
date_default_timezone_set('Asia/Calcutta');
session_start();
$current_dir = dirname($_SERVER['PHP_SELF']);

if($_SERVER['HTTP_HOST'] == 'localhost'){
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'endia');
define('SITE_URL', 'http://localhost/endia');
define('ADMIN_PATH', 'http://localhost/endia/management');
define('VENDOR_PATH','http://localhost/onlinevandy/vendor');
define('PAGE_EXT', 'html');
}
else{
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u565095690_thokvikreta');
define('DB_PASSWORD', 'Thok@ecom2021#');
define('DB_DATABASE', 'u565095690_thokvikreta');
define('SITE_URL', 'https://www.thokvikreta.com');
define('ADMIN_PATH', 'https://www.thokvikreta.com/management');
define('VENDOR_PATH','https://www.thokvikreta.com/vendor');
define('PAGE_EXT', 'html');
}


?>