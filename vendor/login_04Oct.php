<?php 
include ('include/functions.php');
$user = new Admin();
if ($user->get_session())
{
	header("location:index.php");
}
session_destroy();
/*	
if(isset($_POST['login']))
{
	
	$login = $user->check_login($_POST['user'], md5($_POST['password']));
	if ($login) 
	{
	// Login Success
		if($_REQUEST['red']){
			$red = $_REQUEST['red'];
			header("location: $red");
		} else {
			header("location:index.php");
		}
	} 
	else 
	{
	// Login Failed
	$login_errs = 'ERROR: Invalid details. Lost your password?';
	}
}
*/
if(isset($_POST['forgethelp']))
{
$forget = $user->check_forget($_POST['user']);
if ($forget) 
{
// Login Success
$success = 'Password Send on Email';
}  
else 
{
// Login Failed
$errs = 'ERROR: Email not Found!';
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Admin Area</title>

<link rel="stylesheet" type="text/css" href="css/custom.css" />
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<!--<script type="text/javascript" src="js/jquery.min.js"></script>-->


<script type="text/javascript" src="<?=$site_url?>/js/min.js"></script>

<script type="text/javascript" src="js/jquery.ui.shake.js"></script>
<?  if(isset($login_errs) or isset($errs)): ?>
<script type="text/javascript">
	$(document).ready(function() {
	 $('#box form').shake();
	});
</script>
<?  endif; ?>
</head>

<body>
<!-- popup start here -->
<div class="main-container">
	<div class="login-popup">
		<div class="tab bg-white">
			<div class="container">
				<ul class="tabs">
				    <li onclick="get_active('1')" id="login" class="list active">Login</li>
					<li onclick="get_active('2')" id="account" class="list ">Create Account</li>
					
				</ul>
			</div>
		</div>

		<div class="container">
			<div class="pop-up-details">
				<div class="row margin-top-bottom-30px overflow-hide">

				   <!-- step 2 start here -->
					<div class="login">
					<form action="" method="post" id="login_form">
						
						<div class="step-1 row ">
							<h2 class="main-heading">Login</h2>
							<div id="login_response"></div>
							
							<div class="row">
								<div class="col-md-100 left padding-right-10px">
								<span class="label">Username</span>
								<input type="text" id="username" name="user" class="input-box" placeholder="Enter username" />
								</div>
						

							</div>

							<div class="row margin-top-10px">
								<span class="label">Password</span>
								<input type="password" value="" name="user_password" id="user_password" placeholder="Choose your Password" class="input-box">
							</div>


							<div class="buttons">
								<a href="#0" class="save-next" id="step_two">Login</a>
							</div>
						</div>
					</form>
					</div>
					<!-- step 2 end here -->
				
				
					<!-- step 1 start here -->
					<div class="account" style="display:none;">
					<form action="" method="post" id="form_first">
					<input type="hidden" id="available_pin"  name="available_pin">  
					<input type="hidden"  name="vendor_signup">  
					<div class="step-1 row ">
						<h2 class="main-heading">Create Your Account</h2>
						<div id="login-response"></div>
						
						<div class="row">
							<div class="col-md-50 left padding-right-10px">
							<span class="label">Name</span>
							<input type="text" name="full_name" id="full_name" placeholder="Enter Full Name" class="input-box">
							</div>
					

							<div class="col-md-50 left padding-left-10px">
								<span class="label">Email Id</span>
								<input type="text" name="email" id="email" placeholder="Enter Email" class="input-box">
							</div>
						</div>

						<div class="row margin-top-10px">
							<span class="label">Password</span>
							<input type="password" value="" name="password" id="password" placeholder="Choose your Password" class="input-box">
						</div>

						<div class="row margin-top-10px">
							<span class="label">Mobile Number</span>
							<input type="text" name="mobile" id="mobile" placeholder="Your Mobile Number" class="input-box">
						</div>

						<div class="row margin-top-20px">
							<h2 class="main-heading">Please Set Your Pickup Location
								<span class="heading-lable">Our Logistics Partner will pick your packages from this location</span>
							</h2>
						<div class="row margin-top-10px">
							<span class="label">First, Let's Checks if our services is available at your pincode</span>
							<input type="text" name="pincode" onkeyup="availablePincode(this.value);" id="pincode" placeholder="Pincode" class="input-box">
						</div>
						
						<div class="row margin-top-10px">
							<label class="remember-me left"><input type="checkbox" name="check_reg_terms" <?php if($remember){echo 'checked';}?>><a href="vendor_terms.php">Accept our terms</a></label>
						</div>

						

						</div>
						<div class="buttons">
							<a href="#0" class="save-next" id="step_one">Save & Proceed</a>
						</div>
					</div>
					</form>
					</div>
					<!-- step 1 end here -->


				</div>
			</div>
		</div>
	</div>
</div>

<!-- popup end here -->
<script src="js/global_vendor.js"></script>
<script>
function get_active(str)
{
	
	if(str=='1')
	{
		$("#login").addClass('active');
		$("#account").removeClass('active');
		$(".login").css("display","block");
		$(".account").css("display","none");
	}
	else
	{
		$("#login").removeClass('active');
		$("#account").addClass('active');
		$(".login").css("display","none");
		$(".account").css("display","block");
	}
	
	
}
</script>
</body>
</html>