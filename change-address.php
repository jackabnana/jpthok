<?
include 'management/include/functions.php';

if($_REQUEST['logout'] == 'yes'){
	$set->logout_user();
}

if($_REQUEST['prod_id'] != '' and $_REQUEST['quantity'] !='' ){
$set->add_to_cart($_REQUEST['prod_id'],$_REQUEST['quantity'],$_REQUEST['attribute']);
	$url = $site_url.'/cart.html';
	header('location: '.$url.'');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$get->get_website_name()?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?=$site_url?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/main.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/media.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/reset.css" rel="stylesheet">
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
			<li>Change Address</li>
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
				<div class="sd-acoount-div">
					<div class="bold"><b>Your Saved Addresses</b></div>
				   
				   <?
				   $user_id = $get->get_website_session(); 
				   $add = $get->get_address($user_id);
				   while($res = mysql_fetch_array($add))
					{
					extract($res);
				?>
				   <div class="info-of-user" id="add_form_id_<?=$id?>">
				   <div class="add_del_loading" id="add_form_loading_<?=$id?>">
				   <p>Deleting...</p>
				   </div>
				   <a href="javascript:deleteadd(<?=$id?>);"><img src="<?=$site_url?>/img/trash_empty.png" class="delete"/></a>
				     <ul>
					   <li><?=$billname?></li>
					   <li><?=$billaddress?>, <?=$billlandmark?>, <?=$billcountry?>, <?=$billstate?>, <?=$billcity?>, <?=$billzip?></li>
					   <li>Ph: <?=$billcontact?></li>
					 </ul>
				   </div>
					<? } ?>   
				</div><!--sd-acoount-div is close-->
				  
				</div><!--col-md-100 fk-wishl-hdr is close-->
				
				</div><!--col-md-100 fk-wishl-hdr is close-->
			
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