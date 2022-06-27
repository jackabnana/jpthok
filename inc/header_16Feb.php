<?
if(isset($_POST['Submit']))
{
	$q = $_POST['q'];
	//$sql_cat = mysql_query("SELECT * FROM category WHERE category_name like '$q%' AND status= 'active' ");
	//$res_cat = mysql_fetch_array($sql_cat);
	$url = $site_url.'/listing/c-'.$q;
	header("Location: $url");	
}
?>
<div id="alert-poup" class="alert-popup">
			Thankyou for your interest..our business support team will get back to you in 48 hours
		</div>
<header>
	<div class="language-conveter"><div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script></div>

<script>
	function hide_login(){		
		$("#login-response").html('');
		$('.popup').hide();
		
		
	}
</script> 
        
		<div class="header-top">
			<div class="container">
				<div class="logo"><a href="<?=$site_url?>"><img src="<?=$site_url?>/upload/comman/<?=$get->get_logo()?>"></a></div>
				<div class="search">
					<form method="post" action="">
					
							<input type="text" autocomplete="off" onkeyup="search(this.value)" name="q" id="q" class="input" placeholder="Please search for products...">
							<img src="<?=$site_url?>/img/loading-x.gif" style="position:absolute;right:580px;margin-top:10px;display:none;" id="search_loading" width="22px">
							<ul class="search-result col-md-45_5" id="search_response">
							</ul>
							<input type="submit" value="" name="Submit">
						
						<select id="navigation">
						<option value="">All Categories</option>
						<?
						$cat_sql = mysql_query("SELECT * FROM category WHERE parent_id = 0 AND status = 'active' LIMIT 7");
						while($res_cat = mysql_fetch_array($cat_sql))
						{
							$url_new = $site_url.'/listing/c-'.$res_cat['category_id'].'/'.$res_cat['category_name'];
							?>
							<option value="<?=$url_new?>"><a href=""><?=$res_cat['category_name']?></a></option>
							<? 
						} 
						?>
						</select>
					</form>
					
				</div>
				<div class="accout-section">
				<? 
				
				     //echo '<pre>';
					 //print_r($_SESSION);
					 //echo '</pre>';
					 
				    if($_SESSION['websiteuser'] > 0): ?>
					<ul class="q-links">
					<li class="list my-account">
						<a href="#0" class="page-name">My Account<img src="<?=$site_url?>/img/drop.png" class="margin-left-3px right"></a>
						
						<ul class="cart-drop">
							<span class="user-name">HI <?=$get->get_user_first_name($get->get_website_session())?></span>
							<li class="page-list">
							   <a href="change-password.php" class="page-name">
							      <img src="<?=$site_url?>/img/icon/cp.png">Change Password</a>
						    </li>
							<li class="page-list">
							  <a href="<?=$site_url?>/edit-profile.php" class="page-name">
							   <img src="<?=$site_url?>/img/icon/ai.png">Account Info</a></li>
							<li class="page-list">
							  <a href="<?=$site_url?>/order-history.php" class="page-name">
							     <img src="<?=$site_url?>/img/icon/oh.png">Order History</a>
						    </li>
							<li class="page-list">
							  <a href="<?=$site_url?>/wishlist.php" class="page-name">
							     <img src="<?=$site_url?>/img/icon/wh.png">My Wishlist</a>
							</li>
							<li class="page-list">
							   <a href="<?=$site_url?>/index.php?logout=yes&style=simple&lastupadte=modify" class="page-name">
							    <img src="<?=$site_url?>/img/icon/lo.png">Logout</a>
							</li>
							
						</ul>
					</li>
				    </ul>	 
					 
					<? else: ?>
					<ul>
					    <li>
						
