<?include 'management/include/functions.php';
$user_id = $get->get_website_session();
extract($_REQUEST);

if($_POST['addtocart'] != '')
{
	$set->add_to_cart($_POST['product_id'],$_POST['quantity'],null,null);
	$url = $site_url.'/cart.html';
	header('location: '.$url.'');
}

if(isset($_POST['review'])){
	$review = $set->add_review();	
	if($review == true):
	$msg = " <font style='color:green; font-weight:bold'>Review submit successfully. our review moderators will check and approve.</font> ";
	else:
	$msg = " <font style='color:red; font-weight:bold'>Error in review submit. Please try again.</font> ";
	endif;
}
	//Split Url Into Parts
	$bid = explode("/",$did);
	$split_id = $bid[0];
	
	//Select Product Details
	$sql = " SELECT * FROM product WHERE product_id ='$split_id' ";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	$fetchdetails = mysql_fetch_array($query);
	extract($fetchdetails);
?>
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
<div class="main-heading">
	<div class="container">
		<h2>Order History</h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="<?=$site_url?>">Home</a></li>
			<li>Order History</li>
		</ul>
		</div>
	</div>
</div>
<section id="order-history">
<div class="container">
   <div class="col-md-100 left"> 
   
		<ul class="order-history">
		<?
			$selecttotalorder = "SELECT * FROM order_details WHERE userid = '$user_id' ORDER BY id DESC";
			$querya = mysql_query($selecttotalorder);
			$count = mysql_num_rows($querya);
			if($count > 0):
			while($raw=mysql_fetch_array($querya)):
			extract($raw);

		?>
			<li class="order-list">
				<div class="order-number">
					<span class="order_number"><?=$orderid?></span>
					<a href="<?=$site_url?>/order-detail/<?=$orderid?>/<?=$get->seo_friendly_url($get->get_product_name($prod_id))?>" class="order_number right"><i class="fa fa-map-marker"></i> Track</a>
				</div>
				<?
					$selectorder = "SELECT * FROM order_prodcut_details WHERE orderid='$orderid'";
					//$selectorder = "SELECT * from order_prodcut_details as OPD JOIN order_prodcut_attribute as OPA ON OPD.orderid = OPA.orderid WHERE OPD.orderid='$orderid' group by OPA.attribute_option_id";
					
					$query = mysql_query($selectorder);
					
					while($row=mysql_fetch_array($query)):
					extract($row);
					$url = $get->seo_friendly_url($get->get_product_name($prod_id));
					$url_combo = $get->seo_friendly_url($get->get_combo_name($prod_id));
					$aid = $attribute_id;	
                    $aoid = $attribute_option_id;
					
				?>
				<div class="order-toggle">
					<div class="summry">
					    <? if($url !=''){ ?>
						<div class="thumb">
						<a href="<?=$site_url?>/detail/<?=$prod_id?>/<?=$url?>"><img src="<?=$site_url?>/upload/product/thumb/th_<?=$get->get_single_product_img($prod_id)?>"></a>
						</div>
						<div class="product-name">
							<h4 class="order-name"><a class="grey" href="<?=$site_url?>/detail/pid-<?=$prod_id?>/<?=$url?>"><?=$get->get_product_name($prod_id)?></a></h4>
							<span class="qty">Qty <?=$qty?>	</span>
							<br/>
							<?
							/*$select_option = mysql_query("SELECT * FROM order_prodcut_attribute WHERE orderid='$orderid' AND attribute_id > 0 AND prod_id ='$prod_id' ");
					        $count_option =  mysql_num_rows($select_option);
							if($count_option > 0)
							{ 
								while($result_option = mysql_fetch_array($select_option))
								{
									$aid = $result_option['attribute_id'];	
									$aoid = $result_option['attribute_option_id'];	*/
									
									?>
									<? if($aoid > 0){ ?>
									<span>
									<strong><?=$get->get_attribute_name($aid)?>:</strong>
									<small><?=$get->get_attribute_option_name($aoid)?></small>
									</span>
									<br/>
									<? } ?>
									<? 
								//} 
							//}
							?>
						</div>
						<div class="rate">Rs. <?=number_format($price*$qty)?></div>
						<div class="delivery-date">
							<span class="order-date">Delivery expected by <?=$get->product_delivery_for_order($orderid,$prod_id)?></span>
							<br/>
							<!--<span class="status">Your item has been packed</span>-->
						</div>
						<!--<a href="#0" class="cancel-btn">X Cancel</a>-->
						<? } else {
							?>
						<div class="thumb">
								<a href="<?=$site_url?>/detail/<?=$prod_id?>/<?=$url_combo?>"><img src="<?=$site_url?>/upload/combo/thumb/th_<?=$get->get_single_combo_img($prod_id)?>"></a>
								</div>
								<div class="product-name">
									<h4 class="order-name"><a href="<?=$site_url?>/detail/<?=$prod_id?>/<?=$url_combo?>"><?=$get->get_combo_name($prod_id)?></a></h4>
									<span class="qty">Qty <?=$qty?>	</span>
									<br/>
								</div>
								<div class="rate">Rs. <?=number_format($price)?></div>
								<div class="delivery-date">
									<?if($get->combo_delivery_for_order($orderid,$prod_id) !=''){ ?>
									<span class="order-date">Delivery expected by <?=$get->combo_delivery_for_order($orderid,$prod_id)?></span><br/>
									<? } ?>
									<!--<span class="status">Your item has been packed</span>-->
								</div>
						<? } ?>
					</div>
					
				</div>
				<? endwhile; ?>
				<div class="order-dispatch">
						<div class="dateing">Date <span class="order-date"><? $date = $orderdate; echo date('d-M-Y', strtotime($date)); ?></span></div>
						
						<div class="total-order">Order Total :
						<span class="amount">Rs. 
						<? 
						$deliveryamount = $get->get_delivery_charges(); 
						$amount = (($total_amount+$deliveryamount)-$coupon_amount);
						if($coupon_amount !=0){
							echo '<strike>'.($total_amount+$deliveryamount).'</strike> &nbsp;';
							if($amount < 0): echo 'Rs. 0'; else: echo 'Rs. '.(($total_amount+$deliveryamount)-$coupon_amount); endif;
						} else {
							if($amount < 0): echo 'Rs. 0'; else: echo ($total_amount+$deliveryamount);	endif; 
						}
						?></span></div>
						
						<?if($deliveryamount>0){?><div style="margin-right:25px;" class="total-order">Shipping amount: <span class="amount">Rs.<?=$deliveryamount?></span></div><? } ?>
			    </div>
			</li>
			<?  endwhile; ?>
			<? else: ?>	
			<center><h3>No order yet.</h3></center>
			<? endif; ?>
		</ul>
	 

   </div>
</div>
</section>


<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->
	<script src="js/jquery.min.js"></script>
	<script src="js/globle.js"></script>

 

</body>
</html>