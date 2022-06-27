<?php
include_once 'phpconfig.php';

class DB_Class 
{
function __construct() 
{
mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or 
die('Oops connection error -> ' . mysql_error());
mysql_select_db(DB_DATABASE) 
or die('Database error -> ' . mysql_error());
}
}

?>