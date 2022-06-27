<?php 
include ('../management/include/functions.php');
$user = new Admin();

$currentpage = 'orders.php';
$currentpagetitle = 'Orders';
$getdata = $get->get_active_data_vendor($_REQUEST['id'],'order_details',$_SESSION['vendor_id']);
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
	
<? if($_REQUEST['role'] == 'view-invoice'): ?>
<!-- Add Content -->
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
		<!--Add user-->
		<!--<h2>Order Details
		<input type="submit" name="<?//=$getrole?>" onclick="printContent();" class="green_button fright" value="Print" />
		</h2>-->
		<?
		
$selectcat = mysql_query("SELECT * FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid WHERE OD.orderid='{$_REQUEST['id']}' ");
$row=mysql_fetch_array($selectcat);
extract($row);
?>
<!--Invoice-->
  <div style="page-break-after: always;  padding:10px 0px; margin:0px; " id="page-wrap">
  <h1>Order Details</h1>
  <table class="store" >
    <tr>
	<? $delivery = $get->get_delivery_charges();?>
	<td><b>Order ID :</b> <?=$orderid?><br/><br/>
	    <b>Order Date :</b> <? $date = $orderdate; echo date('d-M-Y', strtotime($date)); ?><br/><br/>
		<?/*<b>Amount Paid :</b> Rs. <?=$total_amount+$delivery?>*/?>
	</td>	
	
	<td align="right">
		<h3><?=ucfirst($billname)?>&nbsp;&nbsp;<small><?=$billcontact?></small></h3><br/>
		<p><?=$billaddress?>, <?=$billlandmark?>, <?=$billcity?>, <br><?=$billstate?> - <?=$billzip?></p>
	</td>
    <?
	/*
	<td><?=$get->get_website_name()?><br />
	Address : ,<br />
	<br>
	<br>
	Contact No. : <?=$get->get_phone_no()?><br />
	<?=$get->get_email()?><br />
	www.carryindia.com</td>
	
      <td align="right" valign="top"><table>
          <tr>
            <td><b>Date Added:</b></td>
            <td><?=$orderdate?></td>
          </tr>
                    <tr>
            <td><b>Order ID:</b></td>
            <td><?=$orderid?></td>
          </tr>
          <tr>
            <td><b>Payment Method:</b></td>
            <td><?=$payment_method?></td>
          </tr>
         </table></td>
		 
		 */
	?>
    </tr>
  </table>
  <?
  /*
  <table class="address">
    <tr class="heading">
      <td width="50%"><b>To</b></td>
      <td width="50%"><b>Ship To</b></td>
    </tr>
    <tr>
      <td><?=$billfname?> <?=$billlname?><br />Address<br /><?=$bill1address?><br /><?=$bill2address?><br /><?=$billcountry?><br /><?=$billstate?><br/>
	  <?=$billcity?> <?=$billzip?><br>
        <?=$billcontact?>,<?=$billtelephone?><br/>
         
		</td>
      <td><?=$shipfname?> <?=$shiplname?><br />Address<br /><?=$ship1address?><br /><?=$ship2address?><br /><?=$shillcountry?><br /><?=$shipstate?><br/>
	  <?=$shipcity?> <?=$shipzip?><br>
        <?=$shipcontact?>,<?=$shiptelephone?><br/></td>
    </tr>
  </table>
  */
  ?>
  <table class="product">
    <tr class="heading">
      <td><b>Product Details</b></td>
      <td align="right"><b>Quantity</b></td>
      <td align="right"><b>Unit Price</b></td>
      <td align="right"><b>Total</b></td>
	  <td align="right"><b><?=$get->get_website_name()?> Commission</b></td>
    </tr>
	
	<?
	$selectcart = mysql_query("SELECT * FROM order_prodcut_details WHERE orderid='{$_REQUEST['id']}' AND vendor_id = '".$_SESSION['vendor_id']."' ");
	
	
	//echo "SELECT * from order_prodcut_details as OPD JOIN order_prodcut_attribute as OPA ON OPD.orderid = OPA.orderid WHERE  OPA.prod_id > 0 AND OPD.vendor_id = '".$_SESSION['vendor_id']."' AND OPD.orderid='{$_REQUEST['id']}' ";
	
	
	//$selectcart = mysql_query("SELECT * from order_prodcut_details as OPD JOIN order_prodcut_attribute as OPA ON OPD.orderid = OPA.orderid WHERE  OPA.prod_id > 0 AND OPD.vendor_id = '".$_SESSION['vendor_id']."' AND OPD.orderid='{$_REQUEST['id']}' group by OPA.attribute_option_id ");
	$z=0;
	while($raw=mysql_fetch_array($selectcart)):
	extract($raw);
	?>
    <tr>
      <td class="thumb"><img src="<?=$site_url?>/upload/product/thumb/th_<?=$get->get_single_product_img($prod_id)?>"><?=$get->get_product_name($prod_id)?><br/>Qty: <?=$qty?>
	  <br/>
	<?
	
	$aid = $get->get_order_attribute_id($_REQUEST['id'],$_SESSION['vendor_id'],$prod_id,$z);
	$aoid = $get->get_order_attribute_option_id($_REQUEST['id'],$_SESSION['vendor_id'],$prod_id,$z);
	
	//$selectorderattribute = "SELECT * FROM order_prodcut_attribute WHERE orderid='{$_REQUEST['id']}' AND attribute_id > 0 AND prod_id ='$prod_id' ";
	//$queryc = mysql_query($selectorderattribute);
	//$row_c = mysql_num_rows($queryc);
	//if($row_c > 0)
	//{
		//while($result_option = mysql_fetch_array($queryc))
		//{
			//$aid = $attribute_id;	
			//$aoid = $attribute_option_id;
            if($aid>0){			
			?>
			<span>
			<strong><?=$get->get_attribute_name($aid)?>:</strong>
			<small><?=$get->get_attribute_option_name($aoid)?></small>
			</span>
			<br/>
			<? }
		//}
	//}
	
	$comm = $get->get_commission_according_category($prod_id);
	$per_comm = ($comm*$subtotal)/100;
	$percent_total +=$per_comm; 
	?>
	</td>
      <td align="right" width="80"><?=$qty?></td>
      <td align="right" width="80">Rs. <?=$price?></td>
      <td align="right" width="80">Rs. <?=$subtotal?></td>
	  <td align="right" width="80">Rs. <?=$per_comm?> (<?=$comm;?>%)</td>
    </tr>
	
	 <? $total += $subtotal;?>
	
	<?
	$z++;	
	endwhile; 
	?>
	
	<?
	$commission = $get->get_commission();
	$rupee_commission = ($total*$commission)/100;
	
	
	$Collection_fee = $get->get_collection_fee();
	$fixed_fee = $get->get_fixed_fee();

	$Service = $get->get_service_tax();
	$rupee_Service = ($total*$Service)/100;

	$SwachhBharat = $get->get_swachh_bharat();
	$rupee_SwachhBharat = ($total*$SwachhBharat)/100;

	$total_tax = $percent_total+$Collection_fee+$fixed_fee+$rupee_Service+$rupee_SwachhBharat;
	?>
	
    <tr>
      <td align="right" colspan="4"><b>Total: </b>Rs. <?=$total?></td>
      <td align="right"><b>Total <?=$get->get_website_name()?> Commission: </b>Rs. <?=$percent_total?></td>
    </tr>
	
	<tr>
	   
		<td align="right" colspan="1"><b>Total <?=$get->get_website_name()?> Commission: </b>Rs. <?=$percent_total?></td>
		<td align="right" colspan="1"><b>Collection Fee: </b>Rs. <?=$Collection_fee?></td>
		<td align="right" colspan="1"><b>Fixed Fee </b>Rs. <?=$fixed_fee?></td>
		<td align="right" colspan="1"><b>Service Tax (<?=$Service?>%): </b>Rs. <?=$rupee_Service?></td>
		<td align="right" colspan="1"><b>Swachh Bharat Tax (<?=$SwachhBharat?>%): </b>Rs. <?=$rupee_SwachhBharat?></td>
    </tr>
	
	<tr>
      <td align="right" colspan="4"><b>Total Tax:</b></td>
      <td align="right">Rs. <?=$total_tax?></td>
    </tr>
	<?
	$final_total = $total - $total_tax;
	?>
	
	<tr>
      <td align="right" colspan="4"><b>Settlement Value:</b></td>
      <td align="right">Rs. <?=$final_total?></td>
    </tr>
	
	<?/*<tr>
	<td align="right" colspan="3"><b>Flat Shipping Rate:</b></td>
	<td align="right">Rs. <?=$delivery?></td>
	</tr>

	<tr>
	<td align="right" colspan="3"><b>Total:</b></td>
	<td align="right">Rs. <?=$total_amount?></td>
	</tr>*/?>
	
      </table>
  </div>
		
		<!--Invoice-->
		
		</div>
		
