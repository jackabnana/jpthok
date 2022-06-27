<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'product.php';
$currentpagetitle = 'product';
$getdata = mysql_query("SELECT * FROM product WHERE id='{$_REQUEST['id']}' and prod_id='{$_REQUEST['request_prod_id']}'");
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add']))
{
	$add = $set->add_product();
}

if(isset($_POST['edit']))
{
	$edit = $set->update_product($_REQUEST['id'],$_REQUEST['request_prod_id'],$_REQUEST['page']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'product');
}

if(isset($_GET['proddelid'])){
	extract($_GET);
	mysql_query("DELETE FROM detail_product_attribute WHERE id='{$_GET['proddelid']}'");
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



<script type="text/javascript">
	$(function() {
	var addDiv = $('#addinput');
	var i = $('#addinput p').size() + 3;
	$('#addNew').live('click', function() {
			$('<p style="width:100%; margin:0; padding:0;"><table style="width:100%; margin:0; padding:0;"><tr><td align="center"  width="427px"><input type="file" name="prodcut_img[]" /></td><td width="321px"><input type="text" name="imgpostion[]" /></td><td><a href="#" id="remNew" class="green_button">Remove</a></td></tr></table></p>').appendTo(addDiv);
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
	var addDiv = $('#addinputgroup');
	var i = $('#addinputgroup p').size() + 3;
	$('#addNewGroup').live('click', function() {
			$('<p style="width:100%; margin:0; padding:0;"><table style="width:100%; margin:0; padding:0;"><tr><td><select name="product_attri_group_id[]"><option value="">Select value</option><? $group_prod_sql = mysql_query("SELECT * FROM product_detail_group WHERE status = 'active' ");
			while($getrelated_result = mysql_fetch_array($group_prod_sql)){?><option value="<?=$getrelated_result['id']?>"><?=$getrelated_result['attri_group_name']?></option><?}?></select></td><td><select name="detail_product_att_name[]"><option value="">Select value</option><? $attribute_prod_sql = mysql_query("SELECT * FROM product_detail_attribute WHERE status = 'active' ");
			while($getrelated = mysql_fetch_array($attribute_prod_sql)){?><option value="<?=$getrelated['id']?>"><?=$getrelated['attri_group_name']?></option><?}?></select></td><td><input type="text" name="detail_product_att_value[]"></td><td><a href="#" id="remNewGroup" class="green_button">Remove</a></td></tr></table></p>').appendTo(addDiv);
			i++;
			return false;
	});
	$('#remNewGroup').live('click', function() { 
			if( i > 1 ) {
					$(this).parents('p').remove();
					i--;
			}
			return false;
	});
});
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
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add product-->
		<form action="" method="post" enctype="multipart/form-data">
		<h2><?=$getrole?> Product
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="<? if($getrole == 'edit') { $getrole = 'Update'; }?> <?=$getrole?> Product " />
		</h2>

		<ul id="tabs">
			<li><a href="#general">General </a></li>
			<li><a href="#data">Data</a></li>
			<li OnClick="check_selected_forstock();"><a href="#stock">Stock</a></li>
			<li OnClick="check_selected_forattribute();"><a href="#attribute">Attribute</a></li>
			<li><a href="#images">Images</a></li>
			<li><a href="#related">Related</a></li>	
			<li><a href="#group_detail">Group for Detail</a></li>
		</ul>
		
		<div class="tabContent" id="general">
		<div>
		
		<table style="width:100%; margin:0;">
		<tr>
		<td>Product Name <span class="color_red">*</span></td><td><input type="text" name="product_name" value="<?=$fetchrow->product_name?>" required /></td>
		</tr>
		<tr>
		<td>Product Code <span class="color_red">*</span></td><td><input type="text" name="product_code" value="<?=$fetchrow->product_code?>" required /></td>
		</tr>
		<tr>
			<td>Size Chart</td><td><input type="file" name="size_chart" />
			<? if($fetchrow->size_chart !='') { ?>
							<a href="#0" onClick=window.open("../upload/product/sizechart/<?=$fetchrow->size_chart?>","Image","width=500,height=500,0,status=0,");>View</a>
						<? } ?>
			</td>
		</tr>
			
		<tr>
		<td colspan="2">Product Information</td>
		</tr>
		<tr>
		<td colspan="2">
		<textarea name="details" id="editor1"  maxlength="350"><?=$fetchrow->details?></textarea>
		<!--<script type="text/javascript">
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
		</script>-->
		</td>
		</tr>

		<tr>
		<td colspan="2">Product details</td>
		</tr>
		<tr>
		<td colspan="2">
		<textarea name="details1" id="editor2"><?=$fetchrow->details_one?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace( 'editor2',
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
		<td colspan="2">User Guide</td>
		</tr>
		<tr>
		<tr>
		<td colspan="2"><textarea name="details2" id="editor3"><?=$fetchrow->details_two?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace( 'editor3',
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
		
		<? /* ?>
		<tr>
		<td colspan="2">Buying Guide</td>
		</tr>
		<tr>
		<td colspan="2"><textarea name="details3" id="editor4"><?=$fetchrow->details_three?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace( 'editor4',
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
		<td colspan="2">Product Faq</td>
		</tr>
		<tr>
		<td colspan="2"><textarea name="details4" id="editor5"><?=$fetchrow->details_four?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace( 'editor5',
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
		</tr><? */ ?>
		<tr>
		<td>Product Meta Title</td><td><input type="text" name="prodcut_title" value="<?=$fetchrow->prodcut_title?>" /></td>
		</tr>
		<tr>
		<td>Meta Keywords</td><td><input type="text" name="prodcut_keyword" value="<?=$fetchrow->prodcut_keyword?>" /></td>
		</tr>
		<tr>
		<td>Meta Description</td><td><textarea name="prodcut_desc"><?=$fetchrow->prodcut_desc?></textarea></td>
		</tr>
		<tr>
		<td>Please check if you want to see this <br />product in best sale and feature sale</td>
		<? $best_sales = explode(",",$fetchrow->best_sales);  ?>
		<td width="50%">
		<input type="checkbox" name="best_sales[]" value="BS" <? if(in_array('BS',$best_sales)){ echo 'checked'; } ?> /> Spotlight
		<input type="checkbox" name="best_sales[]" value="PP" <? if(in_array('PP',$best_sales)){ echo 'checked'; } ?> /> Daily Deals
		<input type="checkbox" name="best_sales[]" value="VPC" <? if(in_array('VPC',$best_sales)){ echo 'checked'; } ?> />  Special
		<input type="checkbox" name="best_sales[]" value="DO" <? if(in_array('DO',$best_sales)){ echo 'checked'; } ?> /> Discount Offer
		<input type="checkbox" name="best_sales[]" value="LL" <? if(in_array('LL',$best_sales)){ echo 'checked'; } ?> /> Latest Products
		</td>
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
		<input type="hidden" name="prod_id" value="<?=rand()?>" />
		<input type="hidden" name="request_product_id" id="request_product_id" value="<?=$_REQUEST['request_prod_id']?>" />
		</table>
		</div>
		</div>
		
		<div class="tabContent" id="data">
		<div>
		<table style="width:100%; margin:0;">
		<tr>
		<td>Category</td>
		<td>
		<div style="height:200px; overflow-y:scroll">
		<ul id="tree">
		<?
			$cateselect = explode(',',$fetchrow->cat_id);
			$subcat1select = explode(',',$fetchrow->subcat_id);
			$subcat2select = explode(',',$fetchrow->sub_subcat_id);
		//Fetch Category
		$selectcat = $get->get_category_menu();
		while($catrow=mysql_fetch_object($selectcat)):
		?>
		<li>
		<label>
		<input type="checkbox" value="<?=$catrow->category_id?>" name="cat_id[]" 
		<?php if(in_array($catrow->category_id,$cateselect)) { echo "checked"; } ?> onClick="show(<?=$catrow->id?>); set_attributes(<?=$catrow->id?>); set_display_attributes(<?=$catrow->id?>);" /> <?=$catrow->category_name?>
		</label>
		<ul id="<?=$catrow->id?>" style="display:none;">
		<?
		// Fetch Sub Category 
		$getsubcatmenu = $get->get_subcategory_menu($catrow->category_id); 
		while($subcat=mysql_fetch_object($getsubcatmenu)):
		?>
		<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<label>
		<input type="checkbox" value="<?=$subcat->category_id?>" name="subcat_id[]" 
		<?php if(in_array($subcat->category_id,$subcat1select)) { echo "checked"; } ?> onClick="show(<?=$subcat->id?>); set_attributes(<?=$subcat->id?>); set_display_attributes(<?=$catrow->id?>);" /> <?=$subcat->category_name?></label>
			
			<ul id="<?=$subcat->id?>" style="display:none;">
			<?
			// Fetch Sub 2 Category 
			$getsub2catmenu = $get->get_subcategory_menu($subcat->category_id); 
			while($sub2cat=mysql_fetch_object($getsub2catmenu)):
			?>
			<li >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input type="checkbox" value="<?=$sub2cat->category_id?>" name="sub_subcat_id[]" 
			<?php if(in_array($sub2cat->category_id,$subcat2select)) { echo "checked"; } ?> /> <?=$sub2cat->category_name?></label>
			</li>
			<? endwhile; ?>
			</ul>
			
		</li>
		<? endwhile; ?>
		</ul>	
		</li>
		<? endwhile; ?>
		</ul>
		</div>
		</td>
		</tr>
		<tr>
		<td>Product QTY <span class="color_red">*</span></td>
		<td><input type="text" name="product_qty" value="<?=$fetchrow->product_qty?>"  required/></td>
		</tr>
		<tr>
		<td>Product Rate <span class="color_red">*</span></td>
		<td><input type="text" name="product_rate" value="<?=$fetchrow->product_rate?>"  required/></td>
		</tr>
		<tr>
		<td>Sale Price </td><td><input type="text"  value="<?=$fetchrow->prodcut_discount_rate?>" name="prodcut_discount_rate" /></td>
		</tr>
		<!--<tr>
		<td>Shipping Charges </td><td><input type="text"  value="<?=$fetchrow->product_delivery?>" name="product_delivery" /></td>
		</tr>-->
		<tr>
		<td>Product Delivery Day </td>
		<td>
		<select name="product_delivery_day">
		<? 
		for($x=1;$x<=15;$x++): 
		if($x==$fetchrow->product_delivery_day ){
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
		
		<div class="tabContent" id="stock"> 
		
		<span id="display_msg"></span>
		
		
		<div id="stock_manage">
		
		<!-- Stock group -->
		
		 <div class="selectContainer fleft" style="width:20%;">
		        <select id="theSelect" style="width:200px;" onchange="showstock(this.value);">
		            <option value="">- Select -</option>
					<? 
					
					
					if($fetchrow->cat_id!='' && $fetchrow->subcat_id!='')
					{
					$sql_query.='AND cat_id='.$fetchrow->cat_id.' AND subcat_id='.$fetchrow->subcat_id;	
					}else if($fetchrow->cat_id!=''){
					$sql_query.='AND cat_id='.$fetchrow->cat_id;	
					}else if($fetchrow->subcat_id!=''){
					$sql_query.='AND subcat_id='.$fetchrow->subcat_id;	
					}
				
					$select_group = mysql_query("SELECT * FROM attribute_group WHERE status='active' $sql_query ");
					while($row_group=mysql_fetch_array($select_group))
					{
					
						$select_product_group = mysql_query("SELECT * FROM product_attribute WHERE prod_id='{$_REQUEST['request_prod_id']}' and attri_group_id!=0 ");
						$select_product_group_row=mysql_fetch_array($select_product_group);
						echo $select_product_group_row['attri_group_id'].'='.$row_group['attri_group_id'];
						if($select_product_group_row['attri_group_id'] == $row_group['attri_group_id']){
							$selecteda = "selected";
						} else {
							$selecteda = "";
						}
						?>
						<option value="<?=$row_group['attri_group_id']?>" <?=$selecteda?>><?=$row_group['attri_group_name']?></option>
						<?
					}
					?>
		        </select>
		 </div>
		 
		 <div id="stockdiv" class="fright" style="width:80%;">
			<div class="hidden iswf" >
	<table style="width:100%; margin:0;">		
		<tr>
		<td align="center">
		Attribute Option
		</td>
		<td>
		Price
		</td>
		<td>
		Discount Price
		</td>
		<td>
		Stock
		</td>
		<td>
		Action
		</td>
		</tr>	
		
	<?
	$x=0;
	$select_product_groupa = mysql_query("SELECT * FROM product_attribute WHERE prod_id='{$_REQUEST['request_prod_id']}' and attri_group_id!=0 ");
	while($select_product_group_row=mysql_fetch_array($select_product_groupa))
	{	

			$att = mysql_query("SELECT * FROM attribute_group WHERE attri_group_id = '".$select_product_group_row['attri_group_id']."' ");
			$res = mysql_fetch_array($att);
			$result = explode(',',$res['attribute_ids']);
			$count = count($result);
			?>
		    <tr id="hide<?=$x?>">
			<?
            if($count > 1)
			{
				
			    ?>
				<td align="center" width="25%">
				<?
				
				$select_attribute = mysql_query("SELECT  * FROM attribute_group WHERE attri_group_id='{$select_product_group_row['attri_group_id']}' ");
				$row=mysql_fetch_array($select_attribute);
				$attribute_id = explode(",",$row['attribute_ids']);
				
				
                $attributeoptionid = explode("|",$select_product_group_row['attribute_option_id']);
				for($p=0;$p<sizeof($attributeoptionid);$p++)
                {
							echo '<div class="select_box"><select name="stock_option_id[]" id="stock_option_id[]" class="small-input">';
							
							echo '<option>'.$get->get_attribute_name($attribute_id[$p]).'</option>';		
							
							$select_attribute_option = mysql_query("SELECT * FROM attribute_option WHERE id='{$attributeoptionid[$p]}'");
							$attribute_row=mysql_fetch_array($select_attribute_option);
									
					        $select_attribute_option1 = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$attribute_row['attribute_id']}'");
							
							
								
							while($attribute_row1=mysql_fetch_array($select_attribute_option1))
							{
									if($attribute_row1['id'] == $attributeoptionid[$p])
									{
										echo '<option value='.$attribute_row1['id'].' selected>'.$attribute_row1['attribute_option_name'].'</option>';
									} 
									else 
									{
									 echo '<option value='.$attribute_row1['id'].'>'.$attribute_row1['attribute_option_name'].'</option>';
									}
							}
								
							echo '</select></div>'; 
				}
				?>
				</td>
			<?
            }
			else
			{
				?>
				<td align="center" width="25%">
				<?
				$select_attribute = mysql_query("SELECT distinct attribute_id FROM product_attribute WHERE prod_id='{$_REQUEST['request_prod_id']}' ");
				$row=mysql_fetch_array($select_attribute);
				$attribute_id = explode("|",$row['attribute_id']);
				$p=0;

				$attributeoptionid = explode("|",$select_product_group_row['attribute_option_id']);  // bich me nhi hai 

				while($p<sizeof($attribute_id))
				{
					echo '<div class="select_box"><select name="stock_option_id[]" id="stock_option_id[]" class="small-input">'; 
					echo '<option>'.$get->get_attribute_name($attribute_id[$p]).'</option>';
					$select_attribute_option = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$attribute_id[$p]}'");
					while($attribute_row=mysql_fetch_array($select_attribute_option))
					{
							if($attribute_row['id'] == $attributeoptionid[$p])
							{
								echo '<option value='.$attribute_row['id'].' selected>'.$attribute_row['attribute_option_name'].'</option>';
							} 
							else 
							{
							 echo '<option value='.$attribute_row['id'].'>'.$attribute_row['attribute_option_name'].'</option>';
							}
					}
						
					echo '</select></div>'; 
					$p++; 
				}
				?>
				</td>
				<?		
			}				
		?>			
		<input type="hidden" value="<?=$count?>" name="stock_required" id="stock_required">
		<input type="hidden" name="stock_id[]" value="<?=$select_product_group_row['attribute_id']?>">
		<input type="hidden" name="stock_group_id" id="stock_group_id" value="<?=$select_product_group_row['attri_group_id']?>">
		<td  width="22%">
		<input type="text" name="stock_price[]" value="<?=$select_product_group_row['attribute_price']?>" id="stock_price" />
		</td>
		<td align="center" width="22%">
		<input type="text" name="stock_dis_price[]" value="<?=$select_product_group_row['attribute_dis_price']?>" id="stock_dis_price" />
		</td>
		<td width="15%">
		<input type="text" name="stock_stock[]" value="<?=$select_product_group_row['attribute_stock']?>" id="stock_stock" />
		</td>
		<td width="35%">
		<?
		if($x == 0)
		{
			?>
		<a href="#" id="addNewstocka1" class="green_button">Add Rows</a>
		    <?
		}
		if($x > 0)
		{
			?>
			<span class="green_button" onclick="delete_attribute('<?=$select_product_group_row['id']?>','<?=$x?>');">Delete</span>
			<? 
		} 
		?>
		
		</td>
		</tr>
		<? $x++;
	}
	?>
		<tr>
		<td colspan="5">
		<div id="addinputstocka1">
		</div>
		</td>
		</tr>
				</table>
			</div>



		 </div>
		
		</div>
		
		</div>
		
		
		<div class="tabContent" id="attribute">
		
		<span id="display_msg2"></span>
		
		<div id="manage_attribute">
		<div id="set_attribute">
		<table style="width:100%; margin:0;">
			<?
			if($fetchrow->cat_id!='' && $fetchrow->subcat_id!='')
					{
					$asql_query.='AND cat_id='.$fetchrow->cat_id.' AND subcat_id='.$fetchrow->subcat_id;	
					}else if($fetchrow->cat_id!=''){
					$asql_query.='AND cat_id='.$fetchrow->cat_id;	
					}else if($fetchrow->subcat_id!=''){
					$asql_query.='AND subcat_id='.$fetchrow->subcat_id;	
					}
			
			
			
			$a=1;			
			$select_attribute = mysql_query("SELECT * FROM attribute WHERE status='active' $asql_query");
			while($select_attri=mysql_fetch_array($select_attribute)){
				if($a==1){ echo '<tr>'; }
			?>
		
			<td align="center" width="25%">
			<input type="hidden" name="attribute_id[]" value="<?=$select_attri['attribute_id']?>" />
			<b><?=$select_attri['attribute_name']?></b>
				<select name="attribute_option_id[]" multiple style="height:100px">
				<? 
				$select_sub_attribute = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$select_attri['attribute_id']}' ");
				while($row=mysql_fetch_array($select_sub_attribute)):
				?>
				<option value="<?=$row['id']?>" <?=$get->get_attribute_option_id($row['id'],$_REQUEST['request_prod_id'])?>><?=$row['attribute_option_name']?></option>
				<? endwhile; ?>
				</select>
			</td>
				
			<? if($a==4){ echo '</tr>'; $a=0; } $a++; } ?>		
		
		</table>
		</div>
		</div>
		</div>
		
		<div class="tabContent" id="images">
		<table style="width:100%; margin:0;">	
		<tr><td align="center" colspan="3">Imaage upload size(1000*1000 & 50-100kb) and type(.jpg) only.</td></tr>		
		<tr>
		<td align="center">
		Images
		</td>
		<td>
		Position
		</td>
		<!--<td>
		Add rows
		</td>-->
		<td>
		Option
		</td>
		</tr>
		<? 
		$x=1;
		$productimg = mysql_query("SELECT * FROM product_image WHERE prod_id='{$_REQUEST['request_prod_id']}'"); 
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
		<input type="file" name="prodcut_img[]" />
		</td>
		<td  width="321px">
		<input type="text" name="imgpostion[]" id="imgpostion" />
		</td>
		<!--<td align="center" width="100px">
		<input type="radio" name="default[]" value="1"  checked/>
		</td>-->
		<td>
		<a href="#" id="addNew" class="green_button">Add Rows</a>
		</td>
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
		Related Color Product
		</td>
		</tr>
		<tr>
		<td width="100%" align="center">
		<? 
			$related_color_prod_id = explode(",",$fetchrow->related_color_prod_id); 
			$getrelated = $get->get_product_menu();
			while($relatedrow=mysql_fetch_object($getrelated)):
			?>
			<? endwhile; ?>	
			<select name="related_color_prod_id[]" id="responseForm1" multiple onChange="product1select(this.value)" style="width:100%;">
			<? 
			$getrelated = $get->get_product_menu();
			while($relatedrow=mysql_fetch_object($getrelated)):
			?>
			<option value="<?=$relatedrow->prod_id?>" <? if(in_array($relatedrow->prod_id,$related_color_prod_id)) {echo 'selected'; } ?> >
			<?=$relatedrow->product_name?>
			</option>
			<? endwhile; ?>	
		</td>
		</tr>
		
		<tr>
		<td  width="100%" align="left">
		Related Product
		</td>
		</tr>
		<tr>
		<td width="100%" align="center">
		<? 
		$related_prod_id = explode(",",$fetchrow->related_prod_id); 
		$getrelated = $get->get_product_menu();
		while($relatedrow=mysql_fetch_object($getrelated)):
		?>
		<? endwhile; ?>	
		<select name="related_prod_id[]" id="responseForm" multiple onChange="product1select(this.value)" style="width:100%;">
			<? 
			$getrelated = $get->get_product_menu();
			while($relatedrow=mysql_fetch_object($getrelated)):
			?>
			<option value="<?=$relatedrow->prod_id?>" <? if(in_array($relatedrow->prod_id,$related_prod_id)) {echo 'selected'; } ?> >
			<?=$relatedrow->product_name?>
			</option>
			<? endwhile; ?>	
		</td>
		</tr>
		
		</table>
		
		</div>
		</div>
		
		
		<div class="tabContent" id="group_detail">
		<div>
		<table style="width:100%; margin:0;">
		<tr>
		<td><select name="product_attri_group_id[]">
		<option value="">Select value</option>
		<?
		$group_prod_sql = mysql_query("SELECT * FROM product_detail_group WHERE status = 'active' ");
		while($getrelated_result = mysql_fetch_array($group_prod_sql))
		{
			?>
			<option value="<?=$getrelated_result['id']?>"><?=$getrelated_result['attri_group_name']?></option><?
		}
		?>
		</select></td>
		
		<td><select name="detail_product_att_name[]">
		<option value="">Select value</option>
		<?
		$group_prod_sql = mysql_query("SELECT * FROM product_detail_attribute WHERE status = 'active' ");
		while($getrelated_result = mysql_fetch_array($group_prod_sql))
		{
			?>
			<option value="<?=$getrelated_result['id']?>"><?=$getrelated_result['attri_group_name']?></option><?
		}
		?>
		</select></td>
		<td><input type="text" name="detail_product_att_value[]"></td>
		<td><a href="#" id="addNewGroup" class="green_button">Add Rows</a></td>
		</tr>
		
		<tr>
		<td colspan="4">
		<div id="addinputgroup" style="margin:-11px">
		</div>
		</td>
		</tr>
		</table>
		
		
		<?
		$z=1;
		
		$productatt = mysql_query("SELECT *, PDG.id AS pid,DPA.id AS PID FROM  detail_product_attribute AS DPA JOIN product_detail_group AS PDG ON DPA.product_attri_group_id = PDG.id JOIN product_detail_attribute PDA ON  PDA.id = DPA.detail_product_att_name WHERE prod_id='{$_REQUEST['request_prod_id']}'"); ?>
		<table style="width:100%; margin:0;">
		<?
		while($proatt=mysql_fetch_array($productatt))
		{
			  extract($proatt);?>
			  <tr id="table<?=$z?>">
				  <td>
				  <select name="product_attri_group_id[]">
				  <option value="">Select value</option>
				  <?
				  $group_prod_sql = mysql_query("SELECT * FROM product_detail_group WHERE status = 'active' ");
				  while($getrelated_result = mysql_fetch_array($group_prod_sql))
				  {
				   ?>
				   <option <?if($getrelated_result['id']==$pid){ ?> selected <? }?> value="<?=$getrelated_result['id']?>"><?=$getrelated_result['attri_group_name']?></option><?
				   }
				   ?>
				   </select>
				  </td>
				  
				  <td>
				  <select name="detail_product_att_name[]">
				  <option value="">Select value</option>
				  <?
				  $attribute_prod_sql = mysql_query("SELECT * FROM product_detail_attribute WHERE status = 'active' ");
				  while($getrelated = mysql_fetch_array($attribute_prod_sql))
				  {
				   ?>
				   
				   <option <?if($getrelated['id'] == $detail_product_att_name){ ?> selected <? }?> value="<?=$getrelated['id']?>"><?=$getrelated['attri_group_name']?></option><?
				   }
				   ?>
				   </select>
				  </td>
				  <td><input type="text" name="detail_product_att_value[]" value="<?=$detail_product_att_value?>"></td>
				  
				  <td><a href="javascript:hide_product('<?=$z?>');deleteimg_product('<?=$PID?>');" class="red_button">Delete</a>
				  </td>
				  
			  </tr>
		      <?
		$z++;	  
		}
		?>
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
<h2><span>Manage <?=$currentpagetitle?></span>|
	<span><a href="export.php">Download CSV</a></span>
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
	<input type="text" name="q" value="<?=$_REQUEST['q']?>" placeholder="Search by product name">
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
$sql = " SELECT P.id as pid,P.status as p_status,P.*,C.* From product as P, 
	category as C   ";
	
if($_POST['q'] !=''){
	$q = $_POST['q'];
	$sql .= " WHERE P.product_name like '%$q%'";
	/*$words = explode(" ", $_POST['q']);
	$x=1;
	foreach ($words as $w) {
		if($x == 1) { $sql .= ' AND '; } else { $sql .= ' OR '; }
	$sql .= " P.product_name like '%$w%'";
	$x++; 
	}*/
}

$sql .= " GROUP BY P.prod_id ORDER BY P.id DESC ";

if($_POST['q'] == '' ){
	$sql .= "LIMIT $start, $limit ";	
}

$selectcat = mysql_query($sql);
?>

<table width="100%" style="padding:0; margin:0" id="table">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
    <td><strong>Product Image</strong></td>
	<td><strong>Product Name</strong></td>	
	<td><strong>Product Code</strong></td>	
	<td><strong>Price</strong></td>	
	<td><strong>Stock Qty</strong></td>	
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
	<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$pid?>" /></label></td>
	<td><a href="#0" onClick=window.open("<?=$site_url?>/upload/product/<?=$get->get_single_product_img($prod_id)?>","Image","width=600,height=600,0,status=0,");><img src="<?=$site_url?>/upload/product/<?=$get->get_single_product_img($prod_id)?>" width="80px" /></a></td>
	<td>
	<?
	if (strlen($product_name) >= 25){ 
	echo $get->get_match_text(substr($product_name, 0, 35),$_POST['q']).' ...';
	} else {
	echo $get->get_match_text($product_name,$_POST['q']);
	}
	?>
	</td>
    <td><?=$product_code?></td>
	<td>Rs. 
	<? if($get->get_product_discount_price($prod_id) > 0) { 
      echo $get->get_product_discount_price($prod_id);} 
	  else { 
      echo $get->get_product_without_discount_price($prod_id);}
	  ?>
	</td>
    <td>
	<? if($get->get_qty_sum($prod_id) > 0) { echo $get->get_qty_sum($prod_id); } else { echo $product_qty; } ?></td>
	<td>
	<? if($p_status == 'active') { 
	echo '<font style="color:#9E9E9E;"><img src="images/green-dot.png" width="9px" /> &nbsp;'.$p_status.'</font>'; } 
	else { 
	echo '<font style="color:#9E9E9E;"><img src="images/red-dot.png" width="9px" /> &nbsp;'.$p_status.'</font>'; 
	} ?>
	</td>	
	<td width="50" align="center">
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=edit&page=<?=$page?>&id=<?=$pid?>&request_prod_id=<?=$prod_id?>" class="edit">
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
	<td align="center"  colspan="8">No Recode Found!!</td>

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
function hide_product(s) {
	$('#table'+s).slideUp(1000);
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
function deleteimg_product(str){
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
        xmlhttp.open("GET","product.php?proddelid="+str,true);
        xmlhttp.send();
    }
}
function showstock(str) 
{
	//alert(str);
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
	//alert(id);
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
				$('<p style="width:100%; margin:0; padding:0;"><table style="width:100%; margin:0;padding:0;"><tr><td align="center" width="25%"><?$select_product_groupa = mysql_query("SELECT * FROM product_attribute WHERE prod_id='{$_REQUEST['request_prod_id']}' and attri_group_id!=0 GROUP BY prod_id ");while($select_product_group_row=mysql_fetch_array($select_product_groupa)){$select_attribute = mysql_query("SELECT  * FROM attribute_group WHERE attri_group_id='{$select_product_group_row['attri_group_id']}' ");$row=mysql_fetch_array($select_attribute);$attribute_id = explode(",",$row['attribute_ids']);?><input type="hidden" name="stock_id[]" value="<?=$row['attribute_ids']?>"><?$attributeoptionid = explode("|",$select_product_group_row['attribute_option_id']);for($p=0;$p<sizeof($attributeoptionid);$p++){echo '<div class="select_box"><select name="stock_option_id[]" id="stock_option_id[]" class="small-input">'; echo '<option>'.$get->get_attribute_name($attribute_id[$p]).'</option>';		$select_attribute_option = mysql_query("SELECT * FROM attribute_option WHERE id='{$attributeoptionid[$p]}'");$attribute_row=mysql_fetch_array($select_attribute_option);$select_attribute_option1 = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$attribute_row['attribute_id']}'");while($attribute_row1=mysql_fetch_array($select_attribute_option1)){echo '<option value='.$attribute_row1['id'].'>'.$attribute_row1['attribute_option_name'].'</option>';}echo '</select></div>';}}?><input type="hidden" name="attribute_size" value="<?=$i-1?>"></td><td  width="22%"><input required type="text" name="stock_price[]" id="stock_price" /></td><td align="center" width="22%"><input type="text" name="stock_dis_price[]" id="stock_dis_price" /></td><td width="15%"><input required type="text" name="stock_stock[]" id="stock_stock" /></td><td width="35%"><a href="#" id="remNewstock" class="green_button">Delete Product</a></td></tr></table></p>').appendTo(addDiv);
			}
			else
			{			
				$('<p style="width:100%; margin:0; padding:0;"><table style="width:100%; margin:0;padding:0;"><tr><td align="center" width="25%"><?
				$select_attribute = mysql_query("SELECT * FROM product_attribute WHERE prod_id='{$_REQUEST['request_prod_id']}' ");$row=mysql_fetch_array($select_attribute);$attribute_id = $row['attribute_id'];echo '<div class="select_box"><select name="stock_option_id[]" id="stock_option_id[]" class="small-input">';echo '<option>'.$get->get_attribute_name($attribute_id).'</option>';$select_attribute_option = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$attribute_id}'");while($attribute_row=mysql_fetch_array($select_attribute_option)){if($attribute_row['id'] == $attribute_id){echo '<option value='.$attribute_row['id'].' selected>'.$attribute_row['attribute_option_name'].'</option>';}else{echo '<option value='.$attribute_row['id'].'>'.$attribute_row['attribute_option_name'].'</option>';}}echo '</select></div>';?><input type="hidden" name="stock_id[]" value="<?=$attribute_id?>"><input type="hidden" name="attribute_size" value="<?=$i-1?>"></td><td  width="22%"><input required type="text" name="stock_price[]" id="stock_price" /></td><td align="center" width="22%"><input type="text" name="stock_dis_price[]" id="stock_dis_price" /></td><td width="15%"><input required type="text" name="stock_stock[]" id="stock_stock" /></td><td width="35%"><a href="#" id="remNewstock" class="green_button">Delete Product</a></td></tr></table></p>').appendTo(addDiv);
				
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
<script type="text/javascript">
	function set_attributes(selected){
		
		var cat_id = $("input[name='cat_id[]']:checked").val();
		var subcat_id = $("input[name='subcat_id[]']:checked").val();
		var pid = $("#request_product_id").val();
		//alert("Selected Val===> "+selected +" Cat===> "+cat_id + " Subcat===> "+subcat_id+ "--"+pid);
        var dataString = 'cat_id='+cat_id+'&subcat_id='+subcat_id+'&pid='+pid;
      
        	$.ajax({
        		type: "POST",
				dataType: "text",
        		url: "change_attribute.php",
        		data: dataString,
        		beforeSend: function() {
        			//$('alert, .alert-success, alert-dismissable, #break').remove();
        			
        		},
        		success: function(data){ 
				//alert(data);
				$("#theSelect").html(data);

            }
        	});
}

function set_display_attributes(selected){
		
		var cat_id = $("input[name='cat_id[]']:checked").val();
		var subcat_id = $("input[name='subcat_id[]']:checked").val();
		var pid = $("#request_product_id").val();
		//alert("Selected Val===> "+selected +" Cat===> "+cat_id + " Subcat===> "+subcat_id+ "--"+pid);
        var dataString = 'cat_id='+cat_id+'&subcat_id='+subcat_id+'&pid='+pid;
      
        	$.ajax({
        		type: "POST",
				dataType: "text",
        		url: "display_attribute.php",
        		data: dataString,
        		beforeSend: function() {
        			//$('alert, .alert-success, alert-dismissable, #break').remove();
        			
        		},
        		success: function(data){ 
				//alert(data);
				$("#set_attribute").html(data);

            }
        	});
}
	

function check_selected_forstock(){
	
	
	    var cat_id = $("input[name='cat_id[]']:checked").val();
		var subcat_id = $("input[name='subcat_id[]']:checked").val();
		var pid = $("#request_product_id").val(); 
		
		//alert(" Cat===> "+cat_id + " Subcat===> "+subcat_id+ " Product Id==> "+pid);
			
		if(cat_id=="" && subcat_id==""){
		alert('Please select category and subcategory first');
		$("#stock_manage").css("display", "none");
		}else if(typeof cat_id=="undefined" && typeof subcat_id=="undefined"){
		alert('Please select category and subcategory first');
		$("#display_msg").html('<span style="color:red;font-size:14px" class="col-md-100">Please select any category</span>');
		$("#stock_manage").css("display", "none");
		$("#display_msg").html('<span style="color:red;font-size:14px" class="col-md-100">Please select any category</span>');
		
		}else{
		$("#stock_manage").css("display", "block");		
		$("#display_msg").html('<span style="color:red;font-size:14px" class="col-md-100">&nbsp</span>');	
		}
		//$("#id").css("display", "block");
		}
		
		function check_selected_forattribute(){
	
	
	    var cat_id = $("input[name='cat_id[]']:checked").val();
		var subcat_id = $("input[name='subcat_id[]']:checked").val();
		var pid = $("#request_product_id").val(); 
		
		//alert(" Cat===> "+cat_id + " Subcat===> "+subcat_id+ " Product Id==> "+pid);
			
		if(cat_id=="" && subcat_id==""){
		alert('Please select category and subcategory first');
		$("#manage_attribute").css("display", "none");
		}else if(typeof cat_id=="undefined" && typeof subcat_id=="undefined"){
		alert('Please select category and subcategory first');
		$("#display_msg2").html('<span style="color:red;font-size:14px" class="col-md-100">Please select any category</span>');
		$("#manage_attribute").css("display", "none");
		$("#display_msg2").html('<span style="color:red;font-size:14px" class="col-md-100">Please select any category</span>');
		
		}else{
		$("#manage_attribute").css("display", "block");		
		$("#display_msg2").html('<span style="color:red;font-size:14px" class="col-md-100">&nbsp</span>');	
		}
		//$("#id").css("display", "block");
		}

	
	
	
	
	
	
	</script>
	 
</html>