<?
include 'management/include/functions.php';
//Search
if(isset($_REQUEST['q']))
{
	$q=$_REQUEST['q'];
	$catid = $_REQUEST['cat'];

    /*Searchin for all*/
	$sql = "SELECT * FROM category WHERE category_name LIKE '%$q%' AND parent_id = 0 AND status = 'active' ORDER BY id ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	
	$sql_product = "SELECT * FROM product WHERE product_name LIKE '%$q%' AND status = 'active' ORDER BY id";
	$result_product = mysql_query($sql_product);
	$count_product = mysql_num_rows($result_product);
	
	if($count > 0)
	{
		while($row=mysql_fetch_array($result))
		{ 
	
			?>
			<li class="lsit_cat">
			  <label><a href="<?=$site_url?>/listing/c-<?=$row['category_id']?>/<?=$row['category_name']?>"><?=$row['category_name']?></a></label>
			</li>
			<?
			$sql_cat = "SELECT * FROM category WHERE parent_id = '".$row['category_id']."' AND status = 'active' ORDER BY id ";
			$result_cat = mysql_query($sql_cat);			
			
			while($row_cat=mysql_fetch_array($result_cat))
			{
					?>
					<li style="padding-left:4%;">
					<a style="color:#4a4a4a;" href="<?=$site_url?>/listing/c-<?=$row_cat['category_id']?>/<?=$row_cat['category_name']?>"><?=$row_cat['category_name']?></a>
					</li>
				    <?
					
					$sql_subcat = "SELECT * FROM category WHERE parent_id = '".$row_cat['category_id']."' AND status = 'active' ORDER BY id ";
					$result_subcat = mysql_query($sql_subcat);
					while($row_subcat=mysql_fetch_array($result_subcat))
			        {
						?>
						<li style="padding-left:8%;">
						<a style="color:#fa7455;" href="<?=$site_url?>/listing/c-<?=$row_subcat['category_id']?>/<?=$row_subcat['category_name']?>"><?=$row_subcat['category_name']?></a>
						</li>
						<?
					}
			}
		}
	}
	else if($count_product > 0)
	{
		while($row_product = mysql_fetch_array($result_product))
		{ 
	        $seo_name = $get->seo_friendly_url($row_product['product_name']);
			$img= $get->get_single_product_img($row_product['prod_id']);
			?>
			<li class="lsit_cat">
			  <label><span><img src="<?=$site_url?>/upload/product/thumb/th_<?=$img?>"></span>
			  <a style="color:#fa7455;" href="<?=$site_url?>/detail/pid-<?=$row_product['prod_id']?>/<?=$seo_name?>"><?=$row_product['product_name']?></a></label>
			</li>
		    <?
		
		}
	}
	else
	{
		
			echo '<a href="#0">
					<li>
					No Result Found.
					</li>
				</a>';
	}
}
//Add to cart
if($_REQUEST['prod_id'] > 0 )
{
    $attribute = array(
	                    'first' =>   $_REQUEST['first'],
						'second' =>  $_REQUEST['second']
					  );
	
	$get_pid = $_REQUEST['prod_id'];
	$qty = $_REQUEST['qty'];
	
	$return_qnty = $set->product_quantity_exists($_REQUEST['prod_id'],$qty,$attribute,'');
	$return_maximum = $set->product_stock_quantity($_REQUEST['prod_id'],$qty,$attribute,'');
	
	if($qty > 0 && $return_qnty <= $return_maximum)
	{
	
		$set->add_to_cart($_REQUEST['prod_id'],$_REQUEST['qty'],$attribute,'','');
		
		$limitcart = count($_SESSION['cart']);
		
		if($get->get_cart_qty() > 0)
		{
			$cart_div = "<a class='right' href='#0' onclick='hide_cart();'><i class='fa fa-close icon'></i></a><ul class='bag-ul' id='bag-ul'>";
			$sum = 0;
			$sum1 = 0;
			for($i=0;$i<$limitcart;$i++)
			{

				$pid = $_SESSION['cart'][$i]['productid'];
				$q=$_SESSION['cart'][$i]['qty'];
				$attribute=$_SESSION['cart'][$i]['attribute'];
				$combo = $_SESSION['cart'][$i]['combo'];
				$sale=$_SESSION['cart'][$i]['sale'];
				$first = $attribute['first'];
				$second = $attribute['second'];
				
				
				$combo_price = $combo_price+ $get->get_combo_price($combo);
				$prod_price = $prod_price + $get->get_product_price($pid,$first,$second);
				
				
				$combo_img = $get->get_single_combo_img($combo);
				$combo_name = $get->get_combo_name($combo);
				$comboprice = number_format($combo_price);
				
				$prod_img =$get->get_single_product_img($pid);
				$prod_name = $get->get_product_name($pid);
				$prodprice = number_format($prod_price);
				
				if($combo > 0) 	
				{ 
			
					$sum += $combo_price;
					$cart_div .="<li class='cart-list'>
					<a href='#0'><span class='thumb'><img src='$site_url/upload/combo/$combo_img'></span></a>
					<div class='text'>
					<a href='#0'><h4 class='name'>$combo_name</h4></a>
					<div class='price'><span class='qty'>QTY: $q</span>Rs. $comboprice</div>
					</div>
					</li>";
					
				} 
				else 
				{
					$sum1 += $prod_price;				
					$cart_div .="<li class='cart-list'>
					<a href='#0'><span class='thumb'><img src='$site_url/upload/product/$prod_img'></span></a>
					<div class='text'>
					<a href='#0'><h4 class='name'>$prod_name</h4></a>
					<div class='price'><span class='qty'>QTY: $q</span>Rs. $prodprice</div>
					</div>
					</li>";
					
				} 
			}
			
			$subTotal = $sum+$sum1;
			$cart_div .="</ul>
			<div class='amount'>
			<span class='sub-total'>
			Sub Total:  $subTotal<br>";
			$deliveryamount = $get->get_delivery_charges();
			if($deliveryamount > 0){
			$cart_div .="Delivery Charges: $deliveryamount	<br>";
			} 
			$grandtotal = $subTotal+$deliveryamount;
			$cart_div .="</span>
			<span class='total-amount'>Total: Rs. $grandtotal</span>
			</div>
			<a href='$site_url/cart.html' class='view-all'>View Cart <i class='fa fa-shopping-cart'></i></a>";
			
		}
		else
		{
			
			$cart_div .="<ul class='bag-ul' id='bag-ul'>
			<li class='cart-list'>
			<span class='no-items'>Your Cart is empty. Start shopping now!</span>
			</ul>";
		}
		
			$top_cart = count($_SESSION['cart']);
			$prod_cart_qty = $get->get_cart_qty();
			$prod_cart_amt = number_format($get->get_order_total());
			//echo json_encode(array("return_qty"=>$prod_cart_qty,'return_amt'=>$prod_cart_amt));
			echo json_encode(array("cart_div"=>$cart_div,'top_cart'=>$prod_cart_qty,'return_amt'=>$prod_cart_amt));
		
	 } 
	 else
	 {
		
			$product_display_name = $get->get_product_name($get_pid); 
			$return_message= "We're sorry! We are able to accommodate only ".$return_maximum." units of ".$product_display_name." for each customer."; 
			echo json_encode(array("message"=>$return_message,'status'=>'ERROR'));  
		
	  }	
		
}
//less to cart
if($_REQUEST['less'] != '')
{
	$combo_id = $_REQUEST['less'];
	
	if($get->get_combo_qty($combo_id) > 0)
	{
		$set->less_to_cart($_REQUEST['less']);	
	}
	
}
//Forget Password
if(isset($_POST['forget']))
{
	$check = $set->check_forget();
	if ($check === false) {
    $msg = '<div class="mgs error col-md-40">Email and password mismatch. Please try again.</div>';
	}
	else {
	$msg = '<div class="mgs success col-md-40">Your password has been send on Email.</div>';
	}
}
// Login
if(isset($_POST['login'])){
	//var_dump($_POST);
	$check = $set->check_login();
	if ($check === false) 
	{
		echo $msg =  '<div class="mgs error col-md-60"><i class="fa-exclamation-triangle fa"></i>Email and password mismatch. Please try again.</div>';
	}
	else 
	{
		if($_POST['red'] !=''){
		$red = $_POST['red'];
			?>
			<script>window.location.href = '<?=$red?>';</script>
			<?
		} else {
		?>
			<script>window.location.href = 'index.html';</script>
		<?
		}
	}
}
// SINGUP
if(isset($_POST['signup']))
{
	$check = $set->signup();
	
	
	if ($check === false) {
    $msg = '<div class="mgs error col-md-40">Email already exist.</div>';
	}
	else {
		
		if($_POST['red'] !=''){
		$red = $_POST['red'];
			?>
			<script>window.location.href = '<?=$red?>';</script>
			<?
		} else {
		?>	<script>window.location.href = '<?=$site_url?>';</script>
		<?
		}
		
		
		
		
	}
	
}
//Add Wish List
if(isset($_REQUEST['wish']) and $_REQUEST['wish'] == 'yes')
{
	$check = $set->add_wishlist($_REQUEST);
	echo $check;
}

