<?
include 'management/include/functions.php';
extract($_REQUEST);
$id = explode("/",$id);
$id = $id[0];
if(!is_numeric($id)){
header("");	
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
    <div class="col-md-100  order-details-pannal">
               <h2>Order Details</h2>
               <div class="col-md-50 left order-id-pannal-left">
                <div class="order-id-pannal">
                 <div class="order-id">Order ID</div>
                 <div class="order-id-number"><span class="no-flont-color">OD0075194506</span><small> (1 item)</small></div><small>
                </small></div><small>
				<div class="order-id-pannal">
					<div class="order-id">Order Date</div>
					<div class="order-id-number">20-Jun-2016</div>
				</div>   
				<div class="order-id-pannal">
					<div class="order-id">Amount Paid</div>
										<div class="order-id-number"><span class="no-flont-color Amount-icon"> Rs. 1595</span> <small class="order"> through COD</small></div>
				</div>
				
								
			</small></div><small>
			<div class="col-md-50 right order-id-pannal-right"><h3>praksh<small>9654328578</small></h3><p>
			sfa, sadfd, sdf, <br>Jharkhand - 110094</p>
			</div>
			<div class="clear-both"></div>
             </small></div>
     <div class="order-actions">
              <div class="table-head">MANAGE ORDER </div>
                <ul class="line">
                 <li><a href="#"><i id="print"></i>PRINT ORDER<div class="yellow-border"></div></a> </li>
                 <li><a href="#"><i id="invoice"></i>EMAIL INVOICE<div class="yellow-border"></div></a>  </li>
                 <li class="last"><a href="<?=$site_url?>/contact.html"><i id="contact-us"></i>CONTACT US<div class="yellow-border"></div></a> </li>
                </ul>
     </div>
	 <div class="col-md-100 left row bg-white shadow-1 margin-top-20px margin-bottom-20px" style=" border-bottom: 1px solid #CCC;">
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
						 					<li class="product">
						  	 						<div class="thumb">
							<a href="<?=$site_url?>/detail/237672848/gold-white-metal-alloy-beads-earrings"><img src="<?=$site_url?>/upload/product/thumb/th_product_363213320.jpg"></a>
							</div>
	 						<div class="product-disc">
	 							<h4 class="order-name"><a href="<?=$site_url?>/detail/237672848/gold-white-metal-alloy-beads-earrings">Gold, White Metal Alloy, Beads earrings</a></h4>
	 							<span class="qty">QTY: 1</span><br>
																												<span>
										<strong>Size:</strong>
										<small>Free</small>
										</span>
										<br>
																					 						</div>
						  	 					</li> 
						
						<li class="list">
	 						<div class="line-connect"></div>
	 						<div class="total-round">
							<span class="round checked current-status"></span>
								<div class="possition-status">
								<span class="title">Your order is in pending mode.</span>
								<ul class="timing">
																<li class="schdule">Jun 20, 2016 06:35:04 PM</li>
								<li class="schdule">Pending</li>
								</ul>
								</div>
	 						</div>
	 					</li>
						
						
						
						<li class="list">
							<div class="line-connect"></div>
							<div class="total-round">
								<span class="round  active">
									

							</span></div>
						</li>
						
						
						
						<li class="list processing">
							<div class="line-connect"></div>
							<div class="total-round">
							<span class="round active">
								
							</span></div>
						</li>
						
						
						<li class="list">
							<div class="line-connect"></div>
							<div class="total-round">
							<span class="round active"></span>
								
							</div>
						</li>
						
						
						<li class="list">
						    <div class="line-connect"></div>
							<div class="total-round">
							<span class="round active"></span> 
								
							</div>
						</li>
						
						
						<li class="list delivery">
														
								<span class="deliver-by">by Jun 24, 2016</span>
								<span class="deliver-type">Expected delivery date</span>
							 							
						</li>
						
						
	 					<li class="list sub-tol subtotal">Rs. 1,495						<br>
						</li>
						<div class="clear"></div>
						
	 				</ul>
	 				<div class="left col-md-100 padding-10px" style="">
	 					<div class="right">
						
											      <span class="f-14 margin-right-10px">Shipping</span><span class="f-22 b">Rs.
							100							</span>
													
						<span class="f-14 margin-right-10px">Total</span><span class="f-22 b">Rs. 1,595</span></div>
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
$('ul.sub-sub-cat').each(function(){
  
	  var LiN = $(this).find('li').length;
	  
	  if( LiN > 5){    
	    $('li', this).eq(4).nextAll().hide().addClass('toggleable');
	    $(this).append('<li class="more">More</li>');    
	  }
	  
	});

	$('ul.sub-sub-cat').on('click','.more', function(){
	  
	  if( $(this).hasClass('less') ){    
	    $(this).text('More').removeClass('less');    
	  }else{
	    $(this).text('Less').addClass('less'); 
	  }
	  $(this).siblings('li.toggleable').slideToggle();
	    
	}); 
</script>
</body>
</html>