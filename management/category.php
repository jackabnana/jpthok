<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'category.php';
$currentpagetitle = 'category';
$getdata = $get->get_active_data($_REQUEST['id'],'category');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_category();
}

if(isset($_POST['edit'])){
$edit = $set->update_category($_REQUEST['id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'category');
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
<link rel="stylesheet" type="text/css" href="plugin/lightbox/css/lightbox.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="plugin/lightbox/js/lightbox.js"></script>
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
		<!--Add Category-->
			<form action="" method="post" enctype="multipart/form-data">
			<h2>
			<?=$getrole?> <?=$currentpagetitle?>
			<? if($role == 'edit'){ ?>
			<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=view&page<?=$page?>" class="red_button fright">Cancel</a>
			<? } ?>
			<input type="submit" name="<?=$getrole?>" class="green_button fright" value="Save Category" />
			<div style="clear:both"></div>
			</h2>
				<table style="width:100%; margin:0;">
					<tr>
						<td>Category</td><td><select name="parent_id">
						<option value="">Select Category</option>
						<?=$get->category_option(0,0,$fetchrow->parent_id)?>
						</select></td>
					</tr>
					<tr>
						<td>Name <span class="color_red">*</span></td><td><input type="text" name="category_name" value="<?=$fetchrow->category_name?>"  required /></td>
					</tr>
					<tr>
						<td>Image</td><td><input type="file" name="category_image" /> 
						<? if($fetchrow->category_image !='') { ?>
							<a href="#0" onClick=window.open("../upload/category/<?=$fetchrow->category_image?>","Image","width=500,height=500,0,status=0,");>View</a>
						<? } ?>
						</td>
					</tr>
					<tr>
					
						<td>Category Banner</td><td><input type="file" name="category_banner" /> <? if($fetchrow->category_banner !='') { ?>
						<a href="#0" onClick=window.open("../upload/category/<?=$fetchrow->category_banner?>","Image","width=500,height=500,0,status=0,");>View</a><? } ?>
						</td>
					</tr>
					
					<tr>
						<td>Information</td>
						<td><textarea name="info"><?=$fetchrow->info?></textarea></td>
					</tr>
					
					<tr>
						<td>Page Title</td><td><input type="text" name="category_title" value="<?=$fetchrow->category_title?>" /> </td>
					</tr>
					<tr>
						<td>Meta Keywords</td><td><input type="text" name="category_keyword" value="<?=$fetchrow->category_keyword?>" /></td>
					</tr>
					<tr>
						<td>Meta Description</td><td><textarea name="category_desc"><?=$fetchrow->category_desc?></textarea></td>
					</tr>
					<tr>
						<td>Category Order</td>
						<td><input type="text" name="orderno" value="<?=$fetchrow->orderno?>" /></td>
					</tr>
					
					<tr>
						<td>Home Page Category Wise Product <span class="color_red">*</span></td>
						<td>						
						<select name="category_home" required>
						<option value="">Select</option>
						<option value="yes" <?php if($fetchrow->category_home == 'yes' ){ echo "selected";}?>>Yes</option>
						<option value="no" <?php if($fetchrow->category_home == 'no' ){ echo "selected";}?>>No</option>
						</select></td>
					</tr>
					
					
					<tr>
						<td>Include in Navigation Menu <span class="color_red">*</span></td>
						<td>
						<?
						if($fetchrow->category_menu == 'yes' ){
							$selectyes = 'selected';
						} else if($fetchrow->category_menu == 'no' ){
							$selectno = 'selected';
						}
						?>
						<select name="category_menu" required>
						<option value="">Select</option>
						<option value="yes" <?=$selectyes?>>Yes</option>
						<option value="no" <?=$selectno?>>No</option>
						</select></td>
					</tr>
					<tr>
						<td>Is Active <span class="color_red">*</span></td>
						<td>
						<?
						if($fetchrow->status == 'active' ){
							$selectactive = 'selected';
						} else if($fetchrow->status == 'deactive' ){
							$selectdeactive = 'selected';
						}
						?>
						<select name="category_status" required>
						<option value="">Select</option>
						<option value="active" <?=$selectactive?>>Active</option>
						<option value="deactive" <?=$selectdeactive?>>Deactive</option>
						</select>
						</td>
					</tr>
				<input type="hidden" name="category_id" value="<?=rand()?>" />
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
$sql = "SELECT * FROM category ORDER BY id ASC LIMIT $start, $limit";
$selectcat = mysql_query($sql);
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>Category Name</strong></td>	
	<td><strong>Ordering</strong></td>
	<td width="100px"><strong>Publish</strong></td>	
	<td><strong>Action</strong></td>
</tr>
<?
$x=1;
while($row=mysql_fetch_array($selectcat)):
extract($row);
?>
<tr>
	<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$id?>" /></label></td>
	<td width="350">
	<? if($parent_id != 0 ): ?> <?=$get->get_category_name_by_id($parent_id)?> >  <? endif; ?> 
	<?=$category_name?> 
	</td>
	<td><?=$orderno?></td>	
    <td align="center"><? if($status == 'active' || $status == 'Active') { 
	echo '<font style="color:#FFF;" class="green_button"><img src="images/green-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; } 
	else { 
	echo '<font style="color:#FFF;" class="red_button"><img src="images/red-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; 
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
	<?=$get->get_pagination('category',$currentpage,$page,$start,$limit)?>
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