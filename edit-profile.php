<?
include 'management/include/functions.php';
$user_id = $get->get_website_session();
if($user_id < 0)
{
	header("Location: $site_url/?login=error&red=/edit-profile.html");
}

if(isset($_POST['save'])){
	extract($_POST);
	mysql_query("UPDATE user SET first_name='$first_name',last_name='$last_name',gender='$gender' WHERE user_id='$user_id' ");
}

$select_user_details = mysql_query("SELECT * FROM user WHERE user_id='$user_id'");
$user_row = mysql_fetch_object($select_user_details);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$get->get_website_name()?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?=$site_url?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/main.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/reset.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font2.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/media.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font3.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
<!--header start here-->
<? include 'inc/header.php'; ?>
<!--header end here-->
<div class="main-heading">
	<div class="container">
		<h2>Edit Profile</h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="<?=$site_url?>">Home</a></li>
			<li>Edit Profile</li>
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
				    
				<h1>Personal Information</h1>	
                <div class="sd-acoount-form">
				 <form method="post">
				    <div class="sd-acoount-khand">
					  <ul>
					    <li>First Name</li>
						<li><input class="fk-input" type="text" name="first_name" value="<?=$user_row->first_name?>" required></li>
					  </ul>
					</div> 
					
					<div class="sd-acoount-khand">
					  <ul>
					    <li>Last Name</li>
						<li><input type="text" name="last_name" value="<?=$user_row->last_name?>" required ></li>
					  </ul>
					</div> 
					
					
					
					<div class="sd-acoount-khand">
					  <ul>
					    <li>Gender</li>
						<li>
						<? 
						if($user_row->gender == 'Male'){
							$selectMale = 'selected';
						} elseif($user_row->gender == 'Female'){
							$selectFemale = 'selected';
						}
						?>
						  <select name="gender" required>
						   <option selected="selected" value="">Select</option>
						   <option value="Male" <?=$selectMale?>>Male</option>
						   <option value="Female" <?=$selectFemale?>>Female</option>
						  </select>
						</li>
					  </ul>
					</div> 
					
					<div class="sd-acoount-khand">
					  <ul>
					   <li></li>
					    <li class="li-1"><input type="submit" value="Save" name="save"></li>
						
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