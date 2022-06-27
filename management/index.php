<?php 
include ('include/functions.php');
$user = new Admin();
if (!$user->get_session())
{
header("location:login.php");
}

if($_REQUEST['getmeout'] == 'ok'){
	$user->logout();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin</title>
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

<script type="text/javascript" src="js/jquery.min.js"></script>

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
		<h2>Dashboard</h2>
			<div class="dashbox">
			<p><?=$get->get_total_user()?><br />

			<span>Users</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/user.png" width="32" class="setting-icon" />
			<a href="<?=ADMIN_PATH?>/user.php?role=view" class="edit">More Info</a>

			</div>


			<div class="dashbox bg-light-green">
			<p><?=$get->get_total_product()?><br />
			<span>Total Product</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/product.png" width="42" class="setting-icon" />
			<a href="<?=ADMIN_PATH?>/product.php?role=view" class="edit">More Info</a>
			</div>

			<div class="dashbox bg-green">
			<p><?=$get->get_total_order()?><br />
			<span>Total Order</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/order.png" width="42" class="setting-icon" />
			<a href="<?=ADMIN_PATH?>/orders.php?role=view" class="edit">More Info</a>
			</div>


			<div class="dashbox bg-orange">
			<p><?=$get->get_total_complete_order()?><br />
			<span>Complete Order</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/order.png" width="42" class="setting-icon" />
			<a href="<?=ADMIN_PATH?>/orders.php?role=view&status=complete" class="edit">More Info</a>
			</div>


			<div class="dashbox bg-light-yellow">
			<p><?=$get->get_total_panding_order()?><br />
			<span>Pendding Order</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/order.png" width="42" class="setting-icon" />
			<a href="<?=ADMIN_PATH?>/orders.php?role=view&status=pending" class="edit">More Info</a>
			</div>


			<div class="dashbox bg-light-black">
			<p><?=$get->get_total_review()?><br />
			<span>Reviews</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/order.png" width="42" class="setting-icon" />
			<a href="<?=ADMIN_PATH?>/review.php?role=view" class="edit">More Info</a>
			</div>


			<div class="dashbox bg-last-green">
			<p><?=$get->get_total_price_order()?><br />
			<span>Total Amount</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/money.png" width="42" class="setting-icon" />
			<a href="#" class="edit">More Info</a>
			</div>


			<div class="dashbox bg-light-blue">
			<p><?=$get->get_total_pandding_price_order()?><br />
			<span>Pandding Amount</span>
			</p>
			<img src="<?=ADMIN_PATH?>/images/money.png" width="42" class="setting-icon" />
			<a href="#" class="edit">More Info</a>

			</div>

			<? /* ?>
			<div class="dashbox bg-purple">
			<p><?=$get->get_total_user()?><br />
			<span>Users</span>
			</p>
			<a href="<?=ADMIN_PATH?>/user.php?role=view" class="edit">More Info</a>
			</div>

			<div class="dashbox bg-light-b">
			<p><?=$get->get_total_user()?><br />
			<span>Users Video</span>
			</p>
<a href="#" class="edit">More Info</a>
</div>
<? */ ?>

		<div style="clear:both"></div>
	
	</div>
</div>
<?  include ('include/footer.php');  ?>

</div>




</body>
</html>