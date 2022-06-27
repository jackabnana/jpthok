<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'pending-order.php';
$currentpagetitle = 'False Orders';
$getdata = $get->get_active_data($_REQUEST['id'],'order_details');
$fetchrow = mysql_fetch_object($getdata);
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
	
<? if($_REQUEST['role'] == 'view-invoice'): ?>
<!-- Add Content -->
<div  id='content'>
<div class="page-heading">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=view" class="red_button fright">Back</a>
	</p>
</h2>
<div class="cboth"></div>
</div>
<div class="dashbox-main-div">

	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add user-->
		<h2><?=$getrole?> Order
		<input type="submit" name="<?=$getrole?>" onclick="printContent();" class="green_button fright" value="Print" />
		</h2>
		
		<?
$selectcat = mysql_query("SELECT * FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid WHERE OD.orderid='{$_REQUEST['id']}'");
$row=mysql_fetch_array($selectcat);
extract($row);
?>

		<!--Invoice-->
		<div style="page-break-after: always;  padding:10px 0px; margin:0px; " id="page-wrap">
		<img src="images/fb_icon.png" width="80" class="fleft" style="margin:2px;"/>
  <h1 class="fright">Invoice</h1>
  <table class="store" style="margin:5px 2px">
    <tr>
      <td><?=$get->get_website_name()?><br />
<b>Address</b> : 17A/35, 1st floor, <br />
West Punjabi Bagh.<br />
<b>Contact No.</b> : 011-25227210<br />
<?=$get->get_email()?><br />
www.onlinevandy.com</td>
      <td align="right" valign="top"><table>
          <tr>
            <td><b>Date Added:</b></td>
            <td>
				<? 
				$date = $orderdate;
				echo date('d-M-Y H:i:s', strtotime($date));
				?>
			</td>
          </tr>
                    <tr>
            <td><b>Order ID:</b></td>
            <td><?=$orderid?></td>
          </tr>
          <tr>
            <td><b>Payment Method:</b></td>
            <td><? if($payment_method == 'cod'): echo 'COD'; else: echo 'Online Payment'; endif; ?> </td>
          </tr>
         </table></td>
    </tr>
  </table>
  <table class="address" style="margin:5px 0px">
    <tr class="heading">
      <td width="50%"><b>To</b></td>
      <td width="50%"><b>Ship To</b></td>
    </tr>
    <tr>
      <td><?=$billfname?> <?=$billlname?><br />Address<br /><?=$bill1address?><br /><?=$bill2address?><br /><?=$billcountry?><br /><?=$billstate?><br/>
	  <?=$billcity?> <?=$billzip?><br>
        Phone No. <?=$billcontact?><br/>
         
		</td>
      <td><?=$shipfname?> <?=$shiplname?><br />Address<br /><?=$ship1address?><br /><?=$ship2address?><br /><?=$shillcountry?><br /><?=$shipstate?><br/>
	  <?=$shipcity?> <?=$shipzip?><br>
        Phone No. <?=$shipcontact?><br/></td>
    </tr>
  </table>
  <table class="product" style="margin:5px 0px">
    <tr class="heading">
      <td><b>Product</b></td>
      <td align="right"><b>Quantity</b></td>
      <td align="right"><b>Unit Price</b></td>
      <td align="right"><b>Total</b></td>
    </tr>
	
	<?
	$selectcart = mysql_query("SELECT * FROM order_prodcut_details WHERE orderid='{$_REQUEST['id']}'");
	
	while($raw=mysql_fetch_array($selectcart)):
	extract($raw);
	if($combo == 0){
	$total = $subtotal;
	$total_am += $total;
	}else {
	$getcombo = $get->get_combo_details($prod_id,$combo,$weight,$flavour);
	$combodetails = mysql_fetch_object($getcombo);
	$prod1_rate = $get->get_product_amount($combodetails->prod1_id,$combodetails->prod1_weight);
	$prod2_rate = $get->get_product_amount($combodetails->prod2_id,$combodetails->prod2_weight);
	$total = $prod1_rate+$prod2_rate;
	$total = $total-($total*$combodetails->disc/100);
	}
	?>
	
    <tr>
      <td>
	  <? if($combo == 0): ?>
	  <?=$get->get_product_name($prod_id)?>
	  <br>
	  <font style="font-size:14px;">
	  <b>Weight:</b> <?=$get->get_attribute_name($weight)?><br>
	  <b>Flavour:</b> <?=$get->get_attribute_name($flavour)?>
	  </font>
	  <? else: ?>
	  <div class="fleft" style="width:45%;">
	 <?=$get->get_product_name($combo)?>
	  <br>
	  <font style="font-size:14px;">
	  <b>Weight:</b> <?=$get->get_attribute_name($combodetails->prod2_weight)?><br>
	  <b>Flavour:</b> <?=$get->get_attribute_name($combodetails->prod2_flavour)?>
	  </font>
	  </div>
	  <div class="fleft" style="font-size:25px; width:10%; text-align:center; padding-top:10px;">
	  +
	  </div>
	  <div class="fleft" style="width:45%;">
	  <?=$get->get_product_name($prod_id)?>
	  <br>
	  <font style="font-size:14px;">
	  <b>Weight:</b> <?=$get->get_attribute_name($weight)?><br>
	  <b>Flavour:</b> <?=$get->get_attribute_name($flavour)?>
	  </font>
	  </div>
	  <? endif; ?>
	  </td>
      <td align="right" width="80"><?=$qty?></td>
      <td align="right" width="80">Rs. <?=$price?></td>
      <td align="right" width="80">Rs. <?=$total?></td>
    </tr>
	
	<? endwhile; ?>
	
	
                <tr>
      <td align="right" colspan="3"><b>Sub-Total:</b></td>
      <td align="right">Rs. <?=$total_am?></td>
    </tr>
        <tr>
      <td align="right" colspan="3"><b>Flat Shipping Rate:</b></td>
      <td align="right">Rs. <?=$shipping_amount?></td>
    </tr>
        <tr>
      <td align="right" colspan="3"><b>Total:</b></td>
      <td align="right">Rs. <?=$total_am+$shipping_amount?></td>
    </tr>
      </table>
  </div>
		
		<!--Invoice-->
		
		</div>
		
