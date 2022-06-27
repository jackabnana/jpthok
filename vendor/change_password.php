<?php 
include ('../management/include/functions.php');
$user = new Admin();

$username = $user->get_session();

if(isset($_POST['change_password']))
{
$oldp = $_POST['old_pass'];
$newp = $_POST['new_pass'];
$repp = $_POST['re_pass'];

if($newp==$repp){

$result = mysql_query("SELECT * from admin_login WHERE username = '$username' and password = '$oldp'");	
$no_rows = mysql_num_rows($result);

		if($no_rows > 0){
			
		mysql_query("UPDATE admin_login SET password='$newp' WHERE username='$username' ");		
		$resmsg = "Password Change Successfully.";
		$class = "success";	        
		
		}else{
			
		$resmsg = "Password not match please try with correct password.";
		$class = "error";	
			
		}		
		
	}else{
		$resmsg = "Password and repeat password not matched";
		$class = "error";
	}
//$edit = $set->update_setting();	
}





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Vendor</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<script type="text/javascript">
	function showhide(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
       e.style.display = 'none';
       else
       e.style.display = 'block';
    }
</script>

<script type="text/javascript" src="<?=$site_url?>/js/min.js"></script>
<script type="text/javascript" src="js/jquery.hoveraccordion.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#accordion').hoverAccordion({
		activateitem: '0',
		speed: 'fast'
	});
	$('#accordion').children('li:first').addClass('firstitem');
	$('#accordion').children('li:last').addClass('lastitem');
});

</script>
<script type="text/javascript">
    setInterval("my_function();",3000); 
    function my_function(){
    $('#refresh').load(location.href + ' #time');
    }
	</script>

<body>
<!-- Admin Main Area -->
<div id="adminmain">
<? include ('include/header.php'); ?>

<div class="left">
<?  include ('include/menu.php');  ?>
</div>



<div  id='content'>
<div class="page-heading">
<h2><span>Change Password</span>
<p><a href="index.php">Home</a></p>
</h2>
</div>
<div class="dashbox-main-div">


<?php if($msg != "") { echo '<p class="success">'.$msg.'</p>'; } ?>
	<?php if($resmsg != "") { echo '<p class="'.$class.'">'.$resmsg.'</p>'; } ?>

<?php 
if($class == 'success'){	
	unset($_SESSION['checkadmin']);	
	echo "<script>setTimeout(function(){location.href='login.php'} , 2000); </script>";	
}
?>	



    <div class="col-100 bg_color_white border_top_gray border_radius_5" > 
	
	<form action="" method="post" enctype="multipart/form-data">
	
	<h2>Change Password
		<input type="submit" name="change_password" class="green_button fright" value="Edit Setting" />
	</h2>
	<br />
	<ul id="tabs">
      <li><a href="#general">Change Password </a></li>     
    </ul>
	
	
    <div class="tabContent" id="general">
      <div>
        
		<table width="100%" style="margin:0;">
		    <tr>
				<td>Old Password</td>
				<td><input type="password" value=""  name="old_pass" style="width:85%; height:30px; margin-left:10px;" placeholder="Old Password" required /></td>
			</tr>
            <tr>
				<td>New Password</td>
				<td><input type="password" value=""  name="new_pass" style="width:85%; height:30px; margin-left:10px;"  placeholder="New Password" required /></td>
			</tr>

			<tr>
				<td width="35%">Repeat Password</td>
				<td><input type="password" value=""  name="re_pass" style="width:85%; height:30px; margin-left:10px;" placeholder="Repeat Password" required /></td>
			</tr>
				
		</table>		
      </div>
    </div>

    
	
	
	
	
	
	</form>
		<div>	
</div>
<?  include ('include/footer.php');  ?>

</div>
<script src="js/global_vendor.js"></script>



</body>
</html>