<footer>
	<div class="footer-section">
		<div class="container">
			<div class="footer-top">
				<div class="privacy sec">
					<h3>Privacy Policy</h3>
					<ul>
						<li><a href="<?=$site_url?>/page/1775867624/cancalation&return">Cancalation & Return</a></li>
						<li><a href="<?=$site_url?>/page/3623/terms-of-use">Terms of use</a></li>
						<li><a href="<?=$site_url?>/page/1593917808/shipping&delivery">Shipping & Delivery</a></li>
						<li><a href="<?=$site_url?>/page/24695/terms&conditions">Terms & Conditions</a></li>
					</ul>
				</div>
				<div class="company sec">
					<h3>Company</h3>
					<ul>
						<li><a href="<?=$site_url?>/page/30629/about-us">About Us</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">Sitemap</a></li>
						<li><a href="#">Services</a></li>
					</ul>
				</div>
				<div class="contact sec">
					<h3>Contact Us</h3>
					<ul>
						<li><a href="<?=$site_url?>/page/21953/customer-support">Customer Support</a></li>
						<li><a href="<?=$site_url?>/page/358/merchant-support">Merchant Support</a></li>
						<li><a href="<?=$site_url?>/page/23719/press">Press</a></li>
						<li><a href="<?=$site_url?>/page/1364/merchant-support">Merchant Support</a></li>
					</ul>
				</div>
				<div class="help sec">
					<h3>Help</h3>
					<ul>
						<li><a href="<?=$site_url?>/page/376120459/faq">FAQ</a></li>
						<li><a href="<?=$site_url?>/page/17633/contact-us">Contact Us</a></li>
						
					</ul>
				</div>
				<div class="footer-bottom">
				<div class="social sec">
					<h3>Connect with Social</h3>
					<ul>
						<li><a href="<?=$get->get_facebook_url()?>" target="_BLANK"><i class="fa fa-facebook"></i></a></li>
						<li><a href="<?=$get->get_twitter_url()?>" target="_BLANK"><i class="fa fa-twitter"></i></a></li>
						<li><a href="<?=$get->get_google_plus_url()?>" target="_BLANK"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="<?=$get->get_linkedin_url()?>" target="_BLANK"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="<?=$get->get_youtube_url()?>" target="_BLANK"><i class="fa fa-youtube"></i></a></li>
					</ul>
				</div>
				
				<div class="payment sec">
					<h3>100% Secure & Trusted Payment</h3>
					
					<img src="<?=$site_url?>/img/payment.png" />
					<!----<ul>
						<li><a href="#" class="visa"></a></li>
						<li><a href="#" class="master-card"></a></li>
						<li><a href="#" class="mastro"></a></li>
						<li><a href="#" class="american"></a></li>
					</ul>--->
			</div>
			<?
			if(isset($_POST['SUBMIT']) && $_POST['SUBMIT']=='Submit')
			{
				 $response = $set->add_notification();
				 ?>
				<script>
				function Scrolldown() {
				window.scroll(0,3000); 
				}
				window.onload = Scrolldown;
				</script>
				 <?
			}
			?>
			<div class="newsletter sec">
			<?
					if($response==true)
					{
						?><p id="message" style="color:green;padding-bottom:10px;">Your notification submit successfully.</p><?
					}
					?>
					<form action="" method="post">
						<input required type="email" name="notify_me" placeholder="Enter Your Email Address">
						<input type="submit" name="SUBMIT" value="Submit">
					</form>
				</div>
			</div>
		</div>
		
		
		</div>
	</div>
	
	<div class="top-categories">
		<div class="container">
			<ul>
				<li>
				<b>Top Categories:</b>
				<p> 
				<?
				$cat_sql = mysql_query("SELECT * FROM category WHERE parent_id = 0 AND status = 'active' ORDER BY rand() LIMIT 10");
				$x=1;
				$count_cat= mysql_num_rows($cat_sql);
				while($res_cat = mysql_fetch_array($cat_sql))
				{
					$url_new = $site_url.'/listing/c-'.$res_cat['category_id'].'/'.$res_cat['category_name'];
					?>
					<a class="light-grey" href="<?=$url_new?>"><?=$res_cat['category_name']?></a>
					<? 
					if($x!=$count_cat)
					{
						echo ',';
					}
				    $x++;	
				}				
				?>
				
				
				
				
				</p>
				</li>
				
				<li><b>Top Brand:</b><p> <?
				$subcat_sql = mysql_query("SELECT * FROM category WHERE parent_id != 0 AND status = 'active' ORDER BY rand() LIMIT 10");
				$x=1;
				$count_cat= mysql_num_rows($subcat_sql);
				while($res_subcat = mysql_fetch_array($subcat_sql))
				{
					$url_new = $site_url.'/listing/c-'.$res_subcat['category_id'].'/'.$res_subcat['category_name'];
					?>
					<a class="light-grey" href="<?=$url_new?>"><?=$res_subcat['category_name']?></a>
					<? 
					if($x!=$count_cat)
					{
						echo ',';
					}
				    $x++;	
				}				
				?></p></li>
				<li><b>About Onlinevandy:</b><p><?=strip_tags($get->get_content(30629))?></p></li>
			</ul>
		</div>
	</div>
	<div class="copyright">
		<div class="container">
			<p class="copyright-p"><?=$get->get_copyright()?></p>
			<p class="company-link">Design & Developed by <a href="http://idigitie.com">IDIGITIE</a></p>
		</div>
	</div>
	
