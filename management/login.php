<?php 
include ('include/functions.php');
$user = new Admin();
if ($user->get_session())
{
header("location:index.php");
}


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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Area</title>
<link rel="stylesheet" type="text/css" href="css/login.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
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
<div class="login" id="box" >
		
		<div class="logo"><img src="images/logo.png" width="80%" /></div>
		<br>	

		<? if(!isset($_REQUEST['need'])): ?>
		<form method="post" action="">
		<div class="message">
			<?php if($login_errs != "") { echo '<p class="error">'.$login_errs.'</p>'; } ?>
			<?php if(isset($_GET['log']) != "") { echo '<p class="success">You are now logged out.</p>'; } ?>
		</div>

			<p>
				<label for="username">Username<br />
				<input type="text" id="username" name="user" class="input" value="<?php echo (isset($_POST['user']) ? $_POST['user'] : '') ?>" size="20" tabindex="10" /></label>
			</p>
			<p>
				<label for="password">Password<br />
				<input type="password" id="password" name="password" class="input" value="<?php echo (isset($_POST['password']) ? $_POST['password'] : '') ?>" size="20" tabindex="20" /></label>
			</p>
			<p class="submit" style="width:20%; float:left;">
				<input type="submit" name="login" id="submit" class="submit-button" value="Log In" tabindex="100" />
				
			</p>
			<div class="helplink"><a href="login.php?need=help" >Lost your password?</a></div>
			<div style="clear:both"></div>
		</form>
		<? else: ?>
		<form method="post" action="">
		<div class="message">
			<?php if($errs != "") { echo '<p class="error">'.$errs.'</p>'; } ?>
			<?php if($success != "") { echo '<p class="success">'.$success.'</p>'; } ?>
			<?php if(isset($_GET['log']) != "") { echo '<p class="success">You are now logged out.</p>'; } ?>
		</div>

			<p>
				<label for="username">Email<br />
				<input type="text" id="username" name="user" class="input" value="<?php echo (isset($_POST['user']) ? $_POST['user'] : '') ?>" size="20" tabindex="10" /></label>
			</p>
			
			<p class="submit" style="width:20%; float:left;"> 
				<input type="submit" name="forgethelp" id="submit" class="submit-button" value="Need Help!" tabindex="100" />
				
			</p>
			<div class="helplink"><a href="login.php" > < Back to Login</a></div>
			<div style="clear:both"></div>
		</form>
		<? endif; ?>
</div>
</body>
</html>