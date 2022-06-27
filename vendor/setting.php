<?php 
include ('include/functions.php');
$user = new Admin();
if(isset($_POST['editsetting'])){
	$edit = $set->update_setting();
	if($edit){
		$msg = 'Slider Image Uploaded Successfully';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="<?=ADMIN_PATH?>/css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<script type="text/javascript">
//<![CDATA[

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
</head>

<body onload="init()">
<!-- Admin Main Area -->
<div id="adminmain"> 
<?PHP include ('include/header.php'); ?>

<div class="left">
<?PHP include ('include/menu.php'); ?>
</div>

<div  id='content'>
<div class="page-heading">
<h2>
	<span>Manage Setting's</span>
</h2>
<div class="cboth"></div>
</div>
<div class="dashbox-main-div">
	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	
	<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
	<form action="" method="post" enctype="multipart/form-data">
	
	<h2>Edit Setting
		<input type="submit" name="editsetting" class="green_button fright" value="Edit Setting" />
	</h2>
	<br />
	<ul id="tabs">
      <li><a href="#general">General </a></li>
      <li><a href="#option">Option</a></li>
    </ul>
	
	
    <div class="tabContent" id="general">
      <div>
        <?
		$setting = $get->get_setting();
		$settingrow = mysql_fetch_object($setting);
		?>
		<table width="100%" style="margin:0;">
		<tr>
				<td>Store Name</td>
				<td><input type="text" value="<?=$settingrow->website_name?>"  name="website_name" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td width="35%">Email</td>
				<td><input type="text" value="<?=$settingrow->email?>"  name="email" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td>Phone No.</td>
				<td><input type="text" value="<?=$settingrow->phone_no?>"  name="phone_no" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td>Website Logo</td>
				<td>
				<img src="<?=SITE_URL?>/upload/comman/<?=$settingrow->website_logo?>" width="80" class="fleft" style="background:#000;" />
				<input type="file"  name="website_logo" style="width:85%; height:30px; margin-top:20px; margin-left:10px;"  />
				</td>	
			</tr>
			<tr>
			<td>Website Favicon Logo</td>
			<td>
			<img src="<?=SITE_URL?>/upload/comman/<?=$settingrow->website_favicon?>" width="80" class="fleft" style="background:#000" />
			<input type="file"  name="website_favicon" style="width:85%; height:30px; margin-top:20px; margin-left:10px;"  />
			</td>
			</tr>
			<tr>
				<td>Facebook Url</td>
				<td><input type="text"  value="<?=$settingrow->facebook_url?>" name="facebook_url" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td>Twitter Url</td>
				<td><input type="text"  value="<?=$settingrow->twitter_url?>"  name="twitter_url" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td>Google Plus Url</td>
				<td><input type="text"  value="<?=$settingrow->google_plus_url?>" name="google_plus_url" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td>linkedin Url</td>
				<td><input type="text"   value="<?=$settingrow->linkedin_url?>" name="linkedin_url" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td>Youtube Url</td>
				<td><input type="text"  value="<?=$settingrow->youtube_url?>"  name="youtube_url" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td>Google Analytics Code</td>
				<td><textarea style="width:85%; height:50px; margin-left:10px;" name="google_analytics"><?=$settingrow->google_analytics?></textarea></td>
			</tr>
			<tr>
				<td>Google Map Code</td>
				<td><textarea style="width:85%; height:50px; margin-left:10px;" name="google_map"><?=$settingrow->google_map?></textarea></td>
			</tr>
			<tr>
				<td>Copyright</td>
				<td><input type="text"  value="<?=$settingrow->copyright?>" name="copyright" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			
		</table>		
      </div>
    </div>

    <div class="tabContent" id="option">
      <div>
        <table width="100%" style="margin:0;">
		<tr>
				<td>Default Items Per Page (Site)</td>
				<td><input type="text" value="<?=$settingrow->site_per_page?>"  name="site_per_page" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td width="35%">List Description Limit (Site)</td>
				<td><input type="text" value="<?=$settingrow->site_per_page_description?>"  name="site_per_page_description" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td>Default Items Per Page (Admin)</td>
				<td><input type="text" value="<?=$settingrow->admin_per_page?>"  name="admin_per_page" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<!--<tr>
				<td>Review Allow</td>
				<td>
				<? 
				if($settingrow->admin_per_page == 1){
					$selectrayes = "checked";
				} else {
					$selectrano = "checked";
				} 
				?>
				<label><input type="radio" name="review_allow" value="1" <?=$selectrayes?> /> Yes </label>
				<label><input type="radio" name="review_allow" value="0" <?=$selectrano?> /> No </label>
				</td>	
			</tr>
			<tr>
			<td>Guest Review Allow</td>
			<td>
			<? 
				if($settingrow->guest_review_allow == 1){
					$selectgrayes = "checked";
				} else {
					$selectgrano = "checked";
				} 
				?>
			<label><input type="radio" name="guest_review_allow" value="1" <?=$selectgrayes?> /> Yes </label>
			<label><input type="radio" name="guest_review_allow" value="0" <?=$selectgrano?> /> No </label>
			</td>
			</tr>
			<tr>
			<? 
				if($settingrow->coupan_allow == 1){
					$selectcayes = "checked";
				} else {
					$selectcano = "checked";
				} 
				?>
				<td>Coupan Code</td>
				<td><label><input type="radio" name="coupan_allow" value="1" <?=$selectcayes?> /> Yes </label>
			<label><input type="radio" name="coupan_allow" value="0"  <?=$selectcano?>/> No </label></td>
			</tr>-->
			<tr>
			<? 
				if($settingrow->guest_checkout == 1){
					$selectgcayes = "checked";
				} else {
					$selectgcano = "checked";
				} 
				?>
				<td>Guest Checkout</td>
				<td><label><input type="radio" name="guest_checkout" value="1" <?=$selectgcayes?> /> Yes </label>
			<label><input type="radio" name="guest_checkout" value="0" <?=$selectgcano?> /> No </label></td>
			</tr>
			<tr>
			<? 
				if($settingrow->display_stock == 1){
					$selectdsayes = "checked";
				} else {
					$selectdsano = "checked";
				} 
				?>
				<td>Display Stock</td>
				<td><label><input type="radio" name="display_stock" value="1" <?=$selectdsayes?> /> Yes </label>
			<label><input type="radio" name="display_stock" value="0" <?=$selectdsano?> /> No </label></td>
			</tr>
			
			<tr>
			<? 
				if($settingrow->cashondelivery == 1){
					$selectdsyes = "checked";
				} else {
					$selectdano = "checked";
				} 
				?>
				<td>Cash on Delivery</td>
				<td><label><input type="radio" name="cashondelivery" value="1" <?=$selectdsyes?> /> Yes </label>
			<label><input type="radio" name="cashondelivery" value="0" <?=$selectdano?> /> No </label></td>
			</tr>
			
			<tr>
				<td>Minimum Shopping Amount</td>
				<td><input type="text"   value="<?=$settingrow->minimum_cart_value?>" name="minimum_cart_value" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
			<tr>
				<td>Delivery Charges</td>
				<td><input type="text"  value="<?=$settingrow->delivery_charges?>"  name="delivery_charges" style="width:85%; height:30px; margin-left:10px;"  /></td>
			</tr>
		</table>
      </div>
    </div>
	</form>
	</div>

</div>
<?  include ('include/footer.php'); ?>	
</div>
</body>
</html>