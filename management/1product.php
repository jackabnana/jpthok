<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'product.php';
$currentpagetitle = 'product';
$getdata = mysql_query("SELECT * FROM product WHERE id='{$_REQUEST['id']}' and prod_id='{$_REQUEST['request_prod_id']}'");
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_product();
}

if(isset($_POST['edit'])){
$edit = $set->update_product($_POST,$_REQUEST['request_prod_id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'product');
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="<?=ADMIN_PATH?>/css/select2.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<script  src="<?=ADMIN_PATH?>/js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<style>
.highlight {background-color: #f2f2f2;}

.hidden {display: none;}

.select-your-stock {display: block;}
.select-your-stock li{display: inline; float: left; list-style-type: none; width: 22%; padding: 0px 10px;}
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
        var i = $('#addinput p').size() + 1;
        $('#addNew').live('click', function() {
                $('<p style="width:100%; margin:0; padding:0;">
                	<table style="width:100%; margin:0; padding:0;">
                	<tr>
                		<td align="center"  width="427px"><input type="file" name="prodcut_img[]" /></td>
                		<td width="321px"><input type="text" name="imgpostion[]" /></td>
                		<td align="center" width="100px"><input type="radio" name="default[]" /></td>
                		<td><a href="#" id="remNew" class="green_button">Remove</a></td></tr></table></p>').appendTo(addDiv);
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
        var addDiv = $('#addinputstock');
        var i = $('#addinputstock p').size() + 1;
        $('#addNewstock').live('click', function() {
                $('<p style="width:100%; margin:0; padding:0;"><table class="select-your-stock" style="width:100%;"><tr><td width="20%;"><span style="padding-bottom:5px; float:left;">Weight</span><select style="width:100%;"><option>1 kg</option><option>2 kg</option><option>3 kg</option></select></td><td width="20%;"><span style="padding-bottom:5px; float:left;">Weight</span><select style="width:100%;"><option>1 kg</option><option>2 kg</option><option>3 kg</option></select></td><td width="20%;"><span style="padding-bottom:5px; float:left;">Weight</span><input type="text" style="width:100%;"></td><td width="20%;"> <span style="padding-bottom:5px; float:left;">Weight</span><input type="text" style="width:100%;"></td></tr></table><a href="#" id="remNewstock" class="green_button">Remove</a></p>').appendTo(addDiv);
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
		<li><a href="#stock">Stock</a></li>
		<li><a href="#attribute">Attribute</a></li>
		<li><a href="#images">Images</a></li>
		<li><a href="#related">Related</a></li>		
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
		<td colspan="2">Product Info</td>
		</tr>
		<tr>
		<td colspan="2">
		<textarea name="details" id="editor1"><?=$fetchrow->details?></textarea>
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
		<td colspan="2">Product Details</td>
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
		<td colspan="2">Product User Guide</td>
		</tr>
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
		</tr>
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
		<td>
		<?
		if($fetchrow->instock == '1' ){
		$selectinstock = 'checked';
		} if($fetchrow->feature == '1' ){
		$selectfeature = 'checked';
		} if($fetchrow->bestdeal == '1' ){
		$selectbestdeal = 'checked';
		} if($fetchrow->newly == '1' ){
		$selectnewly = 'checked';
		} if($fetchrow->today == '1' ){
		$selecttoday = 'checked';
		}
		?>
		<input type="checkbox" name="instock" value="1" <?=$selectinstock?> /> In Stock 
		<input type="checkbox" name="feature" value="1" <?=$selectfeature?> /> Feature Product
		<input type="checkbox" name="bestdeal" value="1" <?=$selectbestdeal?> /> Best Deal
		<input type="checkbox" name="newly" value="1" <?=$selectnewly?> /> Newly Launched
		<input type="checkbox" name="today" value="1" <?=$selecttoday?> /> Today Sale
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
		<?php if(in_array($catrow->category_id,$cateselect)) { echo "checked"; } ?> /> <?=$catrow->category_name?>
		</label>
		<ul>
		<?
		// Fetch Sub Category 
		$getsubcatmenu = $get->get_subcategory_menu($catrow->category_id); 
		while($subcat=mysql_fetch_object($getsubcatmenu)):
		?>
		<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<label>
		<input type="checkbox" value="<?=$subcat->category_id?>" name="subcat_id[]" 
		<?php if(in_array($subcat->category_id,$subcat1select)) { echo "checked"; } ?> /> <?=$subcat->category_name?></label>
			
			<ul>
			<?
			// Fetch Sub 2 Category 
			$getsub2catmenu = $get->get_subcategory_menu($subcat->category_id); 
			while($sub2cat=mysql_fetch_object($getsub2catmenu)):
			?>
			<li>
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
		<td>Product Rate <span class="color_red">*</span></td>
		<td><input type="text" name="product_rate" value="<?=$fetchrow->product_rate?>"  required/></td>
		</tr>
		<tr>
		<td>Product Discount Rate </td><td><input type="text"  value="<?=$fetchrow->prodcut_discount_rate?>" name="prodcut_discount_rate" /></td>
		</tr>
		<tr>
		<td>Product Delivery Rate </td><td><input type="text"  value="<?=$fetchrow->product_delivery?>" name="product_delivery" /></td>
		</tr>
		</table>
		</div>
		</div>

		<!-- stock start her-->
		<div style="width:12%; float:left; margin-top:20px;">
			
		    <div class="selectContainer">
		        <select id="theSelect">
		            <option value="">- Select -</option>
		            <option value="wf">w/f</option>
		            <option value="caps">Caps</option>
		            <option value="cs">C/s</option>
		        </select>
		    </div>
		</div>

		<div class="tabContent" id="stock" style="width:85%; float:right;">
			    <div class="hidden iswf" >
			    	<ul class="select-your-stock">
			    		<li>
			    			<div style="width:40%; float:left; padding:0px 10px;">
			    				<span style="padding-bottom:5px; float:left;">Weight</span>
			    				<select style="width:100%;">
				    				<option>1 kg</option>
				    				<option>2 kg</option>
				    				<option>3 kg</option>
			    				</select>
			    			</div>
			    			<div style="width:40%; float:left; padding:0px 10px;">
			    				<span style="padding-bottom:5px; float:left;">Flavour</span>
			    				<select style="width:100%;">
				    				<option>1 kg</option>
				    				<option>2 kg</option>
				    				<option>3 kg</option>
			    				</select>
			    			</div>
			    		</li>
			    		<li>
			    			<span>Price</span>
			    			<input type="text" style="width:100%;">
			    		</li>
			    		<li>
			    			<span>Discount</span>
			    			<input type="text" style="width:100%;">
			    		</li>
			    		<li>
			    			<span>QTY</span>
			    			<input type="text" style="width:100%;">
			    		</li>
			    	</ul>


			    	<a href="#" id="addNewstock" class="green_button">Add Rows</a>

			    	<div id="addinputstock"></div>
    			</div>
			   

			   <div class="hidden iscaps" >
			    	<ul class="select-your-stock">
			    		<li>
			    			<div style="width:40%; float:left; padding:0px 10px;">
			    				<span style="padding-bottom:5px; float:left;">Weight</span>
			    				<select style="width:100%;">
				    				<option>1 kg</option>
				    				<option>2 kg</option>
				    				<option>3 kg</option>
			    				</select>
			    			</div>
			    			<div style="width:40%; float:left; padding:0px 10px;">
			    				<span style="padding-bottom:5px; float:left;">Flavour</span>
			    				<select style="width:100%;">
				    				<option>1 kg</option>
				    				<option>2 kg</option>
				    				<option>3 kg</option>
			    				</select>
			    			</div>
			    		</li>
			    		<li>
			    			<span>Price</span>
			    			<input type="text" style="width:100%;">
			    		</li>
			    		<li>
			    			<span>Discount</span>
			    			<input type="text" style="width:100%;">
			    		</li>
			    		<li>
			    			<span>QTY</span>
			    			<input type="text" style="width:100%;">
			    		</li>
			    	</ul>


			    	<a href="#" id="addNewstock" class="green_button">Add Rows</a>

			    	<div id="addinputstock"></div>
    			</div>


			    <div class="hidden iscs" >
			    	<ul class="select-your-stock">
			    		<li>
			    			<div style="width:40%; float:left; padding:0px 10px;">
			    				<span style="padding-bottom:5px; float:left;">Weight</span>
			    				<select style="width:100%;">
				    				<option>1 kg</option>
				    				<option>2 kg</option>
				    				<option>3 kg</option>
			    				</select>
			    			</div>
			    			<div style="width:40%; float:left; padding:0px 10px;">
			    				<span style="padding-bottom:5px; float:left;">Flavour</span>
			    				<select style="width:100%;">
				    				<option>1 kg</option>
				    				<option>2 kg</option>
				    				<option>3 kg</option>
			    				</select>
			    			</div>
			    		</li>
			    		<li>
			    			<span>Price</span>
			    			<input type="text" style="width:100%;">
			    		</li>
			    		<li>
			    			<span>Discount</span>
			    			<input type="text" style="width:100%;">
			    		</li>
			    		<li>
			    			<span>QTY</span>
			    			<input type="text" style="width:100%;">
			    		</li>
			    	</ul>


			    	<a href="#" id="addNewstock" class="green_button">Add Rows</a>

			    	<div id="addinputstock"></div>
    			</div>



		</div>
		<!-- stock end her-->

		<div class="tabContent" id="attribute">
		<div>
		<table style="width:100%; margin:0;">
			<? 
			$select_attribute = mysql_query("SELECT * FROM attribute WHERE attribute_required=0");
			while($select_attri=mysql_fetch_array($select_attribute)){
			?>		
				<tr>
				<td align="center">
				<?=$select_attri['attribute_name']?>
				</td>
				
				<td align="center">
					<select>
					<option value="">Select <?=$select_attri['attribute_name']?></option>
					<? 
					$select_sub_attribute = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$select_attri['attribute_id']}' ");
					while($row=mysql_fetch_array($select_sub_attribute)):
					?>
					<option value="<?=$row['id']?>"><?=$row['attribute_option_name']?></option>
					<? endwhile; ?>
					</select>
				</td>
				</tr>
			<? } ?>		
		
		</table>
		</div>
		</div>
		
		<div class="tabContent" id="images">
		<table style="width:100%; margin:0;">		
		<tr>
		<td align="center">
		Images
		</td>
		<td>
		Position
		</td>
		<td>
		Default
		</td>
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
		<td align="center">
		<? if($defaultimg == 1) { echo 'Default'; } else { echo '-'; } ?>
		</td>
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
		<td align="center" width="100px">
		<input type="radio" name="default[]" value="1"  checked/>
		</td>
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
		<td width="100%" align="center">
		<? 
	$getrelated = $get->get_product_menu();
	while($relatedrow=mysql_fetch_object($getrelated)):
	?>
	<? endwhile; ?>	
		<select name="related_prod_id[]" id="responseForm" multiple onChange="product1select(this.value)" style="width:100%;">
		<option value="">Select Prodcut</option>
	<? 
	$getrelated = $get->get_product_menu();
	while($relatedrow=mysql_fetch_object($getrelated)):
	?>
	<option value="<?=$relatedrow->prod_id?>" <?=$get->get_related($relatedrow->prod_id,$_REQUEST['request_prod_id'])?> >
	<?=$relatedrow->product_name?>
	</option>
	<? endwhile; ?>	
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
	category as C WHERE P.cat_id = C.category_id ";
	
if($_POST['q'] !=''){
	$q = $_POST['q'];
	$sql .= " AND P.product_name like '%$q%'";
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
    <td><strong>Category Name</strong></td>
	<td><strong>product Name</strong></td>	
	<td><strong>Stock Status</strong></td>	
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
	<td><?=$category_name?></td>
	<td>
	<?
	if (strlen($product_name) >= 25){ 
	echo $get->get_match_text(substr($product_name, 0, 35),$_POST['q']).' ...';
	} else {
	echo $get->get_match_text($product_name,$_POST['q']);
	}
	?>
	</td>	
    <td><? if($instock) { echo 'In Stock'; } else { echo 'Out of Stock'; } ?></td>
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
</script>
<script src="<?=ADMIN_PATH?>/js/jquery-1.8.0.min.js"></script>
<script src="<?=ADMIN_PATH?>/js/select2.js"></script>
<script>
$(document).ready(function() {
$("#responseForm").select2();   
});



$("#theSelect").change(function(){          
    var value = $("#theSelect option:selected").val();
    var theDiv = $(".is" + value);
    
    theDiv.slideDown().removeClass("hidden");
    theDiv.siblings('[class*=is]').slideUp(function() { $(this).addClass("hidden"); });
});
</script> 

</html>