//Remove Wish List
if(isset($_REQUEST['wish']) and $_REQUEST['wish'] == 'no')
{
	$check = $set->remove_wishlist($_REQUEST);
	echo $check;
}

//Check Pincode
if(isset($_REQUEST['check_pincode'])){
	$check = $get->get_pincode($_REQUEST['check_pincode']);
	echo $check;
}
//Available Pincode
if(isset($_REQUEST['pin'])){
	$check = $get->get_pincode($_REQUEST['pin']);
	echo $check;
}
//Remove Address
if(isset($_REQUEST['addressid']) and $_REQUEST['delete'] == 'yes')
{
	$check = $set->delete_address($_REQUEST['addressid']);
	echo $check;
}

//Deactivation Account
if(isset($_REQUEST['deactivation_password']) and $_REQUEST['deactivation_password'] !='')
{
	$set->deactivation_account($_REQUEST);
}

//checkout
if(isset($_REQUEST['payment_method']))
{
	if($_REQUEST['form_validation']=='required')
	{
		$set->add_customer_details($_REQUEST); // Insert into customer details
	}
	
	echo $set->order_details($_REQUEST); // Insert into order details && order customer details && order_prodcut_details
}
//Update cart
if($_REQUEST['update_cart_prod_id'] > 0)
{
	 extract($_REQUEST);
	 $return = $set->update_cart($update_cart_prod_id,$first,$second,$i,$qty);
	 //echo  $return;
	 
	 if($return > 0)
	 { 
		 $name = $get->get_product_name($update_cart_prod_id); 
		 echo "We're sorry! We are able to accommodate only ".$return." units of ".$name." for each customer.";
	 }
	 else
	 {
		 echo 'error';
		 
	 }
	 
}










