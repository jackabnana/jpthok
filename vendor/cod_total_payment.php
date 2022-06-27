<?php 
include ('../management/include/functions.php');
$user = new Admin();


$currentpage = 'orders.php';
$currentpagetitle = 'Orders';
$getdata = $get->get_active_data_vendor($_REQUEST['id'],'order_details',$_SESSION['vendor_id']);
$fetchrow = mysql_fetch_object($getdata);

//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';


$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['edit'])){
$edit = $set->update_user($_REQUEST['id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
	$add = $set->do_action($action,$ids,'order_details');
}

if($_GET['page'] == ''){
	$_GET['page'] = 1;
}

if(!isset($_GET['page'])){
	$_GET['page'] =1;
}
if(isset($_GET['page']))
{
   $page=$_GET['page'];
   $start=($page-1)*$limit;
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
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
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=VENDOR_PATH?>/<?=$currentpage?>?role=view" class="red_button fright">Back</a>
	</p>
</h2>
<div class="cboth"></div>
</div>
<div class="dashbox-main-div">
	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	
	<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
	
	<h2><span>Manage <?=$currentpagetitle?></span>
	
	<?/*<div class="fleft search">
	<form action="" method="post">
	<input type="text" name="q" value="<?=$_REQUEST['q']?>" placeholder="Search by order id">
	<input type="submit" class="green_button" name="search">
	</form>
	</div>*/?>
	<form action="" method="post">
	<input type="submit" name="doaction" class="green_button fright" />
	<select name="action" class="fright select_action">
	<option value="">Select Action</option>
	<option value="panding">Panding</option>
	<option value="complete">Complete</option>
	<option value="cancel">Cancel</option>
	<option value="delete">Delete</option>
	</select>
	<div style="clear:both"></div>

</h2>
<?

$sql = "SELECT * FROM order_prodcut_details WHERE vendor_id= '".$_SESSION['vendor_id']."' GROUP BY orderid";
/*
if($_REQUEST['status']=='pending')
{
	$sql = "SELECT OD.id as oid,OD.*,OCD.* FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid WHERE OD.status = 'pending' AND OD.vendor_id= '".$_SESSION['vendor_id']."' ";
}	
elseif($_REQUEST['status']=='complete')
{
	$sql = "SELECT OD.id as oid,OD.*,OCD.* FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid WHERE OD.status = 'complete' AND OD.vendor_id= '".$_SESSION['vendor_id']."' ";
}
else
{
	$sql = "SELECT OD.id as oid,OD.*,OCD.* FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid WHERE  OD.vendor_id= '".$_SESSION['vendor_id']."' ";
}
*/

$sql .= " ORDER BY id DESC LIMIT $start, $limit";
//echo $sql;
$selectcat = mysql_query($sql);

$row1 = mysql_fetch_array($selectcat);
$PM = $get->get_payment_method($row1['orderid']);
?>
<table width="100%" style="padding:0; margin:0">
<tr>
	<td><strong>Order Id</strong></td>
	<td><strong>Total Price</strong></td>
	<td><strong>TAX</strong></td>
	<td><strong>Payment Mode</strong></td>
	<td><strong>Tracking Status</strong></td>
	<td><strong>Order Date</strong></td>
	<td><strong>Settlement Value</strong></td>	
</tr>
<?
if($PM == 'COD')
{
$sql = "SELECT * FROM order_prodcut_details WHERE vendor_id= '".$_SESSION['vendor_id']."' GROUP BY orderid";
$sql .= " ORDER BY id DESC LIMIT $start, $limit";
$selectcat = mysql_query($sql);
$x=1;
while($row=mysql_fetch_array($selectcat)):



		$settlement = $get->get_order_total_vendor($_SESSION['vendor_id'],$row['orderid']) - $get->get_order_total_tax($_SESSION['vendor_id'],$row['orderid']);
		
		$total_settlement +=  $settlement;

?>
<tr>
	<td><?=$row['orderid']?></td>	
	<td>Rs. <?=$get->get_order_total_vendor($_SESSION['vendor_id'],$row['orderid'])?></td>	
	<td>Rs. <?=$get->get_order_total_tax($_SESSION['vendor_id'],$row['orderid'])?></td>
	<td><?=$get->get_payment_method($row['orderid'])?></td>
	<td><?=$get->get_order_tracking_status($row['orderid'])?></td>
	<td><?=$get->get_order_date($row['orderid'])?></td>
    <td>Rs. <?=$settlement?></td>
	
</tr>
<? 
endwhile; 
?>
<tr>
	<td colspan="6" align="right" width="32"><b>Total Settlement Value</b></td>
	<td>Rs. <?=$total_settlement?></td>
	
</tr>	
</table>

<?=$get->get_pagination_vendor('user',$currentpage,$page,$start,$limit,$_SESSION['vendor_id'])?>

<? }else{?>

<tr><td align="center" colspan="7">No result(s) found.</td></tr>
</table>
<? } ?>
<div  class="cboth"></div>
</form>
	</div>
	
<?  include ('include/footer.php'); ?>	
</div>
</div>
<!-- View Content -->
<? endif; ?>
</body>
</html>