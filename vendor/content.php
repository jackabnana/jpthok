<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'content.php';
$currentpagetitle = 'content';
$getdata = $get->get_active_data($_REQUEST['id'],'content');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_page();
}

if(isset($_POST['edit'])){
$edit = $set->update_page($_REQUEST['id']);
}

if($_REQUEST['role'] == 'del'){
	$set->delete_page($_REQUEST['content_id']);
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
		<h2><?=$getrole?> Content
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="Save Content" />
		</h2>
		<br>
			<table width="100%" style="margin:0">
			<? if($getrole == 'add'){ ?>
			<tr>
			<td>Select Page</td>
			<td>
			<select name="parent_id" style="  width: 95%; height: 32px;  margin-left: 10px;" >
			<option value="">Select Page</option>
			<?=$get->get_content_option()?>
			</select>
			</td>
			</tr>
			<? } ?>
			<tr>
			<td>Page Name</td>
			<td>
			<input type="text" name="page_name" style="  width: 95%; height: 30px; margin-left: 10px;" value="<?=$fetchrow->page_name?>" required />
			</td>
			</tr>
			<tr>
			<td>Page Title</td>
			<td>
			<input type="text" name="page_title" value="<?=$fetchrow->page_title?>"  style="  width: 95%; height: 30px;  margin-left: 10px;"  />
			</td>
			</tr>
			<tr>
			<td>Page Description</td>
			<td>
			<textarea name="page_description" style="  width: 95%; height: 60px;  margin-left: 10px;"><?=$fetchrow->page_description?></textarea>
			</td>
			</tr>
			<tr>
			<td>Page Keywords</td>
			<td>
			<input type="text" name="page_keywords" value="<?=$fetchrow->page_keywords?>"  style="  width: 95%; height: 30px;  margin-left: 10px;"  />
			</td>
			</tr>
			<tr>
			<td>Select Image</td>
			<td><input type="file" name="file" style="  width: 95%; height: 30px;  margin-left: 10px;" /></td>
			</tr>
			<tr>
			<td colspan="4">Content</td>
			</tr>
			<tr>
			<td colspan="4">
			<textarea  cols="100" id="editor1" name="text" rows="10" required><?=$fetchrow->content_text?></textarea>
			<script type="text/javascript">
			CKEDITOR.replace( 'editor1',
			 {
				filebrowserBrowseUrl : 'texteditor/ckfinder/ckfinder.html',
				filebrowserImageBrowseUrl : 'texteditor/ckfinder/ckfinder.html?type=Images',
				filebrowserFlashBrowseUrl : 'texteditor/ckfinder/ckfinder.html?type=Flash',
				filebrowserUploadUrl : 'texteditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				filebrowserImageUploadUrl : 'texteditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserFlashUploadUrl : 'texteditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
			 } 
			 );			
			 </script>
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
	<div style="clear:both"></div>

</h2>


<? 
$bgcolor = array('bg-green','bg-orange','bg-light-b','bg-last-green','bg-light-blue','bg-light-yellow','bg-light-black','bg-light-green','bg-purple');
$x=0;
$select = mysql_query("SELECT * FROM content  ");
while($row=mysql_fetch_array($select)){
extract($row);
?>
<div class="dashbox   <?=$bgcolor[$x]?>">
<? if($deleted == 1): ?>
<div class="del">
<a href="<?=ADMIN_PATH?>/content.php?role=del&content_id=<?=$content_id?>">
<img src="<?=ADMIN_PATH?>/images/delete.png" width="15"/>
</a>
</div>
<? endif; ?>
<p>
<span style="text-transform:capitalize"> 
<? if($parent_id != 0): ?>
<?=$get->get_content_title($parent_id)?> > <br>
<? endif; ?>
<?=str_replace('_',' ',$page_name)?>
</span>
</p>
<img src="images/content.png" width="42" class="setting-icon" />
<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=edit&page=<?=$page?>&id=<?=$id?>" class="edit">Edit Content</a>
</div>

 <? $x++; } ?>

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