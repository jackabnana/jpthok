<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'shipping_charges.php';
$currentpagetitle = 'Shipping Charges';
$getdata = $get->get_active_data($_REQUEST['id'],'shipping_charges');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_shipping();
}

if(isset($_POST['edit'])){
$edit = $set->update_shipping($_REQUEST['id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'shipping_charges');
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
	
<? if($getrole == 'add' or $getrole == 'edit'): ?>
<!-- Add Content -->
<div  id='content'>
<div class="page-heading">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=view&page=<?=$_REQUEST['page']?>" class="red_button fright">Back</a>
	</p>
</h2>
   <div class="cboth"></div>
 </div>
<div class="dashbox-main-div">
	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add shipping charges-->
			<form action="" method="post" enctype="multipart/form-data">

			<h2><?=$getrole?> Shipping Charges
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="Save Shipping" />
		</h2>

			<table style="width:100%; margin:0;">
			<tr>
			<td>Weight (In Gram)<br>Ex: 1,000g = 1kg <span class="color_red">*</span></td><td><input type="text" name="weight" value="<?=$fetchrow->weight?>" required /></td>
			</tr>
			<tr>
			<td>Amount</td><td><input type="text" name="amount" value="<?=$fetchrow->amount?>" /></td>
			</tr>	
			
			
			<tr>
			<td>Is Active <span class="color_red">*</span></td>
			<td><select name="status" required><option value="">Select</option>
			<option value="active" <? if($fetchrow->status == 'active') { echo "selected";}?>>Active</option>
			<option value="deactive" <? if($fetchrow->status == 'deactive') { echo "selected";}?>>Deactive</option>
			</select>
			</td>
			</tr>			
			</table>

			</form>
			<br>
		</div>
			
</div>
<?  include ('include/footer.php'); ?>
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
</h2>
<div class="cboth"></div>
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
$selectcat = mysql_query("SELECT * FROM shipping_charges ORDER BY id ASC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
   <td><strong>Weight</strong></td>
	<td><strong>Amount</strong></td>	
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
	<td><?=$weight?> Gm</td>
	<td><?=$amount?></td>
    <td><? if($status == 'active') { 
	echo '<font style="color:#9E9E9E;"><img src="images/green-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; } 
	else { 
	echo '<font style="color:#9E9E9E;"><img src="images/red-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; 
	} ?></td>
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
	<?=$get->get_pagination('shipping_charges',$currentpage,$page,$start,$limit)?>
<div  class="cboth"></div>
</form>
	</div>

</div>
<?  include ('include/footer.php'); ?>	
</div>
<!-- View Content -->
<? endif; ?>

</body>

</html>