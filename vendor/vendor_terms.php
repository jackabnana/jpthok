<?php 
include ('../management/include/functions.php');


$page_title = $get->get_content_title(19344);
$page_details = $get->get_content(19344);


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
<body>
<!-- Admin Main Area -->
<div id="adminmain">
<? //include ('include/header.php'); ?>
<div id="AdminHeader">
	<div class="logo">
	<a href="index.php">
	
	
	<link rel="stylesheet" type="text/css" href="<?=$site_url?>/fonts/font-awesome/css/font-awesome.min.css"/>
	
	<img src="<?=$site_url?>/upload/comman/<?=$get->get_logo()?>" height="60"/>
	
	</a>
	</div>
	<div class="searcharea">
	<form action="" method="" onsubmit=''>
	<input type="text" class="top-input" placeholder="Type to search ..."/>
	<input type="submit" class="top-input-search" value="" />
	</form>
	</div>
	<div class="logout">Welcome to ezdayshop&nbsp;&nbsp;&nbsp;</div>
	<div style="clear:both;"></div>
</div>

<div class="left">
<?  //include ('include/menu.php');  ?>
</div>



<div  id='content'>
<div class="page-heading">
<h2><span><?=$page_title?></span>
<p><a href="javascript:history.back()">Go Back</a></p>
</h2>
</div>
<div class="dashbox-main-div">


    <div class="col-100 bg_color_white border_top_gray border_radius_5" > 
		<!--Add user-->
		<h2><?=$page_title?></h2>	
		
		<?=$page_details?>
		
    </div>


		
</div>
<?  include ('include/footer.php');  ?>

</div>




</body>
</html>