</div>
<?  //include ('include/footer.php'); ?>	
</div>
<!-- Add Content -->
<? endif; ?>

<? if($_REQUEST['role'] == 'view'): ?>
<!-- View Content -->
<div  id='content'>
<div class="page-heading">
<h2><span>Manage <?=$currentpagetitle?></span>
</h2>
<div class="cboth"></div>
</div>
<div class="dashbox-main-div">

	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	
	<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
	
	<h2><span>Manage <?=$currentpagetitle?></span>
	
	<div class="fleft search">
	<form action="" method="post">
	<input type="text" name="q" value="<?=$_REQUEST['q']?>" placeholder="Search by order id">
	<input type="submit" class="green_button" name="search">
	</form>
	</div>
	<form action="" method="post">
	<input type="submit" name="doaction" class="green_button fright" />
	<select name="action" class="fright select_action">
	<option value="">Select Action</option>
	<option value="pending">Pending</option>
	<option value="complete">Complete</option>
	<option value="cancel">Cancel</option>
	</select>
	<div style="clear:both"></div>

</h2>
<?
$sql = "SELECT OD.id as oid,OD.*,OCD.* FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid and OD.payment_method=''";
if($_POST['q'] !=''){
	$words = explode(" ", $_POST['q']);
	$x=1;
	foreach ($words as $w) {
		if($x == 1) { $sql .= ' '; } else { $sql .= ' OR '; }
	$sql .= " OD.orderid like '%$w%'";
	$x++; 
}
}

if($_REQUEST['user'] !=''){
	$sql .= " OD.userid='{$_REQUEST['user']}'";
}
$sql .= " ORDER BY OD.id DESC ";
if($_POST['q'] ==''){
	
	$sql .= "LIMIT $start, $limit";
}
$selectcat = mysql_query($sql);
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
	<td><strong>Order Id</strong></td>
	<td><strong>Customer Name</strong></td>
	<td><strong>Customer Email</strong></td>
	<td><strong>Order Date</strong></td>
	<td><strong>Order Type</strong></td>
	<td><strong>Order Status</strong></td>
	<td><strong>Order Amount</strong></td>	
	<td><strong>Status</strong></td>
	<td><strong>View</strong></td>	
</tr>
<?
$x=1;
while($row=mysql_fetch_array($selectcat)):
extract($row);
?>
<tr>
	<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$oid?>" /></label></td>
	<td><?=$orderid?></td>	
	<td style="  text-transform: capitalize;"><?=$billfname?> <?=$billlname?></td>
	<td><?=$get->get_user_email($userid)?></td>	
	<td><?=$orderdate?></td>
    <td><?=$payment_method?></td>
	<td><?=$payment_status?></td>
	<td>Rs. <?=$total_amount?> /-</td>
	<? 
	if($status == 'pending'){ 
	$bg = 'orange';
	} else if($status == 'complete'){
	$bg = 'green';
	} else if($status == 'cancel'){
	$bg = 'red';
	}
	?>
	<td style="  text-transform: capitalize;" bgcolor="<?=$bg?>">
	<?=$status?>
	</td>
	<td><a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=view-invoice&page=<?=$page?>&id=<?=$orderid?>">View</a></td>	
</tr>
<? 
endwhile; 
?>
</table>
	<?=$get->get_pagination('user',$currentpage,$page,$start,$limit)?>
<div  class="cboth"></div>
</form>
	</div>
	
</div>
<?  include ('include/footer.php'); ?>	
</div>
<!-- View Content -->
<? endif; ?>

</body>

<script>
function printContent(){
	var DocumentContainer = document.getElementById('page-wrap');
        var WindowObject = window.open('', 'PrintWindow', 'width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');

        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title>');
        WindowObject.document.writeln('<link rel="stylesheet" type="text/css" href="css/style.css" media="print">');
        WindowObject.document.writeln('</head><body>');
        WindowObject.document.writeln(DocumentContainer.innerHTML);
        WindowObject.document.writeln('</body></html>');

        WindowObject.document.close();
        WindowObject.focus();
        WindowObject.print();
        WindowObject.close();
}
</script>
</html>