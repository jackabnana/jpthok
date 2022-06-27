<?php 
include ('../management/include/functions.php');
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
if(isset($_POST['Submit']) && $_POST['Submit']=='Submit')
{
	$add = $set->change_order_status($_POST);
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
	<a href="<?=VENDOR_PATH?>/orders.php?role=view&action=track" class="red_button fright">Back</a>
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
		$selectcat = mysql_query("SELECT * FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid WHERE OD.orderid='{$_REQUEST['id']}'");
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
		<b>Amount Paid :</b> Rs. <?=$total_amount+$delivery?>
	</td>	
	
	<td>
		<h3><?=ucfirst($billname)?>&nbsp;&nbsp;<small><?=$billcontact?></small></h3><br/>
		<p><?=$billaddress?>, <?=$billlandmark?>, <?=$billcity?>, <br><?=$billstate?> - <?=$billzip?></p>
	</td>
    </tr>
  </table>
 
  <table class="product">
    <tr class="heading">
      <td><b>Product Details</b></td>
	  <td><b>Pending</b></td>
	  <td><b>Approval</b></td>
	  <td><b>Processing</b></td>
	  <td><b>Dispatch</b></td>
	  <td><b>Complete</b></td>
	  <td><b>Delivery</b></td>
      <td align="right"><b>Qty</b></td>
      <td align="right"><b>Price</b></td>
      <td align="right"><b>Total</b></td>
	  <td align="right"><b>Incoice</b></td>
    </tr>
	
	<?
	$selectcart = mysql_query("SELECT * FROM order_prodcut_details WHERE orderid='{$_REQUEST['id']}' AND vendor_id = '".$_SESSION['vendor_id']."' ");
	$y=0;
	while($raw=mysql_fetch_array($selectcart)):
	extract($raw);
	?>
	
    <tr>
      <td class="thumb"><img src="<?=$site_url?>/upload/product/thumb/th_<?=$get->get_single_product_img($prod_id)?>"><?=$get->get_product_name($prod_id)?>
	  
		<br/>
		<?
	  $parent_att = $get->get_parent_attribute_id($attribute_option_id);
	  if($attribute_option_id>0)
	  {
		  
		  echo $get->get_attribute_name($parent_att).': ';
		  echo $get->get_attribute_option_name($attribute_option_id);
	  } 
		?>
	  </td>
	  
	<td>
	<li class="list">
		<div class="line-connect"></div>
		<?
		$cancel_status = $get->is_cancel_order($orderid,$raw['id']);
		$reason = $get->cancel_reason($orderid,$raw['id']);
		$comment = $get->cancel_comment($orderid,$raw['id']);
		
		if(($track_status == 'pending' ) && ($cancel_status == true))
		{
			?>	
			<div class="total-round">
			<span class="round checked current-status-red"></span>
			<div class="possition-status">
			<span class="title">This order is cancelled.</span>
			<ul class="timing">
			<? $da = $get->cancel_date($orderid);?>
			<li class="schdule"><?=$da;?></li>
			<li class="schdule"><?=$reason?></li>
			<?if($comment!=''){?> <li class="schdule-new"><?=$comment?></li><? }?>
			</ul>
			</div>
			</div>
			<? 
		} 
		else 
		{ 
			?>
			<div class="total-round">
			<span class="round checked <?if($track_status == 'pending'){ echo 'current-status';}?>"></span>
			<div class="possition-status">
			<span class="title">Your order is in pending mode.</span>
			<ul class="timing">
			<? $d = date_create($orderdate);?>
			<li class="schdule"><?=date_format($d,"M d, Y h:i:s A");?></li>
			<li class="schdule">Pending</li>
			</ul>
			</div>
			</div>
		<? 
		} 
		?>
	</li>
	</td>

	
	<td>
	    <li class="list">
		<div class="line-connect"></div>
		<?
		if($track_status == 'approval' && $cancel_status == true)
		{
			
			?>	
			<div class="total-round">
			<span class="round checked current-status-red"></span>
			<div class="possition-status">
			<span class="title">This order is cancelled.</span>
			<ul class="timing">
			<? $da = $get->cancel_date($orderid);?>
			<li class="schdule"><?=$da;?></li>
			<li class="schdule"><?=$reason?></li>
			<?if($comment!=''){?> <li class="schdule-new"><?=$comment?></li><? }?>
			</ul>
			</div>
			</div>
			<? 
		} 
		else 
		{ 
		?>
		     <div class="total-round">
			 <span class="round  <?if($track_status == 'approval'){ echo 'checked current-status';}elseif($track_status == 'processing' || $track_status == 'dispatch'|| $track_status == 'complete'){ echo 'checked'; } else{ echo 'active'; }?>">
				<?
				$sql_track = mysql_query("SELECT * FROM order_tracking WHERE orderid = '".$_GET['id']."' and status = 'approval' and order_prodcut_details_id = '".$raw['id']."' ORDER BY id DESC");
				$order_track  = mysql_fetch_array($sql_track);
				$count = mysql_num_rows($sql_track);
				if($count >0){
				?>
				<div class="possition-status">
				<span class="title"><?if($order_track['comment']!=''){ echo $order_track['comment']; }?></span>
				<ul class="timing">
					<li class="schdule"><?=$order_track['date']?></li>
					<li class="schdule">Approval</li>
				</ul>
				</div>
				<? } ?>	
		        </div>
		<?
        }
        ?>		
	</li>
	</td>
	
	<td><li class="list">
		<div class="line-connect"></div>
		<?
		if($track_status == 'processing' && $cancel_status == true)
		{
			?>	
			<div class="total-round">
			<span class="round checked current-status-red"></span>
			<div class="possition-status">
			<span class="title">This order is cancelled.</span>
			<ul class="timing">
			<? $da = $get->cancel_date($orderid);?>
			<li class="schdule"><?=$da;?></li>
			<li class="schdule"><?=$reason?></li>
			<?if($comment!=''){?> <li class="schdule-new"><?=$comment?></li><? }?>
			</ul>
			</div>
			</div>
			<? 
		} 
		else 
		{ 
		?>
		<div class="total-round">
			<span class="round <?if($track_status == 'processing'){ echo 'checked current-status';}elseif($track_status == 'dispatch'|| $track_status == 'complete'){ echo 'checked'; }else{ echo 'active'; }?>">
			<?
			$sql_track = mysql_query("SELECT * FROM order_tracking WHERE orderid = '".$_GET['id']."' and status = 'processing' and order_prodcut_details_id = '".$raw['id']."' ORDER BY id DESC");
			$order_track  = mysql_fetch_array($sql_track);
			$count = mysql_num_rows($sql_track);
			if($count >0){
			?>
			<div class="possition-status">
			<span class="title"><?if($order_track['comment']!=''){ echo $order_track['comment']; }?></span>
			<ul class="timing">
			<li class="schdule"><?=$order_track['date']?></li>
			<li class="schdule">Processing</li>
			</ul>
			</div>
			<? } ?>	
		</div>
		<? } ?>
	</li>
	</td>
	
	<td><li class="list">
	<div class="line-connect"></div>
	<?
		if($track_status == 'dispatch' && $cancel_status == true)
		{
			?>	
			<div class="total-round">
			<span class="round checked current-status-red"></span>
			<div class="possition-status">
			<span class="title">This order is cancelled.</span>
			<ul class="timing">
			<? $da = $get->cancel_date($orderid);?>
			<li class="schdule"><?=$da;?></li>
			<li class="schdule"><?=$reason?></li>
			<?if($comment!=''){?> <li class="schdule-new"><?=$comment?></li><? }?>
			</ul>
			</div>
			</div>
			<? 
		} 
		else 
		{ 
		?>
		<div class="total-round">
			<span class="round <?if($track_status == 'dispatch'){ echo 'checked current-status';}elseif($track_status == 'complete'){ echo 'checked'; }else{ echo 'active'; }?>"></span>
			<?
			$sql_track = mysql_query("SELECT * FROM order_tracking WHERE orderid = '".$_GET['id']."' and status = 'dispatch' and order_prodcut_details_id = '".$raw['id']."' ORDER BY id DESC");
			$order_track  = mysql_fetch_array($sql_track);
			$count = mysql_num_rows($sql_track);
			if($count >0){
			?>
			<div class="possition-status">
			<span class="title"><?if($order_track['comment']!=''){ echo $order_track['comment']; }?></span>
			<ul class="timing">
			<li class="schdule"><?=$order_track['date']?></li>
			<li class="schdule">Dispatch</li>
			</ul>
			</div>
			<? } ?>	
		</div>
		<? } ?>
	</li>
	</td>

	<td><li class="list">
		<div class="total-round">
		<div class="line-connect"></div>
			<span class="round <?if($track_status == 'complete'){ echo 'checked current-status';}else{ echo 'active'; }?>"></span> 
			<?
			$sql_track = mysql_query("SELECT * FROM order_tracking WHERE orderid = '".$_GET['id']."' and status = 'complete'  and order_prodcut_details_id = '".$raw['id']."' ORDER BY id DESC");
			$order_track  = mysql_fetch_array($sql_track);
			$count = mysql_num_rows($sql_track);
			if($count >0){
			?>
			<div class="possition-status">
			<span class="title"><?if($order_track['comment']!=''){ echo $order_track['comment']; }?></span>
			<ul class="timing">
			<li class="schdule"><?=$order_track['date']?></li>
			<li class="schdule">Complete</li>
			</ul>
			</div>
			<? } ?>	
		</div>
	</li>
	</td>


	<td>
	<li class="list">
	     <?if($track_status == 'complete'){ ?>
		 
		 <span class="deliver-by"><?=$order_track['date']?></span>
		 <span class="deliver-type">Delivered date</span>
		 <span class="deliver-by cut">by <?=$get->product_delivery_for_order($orderid,$prod_id)?></span>
		 <span class="deliver-type">Expected delivery date</span>
			 
		 <? }else { ?>
	
		<span class="deliver-by">by <?=$get->product_delivery_for_order($orderid,$prod_id)?></span>
		<span class="deliver-type">Expected delivery date</span>
		 <? } ?>
	</li>
	</td>
	  
      <td><?=$qty?></td>
      <td>Rs. <?=$price?></td>
      <td align="right" width="80">Rs. <?=$subtotal?></td>
	 <td>
	 <a target="_blank" href="<?=VENDOR_PATH?>/invoice.php?role=view-invoice&page=1&id=<?=$raw['orderid']?>&did=<?=$raw['id']?>">
	 
	 <?if($track_status==''){?>
	 Not generated yet
	 <?}else{?>
	 View Invoice
	 <? } ?>
	 </a></td> 
    </tr>
	<? 
	$y++;
	endwhile; 
	/*
	?>
	
	<tr>
      <td align="right" colspan="9"><b>Sub-Total:</b></td>
      <td align="right">Rs. <?=$total_amount?></td>
    </tr>
        <tr>
      <td align="right" colspan="9"><b>Flat Shipping Rate:</b></td>
      <td align="right">Rs. <?=$delivery?></td>
    </tr>
        <tr>
      <td align="right" colspan="9"><b>Total:</b></td>
      <td align="right">Rs. <?=$total_amount+$delivery?></td>
    </tr>
	*/?>
      </table>
	  <?/*
	  <h1>Tracking Status</h1>
	  <div style="float:left;width:100%;max-height:191px;overflow-y:auto;overflow-x:hidden;">
	  
	      <?
	      $sql_track = mysql_query("SELECT * FROM order_tracking WHERE orderid = '".$_GET['id']."' ORDER BY id DESC");
          $count = mysql_num_rows($sql_track);
          if($count > 0){ 		  
		  while($row_track = mysql_fetch_array($sql_track)){ 
		  extract($row_track);
		  ?>
		  <table width="100%" style="background:#E7EFEF">
		  <tr>
		  <td>Date/Time : <?=$date?></td>
		  </tr>
		  <tr>
		  <td>Status : <?=$status?></td>
		  </tr>
		  <tr>
		  <td>Comment : <?=$comment?></td>
		  </tr>
		  <tr>
		  </table>
		  <? } } else { ?>
		  
		  <table width="100%" style="background:#E7EFEF">
		  <tr>
		  <td>Date/Time : <?=date_format($d,"M d, Y h:i:s A");?></td>
		  </tr>
		  <tr>
		  <td>Status : Pending</td>
		  </tr>
		  <tr>
		  <td>Comment : Your order is in pending mode.</td>
		  </tr>
		  <tr>
		  </table>
		 
		  <? } ?>
	  </div>
	  <?/*
	  <table width="48%" style="float:left">
	  
		  <form action="" method="post">
		  <input type="hidden" name="orderid" value="<?=$_GET['id']?>">
		  <tr><td><b>Order Status</b></td></tr>
		  <tr>
		  <td>
		  
		  
		   <select name="status" required>
				<option value="">Select Option</option>
				<option value="approval">Approval</option>
				<option value="processing">Processing</option>
				<option value="dispatch">Dispatch</option>
				<option value="complete">Complete</option>
		   </select>
		    </td>
		  </tr>
		  
		  <tr>
		  <td>
		   <textarea required name="comment"></textarea>
		   </td>
		  </tr> 
		   
		  <tr>
		  <td> 
		   <input type="submit" class="green_button" name="Submit" value="Submit">
		  </td>
		  </tr> 
		  </form>
	  </table>
	  */?>
	  <div style="clear:both"></div>
	  
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
	<!--<select name="action" class="fright select_action">
	<option value="">Select Action</option>
	<option value="panding">Panding</option>
	<option value="complete">Complete</option>
	<option value="cancel">Cancel</option>
	<option value="delete">Delete</option>
	</select>-->
	<div style="clear:both"></div>

</h2>
<?
if($_REQUEST['status']=='pending')
{
	$sql = "SELECT OD.id as oid,OD.*,OCD.* FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid WHERE OD.status = 'pending' ";
}	
elseif($_REQUEST['status']=='complete')
{
	$sql = "SELECT OD.id as oid,OD.*,OCD.* FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid WHERE OD.status = 'complete' ";
}
else
{
	$sql = "SELECT OD.id as oid,OD.*,OCD.* FROM order_details as OD JOIN order_customer_details as OCD ON OD.orderid = OCD.orderid";
}


if($_POST['q'] !=''){
	$sql .= " WHERE ";
	$words = explode(" ", $_POST['q']);
	$x=1;
	foreach ($words as $w) {
		if($x == 1) { $sql .= ' '; } else { $sql .= ' OR '; }
	$sql .= " P.orderid like '%$w%'";
	$x++; 
}
}
$sql .= " ORDER BY OD.id DESC LIMIT $start, $limit";

$selectcat = mysql_query($sql);
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<!--<td align="center"><input type="checkbox"   id="selecctall"  /></td>-->
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
	<!--<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?//=$oid?>" /></label></td>-->
	<td><?=$orderid?></td>	
	<td><?=$billname?></td>	
	<td><?=$status?></td>
    <td>Rs. <?=$total_amount?>/-</td>
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