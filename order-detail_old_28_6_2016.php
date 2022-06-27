<?php
include 'management/include/functions.php';
extract($_REQUEST);

if($get->get_website_session() =="")
{
	header("Location: $site_url");
}


$user_id = $get->get_website_session();

$order = explode("/",$id);
$order_id = $order[0];

$selectorder = "SELECT * FROM order_prodcut_details WHERE orderid='$order_id'";
$query = mysql_query($selectorder);
$row=mysql_fetch_array($query);
extract($row);

$selecttotalorder = "SELECT * FROM order_details WHERE orderid='$order_id' ORDER BY id DESC";
$querya = mysql_query($selecttotalorder);
$row_a = mysql_fetch_array($querya);
extract($row_a);

$selectcustomer = "SELECT * FROM order_customer_details WHERE orderid='$order_id' ORDER BY id DESC";
$queryb = mysql_query($selectcustomer);
$row_b = mysql_fetch_array($queryb);
extract($row_b);

$selectorderattribute = "SELECT * FROM order_prodcut_attribute WHERE orderid='$order_id' AND attribute_id > 0";
$queryc = mysql_query($selectorderattribute);
$row_c = mysql_num_rows($queryc);



if(isset($_POST['cancel']) && $_POST['cancel']=='Confirm Cancellation')
{
	
	$confirm =  $set->confirm_cancellation($_POST);
	
	if($confirm == 'true')
	{
		$msg = 'You have successfully canceled this order.';
	}
}
if(isset($_POST['return']) && $_POST['return']=='Confirm Return')
{
	
	//echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$confirm_return =  $set->confirm_return($_POST);
	if($confirm_return == 'true')
	{
		$msg_return = 'Your request for return this order have been placed successfully.';
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
	<link href="<?=$site_url?>/font/font.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font2.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font3.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
</head>	
<body>
<!--header start here-->
   <? include 'inc/header.php'; ?>
<!--header end here-->
<!-- main container strat here-->

<div class="main-heading">
	<div class="container">
		<div class="breadcrumb">
		<ul>
			<li><a href="<?=$site_url?>">Home</a></li>
			<li><?=$get->get_content_title($id)?></li>
		</ul>
		</div>
	</div>
</div>
<section id="all-cat">
  <div class="container">
    <div class="col-md-100 left">
		<h2 style="font-size: 24px;color:#545454;"><?=$get->get_content_title($id)?></h2>
		<span style="font-size:13px;color:#888;text-align:justify;"><?=$get->get_content($id)?></span>
	</div>
  </div>
</section>
<div class="main-container detail-page ">
	<!-- header start here-->
	<!-- header end here-->


	<!-- left menu end here-->
	<span class="margin-top-setting"></span>

	<div class="bg-body">
	<div class="container">
          <!--breadcurmb is close-->
		
		<?if(isset($msg)){ ?><p style="color:green;text-align:center;padding-bottom:8px;"><?=$msg?> </p><? } ?>
		<?if(isset($msg_return)){ ?><p style="color:green;text-align:center;padding-bottom:8px;"><?=$msg_return?> </p><? } ?>
		
		
		<div class="clear-both"></div>
		 <div class="col-md-100  order-details-pannal">
               <h2>Order Details</h2>
               <div class="col-md-50 left order-id-pannal-left">
                <div class="order-id-pannal">
                 <div class="order-id">Order ID</div>
                 <div class="order-id-number"><span class="no-flont-color"><?=$orderid?></span><small> (<?=$row_c?> item)</div>
                </div>
				<div class="order-id-pannal">
					<div class="order-id">Order Date</div>
					<div class="order-id-number"><? $date = $orderdate; echo date('d-M-Y', strtotime($date)); ?></div>
				</div>   
				<div class="order-id-pannal">
					<div class="order-id">Amount Paid</div>
					<?$deliveryamount = $get->get_delivery_charges(); ?>
					<div class="order-id-number"><span class="no-flont-color Amount-icon"> Rs. <?
						$amount = (($total_amount+$deliveryamount)-$coupon_amount);
						if($coupon_amount !=0){
							echo '<strike>'.($total_amount+$deliveryamount).'</strike> &nbsp;';
							if($amount < 0): echo 'Rs. 0'; else: echo 'Rs. '.(($total_amount+$deliveryamount)-$coupon_amount); endif;
						} else {
							if($amount < 0): echo 'Rs. 0'; else: echo ($total_amount+$deliveryamount);	endif; 
						}
						?></span> <small class="order"> through <?=$payment_method?></small></div>
				</div>
				
				<?
				$cancel_status = $get->is_cancel_order($orderid);
				$return_status = $get->is_return_order($orderid);
				if($cancel_status==true){ ?>
				<div class="order-id-pannal"><div class="order-id">Order Status</div><small class="order">Cancelled</small></div>
				<? }
				if($return_status==true){ ?>
				<div class="order-id-pannal"><div class="order-id">Order Status</div><small class="order">Return</small></div>
				<? } ?>
				
			</div>
			<div class="col-md-50 right order-id-pannal-right"><h3><?=$billname?><small><?=$billcontact?></small></h3><p>
			<?=$billaddress?>, <?=$billlandmark?>, <?=$billcity?>, <br><?=$billstate?> - <?=$billzip?></p>
			</div>
			<div class="clear-both"></div>
             </div>
             <div class="clear-both"></div>
             <div class="order-actions">
              <div class="table-head">MANAGE ORDER </div>
                <ul class="line">
                 <li><a href="#"><i id="print"></i>PRINT ORDER<div class="yellow-border"></div></a> </li>
                 <li><a href="#"><i id="invoice"></i>EMAIL INVOICE<div class="yellow-border"></div></a>  </li>
                 <li class="last"><a href="<?=$site_url?>/contact.html"><i id="contact-us"></i>CONTACT US<div class="yellow-border"></div></a> </li>
                </ul>
             </div>
             
              <div class="clear-both"></div>
	 			
	 			<div class="row bg-white shadow-1 margin-top-20px margin-bottom-20px" style=" border-bottom: 1px solid #CCC;">
	 				<ul class="delivery-proccess">
	 					<li class="title product-name-title">Product /Combo Details</li>
						<li class="title approval">Pending</li>
	 					<li class="title approval">Approval</li>
	 					<li class="title processing">Processing</li>
	 					<li class="title shipping">Dispatch</li>
						<li class="title shipping">Complete</li>
	 					<li class="title delivery">Delivery</li>
	 					<li class="title subtotal">Subtotal</li>
	 				</ul>
					
	 				<ul class="product-delivery-proccess">
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
	 					<li class="product">
						  <? if($url !=''){ ?>
	 						<div class="thumb">
							<a href="<?=$site_url?>/detail/<?=$prod_id?>/<?=$url?>"><img src="<?=$site_url?>/upload/product/thumb/th_<?=$get->get_single_product_img($prod_id)?>"></a>
							</div>
	 						<div class="product-disc">
	 							<h4 class="order-name"><a href="<?=$site_url?>/detail/<?=$prod_id?>/<?=$url?>"><?=$get->get_product_name($prod_id)?></a></h4>
	 							<span class="qty">QTY: <?=$qty?></span><br/>
								<? 
								/*$selectorderattribute = "SELECT * FROM order_prodcut_attribute WHERE orderid='$order_id' AND attribute_id > 0 AND prod_id ='$prod_id' ";
								$queryc = mysql_query($selectorderattribute);
								$row_c = mysql_num_rows($queryc);
								if($row_c > 0)
								{
										while($result_option = mysql_fetch_array($queryc))
										{
										$aid = $result_option['attribute_id'];	
										$aoid = $result_option['attribute_option_id'];*/
										
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
						  <? } else {?>
						    <div class="thumb">
							<a href="<?=$site_url?>/detail/<?=$prod_id?>/<?=$url_combo?>"><img src="<?=$site_url?>/upload/combo/thumb/th_<?=$get->get_single_combo_img($prod_id)?>"></a>
							</div>
	 						<div class="product-disc">
	 							<h4 class="order-name"><a href="<?=$site_url?>/detail/<?=$prod_id?>/<?=$url_combo?>"><?=$get->get_combo_name($prod_id)?></a></h4>
	 							<span class="qty">QTY: <?=$qty?></span><br/>
	 						</div>
						  <? } ?>
	 					</li> 
						
						<li class="list">
	 						<div class="line-connect"></div>
	 						<div class="total-round">
							<span class="round checked <?if($status == 'pending'){ echo 'current-status';}?>"></span>
								<div class="possition-status">
								<span class="title">Your order is in pending mode.</span>
								<ul class="timing">
								<? $d = date_create($orderdate);?>
								<li class="schdule"><?=date_format($d,"M d, Y h:i:s A");?></li>
								<li class="schdule">Pending</li>
								</ul>
								</div>
	 						</div>
	 					</li>
						
						
						
						<li class="list">
							<div class="line-connect"></div>
							<div class="total-round">
								<span class="round  <?if($status == 'approval'){ echo 'checked current-status';}elseif($status == 'processing' || $status == 'dispatch'|| $status == 'complete'){ echo 'checked'; } else{ echo 'active'; }?>">
								<?
								$sql_track = mysql_query("SELECT * FROM order_tracking WHERE orderid = '".$orderid."' and status = 'approval' ORDER BY id DESC");
								$order_track  = mysql_fetch_array($sql_track);
								$count = mysql_num_rows($sql_track);
								if($count >0){
								?>
								<div class="possition-status">
								<span class="title"><?if($order_track['comment']!=''){ echo $order_track['comment']; }?></span>
								<ul class="timing">
								<li class="schdule"><?=$order_track['date']?></li>
								<li class="schdule">Approval</li>
								</ul>
								</div>
								<? } ?>	

							</div>
						</li>
						
						
						
						<li class="list processing">
							<div class="line-connect"></div>
							<div class="total-round">
							<span class="round <?if($status == 'processing'){ echo 'checked current-status';}elseif($status == 'dispatch'|| $status == 'complete'){ echo 'checked'; }else{ echo 'active'; }?>">
							<?
							$sql_track = mysql_query("SELECT * FROM order_tracking WHERE orderid = '".$orderid."' and status = 'processing' ORDER BY id DESC");
							$order_track  = mysql_fetch_array($sql_track);
							$count = mysql_num_rows($sql_track);
							if($count >0){
							?>
							<div class="possition-status">
							<span class="title"><?if($order_track['comment']!=''){ echo $order_track['comment']; }?></span>
							<ul class="timing">
							<li class="schdule"><?=$order_track['date']?></li>
							<li class="schdule">Processing</li>
							</ul>
							</div>
							<? } ?>	
							</div>
						</li>
						
						
						<li class="list">
							<div class="line-connect"></div>
							<div class="total-round">
							<span class="round <?if($status == 'dispatch'){ echo 'checked current-status';}elseif($status == 'complete'){ echo 'checked'; }else{ echo 'active'; }?>"></span>
							<?
							$sql_track = mysql_query("SELECT * FROM order_tracking WHERE orderid = '".$orderid."' and status = 'dispatch' ORDER BY id DESC");
							$order_track  = mysql_fetch_array($sql_track);
							$count = mysql_num_rows($sql_track);
							if($count >0){
							?>
							<div class="possition-status">
							<span class="title"><?if($order_track['comment']!=''){ echo $order_track['comment']; }?></span>
							<ul class="timing">
							<li class="schdule"><?=$order_track['date']?></li>
							<li class="schdule">Dispatch</li>
							</ul>
							</div>
							<? } ?>	
							</div>
						</li>
						
						
						<li class="list">
						    <div class="line-connect"></div>
							<div class="total-round">
							<span class="round <?if($status == 'complete'){ echo 'checked current-status';}else{ echo 'active'; }?>"></span> 
							<?
							$sql_track = mysql_query("SELECT * FROM order_tracking WHERE orderid = '".$orderid."' and status = 'complete' ORDER BY id DESC");
							$order_track  = mysql_fetch_array($sql_track);
							$count = mysql_num_rows($sql_track);
							if($count >0){
							?>
							<div class="possition-status">
							<span class="title"><?if($order_track['comment']!=''){ echo $order_track['comment']; }?></span>
							<ul class="timing">
							<li class="schdule"><?=$order_track['date']?></li>
							<li class="schdule">Complete</li>
							</ul>
							</div>
							<? } ?>	
							</div>
						</li>
						
						
						<li class="list delivery">
						<? if($url !=''){ 
						 
						     if(($get->product_delivery_for_order($orderid,$prod_id))!= ''){ ?>
								<?if($status == 'complete'){ ?>

								<span class="deliver-by"><?=$order_track['date']?></span>
								<span class="deliver-type">Delivered date</span>
								<span class="deliver-by cut">by <?=$get->product_delivery_for_order($orderid,$prod_id)?></span>
								<span class="deliver-type">Expected delivery date</span>

								<? }else{ ?>

								<span class="deliver-by">by <?=$get->product_delivery_for_order($orderid,$prod_id)?></span>
								<span class="deliver-type">Expected delivery date</span>
							 <? } }?>
						<? } else {?>
								<?if($status == 'complete'){ ?>

								<span class="deliver-by"><?=$order_track['date']?></span>
								<span class="deliver-type">Delivered date</span>
								<span class="deliver-by cut">by <?=$get->combo_delivery_for_order($orderid,$prod_id)?></span>
								<span class="deliver-type">Expected delivery date</span>

								<? }else { ?>

								<span class="deliver-by">by <?=$get->combo_delivery_for_order($orderid,$prod_id)?></span>
								<span class="deliver-type">Expected delivery date</span>
								<? } ?>
							<? } ?>	
						</li>
						
						
	 					<li class="list sub-tol subtotal">Rs. <?=number_format($price*$qty)?>
						<br/>
						</li>
						<div class="clear"></div>
					<? endwhile; ?>	
	 				</ul>
	 				<div class="left col-md-100 padding-10px" style="">
	 					<div class="right">
						
						<?if($deliveryamount > 0)
						{ ?>
					      <span class="f-14 margin-right-10px">Shipping</span><span class="f-22 b">Rs.
							<?=$deliveryamount; ?>
							</span>
							<?
						}
						?>
						
						<span class="f-14 margin-right-10px">Total</span><span class="f-22 b">Rs. <?
						$amount = (($total_amount+$deliveryamount)-$coupon_amount);
						if($coupon_amount !=0){
							echo '<strike>'.number_format($total_amount+$deliveryamount).'</strike> &nbsp;';
							if($amount < 0): echo 'Rs. 0'; else: echo 'Rs. '.number_format(($total_amount+$deliveryamount)-$coupon_amount); endif;
						} else {
							if($amount < 0): echo 'Rs. 0'; else: echo number_format($total_amount+$deliveryamount);	endif; 
						}
						?></span></div>
	 				</div>
	 			</div>
            
            </div>
	</div>
	

	<!-- footer start here-->
	<? include 'inc/footer.php'; ?>
	<!-- footer end here-->
</div>
<!-- main container end here-->

<script src="<?=$site_url?>/js/min.js"></script>
<script src="<?=$site_url?>/js/globle.js"></script>
	<script>
$(document).ready(function () {
  //called when key is pressed in textbox
  $(".qty_box").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});
</script>
<script src="<?=$site_url?>/plugin/owl/js/owl.carousel.js"></script>
<script type="text/javascript" src="<?=$site_url?>/plugin/zoom/js/jqzoom.js"></script>
<script src="<?=$site_url?>/plugin/number-plus-minus/number.js" ></script>

<SCRIPT TYPE="text/javascript">

$('.after').bootstrapNumber();
$('.colorful').bootstrapNumber({
	upClass: 'success',
	downClass: 'danger'
});

$("#bzoom").zoom({
	zoom_area_width: 410,
	autoplay_interval :3000,
	small_thumbs : 4,
	autoplay : false
});

  $(".slider-5-items").owlCarousel({
   items : 5,
    navigation : true,
    trueslideSpeed : 300,
	paginationSpeed : 500,
	autoPlay : 5000,
	autoplayTimeout:500,    
	responsive: true,
	responsiveRefreshRate : 200,
	responsiveBaseWidth: window,
  });

  $(".brands-slider").owlCarousel({
   items : 6,
    navigation : true,
    trueslideSpeed : 300,
	paginationSpeed : 500,
	autoPlay : 5000,
	autoplayTimeout:500,    
	responsive: true,
	responsiveRefreshRate : 200,
	responsiveBaseWidth: window,
  });


$(window).scroll(function(){
  var megamenu = $('.header'),
      scroll = $(window).scrollTop();

  if (scroll >= 200) megamenu.addClass('fixedheader');
  else megamenu.removeClass('fixedheader');
});


$(window).scroll(function(){
  var megamenu = $('.left-menu'),
      scroll = $(window).scrollTop();

  if (scroll >= 200) megamenu.addClass('scroll-left-menu');
  else megamenu.removeClass('scroll-left-menu');
});


</SCRIPT>
</body>
</html>