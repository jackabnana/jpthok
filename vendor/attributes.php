<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'attributes.php';
$currentpagetitle = 'attribute';
$getdata = $get->get_active_data($_REQUEST['id'],'attribute');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_attribute();
}

if(isset($_POST['edit'])){
$edit = $set->update_attribute($_GET['id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'attribute');
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

</head>

<body onload="init()">
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
<div class="dashbox-main-div">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add&page=<?=$_REQUEST['page']?>" class="red_button fright">Back</a>
	</p>
    <div class="cboth"></div>
</h2>
	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add attribute-->
		<form action="" method="post" enctype="multipart/form-data">
		<h2><?=$getrole?> attribute
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="<?=$getrole?> attribute" />
		</h2>
		
		<table style="width:100%; margin:0;">
		
		<?
			//$cateselect = explode(',',$fetchrow->cat_id);
			//$subcat1select = explode(',',$fetchrow->subcat_id);
			//$subcat2select = explode(',',$fetchrow->sub_subcat_id);
		//Fetch Category
		$selectcat = $get->get_category_menu();
		
		?>
		
		
		
		<tr>
		<td width="45%;">Category <span class="color_red">*</span></td>
		<td>
		<select name="category" id="category" OnChange="getSubcategory(this.value);" required>
		<option value="">Select Category</option>
		<?php while($catrow=mysql_fetch_object($selectcat)){ ?>
		<option value="<?=$catrow->category_id?>" <?php if($catrow->category_id ==$fetchrow->cat_id) { echo "selected"; } ?>><?=$catrow->category_name?></option>
		<?php } ?>
		</select>
		<select name="subcategory" id="subcategory">
		<option value="">Select Subcategory</option>
		<?php 
		$category_list = $get->get_subcategory_menu($fetchrow->cat_id);
		while($rows=mysql_fetch_array($category_list)){ ?>
		<option value="<?=$rows['category_id']?>" <?php if($rows['category_id']==$fetchrow->subcat_id) { echo "selected"; }?> ><?=$rows['category_name']?></option>
		<?php } ?>
		</select>
    	</td>
		</tr>
		
		
		
		<tr>
		<td width="45%;">Attribute Name <span class="color_red">*</span></td>
		<td><input type="text" name="attribute_name" value="<?=$fetchrow->attribute_name?>" required /></td>
		</tr>
		
		
		<? $attribute_group = $get->get_all_attribute_group();	?>
		
		<tr>
		<td width="45%;">Attribute Group </td>
		<td>
		<select name="attri_group_id" id="attri_group_id">
		<option value="">Select Attribute Group</option>
		<?php while($grouprow=mysql_fetch_object($attribute_group)){ 
		if($grouprow->cat_id !=''){
		$cat_name = $get->get_category_name_by_id($grouprow->cat_id);
		
		}
		if($grouprow->subcat_id !=''){
		$subcat_name = $get->get_category_name_by_id($grouprow->subcat_id);
		
		}
		
		?>
		<option value="<?=$grouprow->attri_group_id?>" <?php if($grouprow->attri_group_id ==$fetchrow->attri_group_id) { echo "selected"; } ?>><?=$grouprow->attri_group_name?><?=" Category==>".$cat_name." Subcategory==>".$subcat_name?></option>
		<?php } ?>
		</select>
		
    	</td>
		</tr>
		
		<tr>
		
		<td width="45%;">Attribute Required <span class="color_red">*</span></td>
		<td><input type="checkbox" name="attribute_required" <? if($fetchrow->attribute_required == '1') { echo 'checked'; } ?> value="1" />
		Check if this attribute is required in shopping.
		</td>
		</tr>
		
		<tr>
		<td>Attribute Option <span class="color_red">*</span></td> 
		<?php if($fetchrow->attribute_name=='Color'){?> 
		<td><a href="#" id="addNewColor" class="green_button fright">Add</a></td>
		<?php } else { ?>
		<td><a href="#" id="addNew" class="green_button fright">Add</a></td>
		<?php } ?>
		</tr>
		
		
		
		<? if($getrole == 'edit'): ?>
		
		<?php if($fetchrow->attribute_name=='Color'){?>
		<?  include ('color_attributes.php'); ?>
		<?php } else { ?>
		
		<input type="hidden" name="attribute_id" value="<?=$fetchrow->attribute_id?>"/>
		<tr>
		<td colspan="2">
		<p style="width:20%; float:left; ">
		<div class="fleft" style="width:25%; text-align:center; margin:2px 5px;">Option Name</div> 
		<div style="width:23%; margin:2px 5px; text-align:center" class="fleft">Position</div> 
		<p style="width:20%; float:left">
		<div style="width:23%; margin:2px 5px; text-align:center" class="fleft">Option Name</div> 
		<div style="width:23%; margin:2px 5px; text-align:center" class="fleft">Position</div>
		</p>
		<? 
		$selectoption = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='$fetchrow->attribute_id' ORDER BY attribute_position ASC");
		while($optionrow=mysql_fetch_object($selectoption)):
		
		$data=$optionrow->attribute_position;
		
		?>
		<input type="hidden" name="attribute_action[]" value="edit" />
		<input type="hidden" name="id[]" value="<?=$optionrow->id?>" />
		<p style="width:50%; float:left">
		<input type="text" id="p_new" name="attribute_option_name[]" value="<?=$optionrow->attribute_option_name?>" required placeholder="Attribute Options" style="width:40%; margin:2px 5px;" />
		<input type="text" id="p_new" name="attribute_position[]" value="<?=$optionrow->attribute_position?>" style="width:40%; margin:2px 5px;" placeholder="Attribute Position" />
		<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=edit&page=<?=$page?>&id=<?=$_REQUEST['id']?>&did=<?=$optionrow->id?>" class="green_button">Delete</a></p>
		<? endwhile;?>
		</td>
		</tr>
		<? } endif;  ?>
		<tr>
		<td colspan="2">
		<div id="addinput">
		</div>
		</td>
		</tr>
		<? if($getrole == 'add'): ?>
		<input type="hidden" name="attribute_id" value="<?=rand()?>" />
		<? endif; ?>
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
<div class="dashbox-main-div">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="green_button fright">Add <?=$currentpagetitle?></a>
	</p>
    <div class="cboth"></div>
</h2>
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
$selectcat = mysql_query("SELECT * FROM attribute ORDER BY id ASC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>Attribute Name</strong></td>
	<td><strong>Attribute Category</strong></td>
	<td><strong>Attribute Subcategory</strong></td>	
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
	<? if($parent_id != 0 ): ?> <?=$get->get_attribute_name_by_id($parent_id)?> >  <? endif; ?> 
	<?=$attribute_name?> 
	</td>
<td><?=$get->get_category_name_by_id($cat_id)?></td>
<td><?=$get->get_category_name_by_id($subcat_id)?></td>	
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
	
<?  include ('include/footer.php'); ?>	
</div>
</div>
<!-- View Content -->
<? endif; ?>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

    <script type="text/javascript">
		$(function() {
        var addDiv = $('#addinput');
        var i = $('#addinput p').size() + 1 + <?=$data+0?>;
        $('#addNew').live('click', function() {
                $('<p style="width:50%; float:left" ><input type="text" id="p_new" required name="attribute_option_name[]" style="width:40%; margin:2px 5px;" placeholder="Attribute Option" /><input type="hidden" name="attribute_action[]" value="add" /><input type="text" id="p_new"  name="attribute_position[]" style="width:40%; margin:2px 5px;" placeholder="Attribute Position" value="'+i+'" /><a href="#" id="remNew" class="red_button">Remove</a> </p>').appendTo(addDiv);
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
	
	
	
	<script type="text/javascript">
		$(function() {
        var addDiv = $('#addinput');
        var i = $('#addinput p').size() + 1 + <?=$data+0?>;
        $('#addNewColor').live('click', function() {
                $('<p style="width:50%; float:left" ><input type="text" id="p_new" required name="attribute_option_name[]" style="width:30%; margin:2px 5px;" placeholder="Attribute Option" /><input type="hidden" name="attribute_action[]" value="add" /><input type="text" id="p_new" required name="attribute_hex_code[]" style="width:26%; margin:2px 5px;" placeholder="Color Hex Code" maxlength="7" /><input type="text" id="p_new"  name="attribute_position[]" style="width:25%; margin:2px 5px;" placeholder="Attribute Position" value="'+i+'" /><a href="#" id="remNew" class="red_button">Remove</a> </p>').appendTo(addDiv);
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
	<script type="text/javascript">
	function getSubcategory(selected){
		//alert(selected);
        var dataString = 'cat_id='+selected;
      
        	$.ajax({
        		type: "POST",
				dataType: "text",
        		url: "get_subcategory.php",
        		data: dataString,
        		beforeSend: function() {
        			//$('alert, .alert-success, alert-dismissable, #break').remove();
        			
        		},
        		success: function(data){ 
				$("#subcategory").html(data);

            }
        	});
}
	 </script>
</body>

</html>