<?php 
include ('../management/include/functions.php');
$user = new Admin();

$username = $user->get_session();


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
<h2><span><?=$page_title?></span>
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
    <div class="tabContent" id="general">
      <div>
        
		<table width="100%" style="margin:0;">
		    <tr>	
				<td>
				<h2><?=$page_title?></h2>	
		
		<?=$page_details?>
				</td>
			</tr>				
		</table>		
      </div>
    </div>

    
	
	
	
	
	
	
		<div>	
</div>
<?  include ('include/footer.php');  ?>

</div>
<script src="js/global_vendor.js"></script>



</body>
</html>