#######################
//$site_url = 'http://www.dial4insurance.com';
//$site_url = 'http://localhost/onlinevandy';

$weburl = $get->get_website_url();
$logo_url = $site_url."/upload/comman/".$get->get_logo();
$logo_url_two = $site_url."/upload/comman/".$get->get_logo();

$fb_url = $get->get_facebook_url();
$twit_url = $get->get_twitter_url();
$gp_url = $get->get_google_plus_url();
$link_url=$get->get_linkedin_url();
//$pint_url=$get->get_youtube_url();
//$insta_url=$get->get_youtube_url();
$yout_url = $get->get_youtube_url();

$enquiry_phone = $get->get_phone_no();

$mail_title = $get->get_website_name();

$f_icon_url = $site_url."/img/mailer/fb.png";
$t_icon_url = $site_url."/img/mailer/tw.png";
$g_icon_url = $site_url."/img/mailer/icon3.png";
$l_icon_url = $site_url."/img/mailer/icon4.png";
$p_icon_url = $site_url."/img/mailer/icon6.png";
$i_icon_url = $site_url."/img/mailer/icon7.png";
$y_icon_url = $site_url."/img/mailer/you.png";

$f_img_url = $site_url."/img/mailer/img1.png";
$s_img_url = $site_url."/img/mailer/img2.png";
$t_img_url = $site_url."/img/mailer/img3.png";

	
$ToEmail = 'nagendra.qms@gmail.com,info@onlinevandy.com';
$FromEmail = 'info@onlinevandy.com';