<?  include ('include/footer.php'); ?>	
</div>

</div>
<!-- Add Content -->
<? endif; ?>



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
	<option value="panding">Panding</option>
	<option value="complete">Complete</option>
	<option value="cancel">Cancel</option>
	</select>
	<div style="clear:both"></div>

</h2>
<?
$sql = "SELECT OD.id as oid,OD.*,OCD.* FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid JOIN order_prodcut_details AS OPD ON OD.orderid = OPD.orderid WHERE OPD.vendor_id = '".$_SESSION['vendor_id']."' GROUP BY OPD.orderid ";


if($_POST['q'] !='')
{
	$sql .= " AND ";
	$words = explode(" ", $_POST['q']);
	$x=1;
	foreach ($words as $w) 
	{
		if($x == 1) { $sql .= ' '; } else { $sql .= ' OR '; }
		$sql .= " OD.orderid like '%$w%'";
		$x++; 
	}
}
$sql .= " ORDER BY OD.id DESC LIMIT $start, $limit";
//echo $sql;
$selectcat = mysql_query($sql);
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
	<td><strong>Order Id</strong></td>
	<td><strong>Customer Name</strong></td>
	<td><strong>Order Date</strong></td>
	<td><strong>View</strong></td>	
</tr>
<?
$x=1;
while($row=mysql_fetch_array($selectcat)):
//print_r($row);
extract($row);
?>
<tr>
	<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$oid?>" /></label></td>
	<td><?=$orderid?></td>	
	<td><?=$billname?></td>	
	<td><?=$orderdate?></td>
	<td>
	<?
	if($_REQUEST['action']=='track'){ ?>
	<a href="<?=VENDOR_PATH?>/track-order.php?role=view-invoice&page=<?=$page?>&id=<?=$orderid?>">View Order</a>
	<? } else { ?>
	<a href="<?=VENDOR_PATH?>/<?=$currentpage?>?role=view-invoice&page=<?=$page?>&id=<?=$orderid?>">View Order</a>
	<? } ?>
	</td>	
</tr>
<? 
endwhile; 
?>
</table>
	<?=$get->get_pagination_vendor('user',$currentpage,$page,$start,$limit,$_SESSION['vendor_id'])?>
<div  class="cboth"></div>
</form>
	</div>
	
<?  include ('include/footer.php'); ?>	
</div>
</div>
<!-- View Content -->
<? endif; ?>
</body>
<script>
function printContent()
{
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