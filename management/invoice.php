<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'orders.php';
$currentpagetitle = 'Orders';
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
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>

<script>
function printContent(){ 
	var DocumentContainer = document.getElementById('page-wrap');
        var WindowObject = window.open('', 'PrintWindow', 'width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');

        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title>');
        WindowObject.document.writeln('<link rel="stylesheet" type="text/css" href="css/style.css" media="print">');
        WindowObject.document.writeln('<style>table td { padding:5px 10px;border:solid 1px #000000;}</style></head><body>');
        WindowObject.document.writeln(DocumentContainer.innerHTML);
        WindowObject.document.writeln('</body></html>');

        WindowObject.document.close();
        WindowObject.focus();
        WindowObject.print();
        //WindowObject.close();
}
</script>
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
<div class="dashbox-main-div">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/orders_invoice.php?role=view" class="red_button fright">Back</a>
	</p>
    <div class="cboth"></div>
</h2>
	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
		<div class="col-100 bg_color_white border_top_gray border_radius_5" style="float:left;"> 
		<!--Add user-->
		<h2><?=$getrole?> Order
		<input type="submit" name="<?=$getrole?>" onclick="printContent();" class="green_button fright" value="Print" />
		</h2>
		
		<?
$selectcat = mysql_query("SELECT *,OD.id AS Oid FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid WHERE OD.orderid='{$_REQUEST['id']}'");
$row=mysql_fetch_array($selectcat);
extract($row);
?>

<!--Invoice-->
<div style="page-break-after: always;margin:0px; " id="page-wrap">
<img src="<?=$site_url?>/upload/comman/<?=$get->get_logo()?>" width="80" class="" style="margin:10px;width:6%;">		
<h1 style="float:right;width:180px; padding-top:10px;">Retail Invoice</h1>
<table style="width:100%;margin:0px;padding:0px;font-size:12px;">
<tr><td style="border:none;width:23%;">
<table class="store" style="width:100%;margin:0px;padding:0px;font-size:12px;">
<tr>	
	<td colspan="4">
	<p>SHIP TO</p>
	<b><?=$billname?></b><br/>
	<?=$billaddress?><br/>
	City: <?=$billcity?> <br/>
	State: <?=$billstate?><br/>
	Country: <?=$billcountry?><br />
	Pin: <?=$billzip?><br/>
	MOBILE: <?=$billcontact?>
	</td>
</tr>
<tr>
<td colspan="4">
<?$date=date_create($orderdate);?>
<?
//$data = $get->generate_invoice_no($_REQUEST['id']);
$data = $orderid;
?>
<img style="-webkit-user-select: none" src="http://generator.barcodetools.com/barcode.png?gen=0&data=<?=$data?>&bcolor=FFFFFF&fcolor=000000&tcolor=000000&fh=10&bred=0&w2n=2.5&xdim=2&w=240&h=50&debug=1&btype=7&angle=0&quiet=1&balign=2&talign=0&guarg=1&text=1&tdown=1&stst=1&schk=0&cchk=1&ntxt=1&c128=0">
<span style="float:left;">Invioce No: <?=$data?>&nbsp;&nbsp;&nbsp;</span>
<span style="float:right;">Date: <?=date_format($date,"M d, Y");?></span>
</td>
</tr>
<tr class="heading">
      <td style="width:79%"><b>Product</b></td>
      <td align="right"><b>Quantity</b></td>
      <!--<td align="right"><b>Unit Price</b></td>
      <td align="right"><b>Total</b></td>-->
</tr>
<?
	$selectcart = mysql_query("SELECT * FROM order_prodcut_details WHERE orderid='{$_REQUEST['id']}'");

	$selectorderattribute = "SELECT * FROM order_prodcut_attribute WHERE orderid='{$_REQUEST['id']}' AND attribute_id > 0";
	$queryc = mysql_query($selectorderattribute);
	$row_c = mysql_num_rows($queryc);
	
	$qtysum = 0;
	while($raw=mysql_fetch_array($selectcart)):
	extract($raw);
	
	$qtysum +=$qty; 
	if($combo == 0)
	{
		$total = $subtotal*$qty;
		$total_am += $total;
		
		if($row_c > 0)
			{
				$result_option = mysql_fetch_array($queryc);
				$aid = $result_option['attribute_id'];	
				$aoid = $result_option['attribute_option_id'];
				
				
			}
	}
	else 
	{
		$getcombo = $get->get_combo_details($prod_id,$combo,$weight,$flavour);
		$combodetails = mysql_fetch_object($getcombo);
		$prod1_rate = $get->get_product_amount($combodetails->prod1_id,$combodetails->prod1_weight);
		$prod2_rate = $get->get_product_amount($combodetails->prod2_id,$combodetails->prod2_weight);
		$total = $prod1_rate+$prod2_rate;
		$total = $total-($total*$combodetails->disc/100);
		
		if($row_c > 0)
			{
				$result_option = mysql_fetch_array($queryc);
				$aid = $result_option['attribute_id'];	
				$aoid = $result_option['attribute_option_id'];
				
				
			}
	}
	?>
