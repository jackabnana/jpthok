<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'slider.php';
$currentpagetitle = 'slider';
$getdata = $get->get_active_data($_REQUEST['id'],'slider');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_slider();
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'slider');
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
		<!--Add slider-->
			<form action="" method="post" enctype="multipart/form-data">

			<h2><?=$getrole?> Slider
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="Save Slider" />
		</h2>

			<table style="width:100%; margin:0;">
			<tr>
			<td>Slider Top Text <span class="color_red">*</span></td><td><input type="text" name="slider_txt_top" required /></td>
			</tr>
			<!--<tr>
			<td>Slider Bottom Text</td><td><input type="text" name="slider_txt_bottom" /></td>
			</tr>-->
			<tr>
			<td>Slider Url <span class="color_red">*</span></td><td><input type="text" name="slider_url"  required/></td>
			</tr>
			<tr>
			<td>Slider Image <span class="color_red">*</span></td><td><input type="file" name="file" required/></td>
			</tr>
			<tr>
			<td>Slider Order <span class="color_red">*</span></td><td><input type="text" name="slider_order" required/></td>
			</tr>
			<tr>
			<td>Is Active <span class="color_red">*</span></td><td><select name="status" required><option value="">Select</option><option value="active">Active</option><option value="deactive">Deactive</option></select></td>
			</tr>
			<input type="hidden" name="slider_id" value="<?=rand()?>" />
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
$selectcat = mysql_query("SELECT * FROM slider ORDER BY id ASC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <!--<td><strong>Slider Text</strong></td>	-->
	<td><strong>Slider Image</strong></td>	
	<td><strong>Status</strong></td>	
</tr>
<?
$x=1;
while($row=mysql_fetch_array($selectcat)):
extract($row);
?>
<tr>
	<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$id?>" /></label></td>
	<!--<td><?=$slider_txt_top?> <br><?=$slider_txt_bottom?> </td>-->
	<td><img src="../upload/slider/<?=$slider_img?>" width="120px" /></td>
    <td><? if($status == 'active') { 
	echo '<font style="color:#9E9E9E;"><img src="images/green-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; } 
	else { 
	echo '<font style="color:#9E9E9E;"><img src="images/red-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; 
	} ?></td>	
</tr>
<? 
endwhile; 
?>
</table>
	<?=$get->get_pagination('slider',$currentpage,$page,$start,$limit)?>
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