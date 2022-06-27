<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'ads.php';
$currentpagetitle = 'Ads';
$getdata = $get->get_active_data($_REQUEST['id'],'ads');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_ads();
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'ads');
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
	
<? if($getrole == 'add' or $getrole == 'edit'): ?>
<!-- Add Content -->
<div  id='content'>
<div class="page-heading">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="red_button fright">Back</a>
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="green_button fright">Add <?=$currentpagetitle?></a>
	</p>
</h2>

 <div class="cboth"></div>
	</div>
<div class="dashbox-main-div">

	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add ads-->
			<form action="" method="post" enctype="multipart/form-data">

			<h2><?=$getrole?> <?=$currentpagetitle?>
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="<?=$getrole?> ads" />
		</h2>

			<table style="width:100%; margin:0;">
			<tr>
			<td>Ads Image</td><td><input type="file" name="file" /></td>
			</tr>
			<tr>
			<td>Ads Url </td><td><input type="text" name="ads_url" /></td>
			</tr>
			<tr>
			<td>Ads Code </td><td><textarea name="ad_code"></textarea></td>
			</tr>
			<tr>
			<td>Ads Postion <span class="color_red">*</span></td>
			<td>
			<select name="ad_postion" required>
			<option value="">Select</option>
			<option value="s-first">Slider First</option>
			<option value="s-second">Slider Second</option>
			<option value="s-third">Slider Third</option>
			<option value="f-first">FLY WITH THE WORLD! First</option>
			<option value="f-second">FLY WITH THE WORLD! Second</option>
			<option value="f-third">FLY WITH THE WORLD! Third</option>
			<option value="f-forth">FLY WITH THE WORLD! Forth</option>
			<option value="f-fifth">FLY WITH THE WORLD! Fifth</option>
			<option value="right">Right</option>
			<option value="left">Left</option>
			<option value="top">Top</option>
			<option value="bottom">Bottom</option>
			<option value="brands">Brands</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Ads Page <span class="color_red">*</span></td>
			<td>
			<select name="ad_page" required>
			<option value="">Select</option>
			<option value="home">Home</option>
			<option value="listing">Listing</option>
			<option value="details">Details</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Is Active <span class="color_red">*</span></td><td><select name="status" required><option value="">Select</option><option value="active">Active</option><option value="deactive">Deactive</option></select></td>
			</tr>
			<input type="hidden" name="ads_id" value="<?=rand()?>" />
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
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="red_button fright">Back</a>
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
$selectcat = mysql_query("SELECT * FROM ads ORDER BY id ASC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>Ads URL</strong></td>	
	<td><strong>ads Image</strong></td>	
	<td><strong>Ads Position</strong></td>	
	<td><strong>Ads Page</strong></td>	
	<td><strong>Status</strong></td>	
</tr>
<?
$x=1;
while($row=mysql_fetch_array($selectcat)):
extract($row);
?>
<tr>
	<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$id?>" /></label></td>
	<? if($ad_url !='') {?>
	<td><a href="<?=$ad_url?>" target="_BLANK"> SEE LINK</a></td>
	<td><? if($ad_img !='') {?><img src="../upload/ads/<?=$ad_img?>" width="80px" /><? } ?></td>
	<? } else { echo '<td colspan="2">'.htmlspecialchars($ad_code).'</td>'; } ?> 
	<td><?=$ad_postion?> </td>
	<td><?=$ad_page?> </td>
    <td><?=$status?></td>	
</tr>
<? 
endwhile; 
?>
</table>
	<?=$get->get_pagination('ads',$currentpage,$page,$start,$limit)?>
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