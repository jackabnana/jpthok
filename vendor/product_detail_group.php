<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'product_detail_group.php';
$currentpagetitle = 'product detail group';
$getdata = $get->get_active_data($_REQUEST['id'],'product_detail_group');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_product_detail_group();
}

if(isset($_POST['edit'])){
$edit = $set->update_product_detail_group($_REQUEST['id']);
}

if(isset($_POST['doaction']))
{
	extract($_POST);
	$add = $set->do_action($action,$ids,'product_detail_group');
}

if(isset($_REQUEST['did'])){
$delete = $set->delete_attribute($_REQUEST['did']);
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
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
    <script type="text/javascript">
		$(function() {
        var addDiv = $('#addinput');
        var i = $('#addinput p').size() + 1;
        $('#addNew').live('click', function() {
                $('<p><input type="text" id="p_new" required name="attribute_option_name[]" style="width:40%; margin:2px 5px;" placeholder="Attribute Option" /><input type="text" id="p_new"  name="attribute_position[]" style="width:40%; margin:2px 5px;" placeholder="Attribute Position" /><a href="#" id="remNew" class="red_button">Remove</a> </p>').appendTo(addDiv);
                i++;
                return false;
        });
        $('#remNew').live('click', function() { 
                if( i > 1 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
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
</h2>
<div class="cboth"></div>
	</div>
<div class="dashbox-main-div">

	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add attribute-->
		<form action="" method="post" enctype="multipart/form-data">
		<h2><?=$getrole?> attribute group
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="<?=$getrole?> attribute" />
		</h2>
		
		<table style="width:100%; margin:0;">
		<tr>
		<td width="45%;">Attribute Group Name <span class="color_red">*</span></td>
		<td><input type="text" name="attri_group_name" value="<?=$fetchrow->attri_group_name?>" required /></td>
		</tr>
		
		<?/*
		<tr>
		<td>Attribute</td>
		<td>
		<div style="height:200px; overflow-y:scroll">
		<ul id="tree">
		<?
			$cateselect = explode(',',$fetchrow->attribute_ids);
		//Fetch Category
		$selectcat = mysql_query("SELECT * FROM attribute WHERE status='active' ");
		while($catrow=mysql_fetch_object($selectcat)):
		?>
		<li>
		<label>
		<input type="checkbox" value="<?=$catrow->attribute_id?>" name="attribute_ids[]" 
		<?php if(in_array($catrow->attribute_id,$cateselect)) { echo "checked"; } ?> /> <?=$catrow->attribute_name?>
		</label>
		</li>
		<? endwhile; ?>
		
		</ul>
		</div>
		</td>
		</tr>
		*/?>
		
		<tr>
		<td>Is Active <span class="color_red">*</span></td><td>
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
		<? if($getrole == 'add'): ?>
		<input type="hidden" name="attri_group_id" value="<?=rand()?>" />
		<? endif; ?>
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
$selectcat = mysql_query("SELECT * FROM product_detail_group ORDER BY id ASC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>Group Attribute Name</strong></td>	
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
	<td>
	
	<?=$attri_group_name?> 
	</td>	
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
	<?=$get->get_pagination('attribute',$currentpage,$page,$start,$limit)?>
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