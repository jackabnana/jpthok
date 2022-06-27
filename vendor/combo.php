<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'combo.php';
$currentpagetitle = 'Combo';
$getdata = $get->get_active_data($_REQUEST['id'],'combo');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_combo();
}

if(isset($_POST['edit'])){
$edit = $set->update_combo($_REQUEST['id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'combo');
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
<link href="<?=ADMIN_PATH?>/css/select2.css" rel="stylesheet"/>
<? 
$url = $get->get_current_url();
$prod_idurl = $get->remove_querystring_var($url,'prod_id');
$prod2_idurl = $get->remove_querystring_var($url,'prod2_id');
?>
<script type="text/javascript">
function productoneselect(bh){
var url=window.location;
window.location.href="<?=$prod_idurl?>&prod_id="+bh;
}

function product2select(bh){
var url=window.location;
window.location.href="<?=$prod2_idurl?>&prod2_id="+bh;
}
</script>
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
		<!--Add combo-->
		<form action="" method="post" enctype="multipart/form-data">
		<h2><?=$getrole?> combo
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="<?=$getrole?> Home Middle" />
		</h2>

		<table style="width:100%; margin:0;">
		<tr>
		<td width="50%">
		Combo Name <span class="color_red">*</span></td><td>
		<input type="text" name="combo_name" value="<?=$fetchrow->combo_name?>" />
		</td>
		</tr>
		<tr>
		<td width="50%">
		First Product <span class="color_red">*</span></td><td>
		<select name="prod1_id" id="firstproduct" style="width:95%" onChange="productoneselect(this.value)" required>
		<?
		$sql = "SELECT * FROM product WHERE status='active' order by id asc"; 
		$query = mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			extract($row);
			if($_REQUEST['prod_id'] !=''){
			$select = ($row['prod_id']==$_REQUEST['prod_id'])?'selected':'';	
			} else {
			 $select = ($row['prod_id']==$fetchrow->prod1_id)?'selected':'';
			} 
			 echo "<option value='$prod_id' $select>$product_name</option>";
		}
		?>
		</select>
		</td>
		</tr>
		<tr>
		<td width="50%">
		Second Product <span class="color_red">*</span></td><td>
		<select name="prod2_id" id="secondproduct" style="width:95%" onChange="product2select(this.value)" required>
		<?
		$sql = "SELECT * FROM product WHERE status='active' order by id asc";
		$query = mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			extract($row);
			if($_REQUEST['prod2_id'] !=''){
			$select = ($row['prod_id']==$_REQUEST['prod2_id'])?'selected':'';	
			} else {
			 $select = ($row['prod_id']==$fetchrow->prod2_id)?'selected':'';
			}
			 echo "<option value='$prod_id' $select>$product_name</option>";
		}
		?>
		</select>
		</td>
		</tr>
		<tr>
		<td>First Product Select Flavour <span class="color_red">*</span></td>
		<td>
		<select name="prod1_flavour" class="large-input" required>
		<option value="">Select Flavour</option>
			<?
			$prod_id = $_REQUEST['prod_id'];
			$prod2_id = $_REQUEST['prod2_id'];
			$sql1flv="select * from product_attribute where attribute_id='15493' and prod_id='$prod_id'";
			$rs1flv=mysql_query($sql1flv);
			while($row1flv=mysql_fetch_array($rs1flv)){
				extract($row1flv);
				$select = ($attribute_option_id==$fetchrow->prod1_flavour)?'selected':'';
			?>
			 <option value="<?=$attribute_option_id?>" <?=$select?>> <?=$get->get_attribute_name($attribute_option_id)?></option>
            <? } ?> 
			</select> 
		</td>
		</tr>
		<tr>
		<td>First Product Select Weight <span class="color_red">*</span></td>
		<td>
		<select name="prod1_weight" class="large-input" required >
		<option value="">Select Weight</option>
			<?
			$sql1wei="select * from product_attribute where attribute_id='29289' and prod_id='$prod_id'";
			$rs1wei=mysql_query($sql1wei);
			while($row1wei=mysql_fetch_array($rs1wei)){
				extract($row1wei);
				$select = ($attribute_option_id==$fetchrow->prod1_weight)?'selected':'';
			?>
			 <option value="<?=$attribute_option_id?>" <?=$select?>> <?=$get->get_attribute_name($attribute_option_id)?></option>
            <? } ?> 
		</select>
		</td>
		</tr>
		<tr>
		<td>Second Product Select Flavour <span class="color_red">*</span></td>
		<td>
			<select name="prod2_flavour" class="large-input" required>
			<option value="">Select Flavour</option>
			<?
			$sql2flv="select * from product_attribute where attribute_id='15493' and prod_id='$prod2_id'";
			$rsflv=mysql_query($sql2flv);
			while($row2flv=mysql_fetch_array($rsflv)){
				extract($row2flv);
			$select = ($attribute_option_id==$fetchrow->prod2_flavour)?'selected':'';
			?>
			 <option value="<?=$attribute_option_id?>" <?=$select?>> <?=$get->get_attribute_name($attribute_option_id)?></option>
            <? } ?> 
			</select> 
		</td>
		</tr>
		<tr>
		<td>Second Product Select Weight <span class="color_red">*</span></td>
		<td>
			<select name="prod2_weight" class="large-input " required>
			<option value="">Select Weight</option>
			<?
			$sqlflv="select * from product_attribute where attribute_id='29289' and prod_id='$prod2_id'";
			$rsflv=mysql_query($sqlflv);
			while($row2wei=mysql_fetch_array($rsflv)){
				extract($row2wei);
			$select = ($attribute_option_id==$fetchrow->prod2_weight)?'selected':'';
			?>
			 <option value="<?=$attribute_option_id?>" <?=$select?>> <?=$get->get_attribute_name($attribute_option_id)?></option>
            <? } ?> 
			</select> 

		</td>
		</tr>
		<tr>
		<td>Select Discount Percentage <span class="color_red">*</span></td>
		<td><input type="text" name="disc" value="<?=$fetchrow->disc?>"  required /></td>
		</tr>
		
		<tr>
		<td>Is Active <span class="color_red">*</span></td><td>
			<?
			if($fetchrow->status = 'active' ){
			$selectactive = 'selected';
			} else if($fetchrow->status = 'deactive' ){
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
		<input type="hidden" name="prod_id" value="<?=rand()?>" />
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
	<a href="<?=ADMIN_PATH?>/combo.php?role=add" class="green_button fright">Add combo</a>
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
$selectcat = mysql_query("SELECT * FROM combo ORDER BY id ASC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>First Product Details</strong></td>	
	<td><strong>Second Product Details</strong></td>
	<td><strong>Discount Per.</strong></td>	
	<td><strong>Status</strong></td>	
	<td><strong>Action</strong></td>
</tr>
<?
$x=1;
while($row=mysql_fetch_array($selectcat)):
extract($row);
?>
<tr>
	<td align="center" width="32">
	<label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$id?>" /></label></td>
	<td>
	<img src="../upload/product/<?=$get->get_single_product_img($prod1_id)?>" width="50px" height="50px" class="fleft" style="object-fit: cover; margin:5px;">
	<? if (strlen($get->get_product_name($prod1_id)) >= 15){ 
	echo substr($get->get_product_name($prod1_id), 0, 15).'...';
	} else {
	echo $get->get_product_name($prod1_id);
	} ?>
	<br>
	<b>Flavour:-</b> <?=$get->get_attribute_name($prod1_flavour)?><br>
	<b>Weight:-</b> <?=$get->get_attribute_name($prod1_weight)?><br>
	</td>
	<td>
	<img src="../upload/product/<?=$get->get_single_product_img($prod2_id)?>" width="50px" height="50px" class="fleft" style="object-fit: cover; margin:5px;">
	<?	if (strlen($get->get_product_name($prod2_id)) >= 15){ 
	echo substr($get->get_product_name($prod2_id), 0, 15).'...';
	} else {
	echo $get->get_product_name($prod2_id);
	} ?>
	<br>
	<b>Flavour:-</b> <?=$get->get_attribute_name($prod2_flavour)?><br>
	<b>Weight:-</b> <?=$get->get_attribute_name($prod2_weight)?><br>
	</td>	
	<td><?=$disc?> %</td>	
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
	<?=$get->get_pagination('combo',$currentpage,$page,$start,$limit)?>
<div  class="cboth"></div>
</form>
	</div>
	

</div>
<?  include ('include/footer.php'); ?>	
</div>
<!-- View Content -->
<? endif; ?>

<script src="<?=ADMIN_PATH?>/js/jquery-1.8.0.min.js"></script>
<script src="<?=ADMIN_PATH?>/js/select2.js"></script>
<script>
$(document).ready(function() {
$("#firstproduct").select2();   
});
$(document).ready(function() {
$("#secondproduct").select2();   
});
</script> 
</body>

</html>