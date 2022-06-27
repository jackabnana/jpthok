<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'testimonial.php';
$currentpagetitle = 'Testimonial';
$getdata = $get->get_active_data($_REQUEST['id'],'testimonial');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_testimonial();
}

if(isset($_POST['edit'])){
$edit = $set->update_testimonial($_REQUEST['id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'testimonial');
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
<script type="text/javascript" src="texteditor/ckeditor/ckeditor.js"></script>
<script language="JavaScript" type="text/JavaScript">

function SubmitItem_page(pid) 
{	
if(checkBlankField(document.form_01.page_title.value) == false)
{
	alert("Please enter page title.");
	document.form_01.page_title.select();
	return false;
}

if(checkBlankField(document.form_01.meta_title.value) == false)
{
	alert("Please enter meta title.");
	document.form_01.meta_title.select();
	return false;
}
if(checkBlankField(document.form_01.meta_title.value) != false)
{
	var meta_title = document.form_01.meta_title.value
	var count_metatitle = meta_title.length
	if(count_metatitle > 70)
	{
		alert("You cannot enter more than 70 characters in page meta title.");
		document.form_01.meta_title.select();
		return false;
	}
}

if(checkBlankField(document.form_01.meta_desc.value) == false)
{
	alert("Please enter meta description.");
	document.form_01.meta_desc.select();
	return false;
}
if(checkBlankField(document.form_01.meta_desc.value) != false)
{
	var meta_desc = document.form_01.meta_desc.value
	var count_metadesc = meta_desc.length
	if(count_metadesc > 200)
	{
		alert("You cannot enter more than 200 characters in page meta description.");
		document.form_01.meta_desc.select();
		return false;
	}
}

if(checkBlankField(document.form_01.meta_keyword.value) == false)
{
	alert("Please enter meta keyword.");
	document.form_01.meta_keyword.select();
	return false;
}
if(checkBlankField(document.form_01.meta_keyword.value) != false)
{
	var meta_keyword = document.form_01.meta_keyword.value
	var count_metakey = meta_keyword.length
	if(count_metakey > 800)
	{
		alert("You cannot enter more than 800 characters in page meta keywords.");
		document.form_01.meta_keyword.select();
		return false;
	}
}
document.form_01.submit();
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
	
<? if($getrole == 'add' or $getrole == 'edit'): ?>
<!-- Add Content -->
<div  id='content'>
<div class="page-heading">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=view" class="red_button fright">Back</a>
	</p>
</h2>
<div class="cboth"></div>
</div>
<div class="dashbox-main-div">

	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add content-->
		<form action="" method="post" enctype="multipart/form-data">
		<h2><?=$getrole?> testimonial
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="Save Content" />
		</h2>
		<br>
			<table width="100%" style="margin:0">
			<? if($getrole == 'add'){ ?>
			<!--<tr>
			<td>Select Page</td>
			<td>
			<select name="parent_id" style="  width: 95%; height: 32px;  margin-left: 10px;" >
			<option value="">Select Page</option>
			</select>
			</td>
			</tr>-->
			<? } ?>
			<tr>
			<td> Name</td>
			<td>
			<input type="text" name="name" style="  width: 95%; height: 30px; margin-left: 10px;" value="<?=$fetchrow->name?>" required />
			</td>
			</tr>
			<tr>
			<td> Email</td>
			<td>
			<input type="text" name="email" value="<?=$fetchrow->email?>"  style="  width: 95%; height: 30px;  margin-left: 10px;"  />
			</td>
			</tr>
			<tr>
			<td> Phone</td>
			<td>
			<input type="text" name="phone" value="<?=$fetchrow->phone?>"  style="  width: 95%; height: 30px;  margin-left: 10px;"  />
			</td>
			</tr>
			<tr>
			<td>City</td>
			<td>
			<input type="text" name="city" value="<?=$fetchrow->city?>"  style="  width: 95%; height: 30px;  margin-left: 10px;"  />
			</td>
			</tr>
			<tr>
		    <td>Country<span class="color_red">*</span></td><td>			
			<select name="country" id="country">
			<option value="">Select</option>
			<option value="India" <? if($fetchrow->country=='India'){ ?> selected <? } ?> >India</option>
			<option value="America" <? if($fetchrow->country=='America'){ ?> selected <? } ?>  >America</option>
			<option value="Australia" <? if($fetchrow->country=='Australia'){ ?> selected <? } ?>  >Australia</option>
			<option value="Canada" <? if($fetchrow->country=='Canada'){ ?> selected <? } ?>  >Canada</option><option value="Sri Lanka" <? if($fetchrow->country=='SriLanka'){ ?> selected <? } ?>  >Sri Lanka</option>
			</select>
		</td>
		</tr>
			<tr>
			<td>Testimonial Description</td>
			<td>
			<textarea name="testimonial" style="width: 95%; height: 60px;  margin-left: 10px;"><?=$fetchrow->testimonial?></textarea>
			</td>
			</tr>
			<tr>
			<td>Company Name</td>
			<td>
			<input type="text" name="computer_name" value="<?=$fetchrow->computer_name?>"  style="  width: 95%; height: 30px;  margin-left: 10px;"  />
			</td>
			</tr>
			<tr>
			<td>Select Image</td>
			<td><input type="file" name="image" style="  width: 95%; height: 30px;  margin-left: 10px;" /></td>
			</tr>
			<? if($fetchrow->image != ''): ?>
			<tr>
			<td>Image</td>
			<td><img width="70" src="<?=$site_url?>/upload/testimonial/<?=$fetchrow->image?>"></td>
			</tr>
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
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="red_button fright">Back</a>
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="green_button fright">Add <?=$currentpagetitle?></a>
	</p>
</h2>
<div class="cboth"></div>
</div>
<div class="dashbox-main-div">

	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	
	<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
	<h2 class="fleft"><span>Manage <?=$currentpagetitle?> </span>
	<form action="" method="post">	
	<div class="fright">
	<input type="submit" name="doaction" class="green_button fright" />
	<select name="action" class="fright select_action">
	<option value="">Select Action</option>
	<option value="active">Active</option>
	<option value="deactive">Deactive</option>
	<option value="delete">Delete</option>
	</select>
	</div>
	</h2>
	<div style="clear:both"></div>
<?
$sql = " SELECT * FROM testimonial ";

$sql .= " ORDER BY id DESC ";

$sql .= "LIMIT $start, $limit ";	


$selectcat = mysql_query($sql);
?>

<table width="100%" style="padding:0; margin:0" id="table">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>Name</strong></td>
	<td><strong>Email</strong></td>	
	<td><strong>Phone</strong></td>	
	<td><strong>Testimonial</strong></td>
	<td><strong>Status</strong></td>	
	<td><strong>Action</strong></td>
</tr>
<?
if(mysql_num_rows($selectcat) > 0):
$x=1;
while($row=mysql_fetch_array($selectcat)):
extract($row);
?>
<tr>
	<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$id?>" /></label></td>
	<td><?=$name?></td>
	<td>
	<?=$email?>
	</td>	
    <td><?=$phone?></td>
	<td>
	<?=substr($testimonial,0,80)?>...
	</td>
	<td>
	<?=$status?>
	</td>	
	<td width="50" align="center">
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=edit&page=<?=$page?>&id=<?=$id?>" class="edit">
	<img src="images/edit.png" width="35" /> 
	</a>
	</td>
</tr>
<? 
endwhile; 
else:
?>
<tr>
	<td align="center"  colspan="5">No Recode Found!!</td>

</tr>
<? endif; ?>
</table>
	<?=$get->get_pagination('product',$currentpage,$page,$start,$limit)?>
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