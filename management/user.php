<?php 
include ('include/functions.php');
$user = new Admin();
$currentpage = 'user.php';
$currentpagetitle = 'user';
$getdata = $get->get_active_data($_REQUEST['id'],'user');
$fetchrow = mysql_fetch_object($getdata);
$getrole = $get->get_page_role($_REQUEST['role']);
$page = $_REQUEST['page'];


if(isset($_POST['add']))
{
	$add = $set->add_user();
}

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
		<td width="50%">User First Name <span class="color_red">*</span></td>
		<td><input type="text" name="fname" id="fname" value="<?=$fetchrow->first_name?>" required /></td>
		</tr>
		
		<tr>
		<td width="50%">User Last Name <span class="color_red">*</span></td>
		<td><input type="text" name="lname" id="lname" value="<?=$fetchrow->last_name?>" required /></td>
		</tr>
		
		<tr>
		<td width="50%">User Email <span class="color_red">*</span></td>
		<td><input type="text" name="email" id="email" value="<?=$fetchrow->email?>"  /></td>
		</tr>
		
		<tr>
		<td width="50%">User Phone <span class="color_red">*</span></td>
		<td><input type="text" name="phoneno" id="phoneno" value="<?=$fetchrow->phone?>" required /></td>
		</tr>
		
		<tr>
		<td>Gender <span class="color_red">*</span></td>
		<td>	
			<select name="gender" required>
			<option value="">Select</option>
			<option value="Male" <?php if($fetchrow->gender == "Male"){echo 'selected';}?>>Male</option>
			<option value="Female" <?php if($fetchrow->gender == "Female"){echo 'selected';}?>>Female</option>
			</select>
		</td>
		</tr>
		
		
		
		<!--<tr>
		<td width="50%">Company Name <span class="color_red">*</span></td>
		<td><input type="text" name="company_name" id="company_name" value="<?=$fetchrow->company_name?>" required /></td>
		</tr>
		
		<tr>
		<td width="50%">Website <span class="color_red">*</span></td>
		<td><input type="text" name="website" id="website" value="<?=$fetchrow->website?>" required /></td>
		</tr>
		
		<?php 
		$dob= $fetchrow->date_of_birth;
		$ex_dob = explode("-",$dob);

		$uyear = $ex_dob [0];
		$umonth= $ex_dob [1];
		$udate = $ex_dob [2];
		
		?>
		<tr>
		<td width="50%">Date Of Birth <span class="color_red">*</span></td>
		<td width="100%">
		<table>
		<tr>
		<td><select name="date" id="date" class="col-md-50 padding-8px">
						<option value="">:Date:</option>
						<?php $day = range(1,31);
						foreach($day as $d){ ?>
						<option value="<?php echo $d;?>" <?php if($udate==$d){echo "selected";}?>><?php echo $d;?></option>
						<?php }?>
				</select></td>
		<td><select name="month" id="month" class="col-md-50 padding-8px">
						<option value="">:Month:</option>
						<?php $mm=array('01','02','03','04','05','06','07','08','09','10','11','12');
						foreach($mm as $m){ ?>
						<option value="<?php echo $m;?>" <?php if($umonth==$m){echo "selected";}?>><?php echo $m;?></option>
						<?php }?>
				</select></td>
		<td><select name="year" id="year" class="col-md-50 padding-8px">
						<option value="">:Year:</option>
						<?php $yy=range(1947,2011);
						foreach($yy as $y){?>
						<option value="<?php echo $y;?>" <?php if($uyear==$y){echo "selected";}?>><?php echo $y;?></option>
						<?php } ?>
				</select></td>
		</tr>
		</table>
				
						
						
				
				
				
				
		 </td>
		</tr>-->
		
		<tr>
		<td width="50%">Address <span class="color_red">*</span></td>
		<td><input type="text" name="address" id="address" value="<?=$fetchrow->address?>" required /></td>
		</tr>
		
		<tr>
		<td>User Password</td><td><input type="text" name="password" id="password" value="<?=$fetchrow->password?>" /></td>
		</tr>
		<tr>
		<td>Is Active <span class="color_red">*</span></td>
		<td>		
			<select name="user_type" required>
			<option value="">Select</option>
			<option value="user" <?php if($fetchrow->user_type == "user"){echo 'selected';}?>>User</option>
			<option value="agent" <?php if($fetchrow->user_type == "agent"){echo 'selected';}?>>Agent</option>
			</select>
		</td>
		</tr>
		
		<tr>
		<td>Is Active <span class="color_red">*</span></td>
		<td>		
			<select name="status" required>
			<option value="">Select</option>
			<option value="active" <?php if($fetchrow->status == "active"){echo 'selected';}?>>Active</option>
			<option value="deactive" <?php if($fetchrow->status == "deactive"){echo 'selected';}?>>Deactive</option>
			</select>
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
<h2><span>Manage <?=$currentpagetitle?></span><!--|
<span><a href="export_user.php">Download CSV</a></span>-->
<p> 
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=add" class="green_button fright">Add <?=$currentpagetitle?></a>
	</p>
    <div class="cboth"></div>
</h2>
 <div class="cboth"></div>
</div>
<div class="dashbox-main-div">
	<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	
	<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
	
	<h2><span><?=$currentpagetitle?></span>
	
	<div class="fleft search">
	<form action="" method="post">
	<input type="text" name="q" value="<?=$_REQUEST['q']?>" placeholder="Search by user first name Or Phone">
	<input type="submit" class="green_button" name="search">
	</form>
	</div>
	
	<form action="" method="post">
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
$sql_user = "SELECT * FROM user";

if($_POST['q'] !=''){
	$q = $_POST['q'];
	$sql_user .= " WHERE first_name like '%$q%' OR phone like '%$q%' OR email like '%$q%'";
	}

$sql_user .= " ORDER BY id DESC ";

if($_POST['q'] == '' ){
	$sql_user .= "LIMIT $start, $limit ";	
}

$selectcat = mysql_query($sql_user);
$select_num = mysql_num_rows($selectcat);

?>

<table width="100%" style="padding:0; margin:0">
<tr>
	<td align="center"><input type="checkbox"   id="selecctall"  /></td>
	<td><strong>Name</strong></td>
	<td><strong>Email</strong></td>
	<td><strong>Contact</strong></td>
	<td><strong>Type</strong></td>
	<td><strong>Address</strong></td>
	<td><strong>Last Login</strong></td>
	<td><strong>Total Order</strong></td>
	<td><strong>Status</strong></td>
    <td><strong>Action</strong></td>	
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
	<td><?=$phone?></td>
	<td><?=$user_type?></td>
	<td><?=$address?></td>	
	<td><?=$get->timeAgo($lastlogin)?></td>	
	<td><a href="orders.php?role=view&user=<?=$user_id?>"><?=$get->get_user_total_order($user_id)?> Order</a></td>
    <td><? if($status == 'active') { 
	echo '<font style="color:#9E9E9E;"><img src="images/green-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; } 
	else { 
	echo '<font style="color:#9E9E9E;"><img src="images/red-dot.png" width="9px" /> &nbsp;'.$status.'</font>'; 
	} ?></td>
<td width="50" align="center">
	<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=edit&page=<?=$page?>&id=<?=$id?>&user_id=<?=$user_id?>" class="edit">
	<img src="images/edit.png" width="35" /> 
	</a>
	</td>	
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