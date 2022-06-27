<?include 'management/include/functions.php';

if(isset($_REQUEST['remove']))
{
	$set->remove_product($_REQUEST['remove']);
	header('location:cart.php');
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
			<li>My Cart</li>
		</ul>
		</div>
	</div>
</div>
<section id="my-cart">
	<div class="container">
	
	
	  <? if(is_array($_SESSION['cart']) & $get->get_cart_qty()>0){ ?>
	  <div class="col-md-100 left">
	       <h2 class="my-cart-heading">Shopping Cart (<?=$get->get_cart_qty()?> Items)</h2>
	  </div>
		<p style="text-align:center;color:red;" id="cart_update_msg"></p>
	   <div class="my-cart-table">
	   
		<ul class="heading">
		<li class="item">Item(s)</li>
		<li class="qty">Qty</li>
		<li class="price">Price</li>
		<!--<li class="deliveryi-details">Delivery Details</li>-->
		<li class="sub-total">Sub Total</li>
		</ul>
		<?
		for($i=0;$i<$get->get_cart_qty();$i++)
		{
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$attribute=$_SESSION['cart'][$i]['attribute'];
			$first = $attribute['first'];
			$second = $attribute['second'];
			//$first =''; 
			//$second ='';
			$combo=$_SESSION['cart'][$i]['combo'];
			$sale=$_SESSION['cart'][$i]['sale'];
			if($q==0) continue;
			if($i>0)
			{
				$display = 'dp-none';
			}
			?>
			<ul>
				<li class="item cart-min-height"><a class="grey" href="<?=$site_url?>/detail/pid-<?=$pid?>/<?=$get->seo_friendly_url($get->get_product_name($pid))?>">
					<div class="item-img"><img src="<?=$site_url?>/upload/product/thumb/th_<?=$get->get_single_product_img($pid)?>"></div>
					<div class="item-content">
					<?
					if (strlen($get->get_product_name($pid)) >= 45){ 
					echo substr($get->get_product_name($pid), 0, 45).'...';
					} else {
					echo $get->get_product_name($pid);
					}
					?>
					
					<p><span><?=$get->get_product_detail($pid);?></span></p>
					<p>
					<? if($attribute['first'] !=''){ ?>
					<span>
					<strong><?=$get->get_attribute_name($get->get_attribute_id_option_id($attribute['first']))?>:</strong>
					<small><?=$get->get_attribute_option_name($attribute['first'])?></small>
					</span>
					<? } ?>
					</div></a>			
				</li>
				
				<li class="qty cart-min-height">
				<input name="product" maxlength="3" id="update_qty<?=$i?>" type="text" class="qty_box" placeholder="<?=$q?>">
				<a class="black" href="#0" onclick="update_cart('<?=$pid?>','<?=$first?>','<?=$second?>','<?=$i?>')" class="f-12">Save</a>
				</li>
				
				
				<li class="price cart-min-height">
					<div class="value">Rs. <?=number_format($get->get_product_price($pid,$attribute['first'],$attribute['second']))?></div>
					<p><span>Selling Price: <del>Rs. <?=number_format($get->get_product_selling_price($pid,$attribute['first'],$attribute['second']))?></del></span></p>
					<p><span class="green">Offer Savings: Rs. <?=number_format($get->get_product_selling_price($pid,$attribute['first'],$attribute['second'])- $get->get_product_price($pid,$attribute['first'],$attribute['second']))?></span></p>
				</li>
				
				
				<!--<li class="deliveryi-details cart-min-height">
					<div class="value">Free<br><span>Delivery by 09 Jun 2016</span></div>
				</li>-->
				
				<li class="sub-total cart-min-height">
					<div class="value">
					<?
					$actualPrice = $get->get_product_price($pid,$attribute['first'],$attribute['second']);
					$sub_total = number_format($q*$actualPrice);
					?>
					Rs. <?=$sub_total?>
					<a class="right red f-12" href="<?=$site_url?>/cart.php?remove=<?=$i?>"  class="f-10" onClick="wait();">Remove</a>
					</div>
				</li>
			</ul>
        <?
		}
		?>		
		 
		 
		 <ul class="total-section">
		    <li>Delivery and payment options can be selected later</li>
		    <li>
			  <?$t_total = $get->get_order_total()-$_SESSION['coupen_dis'];?>
			
			   <div class="sub-total-amount"><span class="left">Total:</span> <span class="right">Rs. <?=number_format($t_total)?></span></div>
			   <div class="total-charges"><span class="left">Delivery Charges:</span> 
			   <span class="right">
				<?
				if($get->get_delivery_charges() > 0)
				{	
					$deliveryamount = number_format($get->get_delivery_charges());
					echo 'Rs. '.$deliveryamount;
				}
				else
				{
					?><font style="color:green">Free</font><?
				}
				?>	
			   </span>
			   
			   </div>
			   <?$gtotal = ($get->get_order_total()+$deliveryamount)-$_SESSION['coupen_dis'];?>
			   <div class="sub-total-amounts"><span class="left">Total:</span> <span class="right">Rs. <?=number_format($gtotal)?></span></div>
			</li>
		 </ul>  
	   </div>
	   <div class="my-cat-btn">
	     <a href="<?=$site_url?>" class="continue-shopping">Continue Shopping</a>
	     <a href="<?=$site_url?>/checkout.php" class="place-order">Place Order</a>
	   </div>
	  <? }else{?>
	  
	    <div class="col-md-100 left text-center">
	     <img src="<?=$site_url?>/img/nakup-kos.gif" />
		 <div class="my-cat-btn" style="text-align:center;">
	       <a href="<?=$site_url?>" class="continue-shopping">Continue Shopping</a>
	   </div>
	  </div>
	  
	  <?} ?>
	   
	   
	   
	   
	</div>  
</section>
<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->
<script src="<?=$site_url?>/js/jquery.min.js"></script>
<script src="<?=$site_url?>/js/globle.js"></script>
</body>
</html>