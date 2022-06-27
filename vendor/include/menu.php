<?
$pageName = basename($_SERVER['PHP_SELF']);
$vendor_url = VENDOR_PATH;
if($pageName == 'index.php'){
	$activeDashboard = 'class="currentnav"';
} else if($pageName == 'orders.php'){
	$activeOrders = 'class="currentnav"';
} else if($pageName == 'category.php'){
	$activeCategory = 'class="currentnav"';
} else if($pageName == 'product.php'){
	$activeProduct = 'class="currentnav"';
} else if($pageName == 'review.php'){
	$activeReview = 'class="currentnav"';
} else if($pageName == 'user.php'){
	$activeUser = 'class="currentnav"';
} else if($pageName == 'coupon.php'){
	$activeCoupon = 'class="currentnav"';
} else if($pageName == 'content.php'){
	$activeContent = 'class="currentnav"';
} else if($pageName == 'content.php'){
	$activeContent = 'class="currentnav"';
} else if($pageName == 'slider.php'){
	$activeSlider = 'class="currentnav"';
} else if($pageName == 'attributes.php'){
	$activeAttributes = 'class="currentnav"';
} else if($pageName == 'ads.php'){
	$activeAds = 'class="currentnav"';
} else if($pageName == 'combo.php'){
	$activeCombo = 'class="currentnav"';
} else if($pageName == 'brands.php'){
	$activeBrands = 'class="currentnav"';
}  else if($pageName == 'home_middle.php'){
	$activeMiddle = 'class="currentnav"';
} else if($pageName == 'setting.php'){
	$activeSetting = 'class="currentnav"';
} else if($pageName == 'sale.php'){
	$activeSale = 'class="currentnav"';
}

?> 