#######################






if($_REQUEST['main_category_id'] !='')
{
$main_cat_id = $_REQUEST['main_category_id'];

	$sql = "SELECT * FROM category WHERE parent_id ='".$_REQUEST['main_category_id']."' AND status = 'active'";
    $query = mysql_query($sql) or die(mysql_error());
	
	echo "<li><label>Category</label><select name='sub_category' id='sub_category' onchange='show_sub_subcategory($main_cat_id,this.value)'>
	<option value=''>Select Your Subcategory</option>";
	while($subcategory = mysql_fetch_object($query))
	{	
		if($subcategory->category_id == $category_id){ echo 'selected'; }
		
		echo "<option value='$subcategory->category_id' >".$subcategory->category_name."</option>";		
	}
	echo "</select></li>";
		
}


if($_REQUEST['sub_category_id'] !='')
{
$maincatid = $_REQUEST['maincatid'];
$mainsubcatid  = $_REQUEST['sub_category_id'];


	$sql = "SELECT * FROM category WHERE parent_id ='".$_REQUEST['sub_category_id']."' AND status = 'active'";
    $query = mysql_query($sql) or die(mysql_error());
	
	echo "<li><label>Category</label><select name='sub_subcategory' id='sub_subcategory' onchange='show_productby($maincatid,$mainsubcatid,this.value)'>
	<option value=''>Select Your Subcategory</option>";
	while($subcategory = mysql_fetch_object($query))
	{	
		if($subcategory->category_id == $category_id){ echo 'selected'; }
		
		echo "<option value='$subcategory->category_id' >".$subcategory->category_name."</option>";		
	}
	echo "</select></li>";
		
}


if($_REQUEST['product_by_category'] !='')
{
	
	
$category = $_REQUEST['main_category'];
$subcategory  = $_REQUEST['category'];
$subsubcategory  = $_REQUEST['subcategory'];


$sql = " SELECT * from  product as P JOIN category as C ON P.cat_id = C.category_id ";
$sql .= " WHERE P.status = 'active' ";
$sql_where= " AND FIND_IN_SET($category,P.cat_id) AND FIND_IN_SET($subcategory,P.subcat_id) AND FIND_IN_SET($subsubcategory,P.sub_subcat_id)";

$sql_order = " ORDER BY P.id DESC ";
$query = $sql.$sql_where.$sql_order;

$getproduct = mysql_query($query) or die(mysql_error());
$count = mysql_num_rows($getproduct);
	
	echo "<li><label>Products</label><select name='product_info' id='product_info'>
	<option value=''>Select Products</option>";
	while($res_product = mysql_fetch_array($getproduct))							
	{	
		$prod_id =$res_product['prod_id'];
		$prod_name = $res_product['product_name'];	
		
		if($prod_id == $product_info){ echo 'selected';}
		
		echo "<option value='$prod_id' >".$prod_name."</option>";		
	}
	echo "</select></li>";
		
}