<a href="#0" class="login-btn" id="login"><i class="fa fa-sign-in"></i> Login</a></li>
						<li><a href="#0" class="signin-btn" id="signup"><i class="fa fa-user-plus"></i>
 Sign up</a>
						</li>
						<li><a href="#0" class="signin-btn" id="signup-vendor"><i class="fa fa-user-plus"></i>
 Sell with Us</a>
						</li>
					</ul>
					<!--<li><a href="#" id="login"><i class="fa fa-user"></i> Login</a></li>
					<li><a href="#" id="signup"><i class="fa fa-sign-in"></i> Register</a>-->
					<? endif; ?>
				</div>
			</div>
		</div>
	</header>
	
	
	<nav>
	<div class="category-h">
		<h3>Categories <img src="<?=$site_url?>/img/icon/bar.png"></h3>
		<?
		$base_url = basename($_SERVER['PHP_SELF']);
		if($base_url!= "index.php")
		{
		?>
			<div class="all-categories-section">
			 <ul>
				<?
				$cat_sql = mysql_query("SELECT * FROM category WHERE parent_id = 0 AND status = 'active' ");
				$count_cat= mysql_num_rows($cat_sql);
				while($res_cat = mysql_fetch_array($cat_sql))
				{
					$url_new = $site_url.'/listing/c-'.$res_cat['category_id'].'/'.$res_cat['category_name'];
					?>
					<li><a class="light-grey" href="<?=$url_new?>"><?=$res_cat['category_name']?></a></li>
					<?	
				}				
				?>
			 </ul>
			</div>
		<? 
		}
		?>
		
	</div>
	<div class="navigation">
		<ul>
			<li><a href="<?=$site_url?>"><i class="fa fa-home"></i></a></li>
		
			<li><a href="#" id="request-product">Request Product</a></li>
			<li><a href="#recent" >Offers</a></li>
			<li><a href="#new_arrival">New Arrival</a></li>
		</ul>
	</div>

	<div class="cart-section">
	
	    <? $cartlimit = count($_SESSION['cart']);?>
	
		<p><a style="color:#fff;" href="<?=$site_url?>/cart.php"><img src="<?=$site_url?>/img/icon/cart.png"><span class="price">INR(<span id="cart_price"><?=number_format($get->get_order_total())?></span>)</span><i>-</i><span class="items"><span id="cart_amt"><?=$cartlimit?></span> items(s)</span></a></p>
	</div>
	</nav>
	<!-----------------------popup------------------->
	
<div class="popup" id="popup-login"  href="javascript:vol();">
		<div class="popup_inner col-md-60">
		<a class="grey" href="javascript:vol();" id="login_close" style="float:right"><i class="fa fa-close"></i></a>
		<a href="<?=$site_url?>/cart.html" id="red_home" style="float:right" class="dp-none grey"><i class="fa fa-close"></i></a>
		
			<div id="login-response" class="mgs-area">&nbsp;</div>
		<div class="col-md-40 login-form-page margin-top-30px margin-bottom-30px" >

					<div class="log-in col-md-100 float-left">
					<div style="height:220px ;">
						<h2 id="login-heading" class="grey">LOGIN</h2>
				<form action="" method="post" id="loginform">			
				<div class="col-md-100 margin-top-20px" id="id-login-email">
					<input type="text" class="col-md-100 row-px-30 input" name="login_email" id="login_email" placeholder="Enter email">
				</div>

				<div class="col-md-100 margin-top-20px float-left" id="login-password">
					<input type="password" class="col-md-100 row-px-30 input" name="login_password" id="login_password" placeholder="Enter password">
				</div>
				<input type="hidden" value="LOGIN" name="login" id="login-field">	
				<input type="hidden" value="LOGIN" name="login" id="login-field">	
				<input type="hidden" value="<?=$get->get_current_url()?>" name="red" id="login-field">	
				<input type="hidden" value="FORGET PASSWORD" name="forget" id="forget-field" disabled>	
				<div class="col-md-100 margin-bottom-20px  margin-top-20px ">
					<input type="submit" value="LOGIN" class="input"  id="login-button">
					<input type="submit" value="FORGET PASSWORD" class="margin-top-20px dp-none input" id="forget-button">
					<a  href="javascript:forget();" id="forget-pass" class="margin-top-10px right f-12 grey td-none">forget password?</a>
					<a href="javascript:login();" id="login-pass" class="margin-left-20px f-12 dp-none grey td-none">LOGIN</a>
				</div>
				</form>
					</div>	
					<p class="f-12 ">New to <?=$get->get_website_name()?>? <a href="#" id="login-signup" class="red">SIGNUP</a></p>
				<div class="clear-both margin-bottom-20px"></div>	
						<div class="col-md-100 skip-log-in float-left">
							<a href="<?=$site_url?>/social/fb-login.php?currenturl=<?=$get->get_current_url()?>" onclick="hide_login();" target="_BLANK"><img src="<?=$site_url?>/img/fb.png" width="48%" class="float-left"></a>
							<a href="<?=$site_url?>/social/gplus-login.php?currenturl=<?=$get->get_current_url()?>" onclick="hide_login();" target="_BLANK"><img src="<?=$site_url?>/img/google.png" width="48%"></a>
						</div>
					</div>	
		    </div>
		
			<div class="col-md-50 tips float-right">
				<ul class="tips_text">
					<li class="list">
						<i class="fa fa-car"></i>
						<div class="text">
							<h5>Manage Your Orders</h5>
							<p>Easily Track Orders, Create Returns</p>
						</div>
					</li>
					<li class="list">
						<i class="fa fa-user"></i>
						<div class="text">
							<h5>Make Informed Decisions</h5>
							<p>Get Relevant Alerts And Recommendations</p>
						</div>
					</li>
					<li class="list">
						<i class="fa fa-heart"></i>
						<div class="text">
							<h5>Engage Socially</h5>
							<p>With Wishlists, Reviews, Ratings</p>
						</div>
					</li>
				</ul>
			</div>
		</div>
