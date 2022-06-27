<?
include 'management/include/functions.php';
if($_SESSION['cart']==''):
	header('location:index.html');
endif;


if(isset($_POST['applycopen']))
{
	extract($_POST);
	$response = $set->apply_coupon();
	if($response == 'success')
	{
		$coupon_msg = 'Coupon code applied successfully.';
	}
	elseif($response == 'already-use')
	{
		$coupon_error = 'Coupon code already used.';
	}
	else
	{
		$coupon_error = 'Coupon code mis-match.';
	}		
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
<body onload="DrawCaptcha();showareaonload(3);">
<!--header start here-->
   <? include 'inc/header.php'; ?>
<!--header end here-->

<div class="main-heading">
	<div class="container">
		<h2>Checkout</h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="<?=$site_url?>">Home</a></li>
			<li>Checkout</li>
		</ul>
		</div>
	</div>
</div>
<section id="checkout-page">
  <div class="container">
	<div class="clear-both"></div>
	<?if(isset($coupon_msg))
	{
		?>
		<div class="mgs success col-md-60"><?=$coupon_msg;?></div>
		<? 
	} 
	if(isset($coupon_error))
	{
		?>
		<div class="mgs error col-md-60"><?=$coupon_error;?></div>
		<? 
	} 
	?>
   <div id="form-response" class="col-md-60"></div>
   <div class="col-md-100">
	
	
    <!-- billing addess start here-->
		<div class="col-md-25 bg-white billing-address left">
		<h2><span class="steps-1">1</span>DELIVERY ADDRESS</h2>
		<? 
		$user_id = $get->get_website_session(); 
		$add = $get->get_address($user_id);
		if($add != 'no')
		{
			$class = 'dp-none';
		}
        else
		{
			$req = 'required';	
			$class = 'dp-block';		
		}
	
		
		if($add != 'no')
		{
		?>
			<div class="col-md-100 left checkout-body address_detail">
			<span class="add_address_btn btn btn-white-yellow" id="add_address">+ Add new Address</span>
			<?
			while($res = mysql_fetch_array($add))
			{
				extract($res);?>
				<div id="add_form_id_<?=$id?>" class="getaddress"  value="<?=$id?>" onclick="change_address('<?=$id?>')">
				<div class="namea rposition" style="border-bottom:#e6e6e6 solid 1px; height:auto;">
					<p style="width:32px; height:32px; margin:0px; padding:0px; float:left">
						<span class="tick-icon tick-mark" style="display:none;" id="select_<?=$id?>"></span>
					</p>
					<div class="text-ellipsis ng-binding" title="" ><?=$get->get_user_name($userid)?></div> 
					<div class="clear-both"></div>
				</div>
				<p>
				<?=$billname?>, <?=$billaddress?>, <?=$billlandmark?>, <?=$billcountry?>, <?=$billstate?>, <?=$billcity?>, <?=$billzip?>
				</p>
				<p><?=$billcontact?></p>
				</div>
			<?	
			}
			?>
			</div>	
			<?
		}
        
		$total_amount = ($get->get_order_total()+$deliveryamount)-$_SESSION['coupen_dis'];
		if($total_amount < 0 )
		{
			$method = 'None'; 
		}
		else
		{
			$method = 'Credit Card'; 
		}
		?>
						
		<form action="" method="post" id="address_form" class="<?=$class?>" autocomplete="off">
			<input type="hidden" id="payment_method" name="payment_method" value="<?=$method?>">
			<input type="hidden" id="online_method" name="online_method" value="">
			<input type="hidden" id="form_validation" name="form_validation" value="<?=$req?>">	
			<input type="hidden" id="get_address_id" value="" name="get_address_id">
            <input type="hidden" id="available_pin" value="" name="available_pin">  			
			
			<div class="col-md-100 left checkout-body">
			<? if($add != 'no')	{ ?>
			<p id="back_address"><< Choose Address</p>
			<? } ?>
			<div class="col-md-100 left">
				<div class="col-md-100 left">
					<label class="form-label">Name</label>
					<input type="text" class="col-md-100 left padding-5px border-1" placeholder="Name" name="billname" id="billname">
				</div>
			</div>

			<!--<div class="col-md-100 left margin-top-10px">
				<label class="form-label">Pincode</label>
				<input type="text" class="col-md-100 left padding-5px border-1" placeholder="Pincode" name="billzip" id="billzip">
			</div>-->

			<div class="col-md-100 left margin-top-10px">
				<label class="form-label">Address</label>
				<textarea class="col-md-100 left padding-5px border-1" height="60px" placeholder="Address" name="billaddress" id="billaddress"></textarea>
			</div>
			
			<div class="col-md-100 left margin-top-10px">
				<label class="form-label">Landmark</label>
				<input type="text" class="col-md-100 left padding-5px border-1" placeholder="Landmark" name="billlandmark" id="billlandmark">
			</div>
			
			<input type="hidden" name="billcountry" id="billcountry" value="India">	
				<input type="hidden" name="billstate" id="billstate" value="Delhi">
			
			<!--<div class="col-md-100 left margin-top-10px">
				<div class="col-md-100 left">
					<label class="form-label">State</label>
					<select class="col-md-100 left padding-5px border-1" name="billstate" id="billstate">
						<option value="">Select State</option>
						<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
						<option value="Andhra Pradesh">Andhra Pradesh</option>
						<option value="Arunachal Pradesh">Arunachal Pradesh</option>
						<option value="Assam">Assam</option>
						<option value="Bihar">Bihar</option>
						<option value="Chandigarh">Chandigarh</option>
						<option value="Chhattisgarh">Chhattisgarh</option>
						<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
						<option value="Daman and Diu">Daman and Diu</option>
						<option value="Delhi">Delhi</option>
						<option value="Goa">Goa</option>
						<option value="Gujarat">Gujarat</option>
						<option value="Haryana">Haryana</option>
						<option value="Himachal Pradesh">Himachal Pradesh</option>
						<option value="Jammu and Kashmir">Jammu and Kashmir</option>
						<option value="Jharkhand">Jharkhand</option>
						<option value="Karnataka">Karnataka</option>
						<option value="Kerala">Kerala</option>
						<option value="Lakshadweep">Lakshadweep</option>
						<option value="Madhya Pradesh">Madhya Pradesh</option>
						<option value="Maharashtra">Maharashtra</option>
						<option value="Manipur">Manipur</option>
						<option value="Meghalaya">Meghalaya</option>
						<option value="Mizoram">Mizoram</option>
						<option value="Nagaland">Nagaland</option>
						<option value="Orissa">Orissa</option>
						<option value="Pondicherry">Pondicherry</option>
						<option value="Punjab">Punjab</option>
						<option value="Rajasthan">Rajasthan</option>
						<option value="Sikkim">Sikkim</option>
						<option value="Tamil Nadu">Tamil Nadu</option>
						<option value="Tripura">Tripura</option>
						<option value="Uttaranchal">Uttaranchal</option>
						<option value="Uttar Pradesh">Uttar Pradesh</option>
						<option value="West Bengal">West Bengal</option>
					</select>
				</div>
			</div>-->
			
			<div class="col-md-100 left">
				<div class="col-md-100 left">
					<label class="form-label">City</label>
					<input type="text" class="col-md-100 left padding-5px border-1" placeholder="city" name="billcity" id="billcity">
				</div>
			</div>
			

			<div class="col-md-100 left">
				<label class="form-label">Mobile</label>
				<input type="text" class="col-md-100 left padding-5px border-1" id="billcontact" name="billcontact"  placeholder="mobile">
			</div>
		</div>
		
	</div>
	<!-- billing addess end here-->
	
	<div class="col-md-75 review-order-bill left padding-left-20px">

		<div class="col-md-100 left border-1">
			<h2><span class="steps-1">2</span>ORDER SUMMARY</h2>

			<!-- heading start here-->
			<div class="col-md-100 left">
				<div class="col-md-100 left">
					<div class="col-md-30 left border-right heading">Product Name</div>
					<div class="col-md-30 left border-right heading text-center">Price</div>
					<div class="col-md-20 left border-right heading text-center">Qty</div>
					<div class="col-md-20 left heading text-center">Subtotal</div>
				</div>
					<? 
						for($i=0;$i<$get->get_cart_qty();$i++):
						$pid=$_SESSION['cart'][$i]['productid'];
						$q=$_SESSION['cart'][$i]['qty'];
						$attribute=$_SESSION['cart'][$i]['attribute'];
						$combo=$_SESSION['cart'][$i]['combo'];
						$sale=$_SESSION['cart'][$i]['sale'];
						$first = $attribute['first'];
						$second = $attribute['second'];
						if($q==0) continue;
					?>
				<!-- multiple products-->
				<div class="col-md-100 left cart-item">
				    <?if($pid > 0):?>
					<div class="col-md-30 left border-right value"><a class="grey" href="<?=SITE_URL?>/detail/<?=$pid?>/<?=$get->seo_friendly_url($get->get_product_name($pid))?>"><?
					if (strlen($get->get_product_name($pid)) >= 25){ 
					echo substr($get->get_product_name($pid), 0, 25).'...';
					} else {
					echo $get->get_product_name($pid);
					}
					?><br/><? 
					if($first !=''){ ?>
					<span>
					<strong><?=$get->get_attribute_name($get->get_attribute_id_option_id($attribute['first']))?>:</strong>
					<small><?=$get->get_attribute_option_name($attribute['first'])?></small>
					</span>
					<? } ?>
					<br/>
					<? 
					if($second !=''){ ?>
					<span>
					<strong><?=$get->get_attribute_name($get->get_attribute_id_option_id($attribute['second']))?>:</strong>
					<small><?=$get->get_attribute_option_name($attribute['second'])?></small>
					</span>
					<? } 
					?></a></div>
					<div class="col-md-30 left border-right value text-center">Rs. <?=number_format($get->get_product_price($pid,$first,$second))?></div>
					<div class="col-md-20 left border-right value text-center"><?=$q?></div>
					<div class="col-md-20 left heading text-center value">Rs. <?=number_format($get->get_product_price($pid,$first,$second)*$q)?>
					</div>
				    <? else:?>
                    <div class="col-md-30 left border-right value"><a href="<?=SITE_URL?>/detail/<?=$combo?>/<?=$get->seo_friendly_url($get->get_combo_name($combo))?>"><?
					if (strlen($get->get_combo_name($combo)) >= 25){ 
					echo substr($get->get_combo_name($combo), 0, 25).'...';
					} else {
					echo $get->get_combo_name($combo);
					}
					?></a></div>
					<div class="col-md-30 left border-right value text-center">Rs. <?=number_format($get->get_combo_price($combo))?></div>
					<div class="col-md-20 left border-right value text-center"><?=$q?></div>
					<div class="col-md-20 left heading text-center value">Rs. <?=number_format($get->get_combo_price($combo)*$q)?>
					</div>
                    <?endif;?>					
				</div>
				<!-- multiple products-->
					<? endfor; ?>
			</div>

			
			<!-- subtotal- start here-->
			<div class="col-md-100 left">
				<div style="color: #20876A;" class="col-md-80 left text-right f-13  border-right padding-10px red border-bottom">Base Total</div>
				<div class="col-md-20 left text-center padding-10px f-13 b-bold grey border-bottom">Rs. <?=number_format($get->get_order_total())?></div>
			</div>
			<!-- subtotal- end here-->
			<? if($_SESSION['coupen_dis'] !=''): ?>
			<!-- Discount- start here-->
			<div class="col-md-100 left">
				<div  class="col-md-80 left text-right f-13  border-right padding-10px red border-bottom">Discount Total</div>
				<div class="col-md-20 left text-center padding-10px f-13 b-bold grey border-bottom">Rs. <?=number_format($_SESSION['coupen_dis'])?></div>
			</div>
			<!-- Discount- end here-->
			<? endif; ?>
			
			<!-- Delivery- start here-->
			<div class="col-md-100 left">
				<div style="color: #20876A;" class="col-md-80 left text-right f-13  border-right padding-10px red border-bottom">Delivery Total</div>
				<div class="col-md-20 left text-center padding-10px f-13 b-bold grey border-bottom">
				<? $deliveryamount = $get->get_delivery_charges(); ?>
				<?
				if($get->get_delivery_charges() > 0)
				{	
				echo 'Rs. '.number_format($get->get_delivery_charges());
				}
				else
				{
				?>
				<font style="color:green">Free</font>
				<?
				}
				?>	
				</div>
			</div>
			<!-- Delivery- end here-->

			<!-- grand total start here-->
			<div class="col-md-100 left">
				<div class="col-md-80 left text-right f-13  border-right padding-10px blue">GrandTotal</div>
				<div class="col-md-20 left text-center padding-10px f-13 b-bold ">Rs. 
				<?
				$total_amount = ($get->get_order_total()+$deliveryamount)-$_SESSION['coupen_dis'];
				?>
				<? if($total_amount < 0): echo 0; else: echo number_format($total_amount); endif; ?></div>
			<!-- grand total end here-->
			</div>
			<!-- heading end here-->
		</div>
        </form>	
	
	<!-- billing addess end here-->
	
		
		<div class="col-md-100 left padding-10px border-1 margin-top-bottom-20px discount-coupon">
			<h4 class="disc-cup-heading">DISCOUNT COUPON</h4>
			<form action="" method="post" >
			<div class="col-md-30 left"><input type="text" placeholder="Discount Code (815561)" value="<?=$_SESSION['coupon_code']?>" name="coupon_code" class="border-1 left col-md-100 padding-5px"></div>
			<div class="col-md-15 left padding-left-10px"><input type="submit" value="Apply Coupon" name="applycopen" class="f-13 col-md-100 left submit-btn padding-5px"></div>
			<div class="clear-both"></div>
			<? if($total_amount < 0):?><div class="mgs success col-md-60">
			<?  echo 'Rs. '.$total_amount.' left in coupon. It will discard if you processed. <a href="'.$site_url.'" style="color:#FFF">SHOP MORE</a>';  ?>
			</div><? endif; ?>
			</form>
		</div>
		
		
		<? if($total_amount < 0):?>	
		<div class="col-md-100 left select-payment-method">
			<h2><span class="steps-1">3</span>PAYMENT METHOD</h2>			
			<div class="search_area_left left col-md-100">
				<ul class="tabs">						
					<li onclick="showareaonload(3);" id="tabs_3" class="tabs_payment">CONFORM ORDER</li>	
				</ul>
				<div class="search_area_right left">
				 <ul>
				 <li class="cards" id="credit_card_3">
				<div class="txtCaptcha-info">
                <input id="txtCaptcha" type="text" readonly="" style="background-color:#fff; color:#333; text-align:center; width:80px;">
				<a href="#0"><img src="images/captcha.gif" width="18" style=" padding-top:5px;" onClick="DrawCaptcha();"></a>
				<br>
				<input id="getCaptcha" name="getCaptcha" type="text" placeholder="Enter the above code." style="background-color:#fff; color:#333;">
				</div>
				<div class="txtCaptcha-para">
				  <b>Verify Order</b><br>
                  Type the characters you see in the image on the left. Letters shown are not case-sensitive.
				</div>
				<br/>
				<br/>
				<button class="btn btn-success btn-checkout pay_now" title="Pay Now" value="COD" type="button" autocomplete="off">CONFIRM ORDER</button>
				</li>		
				</ul>
				</div>
				<div>
				<ul class="tabs1">						
					<li class="tabs_payment"><span class="tabs_payment-left">Total</span> <span class="tabs_payment-right">Rs. <?=number_format($get->get_order_total())?></span>
					</li>
					<li class="tabs_payment"><div class="tabs_payment-up">Amount Payable</div> <div class="tabs_payment-down">Rs.<? if($total_amount < 0): echo 0; else: echo number_format($total_amount); endif; ?></div></li>
					
				</ul>
				</div>
				</div>
		</div>
		<? else: ?>
		<div class="col-md-100 left select-payment-method">
			<h2><span class="steps-1">3</span>PAYMENT METHOD</h2>			
			<div class="search_area_left left col-md-100">
				<ul class="tabs">						
					<li onclick="showareaonload(3);" id="tabs_3" class="tabs_payment">COD</li>	
					<!--<li onclick="showareaonload(1);" id="tabs_1" class="tabs_payment">Online Payment</li>-->
					
				</ul>
				<div class="search_area_right left">
				 <ul>
				 <li class="cards" id="credit_card_3">
				<div class="txtCaptcha-info">
                <input id="txtCaptcha" type="text" readonly="" style="background-color:#fff; color:#333; text-align:center; width:80px;">
				<a href="#0"><img src="<?=$site_url?>/img/captcha.gif" width="18" style=" padding-top:5px;" onClick="DrawCaptcha();"></a>
				<br>
				<input id="getCaptcha" name="getCaptcha" type="text" placeholder="Enter the above code." style="background-color:#fff; color:#333;">
				</div>
				<div class="txtCaptcha-para">
				  <b>Verify Order</b><br>
                  Type the characters you see in the image on the left. Letters shown are not case-sensitive.
				</div>
				<br/>
				<br/>
				<button class="btn btn-success btn-checkout pay_now" title="Pay Now" value="COD" type="button" autocomplete="off">CONFIRM ORDER</button>
				</li>		
				 <li class="cards" id="credit_card_1">
					<p>When you click on 'Pay Now', you will be redirected to PayU to complete the transaction.</p>
					<fieldset class="form-list">
					<ul style="" id="payment_form_payu_cc">
					<li><img alt="Credit Cards" src="<?=$site_url?>/img/credit_cards.jpg">
					<img alt="payamerican" src="<?=$site_url?>/img/pay-american.jpg">
					</li>     
					</ul>
					</fieldset>
					<br/>
					<img class="btn pay_now btn-checkout" alt="PayUMoney" src="<?=$site_url?>/img/payu.jpg" style="cursor:pointer">
				</li>				
				</ul>
				</div>
				<div>
				<ul class="tabs1">						
					<li class="tabs_payment"><span class="tabs_payment-left">Total</span> <span class="tabs_payment-right">Rs. <?=number_format(($get->get_order_total()+$deliveryamount)-$_SESSION['coupen_dis'])?></span>
					</li>
					<li class="tabs_payment"><div class="tabs_payment-up">Amount Payable</div> <div class="tabs_payment-down">Rs.<?=number_format(($get->get_order_total()+$deliveryamount)-$_SESSION['coupen_dis'])?></div></li>
					
				</ul>
				</div>
				</div>
		</div>
		<? endif; ?>
	</div>	

</div>
	</div>			
			
				
		</div>
	</div>
   </div>
 </section>

<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->
<script src="<?=$site_url?>/js/jquery.min.js"></script>
<script src="<?=$site_url?>/js/globle.js"></script>
<script>
<? if(!$get->get_website_session()): ?>
$('#red_home').show();
$('#login_close').hide();
$('#signup_close').hide();
$('#popup-login').show();
<? endif; ?>
</script>	
</body>
</html>