<?php 
include ('../management/include/functions.php');
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
$user = new Admin();

if (!$user->get_session())
{

        header("location:".$site_url."/vendor/login.php");

}


if($_REQUEST['getmeout'] == 'ok')
{
	$user->logout();
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
<h2><span>Dashboard</span>
<p><a href="index.php">Home</a></p>
</h2>
</div>
<div class="dashbox-main-div">


    <div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add user-->
		<h2>Welcome</h2>
		
		<!--<div id="buss_response"></div>
		<form action=""  method="post">
		<input type="text" name="pan_card" id="pan_card">
		<input type="button" id="business" name="Submit" Value="Submit">
		</form>-->
		<?

		$buss_detail = mysql_query("SELECT * FROM business_details WHERE vendor_id = '".$_SESSION['vendor_id']."' ");
		$res_buss = mysql_fetch_array($buss_detail);
		?>
		
		<div class="col-lg-4 col-md-4 col-sm-4 content-box content-box-1">
                    <div class="business-details col-bgcolors">
					
					  <?
					  if($res_buss['status']=='active'){?>                        
						<div class="ribbon-container1 open-ribbon-container1">
                            <span class="ribbon open-ribbon">Approved</span>
                        </div>						
					  <? }else{?>
					  <div class="ribbon-container open-ribbon-container">
                            <span class="ribbon open-ribbon">Pending</span>
                        </div>
					  <? } ?>
						
						
                        <div class="onboarding-icon-business"></div>
                        <h3>Business Details</h3>
                            <span class="open-close-verify">We need your PAN, TIN, TAN details to verify your business details</span>
							<hr>
							<a class="update-button business-detail" href="business_detail.php">Add Details</a>
                            <!--<button onclick="business_details()" class="update-button business-detail">Add Details</button>-->
                    </div>
        </div>
		
		<div class="col-lg-4 col-md-4 col-sm-4 content-box content-box-2">
                    <div class="bank-details col-bgcolors">
				
		<?
		$bank_detail = mysql_query("SELECT * FROM bank_detail WHERE vendor_id = '".$_SESSION['vendor_id']."' ");
		$res_bank = mysql_fetch_array($bank_detail);
		?>				
					
                        <?
					  if($res_bank['status']=='active'){?>                        
						  <div class="ribbon-container1 open-ribbon-container1">
                            <span class="ribbon open-ribbon">Approved</span>
                        </div>
					  <? }else{?>
					  <div class="ribbon-container open-ribbon-container">
                            <span class="ribbon open-ribbon">Pending</span>
                        </div>
					
					  <? } ?>
						
		
		
                        <div class="onboarding-icon-bank"></div>
                        <h3>Bank Details</h3>
                        <span class="open-close-verify">We need your bank account details and KYC documents to verify your bank account</span>
						<hr>
                        <!--<button class="update-button bank-detail">Add Details</button>-->
						<a class="update-button bank-detail" href="bank_detail.php">Add Details</a>
                    </div>
        </div>
		
		
		<div class="col-lg-4 col-md-4 col-sm-4 content-box content-box-3">
                    <div class="store-details col-bgcolors">
					
					
						<?
						$store_detail = mysql_query("SELECT * FROM store_details WHERE vendor_id = '".$_SESSION['vendor_id']."' ");
						$store_bank = mysql_fetch_array($store_detail);
						?>				
					
                        <?
					  if($store_bank['status']=='active'){?>
                       
						<div class="ribbon-container1 open-ribbon-container1">
                            <span class="ribbon open-ribbon">Approved</span>
                        </div>
						
					  <? }else{?>
					   <div class="ribbon-container open-ribbon-container">
                            <span class="ribbon open-ribbon">Pending</span>
                        </div>
					  <? } ?>
						
						
                        <div class="onboarding-icon-store"></div>
                        <h3>Store Details</h3>
                        <span class="open-close-verify">We need your display name and business description to verify your store details</span>
						<hr>
                        <!--<button class="update-button store-detail">Add Details</button>-->
						<a class="update-button store-detail" href="store_detail.php">Add Details</a>
                    </div>
        </div>

    </div>


		<div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add user-->
		<h2>Dashboard</h2>
		
		
			<?/*
			<div class="dashbox">
			<p><?=$get->get_total_user()?><br />
			<span>Users</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/user.png" width="32" class="setting-icon" />
			<a href="<?=ADMIN_PATH?>/user.php?role=view" class="edit">More Info</a>
			</div>
			*/?>
			

			<div class="dashbox bg-light-green">
			<p><?=$get->get_total_product_vendor($_SESSION['vendor_id'])?><br />
			<span>Total Product</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/product.png" width="42" class="setting-icon" />
			<a href="<?=$vendor_url?>/product.php?role=view" class="edit">More Info</a>
			</div>

			<div class="dashbox bg-green">
			<p><?=$get->get_total_order_vendor($_SESSION['vendor_id'])?><br />
			<span>Total Order</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/order.png" width="42" class="setting-icon" />
			<a href="<?=$vendor_url?>/orders.php?role=view" class="edit">More Info</a>
			</div>

			<div class="dashbox bg-orange">
			<p><?=$get->get_total_complete_order_vendor($_SESSION['vendor_id'])?><br />
			<span>Complete Order</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/order.png" width="42" class="setting-icon" />
			<a href="<?=$vendor_url?>/orders.php?role=view&status=complete" class="edit">More Info</a>
			</div>


			<div class="dashbox bg-light-yellow">
			<p><?=$get->get_total_panding_order_vendor($_SESSION['vendor_id'])?><br />
			<span>Pendding Order</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/order.png" width="42" class="setting-icon" />
			<a href="<?=$vendor_url?>/orders.php?role=view&status=pending" class="edit">More Info</a>
			</div>

            <?
			/*
			<div class="dashbox bg-light-black">
			<p><?=$get->get_total_cancel_order_vendor($_SESSION['vendor_id'])?><br />
			<span>Cancel Order </span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/order.png" width="42" class="setting-icon" />
			<a href="#" class="edit">More Info</a>
			</div>
			*/
			?>


			<div class="dashbox bg-last-green">
			<p><?=$get->get_total_price_order()?><br />
			<span>Total Amount</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/money.png" width="42" class="setting-icon" />
			<a href="#" class="edit">More Info</a>
			</div>
		<div style="clear:both"></div>
	
	</div>
</div>
<?  include ('include/footer.php');  ?>

</div>
<script src="js/global_vendor.js"></script>



</body>
</html>