</div>

<div class="popup" id="popup-signup" <? if(isset($_REQUEST['register_type']) & ($_REQUEST['register_type'] == 'fb' || $_REQUEST['register_type'] == 'gp')  & $get->get_website_session() =='') { ?> style="display:block;" <? } ?>>

<? 
$email = $_REQUEST['email'];
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];

$full_name = $fname." ".$lname;

?>


		<div class="popup_inner col-md-60">
		<a class="grey" href="javascript:vol();" id="signup_close" style="float:right"><i class="fa fa-close"></i></a>
			<div id="signup-response" class="mgs-area">&nbsp;</div>
		<div class="col-md-40 login-form-page margin-top-30px margin-bottom-30px"  >

					<div class="log-in col-md-100 float-left">
					<div>
						<h2 id="signup-heading" class="grey">SIGNUP</h2>
				<form action="" method="post" id="signform">
				
				<div class="col-md-100 margin-top-20px margin-bottom-20px ">
					<div class="col-md-100 margin-top-20px float-left" id="id-signup-fname">
						<input type="text" class="col-md-100 row-px-30 input" name="fname" id="fname" value="<?=$full_name?>" placeholder="Enter Your Name">
					</div>
				
				
				<div class="col-md-100 margin-top-20px float-right">
					<input type="text" class="col-md-100 row-px-30 input" id="signup_email" name="email" placeholder="Enter Email-ID" value="<?=$email?>">
				</div>
				
				
				<div class="col-md-100 margin-top-20px float-right">
					<input type="text" class="col-md-100 row-px-30 input" value="" id="signup_phoneno" name="phoneno" placeholder="Enter Phone">
				</div>
				
				<div class="col-md-100 margin-top-20px float-right" id="signup-password">
					<input type="password" class="col-md-100 row-px-30 input" name="password" id="signup_password" placeholder="Enter Password">
				</div>
				</div>
				<input type="hidden" value="SIGNUP" name="signup" id="signup-signup">	
				<input type="hidden" value="active" name="status" id="signup-status">	
				<input type="hidden" value="form" name="register_type" id="signup-register_type">
				<input type="hidden" value="<?=$get->get_current_url()?>" name="red" id="login-field">				
				<div class="col-md-100 margin-bottom-20px f-13">
					<input type="submit" value="SIGNUP" class="margin-top-20px input" style="cursor: pointer;"  id="signup-button"><br>
					You have already signup?<a href="javascript:vol();" id="signup-login" class="grey margin-left-20px f-12 dark-grey td-none">LOGIN</a>
				</div>
				</form>
					</div>	
						<div class="clear-both margin-bottom-20px"></div>	
						<div class="col-md-100 skip-log-in float-left">
							<a href="<?=$site_url?>/social/fb-login.php?currenturl=<?=$get->get_current_url()?>" onclick="hide_login();" target="_BLANK"><img src="<?=$site_url?>/img/fb.png" width="48%" class="float-left"></a>
							<a href="<?=$site_url?>/social/gplus-login.php?currenturl=<?=$get->get_current_url()?>" onclick="hide_login();" target="_BLANK"><img src="<?=$site_url?>/img/google.png" width="48%"></a>
						</div>
					</div>	
		    </div>
		
			<div class="col-md-50 tips float-right">
				<ul class="tips_text">
					<li class="list">
						<i class="fa fa-car"></i>
						<div class="text">
							<h5>Manage Your Orders</h5>
							<p>Easily Track Orders, Create Returns</p>
						</div>
					</li>
					<li class="list">
						<i class="fa fa-user"></i>
						<div class="text">
							<h5>Make Informed Decisions</h5>
							<p>Get Relevant Alerts And Recommendations</p>
						</div>
					</li>
					<li class="list">
						<i class="fa fa-heart"></i>
						<div class="text">
							<h5>Engage Socially</h5>
							<p>With Wishlists, Reviews, Ratings</p>
						</div>
					</li>
				</ul>
			</div>

			<div class="clear-both"></div>		
		    </div>
		</div>
		