</footer>


<!----------services pop up---->


<!--<div id="services-pop-up">
<div class="reset-all-btn"><img src="img/icon/white-icon.png" /></div>
  <div class="services-form">
     <div class="heading">Request of Service</div>
	 <span id="service-response"></span>
	 <form id="service_request" name="service_request" action="" method="post" >
	    <ul>
		  <li>
		     <label>First Name</label>
			 <input type="text" placeholder="Enter your full name" name="fname" id="fname1" />
		  </li>
		  <li>
		     <label>Last Name</label>
			 <input type="text" placeholder="Enter your full name" name="lname" id="lname1" />
		  </li>
		  <li>
		     <label>Email</label>
			 <input type="email" placeholder="Enter your Email " name="email" id="email1" />
		  </li>
		  <li>
		     <label>Phone</label>
			 <input type="text" placeholder="Enter your Phone" name="phone" id="phone1" />
		  </li>
		
		  <li>
		     <label>Pincode</label>
			 <input type="text" placeholder="Enter your Pincode" name="pincode" id="pincode1" />
		  </li>
		  <li>
		     <label>City</label>
			 <input type="text" placeholder="Enter your City" name="city" id="city1" />
		  </li>
		  <li>
		     <label>Brand</label>
			 <input type="text" placeholder="Enter  Brand" name="brand" id="brand1" />
		  </li>
		  <li>
		     <label>Model</label>
			 <input type="text" placeholder="Enter  Model" name="model" id="model1" />
		  </li>
		<li>
		     <label>Date</label>
			 <input type="date" placeholder="Enter  Date" name="date" id="date1" />
		  </li>
		  <li>
		     <label>Name of Product</label>
			 <input type="text" placeholder="Enter Name of Product" name="no_of_product" id="no_of_product1" />
		  </li>	
			<li>
		     <label>Address</label>
			 <textarea placeholder="Enter your Address" name="address" id="address1"></textarea>
		  </li>		  
		  <li>
			 <input type="submit" value="Submit" name="submit" id="submit_request" />
		  </li>
		</ul>
	 </form>
  </div>
</div>-->


<div id="request-product-pop-up">
<div class="reset-all-btn"><img src="<?=$site_url?>/img/icon/white-icon.png" /></div>
  <div class="services-form">
     <div class="heading">Request of Products</div>
	 <form name="product_form" id="product_form" action="" method="post" enctype="multipart/form-data">
	 <input type="hidden" name="request_of_products" id="request_of_products" value="REQUEST OF PRODUCTS">
	    <ul>
		  <li>
		     <label>Full Name</label>
			 <input type="text" placeholder="Enter your full name" name="request_name" id="request_name" />
		  </li>
		  <li>
		     <label>Email</label>
			 <input type="email" placeholder="Enter your Email" name="request_email" id="request_email"/>
		  </li>
		  <li>
		     <label>Phone</label>
			 <input type="text" placeholder="Enter your full name" name="request_phone" id="request_phone" />
		  </li>
			<li>
		     <label>Company Name/ Store Name</label>
			 <input type="text" placeholder="Enter your Company Name/ Store Name" name="request_company_name" id="request_company_name"/>
		  </li>
		  
		  
			 <li>
			<label>Main Category </label>
			<select class="select-option" name="main_category" id="main_category" onchange="show_subcategory(this.value)">
			<option value="">Select Category</option>
				<?
				$main_cat_sql = mysql_query("SELECT * FROM category WHERE parent_id = 0 AND status = 'active'") or die(mysql_error());
				while($main_cat_record = mysql_fetch_array($main_cat_sql)){
				?>															
				<option  <? if($main_cat_record['category_id'] == $_REQUEST['main_category']){ ?> selected <? } ?> value="<?=$main_cat_record['category_id']?>" >
				<?=$main_cat_record['category_name']?></option>
				<? } ?>	
			</select>
			  </li>
			  
			  
			 <div id="display_sub_category"> 
				<li>
				 <label>Category </label>
				 <select name="sub_category" id="sub_category" onchange="show_sub_subcategory(this.value)">
					<option>Select Category</option>			    
				 </select>
			   </li>
		  </div>
		  
		  
		  <div id="display_sub_subcategory"> 
			<li>
		     <label>Sub Category </label>
			<select name="sub_subcategory" id="sub_subcategory" onchange="show_productby('<?=$maincatid?>','<?=$mainsubcatid?>',this.value)">
					<option>Select Subcategory</option>			    
				 </select>
		  </li>
		  </div>
		  
			 <div id="display_product_by_cat"> 
			<li>
		     <label>Products </label>
			 <select name="product_info" id="product_info">
			    <option>Select Product</option>			    
			 </select>
		  </li>
		  </div>
		  
		  <li>
		     <label>Message</label>
			 <textarea name="request_message" id="request_message"></textarea>
		  </li>
		  <li>
			 <input type="submit" value="Submit" id="product-button"/>
		  </li>
		</ul>
	 </form><div id="show_response"></div>
  </div>
</div>
<div class="services-overlay"></div>

<div id="request-right-product-btn"><img src="<?=$site_url?>/img/quiry.jpg" /></div>