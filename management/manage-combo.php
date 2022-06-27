<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'manage-combo.php';
$currentpagetitle = 'combo';
$getdata = mysql_query("SELECT * FROM combo WHERE id='{$_REQUEST['id']}' and combo_id='{$_REQUEST['request_combo_id']}'");
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add']))
{
	$add = $set->add_combo();
}

if(isset($_POST['edit']))
{
	
	if($_FILES['image']['name'] !=''){
$filename = $_FILES['image']['tmp_name'];	
$array_message = $get->validate_image($filename,422,225,0,640,480,100);
//print_r($array_message);die;
if(key($array_message)=='success'){

  $edit = $set->update_combo($_REQUEST['id'],$_REQUEST['request_combo_id']);
  
  }
	}else{
		
	$edit = $set->update_combo($_REQUEST['id'],$_REQUEST['request_combo_id']);
	
	}
	
}

if(isset($_POST['doaction'])){
extract($_POST);
$add = $set->do_action($action,$ids,'combo');
}

if(isset($_GET['imgdelid'])){
	extract($_GET);
	$selectimg = mysql_query( "SELECT * FROM product_image WHERE id='{$_GET['imgdelid']}' ");
	$row = mysql_fetch_array($selectimg);
	unlink('../upload/product/'.$row['product_img']);
	mysql_query("DELETE FROM product_image WHERE id='{$_GET['imgdelid']}'");
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
<link href="<?=ADMIN_PATH?>/css/select2.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<script  src="<?=ADMIN_PATH?>/js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<style>
.highlight {background-color: #f2f2f2;}
</style>
<script type="text/javascript">
//<![CDATA[

$(function() {
    $('td:first-child input').change(function() {
        $(this).closest('tr').toggleClass("highlight", this.checked);
    });
});

var tabLinks = new Array();
var contentDivs = new Array();

function init() {

  // Grab the tab links and content divs from the page
  var tabListItems = document.getElementById('tabs').childNodes;
  for ( var i = 0; i < tabListItems.length; i++ ) {
	if ( tabListItems[i].nodeName == "LI" ) {
	  var tabLink = getFirstChildWithTagName( tabListItems[i], 'A' );
	  var id = getHash( tabLink.getAttribute('href') );
	  tabLinks[id] = tabLink;
	  contentDivs[id] = document.getElementById( id );
	}
  }

  // Assign onclick events to the tab links, and
  // highlight the first tab
  var i = 0;

  for ( var id in tabLinks ) {
	tabLinks[id].onclick = showTab;
	tabLinks[id].onfocus = function() { this.blur() };
	if ( i == 0 ) tabLinks[id].className = 'selected';
	i++;
  }

  // Hide all content divs except the first
  var i = 0;

  for ( var id in contentDivs ) {
	if ( i != 0 ) contentDivs[id].className = 'tabContent hide';
	i++;
  }
}

function showTab() {
  var selectedId = getHash( this.getAttribute('href') );

  // Highlight the selected tab, and dim all others.
  // Also show the selected content div, and hide all others.
  for ( var id in contentDivs ) {
	if ( id == selectedId ) {
	  tabLinks[id].className = 'selected';
	  contentDivs[id].className = 'tabContent';
	} else {
	  tabLinks[id].className = '';
	  contentDivs[id].className = 'tabContent hide';
	}
  }

  // Stop the browser following the link
  return false;
}

function getFirstChildWithTagName( element, tagName ) {
  for ( var i = 0; i < element.childNodes.length; i++ ) {
	if ( element.childNodes[i].nodeName == tagName ) return element.childNodes[i];
  }
}

function getHash( url ) {
  var hashPos = url.lastIndexOf ( '#' );
  return url.substring( hashPos + 1 );
}

//]]>
</script>
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

function check_stock(id){
	if($('#attribute_stock_check_'+id).attr('checked')) {
		$('#attribute_stock_'+id).val(1);
	} else {
		$('#attribute_stock_'+id).val(0);
	}
}
</script>
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
<div class="page-heading">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=view&page=<?=$_REQUEST['page']?>" class="red_button fright">Back</a>
	</p>
    <div class="cboth"></div>
</h2>
</div>
<div class="dashbox-main-div">
	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	<?php if(key($array_message)=='error'){ $dataval =  key($array_message);
echo '<p class="error">'.$array_message[$dataval].'</p>'; }?>
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add product-->
		<form action="" method="post" enctype="multipart/form-data">
		<h2><?=$getrole?> Combo
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="<? if($getrole == 'edit') { $getrole = 'Update'; }?> <?=$getrole?> Combo " />
		</h2>

		<ul id="tabs">
			<li><a href="#general">General </a></li>
			<li><a href="#data">Data</a></li>
			<li><a href="#images">Images</a></li>
			<li><a href="#related">Products</a></li>		
		</ul>
		
		<div class="tabContent" id="general">
		<div>
		
		<table style="width:100%; margin:0;">
		<tr>
		<td>Combo Name <span class="color_red">*</span></td><td><input type="text" name="combo_name" value="<?=$fetchrow->combo_name?>" required /></td>
		</tr>
		<tr>
		<td>Combo Code <span class="color_red">*</span></td><td><input type="text" name="combo_code" value="<?=$fetchrow->combo_code?>" required /></td>
		</tr>
		<tr>
		<td colspan="2">Combo Detail</td>
		</tr>
		<tr>
		<td colspan="2">
		<textarea name="details" id="editor1"  maxlength="350"><?=$fetchrow->details?></textarea>
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
		
		
		<tr>
		<td>Combo Meta Title</td><td><input type="text" name="combo_title" value="<?=$fetchrow->combo_title?>" /></td>
		</tr>
		<tr>
		<td>Combo Meta Keywords</td><td><input type="text" name="combo_keyword" value="<?=$fetchrow->combo_keyword?>" /></td>
		</tr>
		<tr>
		<td>Combo Meta Description</td><td><textarea name="combo_desc"><?=$fetchrow->combo_desc?></textarea></td>
		</tr>
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
		<input type="hidden" name="combo_id" value="<?=rand()?>" />
		</table>
		</div>
		</div>
		
		<div class="tabContent" id="data">
		<div>
		<table style="width:100%; margin:0;">
		
		
		
		<tr>
		<td>Combo QTY </td>
		<td><input type="text" name="combo_qty" value="<?=$fetchrow->combo_qty?>"  /></td>
		</tr>
		<tr>
		<td>Combo MRP <span class="color_red">*</span></td>
		<td><input type="text" name="combo_rate" value="<?=$fetchrow->combo_rate?>"  required/></td>
		</tr>
		<tr>
		<td>Combo Sale Price </td><td><input type="text"  value="<?=$fetchrow->combo_discount_rate?>" name="combo_discount_rate" /></td>
		</tr>
		<tr>
		<td>Shipping Charges </td><td><input type="text"  value="<?=$fetchrow->combo_delivery?>" name="combo_delivery" /></td>
		</tr>
		<tr>
		<td>Combo Delivery Day </td>
		<td>
		<select name="combo_delivery_day">
		<? 
		for($x=1;$x<=15;$x++): 
		if($x==$fetchrow->combo_delivery_day ){
			$select = 'selected';
		} else if($x==3){
			$select = 'selected';
		} else {
			$select = '';
		}
		?>
		<option value="<?=$x?>" <?=$select?>><?=$x?> Days</option>
		<? endfor; ?>
		</select>
		</td>
		</tr>
		</table>
		</div>
		</div>
		
		<div class="tabContent" id="images">
		<table style="width:100%; margin:0;">		
		<tr>
		<td align="center">
		Images <span class="color_red"> *</span>
		</td>
		<td>
		Position
		</td>
		<!--<td>
		Add rows
		</td>
		<td>
		Option
		</td>-->
		</tr>
		<? 
		$x=1;
		$productimg = mysql_query("SELECT * FROM product_image WHERE combo_id='{$_REQUEST['request_combo_id']}'"); 
		while($proimg=mysql_fetch_array($productimg)):
		extract($proimg);
		?>
		<tr id="<?=$x?>">
		<td align="center">
		<img src="<?=SITE_URL?>/upload/product/<?=$product_img?>" width="60">
		</td>
		<td>
		<?=$postion?>
		</td>
		<!--<td align="center">
		<? //if($defaultimg == 1) { echo 'Default'; } else { echo '-'; } ?>
		</td>-->
		<td>
		<a href="javascript:hide(<?=$x?>);deleteimg(<?=$proimg['id']?>);" onclick="deleteimg(<?=$proimg['id']?>);" class="red_button">Delete</a>
		</td>
		</tr>
		<? $x++; endwhile; ?>
		<tr>
		<td align="center" width="427px">
		<input type="file" name="image" />
		<?if($fetchrow->image !=''){ ?>
		<a href="#0" onClick=window.open("../upload/combo/<?=$fetchrow->image?>","Image","width=600,height=600,0,status=0,");>View</a>
		<? } ?>
		</td>
		<td  width="321px">
		<input type="text" name="imgpostion" id="imgpostion" value="<?=$fetchrow->imgpostion?>"/>
		</td>
		<!--<td align="center" width="100px">
		<input type="radio" name="default[]" value="1"  checked/>
		</td>
		<td>
		<a href="#" id="addNew" class="green_button">Add Rows</a>
		</td>-->
		</tr>
		<tr>
		<td colspan="4">
		<div id="addinput" style="margin:-11px">
		</div>
		</td>
		</tr>
		</table>
		
		</div>
		
		<div class="tabContent" id="related">
		<div>
		<table style="width:100%; margin:0;">
		<tr>
		<td  width="100%" align="left">
		Combo Products <span class="color_red"> *</span>
		</td>
		</tr>
		<tr>
		<td width="100%" align="center">
		<? 
		$related_prod_id = explode(",",$fetchrow->related_combo_id); ?>
		
		<select required name="related_combo_id[]" id="responseForm" multiple onChange="product1select(this.value)" style="width:100%;">
			<? 
			$getrelated = $get->get_product_menu();
			while($relatedrow=mysql_fetch_object($getrelated)):
			?>
			<option value="<?=$relatedrow->prod_id?>" <? if(in_array($relatedrow->prod_id,$related_prod_id)) {echo 'selected'; } ?> >
			<?=$relatedrow->product_name?>
			</option>
			<? endwhile; ?>	
		</select>	
		</td>
		</tr>
		
		</table>
		
		</div>
		</div>
		
		

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
<div class="page-heading">
<h2><span>Manage <?=$currentpagetitle?></span>
	<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="green_button fright">Add <?=$currentpagetitle?></a>
	</p>
    <div class="cboth"></div>
</h2>
</div>
<div class="dashbox-main-div">

	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	<div class="col-100 bg_color_white border_top_gray border_radius_5" > 

	<h2 class="fleft"><span>Manage <?=$currentpagetitle?> </span>
	<div class="fleft search">
	<form action="" method="post">
	<input type="text" name="q" value="<?=$_REQUEST['q']?>" placeholder="Search by combo name">
	<input type="submit" class="green_button" name="search">
	</form>
	</div>
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
$sql = " SELECT * From combo ";
if($_POST['q'] !=''){
	$q = $_POST['q'];
	$sql .= " WHERE combo_name like '%$q%'";
}

$sql .= " ORDER BY id DESC ";

if($_POST['q'] == '' ){
	$sql .= "LIMIT $start, $limit ";	
}
$selectcat = mysql_query($sql);
?>

<table width="100%" style="padding:0; margin:0" id="table">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>Combo Image</strong></td>
	<td><strong>Combo Name</strong></td>	
	<td><strong>Combo Code</strong></td>	
	<td><strong>Price</strong></td>	
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
	<td><a href="#0" onClick=window.open("../upload/combo/<?=$image?>","Image","width=600,height=600,0,status=0,");><img src="../upload/combo/thumb/th_<?=$image?>" width="80px" /></a></td>
	<td>
	<?
	if (strlen($combo_name) >= 25){ 
	echo $get->get_match_text(substr($combo_name, 0, 35),$_POST['q']).' ...';
	} else {
	echo $get->get_match_text($combo_name,$_POST['q']);
	}
	?>
	</td>
    <td><?=$combo_code?></td>
	<td>Rs. <?=$get->get_combo_price($combo_id);?>
	</td>
    
	<td>
	<? if($status == 'active') { 
	echo '<font style="color:#9E9E9E;"><img src="images/green-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; } 
	else { 
	echo '<font style="color:#9E9E9E;"><img src="images/red-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; 
	} ?>
	</td>	
	<td width="50" align="center">
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=edit&page=<?=$page?>&id=<?=$id?>&request_combo_id=<?=$combo_id?>" class="edit">
	<img src="images/edit.png" width="35" /> 
	</a>
	</td>
</tr>
<? 
$x++;
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
	
	
<?  include ('include/footer.php'); ?>	
</div>
</div>
<!-- View Content -->
<? endif; ?>


</body>
<script>
function hide(s) {
	$('#'+s).slideUp(1000);
}

function deleteimg(str) {
    if (str != "") {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","product.php?imgdelid="+str,true);
        xmlhttp.send();
    }
}

function showstock(str) 
{
	$('#addinputstocka p').remove();
	$('#addinputstocka').html('');
	var dataString = 
	"id=" + str;
	$.ajax({  
		type: "POST",  
		url: "active.php",  
		data: dataString,
		beforeSend: function() 
		{
			
		},  
		success: function(response)
		{
			
			$("#stockdiv").html(response);
			
		}
	});
}
</script>
<script src="<?=ADMIN_PATH?>/js/jquery-1.8.0.min.js"></script>
<script src="<?=ADMIN_PATH?>/js/select2.js"></script>
<script>

function show(id){
	$('#'+id).toggle();
}

function delete_attribute(str,id)
{
	
	//$('#stockdiv').show();
	
	
	var dataString = "att_id=" + str;
	$.ajax({  
		type: "POST",  
		url: "active.html",  
		data: dataString,
		beforeSend: function() 
		{
			//$('html, body').animate({scrollTop:0}, 'slow');
			//$("#loading").html('<img src="images/loading.gif" align="absmiddle" alt="Loading..."> Loading...');
		},  
		success: function(response)
		{
			if(response == 'success')
			{
				$('#hide'+id).hide();
			}	
		}
	});
	
}
</script>
<script type="text/javascript">
var addDiv = $('#addinputstocka1');
		$('#addinputstocka1').html('');
		//alert($('#addinputstocka1 p').size());
        var i = $('#addinputstocka1 p').size() + 1;
        $('#addNewstocka1').live('click', function() {
			    var groupId =  $("#stock_required").val();
				
			if(groupId > 1)
			{
				$('<p style="width:100%; margin:0; padding:0;"><table style="width:100%; margin:0;padding:0;"><tr><td align="center" width="25%"><?$select_product_groupa = mysql_query("SELECT * FROM product_attribute WHERE combo_id='{$_REQUEST['request_combo_id']}' and attri_group_id!=0 GROUP BY combo_id ");while($select_product_group_row=mysql_fetch_array($select_product_groupa)){$select_attribute = mysql_query("SELECT  * FROM attribute_group WHERE attri_group_id='{$select_product_group_row['attri_group_id']}' ");$row=mysql_fetch_array($select_attribute);$attribute_id = explode(",",$row['attribute_ids']);?><input type="hidden" name="stock_id[]" value="<?=$row['attribute_ids']?>"><?$attributeoptionid = explode("|",$select_product_group_row['attribute_option_id']);for($p=0;$p<sizeof($attributeoptionid);$p++){echo '<div class="select_box"><select name="stock_option_id[]" id="stock_option_id[]" class="small-input">'; echo '<option>'.$get->get_attribute_name($attribute_id[$p]).'</option>';		$select_attribute_option = mysql_query("SELECT * FROM attribute_option WHERE id='{$attributeoptionid[$p]}'");$attribute_row=mysql_fetch_array($select_attribute_option);$select_attribute_option1 = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$attribute_row['attribute_id']}'");while($attribute_row1=mysql_fetch_array($select_attribute_option1)){echo '<option value='.$attribute_row1['id'].'>'.$attribute_row1['attribute_option_name'].'</option>';}echo '</select></div>';}}?><input type="hidden" name="attribute_size" value="<?=$i-1?>"></td><td  width="22%"><input required type="text" name="stock_price[]" id="stock_price" /></td><td align="center" width="22%"><input type="text" name="stock_dis_price[]" id="stock_dis_price" /></td><td width="15%"><input required type="text" name="stock_stock[]" id="stock_stock" /></td><td width="35%"><a href="#" id="remNewstock" class="green_button">Delete Product</a></td></tr></table></p>').appendTo(addDiv);
			}
			else
			{			
				$('<p style="width:100%; margin:0; padding:0;"><table style="width:100%; margin:0;padding:0;"><tr><td align="center" width="25%"><?
				$select_attribute = mysql_query("SELECT * FROM product_attribute WHERE combo_id='{$_REQUEST['request_combo_id']}' ");$row=mysql_fetch_array($select_attribute);$attribute_id = $row['attribute_id'];echo '<div class="select_box"><select name="stock_option_id[]" id="stock_option_id[]" class="small-input">';echo '<option>'.$get->get_attribute_name($attribute_id).'</option>';$select_attribute_option = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$attribute_id}'");while($attribute_row=mysql_fetch_array($select_attribute_option)){if($attribute_row['id'] == $attribute_id){echo '<option value='.$attribute_row['id'].' selected>'.$attribute_row['attribute_option_name'].'</option>';}else{echo '<option value='.$attribute_row['id'].'>'.$attribute_row['attribute_option_name'].'</option>';}}echo '</select></div>';?><input type="hidden" name="stock_id[]" value="<?=$attribute_id?>"><input type="hidden" name="attribute_size" value="<?=$i-1?>"></td><td  width="22%"><input required type="text" name="stock_price[]" id="stock_price" /></td><td align="center" width="22%"><input type="text" name="stock_dis_price[]" id="stock_dis_price" /></td><td width="15%"><input required type="text" name="stock_stock[]" id="stock_stock" /></td><td width="35%"><a href="#" id="remNewstock" class="green_button">Delete Product</a></td></tr></table></p>').appendTo(addDiv);
				
			}		
			i++;
                return false;
        });
        $('#remNewstock').live('click', function() { 
                if( i > 1 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
</script>
<script>
$(document).ready(function() {
$("#responseForm").select2(); 
$("#responseForm1").select2();   
});
</script> 
</html>