if(isset($_REQUEST['request_of_products']))
{
	
extract($_REQUEST);

	
	
	$category_info = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE category_id ='".$_REQUEST['main_category']."'"));
    $category_name = $category_info['category_name'];
	
	$subcategory_info = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE category_id ='".$_REQUEST['sub_category']."'"));
	$subcategory_name = $subcategory_info['category_name'];
	
   $sub_subcategory_info = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE category_id ='".$_REQUEST['sub_subcategory']."'"));
   $sub_subcategory_name = $sub_subcategory_info['category_name'];
	
	
	$product_details = mysql_fetch_array(mysql_query("select * from product WHERE prod_id ='$product_info'"));
	$product_name = $product_details['product_name'];
	
	    
	
	

		$current_date = date("Y-m-d H:i:s");
		
		
		$sql = "INSERT INTO enquiry SET name='$request_name',email='$request_email',phone='$request_phone',company='$request_company_name',prod_id='$product_info',product_name='$product_name',type='REQUEST',category_name='$category_name',subcategory_name='$subcategory_name',sub_subcategory_name='$sub_subcategory_name',message='$request_message',enquiry_date='$current_date',status='active'";
		
		$query= mysql_query($sql) or die(mysql_error());
		$lid = mysql_insert_id();
	
	//echo $sql."Success".$lid;
	//echo print_r($_REQUEST);
	
	if($query){
	
	
$subject = 'Product Enquiry: ONLINEVANDY';

$mailmsg = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>$mail_title</title>
<style>
table.inner, table.inner td, table.inner tr {
    border:1px solid rgb(125, 125, 125);
	border-collapse: collapse;
}
</style>
</head>

<body style='font-size:13px; margin:0px; padding:0px;background:#d5d5d5; color:rgb(125, 125, 125); font-family:Arial, Helvetica, sans-serif;'>
<table width='600' cellspacing='0' cellpadding='0' align='center' bgcolor='#fff' style='border:1px solid #f8f8f6; padding:10px;' 
  <tr>
    <td width='60'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
    <td width='60'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='5' align='left'><a href='$site_url' target='_BLANK'><img src='$logo_url'  height='50'/></a></td>
    <td colspan='5' align='right'>
      <span style='margin:0px; font-weight:700;font-size:16px; color:#333;'>Hello $request_name,</span><br />
      <span style='margin:0px;font-size:13px;color:#7d7d7d;'><a style='text-decoration:none;color:#7d7d7d !important;'>$request_email</span>
    </td>
  </tr>
   <tr>
    <td colspan='10' height='10px'></td>
  </tr>
  <tr>
    <td colspan='10' style='border-bottom:1px solid #333;'></td>
  </tr>
   <tr>
    <td colspan='10' height='20px'></td>
  </tr>
  <tr>
    <td colspan='10' align='left'>
      <span style='margin:0px;font-size:14px; color:rgb(99, 96, 96)'><b>Thank you for visiting on onlinevandy</b></span><br />
      <span style='margin:0px;font-size:12px;color:#7d7d7d;'><a style='text-decoration:none;color:#7d7d7d !important;'>We hope you enjoy your stay on onlinevandy. We're still small, so it would really help us if you can help us spread the word by telling your friends about onlinevandy. </span>
    </td>
  <tr>
   <tr>
    <td colspan='10' height='10px'></td>
  </tr>
  
   <td  colspan='10'>
  <table class='inner' cellpadding='5' width='100%'>
   <tr style='display:none;'>
    <td width='60' height='0px'></td>
    <td width='60' height='0px'></td>
    <td width='60' height='0px'></td>
    <td width='60' height='0px'></td>
    <td width='60' height='0px'></td>
    <td width='60' height='0px'></td>
    <td width='60' height='0px'></td>
    <td width='60' height='0px'></td>
    <td width='60' height='0px'></td>
    <td width='60' height='0px'></td>
  </tr>
  
  
   <tr>
    <td colspan='2' valign='top'><b>Name</b></td>
    <td colspan='3' valign='top'>$request_name</td>
    <td colspan='2' valign='top'><b>Mobile No.</b></td>
    <td colspan='3' valign='top'>$request_phone</td>
  </tr>
  <tr>
    <td colspan='2' valign='top'><b>Email</b></td>
    <td colspan='3' valign='top'>$request_email</td>
    <td colspan='2' valign='top'><b>Company/Store</b></td>
    <td colspan='3' valign='top'>$request_company_name</td>
  </tr>
  <tr>
    <td colspan='2' valign='top'><b>Main Category</b></td>
    <td colspan='3' valign='top'>$category_name</td>
    <td colspan='2' valign='top'><b>Category</b></td>
    <td colspan='3' valign='top'>$subcategory_name</td>
  </tr>
  
  <tr>
    <td colspan='2' valign='top'><b>Sub Category</b></td>
    <td colspan='3' valign='top'>$sub_subcategory_name</td>
    <td colspan='2' valign='top'><b>Product Name</b></td>
    <td colspan='3' valign='top'>$product_name</td>
  </tr>
  
   <tr>
    <td colspan='3' valign='top'><b>Message</b></td>
    <td colspan='7' valign='top'>$request_message</td>
  </tr>
  <tr>
    <td colspan='7' valign='top'><b>Enquiry Date</b></td>
    <td colspan='3' valign='top'>$current_date</td>
  </tr>
  
  </table>
  </td>
  </tr>
  <tr>
    <td colspan='10' height='30px'></td>
  </tr>
  <tr>
    <td colspan='3' align='left' valign='middle'>Keep In Touch with Social: &nbsp;</td>
    <td colspan='7' align='left' >
      <a href='$fb_url'><img src='$f_icon_url' /></a>
       <a href='$twit_url'><img src='$t_icon_url' /></a>
       <a href='$gp_url'><img src='$g_icon_url' /></a>
       <a href='$yout_url'><img src='$y_icon_url' /></a></td>
  </tr>
  <tr>
    <td colspan='10' height='5px'></td>
  </tr>
  <tr>
    <td colspan='10' align='left'>
      <span style='margin:0px;font-size:11px;color:#7d7d7d;'><a style='text-decoration:none;color:#7d7d7d !important;'>We hope you enjoy your stay on onlinevandy. We're still small, so it would really help us if you can help us spread the word by telling your friends about onlinevandy. </span>
    </td>
  <tr>
  <tr>
    <td colspan='10' height='10px'></td>
  </tr>
  <tr>
		 
            <td colspan='10' style='text-align:center; color:#fff; text-align:center' bgcolor='212121' height='30'>If you have any questions or trouble logging on please choose our helpline:- $enquiry_phone</td>
			
         </tr>
</table>

</body>
</html>
";
			//echo $mailmsg;die;
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			//$headers .= 'From: <$FromEmail>' . "\r\n";
			$headers .= 'From: '.$FromEmail."\r\n".'Reply-To: '.$FromEmail."\r\n" .'X-Mailer: PHP/' . phpversion();
			
			$ToEmail = mail($ToEmail,$subject,$mailmsg,$headers);
			
			if($ToEmail == true ){
				echo $msg = "Request Send sucessfully. Wait for response.";
			}else{
				echo $msg = "Try Again!!!";	
			}	
	}	
		
	
}





