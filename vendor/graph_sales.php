<?php 
include ('../management/include/functions.php');
$user = new Admin();
$currentpage = 'graph_sales.php';
$currentpagetitle = 'Sales Graph';


$order = mysql_query("SELECT *, COUNT(id) AS Count, DATE_FORMAT(orderdate, '%M') AS Period FROM order_prodcut_details WHERE vendor_id='".$_SESSION['vendor_id']."' GROUP BY Period ");

while($getres = mysql_fetch_array($order))
{	
    $count_months = $get->get_number_of_month_acc_order($_SESSION['vendor_id'],$getres['Period']);

	$m = $getres['Period'];
	$c = $count_months;
	$saurav[] = array(
	                  "label" => $m ,
					  "value"=>$c
					  );
}


//echo '<pre>';
//print_r($saurav);
//echo '</pre>';

$aa = '$'.'label'.' Order : ' .'$'.'value';

$a1 = array(
			"chart" =>
				 array(
							"caption"      =>"Sales Graph - Month wise",
							"numberPrefix" =>"",
							"rotatevalues" =>"0",
							"plotToolText" =>$aa,
							"theme"        =>"fint"
					  )
			 );
           				 
$a2 = array(
				"data" => $saurav
			);
				   
$array_merge = json_encode((array_merge($a1,$a2)));
$file = file_put_contents("saurav.json",$array_merge);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<style>
.code-block-holder pre {
      max-height: 188px;  
      min-height: 188px; 
      overflow: auto;
      border: 1px solid #ccc;
      border-radius: 5px;
}
.tab-btn-holder {
	width: 100%;
	margin: 20px 0 0;
	border-bottom: 1px solid #dfe3e4;
	min-height: 30px;
}
.tab-btn-holder a {
	background-color: #fff;
	font-size: 14px;
	text-transform: uppercase;
	color: #006bb8;
	text-decoration: none;
	display: inline-block;
	*zoom:1; *display:inline;


}
.tab-btn-holder a.active {
	color: #858585;
    padding: 9px 10px 8px;
    border: 1px solid #dfe3e4;
    border-bottom: 1px solid #fff;
    margin-bottom: -1px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    position: relative;
    z-index: 300;
}
#ex1 > text >tspan
{
	display:none;
}

.my-style {position:relative;}
.my-style .hide-smothing {position: absolute;
    bottom: 16px;
    left: 15px;
    z-index: 1;
    width: 120px;
    height: 13px;
    background-color: #E6E6E6;}
</style>
</head>

<body>
<!-- Admin Main Area -->
<div id="adminmain">  
	<!-- Header -->
	<? include ('include/header.php'); ?>
	<!-- Header -->

	<!-- Left -->
	<div class="left">
	<?  include ('include/menu.php');  ?>
	</div>
	<!-- Left -->



<? if($_REQUEST['role'] == 'view'): ?>
<!-- View Content -->
<div  id='content'>
<div class="page-heading">

<h2><span>Manage <?=$currentpagetitle?></span></h2>

<div class="cboth"></div>
</div>
<div class="dashbox-main-div">
	
<div class="col-100 bg_color_white border_top_gray border_radius_5 my-style" > 

	<div class="hide-smothing"></div>
	<h2 style="border:none;"><span>Manage <?=$currentpagetitle?></span></h2>

	<?
	include("src/fusioncharts.php");
	$str = file_get_contents('saurav.json');
	$columnChart = new FusionCharts("column2d", "ex1" , "100%", 400, "chart-1", "json", $str);
	
// Render the chart
$columnChart->render();
?>
<div id="chart-1"><!-- Fusion Charts will render here--></div>
	
<div  class="cboth"></div>
</div>
<?  include ('include/footer.php'); ?>	
</div>
</div>
<!-- View Content -->
<? endif; ?>
</body>
</html>