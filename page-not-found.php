<?include 'management/include/functions.php';?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$get->get_website_name()?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/media.css" rel="stylesheet">
	<link href="css/reset.css" rel="stylesheet">
	<link href="font/font.css" rel="stylesheet">
	<link href="font/font2.css" rel="stylesheet">
	<link href="font/font3.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
</head>


<body>

<!--header start here-->
   <? include 'inc/header.php'; ?>
<!--header end here-->

<nav>
	<div class="category-h">
		<h3>Categories <img src="img/icon/bar.png"></h3>
	</div>
	<div class="navigation">
		<ul>
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">Request Product</a></li>
			<li><a href="#">Offers</a></li>
			<li><a href="#">New Arrival</a></li>
		</ul>
	</div>
	
	<div class="cart-section">
		<p><img src="img/icon/cart.png"><span class="price">INR(0)</span><i>-</i><span class="items">0 items(s)</span></p>

	</div>
</nav>


<div class="main-heading">
	<div class="container">
		<h2>Page Not Found</h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="#">Home</a></li>
			<li>Page Not Found</li>
		</ul>
		</div>
	</div>
</div>
<section id="page-not-found">
  <div class="container text-center" >
    <a href="index.php"><img src="img/page-not-found.jpg" /></a>	
  <div class="clear-both"></div>
  </div>
</section>


<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->




	<script src="js/jquery.min.js"></script>
	<script src="js/globle.js"></script>

 

</body>
</html>