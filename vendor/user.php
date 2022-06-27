<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'user.php';
$currentpagetitle = 'user';
$getdata = $get->get_active_data($_REQUEST['id'],'user');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];

if(isset($_POST['edit'])){
$edit = $set->update_user($_REQUEST['id']);
}

if(isset($_POST['doaction'])){
	extract($_POST);
$add = $set->do_action($action,$ids,'user');
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
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="red_button fright">Back</a>
	</p>
</h2>
<div class="cboth"></div>
</div>
<div class="dashbox-main-div">
	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add user-->
		<form action="" method="post" enctype="multipart/form-data">
		<h2><?=$getrole?> user
		<input type="submit" name="<?=$getrole?>" class="green_button fright" value="<?=$getrole?> user" />
		</h2>

		<table style="width:100%; margin:0;">
		<tr>
		<td width="50%">User Name <span class="color_red">*</span></td><td><input type="text" name="user_name" value="<?=$fetchrow->user_name?>" required /></td>
		</tr>
		<tr>
		<td>User Email</td><td><input type="text" name="user_email" value="<?=$fetchrow->user_email?>" /></td>
		</tr>
		<tr>
		<td>user Msg</td><td><textarea name="user_msg"><?=$fetchrow->user_msg?></textarea></td>
		</tr>
		<tr>
		<td>user Star</td>
		<td>
		<?
		if($fetchrow->user_star == '1' ){
		$selecta = 'checked';
		} else if($fetchrow->user_star == '2' ){
		$selectb = 'checked';
		} else if($fetchrow->user_star == '3' ){
		$selectc = 'checked';
		} else if($fetchrow->user_star == '4' ){
		$selectd = 'checked';
		} else if($fetchrow->user_star == '5' ){
		$selecte = 'checked';
		}	
		?>
		<label><input type="radio" name="user_star" <?=$selecta?> value="1"> 1 STAR</label>
		<label><input type="radio" name="user_star" <?=$selectb?> value="2"> 2 STAR</label>
		<label><input type="radio" name="user_star" <?=$selectc?> value="3"> 3 STAR</label>
		<label><input type="radio" name="user_star" <?=$selectd?> value="4"> 4 STAR</label>
		<label><input type="radio" name="user_star" <?=$selecte?> value="5"> 5 STAR</label>
		</td>
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
$selectcat = mysql_query("SELECT * FROM user ORDER BY id DESC LIMIT $start, $limit");
?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
	<td><strong>Name</strong></td>
	<td><strong>Email</strong></td>	
	<td><strong>Last Login</strong></td>
	<td><strong>Total Order</strong></td>
	<td><strong>Status</strong></td>	
</tr>
<?
$x=1;
if(mysql_num_rows($selectcat) > 0){
while($row=mysql_fetch_array($selectcat)):
extract($row);
?>
<tr>
	<td align="center" width="32"><label><input type="checkbox" class="checkbox1" name="ids[]" value="<?=$id?>" /></label></td>
	<td><?=$first_name?> <?=$last_name?></td>	
	<td><?=$email?></td>	
	<td><?=$get->timeAgo($lastlogin)?></td>	
	<td><a href="orders.php?role=view&user=<?=$user_id?>"><?=$get->get_user_total_order($user_id)?> Order</a></td>
    <td><? if($status == 'active') { 
	echo '<font style="color:#9E9E9E;"><img src="images/green-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; } 
	else { 
	echo '<font style="color:#9E9E9E;"><img src="images/red-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; 
	} ?></td>	
</tr>
<? 
endwhile;
} else { 
?>
<tr>
	<td align="center" colspan="5">No result found.</td>

</tr>
<? } ?>
</table>
	<?=$get->get_pagination('user',$currentpage,$page,$start,$limit)?>
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