<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'pincode.php';
$currentpagetitle = 'pincode';
$getdata = $get->get_active_data($_REQUEST['id'],'product_pincode');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['add'])){
$add = $set->add_pincode();
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'product_pincode');
}
$limit = 45;

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

<? if($getrole == 'view'): ?>
<!-- View Content -->
<div  id='content'>
<div class="dashbox-main-div">
<h2>
<span>Manage <?=$currentpagetitle?></span>

	<div class="fright" style="margin-right:80px">
	<form action="" method="post" >
	Pincode <input type="text" name="pincode" class="input">
	<input type="submit" name="add" class="green_button">
	</form>
	</div>
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
$selectcat = mysql_query("SELECT * FROM product_pincode ORDER BY id DESC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
	<td><strong>Pincode</strong></td>
	<td><strong>Status</strong></td>
	<td align="center">#</td>
	<td><strong>Pincode</strong></td>
	<td><strong>Status</strong></td>
	<td align="center">#</td>
	<td><strong>Pincode</strong></td>
	<td><strong>Status</strong></td>	
</tr>
<?
$x=1;
while($row=mysql_fetch_array($selectcat)):
extract($row);
if($x==1) { echo '<tr>'; }
?>

	<td align="center" width="32">
	<label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$id?>" /></label>
	</td>
	<td><?=$pincode?></td>		
    <td>
	<? if($status == 'active') { 
	echo '<font style="color:#9E9E9E;"><img src="images/green-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; } 
	else { 
	echo '<font style="color:#9E9E9E;"><img src="images/red-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; 
	} ?>
	</td>
<? 
if($x==3) { echo '</tr>';  $x=0; }
$x++;  endwhile; 
?>
</table>
	<?=$get->get_pagination('product_pincode',$currentpage,$page,$start,$limit)?>
<div  class="cboth"></div>
</form>
	</div>
	
<?  include ('include/footer.php'); ?>	
</div>
</div>
<!-- View Content -->
<? endif; ?>

</body>

</html>