<tr>
<td><?=$get->get_product_name($prod_id)?>(<?=$get->get_product_code($prod_id)?>)

<span>
			<strong><?=$get->get_attribute_name($aid)?>:</strong>
			<small><?=$get->get_attribute_option_name($aoid)?></small>
			</span>
</td>
<td align="right" width="80"><?=$qty?></td>
<?/*
<td align="right" width="80">Rs. <?=$subtotal?></td>
<td align="right" width="80">Rs. <?=$total?></td>
*/?>
</tr>
<? endwhile; 
$deliveryamount = $get->get_delivery_charges(); 

?>
<tr>
<td align="right" colspan="1"><b>Total:</b></td>
<td align="right"><?=$qtysum?></td>
</tr>
<?
/*
<tr>
<td align="right" colspan="3"><b>Courier & COD charges:</b></td>
<td align="right">Rs. 
<?
$deliveryamount = $get->get_delivery_charges(); 
if($payment_method=='COD')
{
	echo $deliveryamount;
}
else
{
	echo 'Free';
}
?>
</td>
</tr>
<tr>
<td align="right" colspan="3"><b>Total:</b></td>
<td align="right">Rs. 
<?
if($payment_method=='COD')
{
	echo $total_am+$deliveryamount;
}
else
{
	echo $total_am;
}
?>	
</td>
</tr>
*/
?>
<tr>
<td colspan="4">ORDER #: <?=$orderid?><span style="float:right;">Date: <?=date_format($date,"M d, Y");?></span>
</br></br></br>
if undelivered return to </td>
</tr>
<tr>
    <td colspan="4"><b>www.onlinevandy.com</b>
	<br>Nepal<br />

<!--<b>CITY</b>: Delhi<br />
<b>STATE</b>: Delhi<br />
<b>PIN</b>: 110092<br />
<b>PHONE</b>: 0123456789<br />
<b>COMPANY'S VAT / TIN NO.</b>: 0123456789 <br />w.e.f. 10/02/2016<br />
<b>COMPANY'S CST NO.</b>: 0123456789<br />
<b>COMPANY'S PAN NO.</b>: DEMO1234567<br />-->
	</td>
</tr>
</table>

</td><td style="border:none;">
<table style="width:100%;margin:0px;padding:0px;font-size:12px;">
<tr><td colspan="8">
<span style="float:left;">Invioce No: <?=$orderid?> <?//=$get->generate_invoice_no($_REQUEST['id'])?></span>
<?$invoicedate = $get->invoice_date($_REQUEST['id']);
if($invoicedate){?>
<span style="float:right;">Date: <?=$invoicedate;?></span>
<?}?>


<br>
<img style="-webkit-user-select: none" src="http://generator.barcodetools.com/barcode.png?gen=0&data=<?=$data?>&bcolor=FFFFFF&fcolor=000000&tcolor=000000&fh=10&bred=0&w2n=2.5&xdim=2&w=240&h=50&debug=1&btype=7&angle=0&quiet=1&balign=2&talign=0&guarg=1&text=1&tdown=1&stst=1&schk=0&cchk=1&ntxt=1&c128=0">
</td></tr>
<tr>
<td colspan="4" style="width:50%">
	<p><b>SELLER</b></p>
	<p><b>www.onlinevandy.com</b>
	<br>Nepal</br><!--<br />
Laxmi Nagar, New Delhi - 110092<br />
<b>CITY</b>: Delhi<br />
<b>STATE</b>: Delhi<br />
<b>PIN</b>: 110092<br />
<b>PHONE</b>: 0123456789<br />
<b>COMPANY'S VAT / TIN NO.</b>: 0123456789 <br />w.e.f. 10/02/2016<br />
<b>COMPANY'S CST NO.</b>: 0123456789<br />
<b>COMPANY'S PAN NO.</b>: DEMO1234567<br />-->
</td>

<td colspan="4" style="width:50%">
	<p><b>BUYER</b></p>
	<b><?=$billname?></b><br/>
	<?=$billaddress?><br/>
	City: <?=$billcity?> <br/>
	State: <?=$billstate?><br/>
	Country: <?=$billcountry?><br />
	Pin: <?=$billzip?><br/>
	MOBILE: <?=$billcontact?>
</td>
</tr>
<tr>
<td colspan="8">ORDER #: <?=$orderid?><span style="float:right;">Date: <?=date_format($date,"M d, Y");?></span>
</br>
</td>
</tr>
<tr class="heading">
      <td style="width:40%" colspan="3"><b>Product</b></td>
      <td style="width:5%" align="right" colspan="1"><b>Quantity</b></td>
      <td style="width:12%" align="right" colspan="2"><b>Unit Price</b></td>
	  <!--<td style="width:12%" align="right"><b>CST / VAT</b></td>
	  <td style="width:5%" align="right"><b>Shipping</b></td>
	  <td style="width:5%" align="right"><b>Discount</b></td>--->
      <td style="width:10%" align="right" colspan="2"><b>Total</b></td>