<div class="popup" id="popup-signup-vendor">
<div class="popup_inner col-md-30">
<a class="grey" href="javascript:vol();" id="signup_close_vendor" style="float:right"><i class="fa fa-close"></i></a>
<div id="vendor_response" class="mgs-area">&nbsp;</div>

<div class="col-md-100 login-form-page margin-top-30px margin-bottom-30px"  >
<div class="log-in col-md-100 float-left"><div>
<h2 id="signup-heading" class="grey">SIGNUP FOR VENDOR</h2>

<form name="vendor_form" id="vendor_form" action="" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$get->get_current_url()?>" name="request_ip" id="request_ip">
<input type="hidden" name="request_for_vendor" id="request_for_vendor" value="REQUEST FOR VENDOR">
<div class="col-md-100 margin-top-20px margin-bottom-20px ">

				<div class="col-md-100 margin-top-20px float-left">
				<input type="text" class="col-md-100 row-px-30 input" name="vendor_name" id="vendor_name" value="" placeholder="Enter Your Name">
				</div>				
				
				<div class="col-md-100 margin-top-20px float-right">
					<input type="text" class="col-md-100 row-px-30 input" value="" name="vendor_email" id="vendor_email" placeholder="Enter Email-ID">
				</div>				
				
				<div class="col-md-100 margin-top-20px float-right">
					<input type="text" class="col-md-100 row-px-30 input" value="" name="vendor_phoneno" id="vendor_phoneno" placeholder="Enter Phone">
				</div>
				
				<div class="col-md-100 margin-top-20px float-right" id="signup-password">
				<textarea placeholder="Enter Message" class="col-md-100 min-height" rows="4" cols="50" name="vendor_message" id="vendor_message"></textarea>
					
				</div>
				</div>
				
								
			<div class="col-md-100 margin-bottom-20px f-13">
			<input type="submit" name="submit" id="vendor-button" value="Submit"  class="margin-top-20px input" style="cursor: pointer;">
			</div>
			
		 </form>
	   </div>			
	 </div>	
   </div>
		
			<!---<div class="col-md-50 tips float-right">
				<ul class="tips_text">
					<li class="list">
						<i class="fa fa-car"></i>
						<div class="text">
							<h5>Manage Your Orders</h5>
							<p>Easily Track Orders, Create Returns</p>
						</div>
					</li>
					<li class="list">
						<i class="fa fa-user"></i>
						<div class="text">
							<h5>Make Informed Decisions</h5>
							<p>Get Relevant Alerts And Recommendations</p>
						</div>
					</li>
					<li class="list">
						<i class="fa fa-heart"></i>
						<div class="text">
							<h5>Engage Socially</h5>
							<p>With Wishlists, Reviews, Ratings</p>
						</div>
					</li>
				</ul>
			</div>-->

			<div class="clear-both"></div>		
		    </div>
		</div>