<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'home_middle.php';
$currentpagetitle = 'home middle';
$getdata = $get->get_active_data($_REQUEST['id'],'home_middle');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_home_middle();
}

if(isset($_POST['edit'])){
$edit = $set->update_home_middle($_REQUEST['id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'home_middle');
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
		<!--Add home_middle-->
		<form action="" method="post" enctype="multipart/form-data">
		<h2><?=$getrole?> home_middle
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="<?=$getrole?> Home Middle" />
		</h2>

		<table style="width:100%; margin:0;">
		<tr>
		<td width="50%">
		Category Name <span class="color_red">*</span></td><td>
		<select name="category_id">
		<?
		$sql = "SELECT * FROM category WHERE parent_id='0' and status='active' order by id asc";
		$query = mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			extract($row);
			 $select = ($row['category_id']==$fetchrow->category_id)?'selected':'';
			 echo "<option value='$category_id' $select>$category_name</option>";
		}
		?>
		</select>
		</td>
		</tr>
		<tr>
		<td>Banner One</td><td><input type="file" name="file" /></td>
		</tr>
		<tr>
		<td>Banner One Url</td><td><input type="text" name="one_url" value="<?=$fetchrow->one_url?>" /></td>
		</tr>
		<tr>
		<td>Banner Two</td><td><input type="file" name="file1" /></td>
		</tr>
		<tr>
		<td>Banner Two Url</td><td><input type="text" name="two_url" value="<?=$fetchrow->two_url?>" /></td>
		</tr>
		<tr>
		<td>Banner Three</td><td><input type="file" name="file2" /></td>
		</tr>
		<tr>
		<td>Banner Three Url</td><td><input type="text" name="three_url" value="<?=$fetchrow->three_url?>" /></td>
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
	<a href="<?=ADMIN_PATH?>/home_middle.php?role=add" class="green_button fright">Add Home Middle</a>
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
$selectcat = mysql_query("SELECT * FROM home_middle ORDER BY id ASC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>Category Name</strong></td>	
	<td><strong>First Banner</strong></td>
	<td><strong>Second Banner</strong></td>	
	<td><strong>Third Banner</strong></td>	
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
	<td><?=$get->get_category_name_by_id($category_id)?></td>
	<td><a href="<?=$one_url?>"><img src="../upload/ads/<?=$banner_one?>" width="50"></a></td>	
	<td><a href="<?=$two_url?>"><img src="../upload/ads/<?=$banner_two?>" width="50"></a></td>	
	<td><a href="<?=$three_url?>"><img src="../upload/ads/<?=$banner_three?>" width="50"> </a></td>	
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
	<?=$get->get_pagination('home_middle',$currentpage,$page,$start,$limit)?>
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