</tr>
<?
	$selectcart_new = mysql_query("SELECT * FROM order_prodcut_details WHERE orderid='{$_REQUEST['id']}'");
	while($raw_new=mysql_fetch_array($selectcart_new)):
	extract($raw_new);
	if($combo == 0){
	$total_new = $subtotal;
	$total_am_new += $total_new;
	}else {
	$getcombo = $get->get_combo_details($prod_id,$combo,$weight,$flavour);
	$combodetails = mysql_fetch_object($getcombo);
	$prod1_rate = $get->get_product_amount($combodetails->prod1_id,$combodetails->prod1_weight);
	$prod2_rate = $get->get_product_amount($combodetails->prod2_id,$combodetails->prod2_weight);
	$total = $prod1_rate+$prod2_rate;
	$total = $total-($total*$combodetails->disc/100);
	}
	$checkzip = $get->check_cst_or_vat($billzip);
	if($checkzip=='vat')
	{
		$local= $get->get_local_charges($prod_id);
	}
	else
	{
		$local = $get->get_central_charges($prod_id);
	}
	
	$cstORvat = (($subtotal*$local)/100);
?> 
<tr>
<td colspan="3"><?=$get->get_product_name($prod_id)?>(<?=$get->get_product_code($prod_id)?>)</td>
<td align="right" width="20" colspan="1"><?=$qty?></td>
<td align="right" width="70" colspan="2">Rs. <?=$price?></td>
<!--<td align="right" width="70">Rs. <?=$cstORvat?></td>
<td align="right" width="20">---</td>
<td align="right" width="20">---</td>-->
<td align="right" width="40" colspan="2">Rs. <?=$total_new?></td>
</tr>
<? endwhile; ?>
<tr>
<td align="right" colspan="6"><b>Sub-Total:</b></td>
<td align="right">Rs. <?=$total_am_new?></td>
</tr>
<tr>
<td align="right" colspan="6"><b>Courier & COD charges:</b></td>
<td align="right">Rs. 
<?
if($payment_method=='COD')
{
	echo $deliveryamount;
}
else
{
	echo 'Free';
}
?>
</td>
</tr>
<tr>
<td align="right" colspan="6"><b>Total:</b></td>
<?
if($payment_method=='COD')
{
	?>
	<td align="right">Rs. <?=$total_am_new+$deliveryamount?></td>
	<?
}
else
{
	?>
	<td align="right">Rs. <?=$total_am_new?></td>
	<?
}	
?>
</tr>
<tr>
<td colspan="8">
<b>DECLARATION:</b></br/>
<p>We declare that this invoice shows the actual price of the goods described inclusive of taxes and that all particulars are true and correct.</p></br/>
<p>If you find selling price on this invoice to be more than MRP mentioned on the product, please inform us at <?=$get->get_email()?>. Goods sold as part of this invoice are intended for end user consumption sale and not for re-sale.</p></br/>
<p><b>** Condition Apply.</b> Please refer to the product page for more details.</p><br/> 
<b>CUSTOMER ACKNOWLEDGEMENT:</b></br/>
<p>I <?=ucfirst($billname)?> confirm that the said products are being purchased for my internal/personal consumption and not for re-sale. I further understand and agree with <?=$get->get_website_url()?> terms and conditions for sale.</p></br/>
</td>
</tr>
<tr>
<td colspan="8" align="center">
THIS IS A COMPUTER GENERATED INVOICE AND DOES NOT REQUIRE SIGNATURE
</td>
</tr>
</tr>
</table>

</td>
</tr>

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
<div class="dashbox-main-div">
<h2><span>Manage <?=$currentpagetitle?></span>
    <div class="cboth"></div>
</h2>
	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	
	<div class="col-100 bg_color_white border_top_gray border_radius_5"  style="float:left;"> 
	
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
$sql = "SELECT OD.id as oid,OD.*,OCD.* FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid";
if($_POST['q'] !=''){
	$sql .= " WHERE ";
	$words = explode(" ", $_POST['q']);
	$x=1;
	foreach ($words as $w) {
		if($x == 1) { $sql .= ' '; } else { $sql .= ' OR '; }
	$sql .= " OD.orderid like '%$w%'";
	$x++; 
}
}
$sql .= " ORDER BY OD.id DESC LIMIT $start, $limit";

$selectcat = mysql_query($sql);
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
	<td><strong>Order Id</strong></td>
	<td><strong>Customer Name</strong></td>
	<td><strong>Status</strong></td>
	<td><strong>Total Order</strong></td>	
	<td><strong>Order Date</strong></td>
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
	<td><?=$billfname?> <?=$billlname?></td>	
	<td><?=$status?></td>
    <td>Rs. <?=$total_amount?>/-</td>
	<td><?=$orderdate?></td>
	<td><a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=view-invoice&page=<?=$page?>&id=<?=$orderid?>">View Order</a></td>	
</tr>
<? 
endwhile; 
?>
</table>
	<?=$get->get_pagination('user',$currentpage,$page,$start,$limit)?>
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