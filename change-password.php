<?
include 'management/include/functions.php';
$user_id = $get->get_website_session();
if($user_id =='')
{
	header("Location: $site_url/?login=error&red=/change-password.html");
}

if(isset($_POST['change_pass'])) 
{
	$set->change_password();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$get->get_website_name()?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?=$site_url?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/main.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/reset.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/media.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font2.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font3.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
<!--header start here-->
<? include 'inc/header.php'; ?>
<!--header end here-->
<div class="main-heading">
	<div class="container">
		<h2>My Cart</h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="<?=$site_url?>">Home</a></li>
			<li>Change Password</li>
		</ul>
		</div>
	</div>
</div>
<section id="change-password">
<div class="container">
		
			
			
			<!--menu-->
			<? include 'inc/account-menu.php'; ?> 
			<!--menu-->
			 
			<div class="col-md-75 my-acunt2">
			    <div class="col-md-100 sd-acoount">
				    
				<h1>Change Password</h1>	
                <div class="sd-acoount-form">
				
				<? if($_REQUEST['msg'] == 'error'): ?>
				<div id="login-response" class="mgs-area" style="">
					<div class="mgs error col-md-100"><i class="fa-exclamation-triangle fa"></i> 
						Password not match please try with correct password.
					</div>
				</div>
				<? endif; ?>

				<? if($_REQUEST['msg'] == 'success'): ?>
				<div id="login-response" class="mgs-area" style="">
					<div class="mgs success col-md-100">
					Password Change Successfully.
					</div>
				</div>	
				<? endif; ?>
				
				 <form method="post">
				    <div class="sd-acoount-khand">
					  <ul>
					    <li>Old Password</li>
						<li><input class="fk-input" type="password" name="old_pass" required></li>
					  </ul>
					</div> 
					
					<div class="sd-acoount-khand">
					  <ul>
					    <li>New Password</li>
						<li><input type="password" name="new_pass" required ></li>
					  </ul>
					</div> 
					
					<div class="sd-acoount-khand">
					  <ul>
					    <li>Repeat Password</li>
						<li><input type="password" name="re_pass" required ></li>
					  </ul>
					</div> 
					
					<div class="sd-acoount-khand">
					  <ul>
					   <li></li>
					    <li class="li-1"><input type="submit" value="Change Password" name="change_pass"></li>
						
					  </ul>
					</div> 
				 </form>	
				</div><!--sd-acoount-form is close-->
				  
				</div><!--col-md-100 fk-wishl-hdr is close-->
				
				<div class="clear-both"></div>   
			 </div><!--col-md-75 my-acunt2 is close-->
			 
			
			<div class="clear-both"></div>
		    </div>
</section>


<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->
<script src="<?=$site_url?>/js/jquery.min.js"></script>
<script src="<?=$site_url?>/js/globle.js"></script>
</body>
</html>