// Service Request Form
/*
if(isset($_REQUEST['service_form'])){
	
	extract($_REQUEST);
    $fullname = $fname." "$lname;
	$to = "qms.sujit@gmail.com";
	$subject = 'Query:Sent By '.$fullname.'';
	$headers = "From: $email_id \r\n";
	$headers .= "Reply-To: $email_id \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
	$message = '<html><body>';
	$message .= '<h4>Detail Of Sender <br/>';
	$message .= 'Sender Name:'.$usrName;
	$message .= 'Sender Mail-Id:'.$email_id;
	$message .= 'Sender Mobile Number:'.$usr_mob;
	$message .= 'Sender Address:'.$address;
	$message .= 'Sender Pincode:'.$pincode;
	$message .= 'Sender City:'.$city;
	$message .= 'Sender Brand:'.$brand;
	$message .= 'Sender Model:'.$model;	
	$message .= 'Sender Date:'.$date;
	$message .= 'Name Of Product:'.$no_of_product;
	$message .= '</h4>';
	$message .= '</body></html>';
	return $message;
	if(@mail($to, $subject, $message, $headers))
	{
		echo "Check your mail"; 
	}
	else
	{
		echo "Opps Something went wrong";
	}
}
*/



/****************Vendor Code Starts here*********************/

