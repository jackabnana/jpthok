<?include 'management/include/functions.php';
if($get->get_website_session() == '')
{
	header("Location: $site_url/?login=error&red=/wishlist.html");
}

$user_id = $get->get_website_session();
$select_wishlist = mysql_query("SELECT * FROM wishlist AS WL JOIN product as P ON P.prod_id = WL.prod_id WHERE WL.user_id='{$user_id}' AND P.status='active' ");
$count = mysql_num_rows($select_wishlist);
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
		<h2>My Wishlist </h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="#">Home</a></li>
			<li>My Wishlist</li>
		</ul>
		</div>
	</div>
</div>
<section id="order-history">
<div class="container">
   <div "col-md-100="" left"=""> 
		<ul class="order-history">

		    <?
			if($count>0){
			$i=1;	
			while($res_product = mysql_fetch_array($select_wishlist)){?>
			<li id="<?=$i?>" class="order-list">
				
				<div class="order-toggle">
					<div class="summry">
					<div class="thumb">
					<a href="#">
						<?
						$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_product['prod_id']."'  ORDER BY rand() LIMIT 1");
						while($res_image = mysql_fetch_array($prod_image))
						{
							?>
							<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
							<? 
						} 
						?>
			     	</a>
					</div>
					<div class="product-name">
					<?
					$seo_name = $get->seo_friendly_url($res_product['product_name']);
					$url = $site_url.'/detail/pid-'.$res_product['prod_id'].'/'.$seo_name;
					?>
					
					<h4 class="order-name"><a class="grey" href="<?=$url?>">
					<?
					if(strlen($res_product['product_name']) > 40)
					{ 
						echo substr($res_product['product_name'],0,40).'...';
					}else{
						echo $res_product['product_name'];
					}
					?>
					</a></h4>
					<span class="qty">Qty 1	</span>
					<br>
					<!--<span>
					<strong>Size:</strong>
					<small>Free</small>
					</span>-->
					<br>
					</div>
					<div class="rate">Rs. <?=number_format($res_product['prodcut_discount_rate'])?></div>
					
					<div class="delivery-date">
					<span class="order-date">Delivery expected by <?=$get->product_delivery_day($res_product['prod_id'])?></span>
					<br>
					<!--<span class="status">Your item has been packed</span>-->
					</div>
					<!--<a href="#0" class="cancel-btn">X Cancel</a>-->
					</div>

				</div>
				<div class="order-dispatch">
					<div class="dateing"><span style="cursor:pointer" onclick="remove_wishlist('<?=$i?>','<?=$res_product['prod_id']?>')" class="order-date">Remove from List</span></div>

					<!--<div class="total-order">Order Total :
					<span class="amount">Rs. 
					2395</span>
					</div>-->
					<?
                    $deliveryamount = $get->get_delivery_charges(); 
					?>
					<div style="margin-right:25px;" class="total-order">Shipping amount: <span class="amount">Rs.<?=$deliveryamount?></span>
					</div>						
				</div>
			</li>
		    <? $i++;
			} 
			}
			else
			{ ?>
			<li class="order-list text-center">No product(s) found.</li>
			<? }?>
		</ul>
	 

   </div>
</div>
</section>
<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->
<script src="<?=$site_url?>/js/jquery.min.js"></script>
<script src="<?=$site_url?>/js/globle.js"></script>
</body>
</html>