<div  class="menu_list"> 
<!--Code for menu starts here-->
<div>
  <a name="ex2" id="ex2"></a>
  <ul id="accordion">
  
	<li <?=$activeDashboard?>><a href="<?=$vendor_url?>/index.php" rel='tab'>Dashboard</a></li>
	
	<li <?=$activeOrders?>>
		<a href="#" rel='tab'> Listing 
			<ul class="dropdown">
			   
				<a href="<?=$vendor_url?>/product.php?role=view"><li>Manage Products</li></a>
				<?
				/*
				<li><a href="#">Manage Attribute</a>
					<ul class="dropdown2">
						<a href="<?=$vendor_url?>/attributes.php?role=view"><li>Manage Attribute</li></a>
						<a href="<?=$vendor_url?>/attributes-group.php?role=view"><li>Manage Attribute Group</li></a>
					</ul>	
				</li>
				 <a href="<?=$vendor_url?>/product_detail_group.php?role=view"><li>Product Detail Group</li></a>
				 <a href="<?=$vendor_url?>/product_detail_attribute.php?role=view"><li>Product Detail Attribute</li></a>
				 */
				 ?>
			</ul>
		</a>
	</li>
	
	<li <?=$activeOrders?>>
		<a href="<?=$vendor_url?>/orders.php?role=view" rel='tab'> Orders 
			<ul class="dropdown">		
				<li><a href="<?=$vendor_url?>/orders.php?role=view">Manage Order</a></li>
				<li><a href="<?=$vendor_url?>/orders.php?role=view&status=pending">Pending Order</a></li>
				<li><a href="<?=$vendor_url?>/orders.php?role=view&status=complete">Complete Order</a></li>
				<li><a href="<?=$vendor_url?>/orders.php?role=view&action=track">Tracking Order</a></li>
                <li><a href="<?=$vendor_url?>/cancel.php?role=view&action=track">Cancel Order</a></li>
				<li><a href="<?=$vendor_url?>/return.php?role=view&action=track">Return Order</a></li>
			</ul>
		</a>
	</li>
	
	<?/*<li <?=$activeOrders?>>
		<a href="#" rel='tab'> Accounts 
			<ul class="dropdown">	
				<li><a href="<?=$vendor_url?>/orders_invoice.php?role=view">Invoices</a></li>
			</ul>
		</a>
	</li>
	*/?>
	
	
	
	<!--<li <?//=$activeOrders?>>
		<a href="#" rel='tab'> Business 
			<ul class="dropdown">
				<li><a href="<?//=$vendor_url?>/complete-profile.php?role=view">Business Detail</a></li>
			</ul>
		</a>
	</li>-->
	
	
	<li <?=$activeOrders?>>
		<a href="#" rel='tab'> Graphical Representation of Sale 
			<ul class="dropdown">
				<li><a href="<?=$vendor_url?>/graph_sales.php?role=view">Detail</a></li>
			</ul>
		</a>
	</li>
	
	
	<li <?=$activeOrders?>>
		<a href="#" rel='tab'> Payment 
			<ul class="dropdown">
				<li><a href="<?=$vendor_url?>/total_payment.php?role=view">Total payment</a></li>
			</ul>
		</a>
	</li>
	
	<li <?=$activeOrders?>>
		<a href="<?=$vendor_url?>/agree_terms.php?role=view" rel='tab'>Agreed Terms</a>
	</li>
	
	<li <?=$activeOrders?>>
		<a href="<?=$vendor_url?>/change_password.php?role=view" rel='tab'>Change Password</a>
	</li>
	
	
	<?/*
	<li <?=$activeOrders?>>
		<a href="#" rel='tab'> CRM 
			<ul class="dropdown">
				<li><a href="<?=$vendor_url?>/user.php?role=view">Manage Customers</a></li>
				<li>
				<a href="#">Review and Ratings</a>
						<ul class="dropdown2">
							<li><a href="<?=$vendor_url?>/review.php?role=view&status=pending">Pending Reviews</a></li>
							<li><a href="<?=$vendor_url?>/review.php?role=view">All Reviews</a></li>
						</ul>
				</li>
				<li><a href="<?=$vendor_url?>/feedback.php?role=view">Feedback</a></li>
				<li><a href="<?=$vendor_url?>/testimonial.php?role=view">Testimonial</a></li>
			</ul>
		</a>
	</li>
	
	
	<li <?=$activeOrders?>>
		<a href="#" rel='tab'> CMS 
			<ul class="dropdown">
				<li><a href="<?=$vendor_url?>/content.php?role=view">Manage Pages</a></li>
				<li><a href="<?=$vendor_url?>/search-terms.php?role=view">Search Terms</a></li>
                <li><a href="<?=$vendor_url?>/notification.php?role=view">Notification</a></li>
			</ul>
		</a>
	</li>
	
	<li <?=$activeOrders?>>
		<a href="#" rel='tab'> Advertising and Promotions 
			<ul class="dropdown">
				<a href="<?=$vendor_url?>/coupon.php?role=view"><li>Manage Coupons</li></a>
				<a href="<?=$vendor_url?>/ads.php?role=view"><li>Manage Ads</li></a>
				<a href="<?=$vendor_url?>/slider.php?role=view"><li>Manage Slider</li></a>
				<a href="<?=$vendor_url?>/newsletter.php?role=view" rel='tab'><li>Manage Newsletter</li></a>
				<a href="<?=$vendor_url?>/manage-combo.php?role=view" rel='tab'><li>Manage Combo</li></a>
			</ul>
		</a>
	</li>
		
	
	<li <?=$activeOrders?>>
		<a href="#" rel='tab'> Settings 
			<ul class="dropdown">
				<a href="<?=$vendor_url?>/setting.php?role=view" rel='tab'><li <?=$activeSetting?>>General Settings</li>
				</a>
			</ul>
		</a>
	</li>
	
	<li <?=$activeOrders?>>
		<a href="#" rel='tab'>Newsletter Listing
			<ul class="dropdown">
				<li><a href="<?=$vendor_url?>/product-noti.php?role=view">Newsletter</a></li>
			</ul>
		</a>
	</li>
	*/?>
   
   <ul class="dropdown">
		<a href="<?=$vendor_url?>/thought.php?role=view"><li>Thought</li></a>
	</ul>
	</ul>
  </div>
<div style="clear:both"></div> 
 </div>