if(isset($_REQUEST['user_password']))
{
	$log = $admin->check_login($_REQUEST['user'],$_REQUEST['user_password'],'vendor');
	if($log === false)
	{
			echo "error";
	}
	else
	{
		    echo 'success';
	}
}
if(isset($_REQUEST['vendor_signup']))
{
	$check = $set->signup_vendor();
	if ($check === false) 
	{
		$msg = '<div class="mgs error col-md-40">Email already exist..</div>';
	}
	else 
	{
		
		if($_POST['red'] !='')
		{
		$red = $_POST['red'];
			?>
			<script>window.location.href = '<?=$red?>';</script>
			<?
		} 
		else
		{
			?>	
			<script>window.location.href = '<?=$site_url?>/vendor/index.html';</script>
			<?
		}
	}
}
if(isset($_REQUEST['buss_name']))
{
	
	if(isset($_REQUEST['update_business']))
	{
		 $add = $set->update_business_detail();
		
		if($add === true)
		{
			echo 'Business details updated successfully and pending for approvel.';
		}	
	}
	else
	{
		$add = $set->add_business_detail();
		
		
		if($add === true)
		{
			echo 'Business details submited successfully and pending for approvel.';
		}	
		
	}
     	 
}
if(isset($_REQUEST['dis_name']))
{
	if(isset($_REQUEST['update_store']))
	{
		$add = $set->update_store_detail();
		 if($add === true)
		 {
			 echo 'Store details submited successfully and pending for approvel.';
		 }
	}
	else
	{
		 $add = $set->add_store_detail();
		 if($add === true)
		 {
			 echo 'Store details submited successfully and pending for approvel.';
		 }
	}			 
}
if(isset($_REQUEST['account_name']))
{
	if(isset($_REQUEST['update_bank']))
	{
	
		 $add = $set->update_bank_detail();
		 if($add === true)
		 {
			 echo 'Bank details submited successfully and pending for approvel.';
		 }		 
    }
	else
	{
		$add = $set->add_bank_detail();
		 if($add === true)
		 {
			 echo 'Bank details submited successfully and pending for approvel.';
		 }
	}
}
if(isset($_REQUEST['ifsc_code_check']))
{	
	$code = $_REQUEST['ifsc_code_check'];
	$link = 'https://ifsc.razorpay.com/'.$code;
	
	$str = file_get_contents($link);
	$res = json_decode($str, true);
	$bank = $res['BANK'];
	$state = $res['STATE'];
	$city = $res['CITY'];
	$branch = $res['BRANCH'];
	
	if($bank != '')
	{	
		echo $array = json_encode(array("status" => "success","bank"=>$bank,"state"=>$state,"city"=>$city,"branch"=>$branch));
	}
}


if(isset($_REQUEST['detail_id']) && $_REQUEST['cancel'] =='yes')
{

	$confirm =  $set->confirm_cancellation($_REQUEST);
	if($confirm == true)
	{
		echo 'success';
	}
}

if(isset($_REQUEST['detail_id']) && $_REQUEST['return'] =='yes')
{

	$confirm =  $set->confirm_return($_REQUEST);
	if($confirm == true)
	{
		echo 'success';
	}
}

#Update Cart
/* if($_REQUEST['update_cart_prod_id'] > 0)
{
 
	 extract($_REQUEST);
	 
	 $return_qnty = $set->product_quantity_exists($update_cart_prod_id,$qty,$attribute);
	 $return_maximum = $set->product_stock_quantity($update_cart_prod_id,$qty,$attribute);
	  
	  if($qty > 0 && $return_qnty <= $return_maximum)
	{
	 
	 $return = $set->update_cart($update_cart_prod_id,$attribute,$i,$qty);
	 //echo  $return;
	 
	 if($return > 0)
	 { 
		 $name = $get->get_product_name($update_cart_prod_id); 
		 echo "NWe're sorry! We are able to accommodate only ".$return." units of ".$name." for each customer.";
	 }
	 else
	 {
		 echo 'error';
		 
	 }
	 
	 }else{
	 
	     $name = $get->get_product_name($update_cart_prod_id); 
		 echo "We're sorry! We are able to accommodate only ".$return_maximum." units of ".$name." for each customer.";
	 }
	 
} */


