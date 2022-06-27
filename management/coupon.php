<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'coupon.php';
$currentpagetitle = 'coupon';
$getdata = $get->get_active_data($_REQUEST['id'],'coupon');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_coupon();
}

if(isset($_POST['edit'])){
$edit = $set->update_coupon($_REQUEST['id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'coupon');
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
<link href="<?=ADMIN_PATH?>/css/select2.css" rel="stylesheet"/>
<script src="<?=ADMIN_PATH?>/js/jquery-1.8.0.min.js"></script>
<script src="<?=ADMIN_PATH?>/js/select2.js"></script>
<script>
$(document).ready(function() {
$("#responseForm").select2();   
});
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
	
<? if($getrole == 'add' or $getrole == 'edit'): ?>
<!-- Add Content -->
<div  id='content'>
<div class="page-heading">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=view&page=<?=$_REQUEST['page']?>" class="red_button fright">Back</a>
	</p>
    <div class="cboth"></div>
</h2>
</div>
<div class="dashbox-main-div">

	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add coupon-->
			<form action="" method="post" enctype="multipart/form-data">
			<h2>
			<?=$getrole?> <?=$currentpagetitle?>
			<? if($role == 'edit'){ ?>
			<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=view&page<?=$page?>" class="red_button fright">Cancel</a>
			<? } ?>
			<input type="submit" name="<?=$getrole?>" class="green_button fright" value="<?=$getrole?> coupon" />
			<div style="clear:both"></div>
			</h2>
				<table style="width:100%; margin:0;">
					<tr>
						<td>Coupon Name <span class="color_red">*</span></td><td><input type="text" name="coupon_name" value="<?=$fetchrow->coupon_name?>"  required /></td>
						<td>Coupon Code <span class="color_red">*</span></td><td><input type="text" name="coupon_code" value="<?=$fetchrow->coupon_code?>"  required /></td>
					</tr>
					<?
						if($fetchrow->coupon_type == 'P' ){
							$selectp = 'selected';
						} else if($fetchrow->coupon_type == 'F' ){
							$selectf = 'selected';
						}
						?>
					<tr>
						<td>Type <span class="color_red">*</span></td><td>
							<select name="coupon_type" id="input-type" class="form-control">
								<option value="P" <?=$selectp?> >Percentage</option>
								<option value="F" <?=$selectf?>>Fixed Amount</option>
							</select>
						</td>
						<td>Coupon Discount <span class="color_red">*</span></td><td><input type="text" name="discount_amount" value="<?=$fetchrow->discount_amount?>"  required /></td>
					</tr>
					<tr>
						<td>Total Amount <span class="color_red">*</span></td><td><input type="text" name="cart_amount" value="<?=$fetchrow->cart_amount?>"  required /></td>
					
					<?
						if($fetchrow->customer_login == 'yes' ){
							$selectyes = 'selected';
						} else if($fetchrow->customer_login == 'no' ){
							$selectno = 'selected';
						}
						?>
						<td>Customer Login</td>
						<td>
						<select name="customer_login" required>
						<option value="no" <?=$selectno?>>No</option>
						<option value="yes" <?=$selectyes?>>Yes</option>
						</select>
						</td>
					</tr>
					<?
						if($fetchrow->free_shiping == 'yes' ){
							$selectyes = 'selected';
						} else if($fetchrow->free_shiping == 'no' ){
							$selectno = 'selected';
						}
					?>
					<tr>
						<td>Free Shiping</td><td>
						<select name="free_shiping" required>
						<option value="no" <?=$selectno?>>No</option>
						<option value="yes" <?=$selectyes?>>Yes</option>
						</select>
						</td>
						<td>Uses Per Coupon <span class="color_red">*</span></td><td><input type="text" name="per_coupon" value="<?=$fetchrow->per_coupon?>"  required /></td>
					</tr>
					<tr>
						<td colspan="4">Products</td>
					</tr>
					<tr>
						<td colspan="4">
                        						
								<select name="product_id[]" id="responseForm" multiple onChange="product1select(this.value)" style="width:100%;">
								<? 
								$getrelated = $get->get_product_menu();
								while($relatedrow=mysql_fetch_object($getrelated)):
								?>
								<option value="<?=$relatedrow->prod_id?>" <?=$get->get_coupon_product($fetchrow->coupon_id,$relatedrow->prod_id)?> >
								<?=$relatedrow->product_name?>
								</option>
								<? endwhile; ?>	
						</td>
					</tr>
					
					
					<!--<tr>
						<td colspan="4">Products New</td>
					</tr>
					
					<tr>
						<td colspan="4">
						
						<?
						//$sql = "SELECT * FROM product WHERE status='active' ORDER BY product_name ASC";
						//$query = mysql_query($sql);?>
						<select name="product_id[]" id="responseForm" multiple onChange="product1select(this.value)" style="width:100%;">
							<?
							//while($result = mysql_fetch_object($query))
							//{
								?>
								<option value="<?//=$result->prod_id?>"><?//=$get->get_coupon_product($fetchrow->coupon_id,$result->prod_id)?></option>
								<?
							//}	
							?>
						</select>
					    </td>
					</tr>-->
					
					
					
					<tr>
						<td>Date Start</td><td>
						<select name="date_start" required>
						<option value="no" <?=$selectno?>>No</option>
						<option value="yes" <?=$selectyes?>>Yes</option>
						</select>
						</td>
						<td>Date End</td><td>
						<select name="date_end" required>
						<option value="no" <?=$selectno?>>No</option>
						<option value="yes" <?=$selectyes?>>Yes</option>
						</select>
						</td>
					</tr>
					<tr>
						<td>Uses Per Customer <span class="color_red">*</span></td><td><input type="text" name="per_customer" value="<?=$fetchrow->per_customer?>"  required /></td>
						<td>Is Active <span class="color_red">*</span></td>
						<td>
						<?
						if($fetchrow->status == 'active' ){
							$selectactive = 'selected';
						} else if($fetchrow->status == 'deactive' ){
							$selectdeactive = 'selected';
						}
						?>
						<select name="status" required>
						<option value="">Select</option>
						<option value="active" <?=$selectactive?>>Active</option>
						<option value="deactive" <?=$selectdeactive?>>Deactive</option>
						</select>
						</td>
					</tr>
				<input type="hidden" name="coupon_id" value="<?=rand()?>" />
				</table>
			</form>
			<br>
		</div>
		
	
<?  include ('include/footer.php'); ?>	
</div>
</div>
<!-- Add Content -->
<? endif; ?>

<? if($getrole == 'view'): ?>
<!-- View Content -->
<div  id='content'>
<div class="page-heading">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="green_button fright">Add <?=$currentpagetitle?></a>
	</p>
    <div class="cboth"></div>
</h2>
</div>
<div class="dashbox-main-div">

	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	
	<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
	<form action="" method="post">
	<h2>Manage <?=$currentpagetitle?>
	
	<input type="submit" name="doaction" class="green_button fright" />
	<select name="action" class="fright select_action">
	<option value="">Select Action</option>
	<option value="active">Active</option>
	<option value="deactive">Deactive</option>
	<option value="delete">Delete</option>
	</select>
	<div style="clear:both"></div>

</h2>
<?
$selectcat = mysql_query("SELECT * FROM coupon ORDER BY id ASC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>Coupon Name</strong></td>	
	<td><strong>Coupon Code</strong></td>	
	<td><strong>Discount</strong></td>
	<td><strong>Date Start</strong></td>
	<td><strong>Date End</strong></td>	
	<td><strong>Status</strong></td>	
	<td><strong>Action</strong></td>
</tr>
<?
$x=1;
while($row=mysql_fetch_array($selectcat)):
extract($row);
?>
<tr>
	<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$id?>" /></label></td>
	<td><?=$coupon_name?></td>	
	<td><?=$coupon_code?></td>	
	<td><?=$discount_amount?></td>
	<td><?=$date_start?></td>
	<td><?=$date_end?></td>	
	<td>
	<? if($status == 'active') { 
	echo '<font style="color:#9E9E9E;"><img src="images/green-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; } 
	else { 
	echo '<font style="color:#9E9E9E;"><img src="images/red-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; 
	} ?>
	</td>	
	<td width="50" align="center">
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=edit&page=<?=$page?>&id=<?=$id?>" class="edit">
	<img src="images/edit.png" width="35" /> 
	</a>
	</td>
</tr>
<? 
endwhile; 
?>
</table>
	<?=$get->get_pagination('coupon',$currentpage,$page,$start,$limit)?>
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