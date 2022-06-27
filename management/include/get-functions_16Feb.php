<?php

class Get
{
//Class Start

/******************Global Setting Get Functions*********************/	
		
	//Fetch Setting
	public function get_setting(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		return $query;
	}

	//Fetch Logo
	public function get_logo(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['website_logo'];
	}
	
	//Fetch Website Name
	public function get_website_name(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['website_name'];
	}
	
	//Fetch Website Url
	public function get_website_url(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['website_url'];
	}

	//Fetch Favicon Icon
	public function get_favicon(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['website_favicon'];
	}

	//Fetch Email
	public function get_email(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['email'];
	}
	
	//Fetch Address
	public function get_website_address(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['address'];
	}

	//Fetch Phone No
	public function get_phone_no(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['phone_no'];
	}

	//Fetch Copyright
	public function get_copyright(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['copyright'];
	}

	//Fetch Facebook URL
	public function get_facebook_url(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['facebook_url'];
	}

	//Fetch Twitter URL
	public function get_twitter_url(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['twitter_url'];
	}

	//Fetch Google Plus URL
	public function get_google_plus_url(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['google_plus_url'];
	}

	//Fetch linkedin URL
	public function get_linkedin_url(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['linkedin_url'];
	}

	//Fetch youtube URL
	public function get_youtube_url(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['youtube_url'];
	}
	
	//Fetch Qucik Media URL
	public function get_quickmedia_url(){
		$url = 'http://www.quickmediasolution.com/';
		return $url;
	}
	
	//Fetch Google Analytics
	public function get_analytics(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['google_analytics'];
	}
	
	//Fetch Site Per Page
	public function get_site_per_page(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['site_per_page'];
	}
	
	//Fetch Site Per Page Description
	public function get_site_per_page_description(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['site_per_page_description'];
	}
	
	//Fetch Admin Per Page 
	public function get_admin_per_page(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['admin_per_page'];
	}
	
	//Fetch Review Allow
	public function get_review_allow(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['review_allow'];
	}
	
	//Fetch Guest Review Allow
	public function get_guest_review_allow(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['guest_review_allow'];
	}
	
	//Fetch Coupon Allow
	public function get_coupan_allow(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['guest_review_allow'];
	}
	
	//Fetch Guest Checkout
	public function get_guest_checkout(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['guest_checkout'];
	}
	
	//Fetch display Stock
	public function get_display_stock(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['display_stock'];
	}
	
	//Fetch display Stock
	public function get_cashondelivery(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['cashondelivery'];
	}
	
	//Fetch Minimum Cart Value
	public function get_minimum_cart_value(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['minimum_cart_value'];
	}
	
	//Fetch Delivery Charges
	public function get_delivery_charges(){
		$sql = "SELECT * FROM global_setting WHERE id=1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['delivery_charges'];
	}
	
	
/******************Regular Get Functions*********************/	


	/////// Input ////////	
	
	public function get_input($str)	{
		if(is_array($str)){
		return array_map('mysql_real_escape_string',$str);
		}
		else {
			return trim(addslashes($str));
		}
	}
	
	/////// Output ////////
	public function get_output($str) {
		return stripslashes($str);
	}
	
	/////// Admin page role ////////	
	public function get_page_role($id){
		if($id == 'add'){
		return	"add";
		}
		elseif($id == 'edit'){
		return	"edit";
		}
		else {
			return "view";
		}
	}
	
	//Fetch Category By Id
	public function get_active_data($id,$tbname){
		$sql = "SELECT * FROM $tbname WHERE id='$id'";
		$query = mysql_query($sql);
		return $query;
	}
	
	//Get Seo Url 
	function seo_friendly_url($string){
		$string = str_replace(array('[\', \']'), '', $string);
		$string = preg_replace('/\[.*\]/U', '', $string);
		$string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
		$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
		return strtolower(trim($string, '-'));
	}
	
	
	// Match Text in search 
	function get_match_text($text,$words) {
		$str = $text;
		$search = $words;
		$highlightcolor = "#000";
		$occurrences = substr_count(strtolower($str), strtolower($search));
		$newstring = $str;
		$match = array();

		for ($i=0;$i<$occurrences;$i++) {
			$match[$i] = stripos($str, $search, $i);
			$match[$i] = substr($str, $match[$i], strlen($search));
			$newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', strip_tags($newstring));
		}

		$newstring = str_replace('[#]', '<k style="color: '.$highlightcolor.'; font-weight:bold;">', $newstring);
		$newstring = str_replace('[@]', '</k>', $newstring);
		return $newstring;
	}
	
	/* Get File Extension*/
	function get_extension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; } 
		
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	//Get Ip Address
	function get_user_ip(){
		return $_SERVER['REMOTE_ADDR'];
	}
	
	//Get Current URL
	function get_current_url(){
		return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}
	
	//Replace Same Query String
	function remove_querystring_var($url, $key) { 
		return preg_replace('/(?|&)'.$key.'=[^&]*/i', '$1', $url); 
	}
	
	public function get_pagination($tbname,$currentpage,$page,$start,$limit){
	$rows=mysql_num_rows(mysql_query("select * from $tbname"));
	$total=ceil($rows/$limit);
	$pagination .= '<div class="bodyfooter fright"><br /><div class="fleft">';
	$url = ADMIN_PATH."/".$currentpage."?role=view";
	if($page>1)
	{
		$pagination .= "<a href='".$url."&page=".($page-1)."' class='button fleft'>PREVIOUS</a>";
	}
	else{
		 $pagination .= "<a href='javascript:void(0);' class='disable fleft'>PREVIOUS</a>";
	}
	$pagination .= '</div><div class="fleft">';
	$pagination .=  "<ul class='page'>";
    for($i=1;$i<=$total;$i++)
    {
	if($i==$page) { $pagination .= "<li class='current'>".$i."</li>"; }
	else { $pagination .=  "<li><a href='".$url."&page=".$i."'>".$i."</a></li>  "; }
	}
	$pagination .= "</ul>";
	$pagination .= '</div><div class="fleft">';
	if($page!=$total)
	{
	   $pagination .= "<a href='".$url."&page=".($page+1)."' class='button fright'>NEXT</a>";
	}
	else
	{
	   $pagination .= "<a href='javascript:void(0);' class='disable fright'>NEXT</a>";
	}
	$pagination .= '</div><div class="cboth"></div></div> ';
	return $pagination;
}

// Time Ago
function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "Just Now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}

//File Exist
	function get_file_exist($path){
		if(!file_exists($path)){
			return false;
		} else {
			return true;
		}
	}
	
	//Check Folder
	function create_path($path) {
	if (!file_exists($path) && !is_dir($path)) {
		mkdir($path, 0755, true);
		return true;				
	}
	else {
		return false;
	}
	}
	
/******************Category Get Functions*********************/	
	
//////////// Select Category Option ////////////
	public function category_option($parent,$level,$match){
		$sql = "SELECT * FROM category WHERE parent_id='$parent' and status='active' ORDER BY category_name ASC";
		$query = mysql_query($sql);
		while ($row=mysql_fetch_array($query)):
		extract($row);
		$select = ($row['category_id']==$match)?'selected':'';
			echo "<option value='$category_id' $select>".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$level).$category_name."</option>";
			$this->category_option($category_id,$level+1,$match);
		endwhile;
	}
	
	public function main_category_option($parent,$level,$match){
		$sql = "SELECT * FROM category WHERE parent_id='$parent' and status='active' ORDER BY category_name ASC";
		$query = mysql_query($sql);
		while ($row=mysql_fetch_array($query)):
		extract($row);
		$select = ($row['category_id']==$match)?'selected':'';
			echo "<option value='$category_id' $select>".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$level).$category_name."</option>";
			//$this->category_option($category_id,$level+1,$match);
		endwhile;
	}
	
	public function get_category_name_by_id($id){
		$sql = "SELECT * FROM category WHERE category_id='$id'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['category_name'];	
	}
	
	public function get_parent_category_name_by_id($id){
		$sql = "SELECT * FROM category WHERE category_id='$id'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $this->get_category_name_by_id($row['parent_id']);	
	}
	
	public function get_parent_category_id_by_id($id){
		$sql = "SELECT * FROM category WHERE category_id='$id'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['parent_id'];	
	}

	
	public function get_all_category(){
		$sql = "SELECT * FROM category WHERE parent_id=0 and status='active' ORDER BY orderno ASC";
		$query = mysql_query($sql);
		return $query;
	}
	
	public function get_category_menu(){
		$sql = "SELECT * FROM category WHERE parent_id=0 and status='active' ORDER BY orderno ASC";
		$query = mysql_query($sql);
		return $query;
	}
	
	public function get_category_menu_yes(){
		$sql = "SELECT * FROM category WHERE parent_id=0 and status='active' and category_menu='yes' ORDER BY orderno ASC";
		$query = mysql_query($sql);
		return $query;
	}
	
	public function get_category_menu_no(){
		$sql = "SELECT * FROM category WHERE parent_id=0 and status='active' and category_menu='no' ORDER BY orderno ASC";
		$query = mysql_query($sql);
		return $query;
	}

	public function get_subcategory_menu($id){
		$sql = "SELECT * FROM category WHERE parent_id='$id' and status='active' ORDER BY orderno ASC";
		$query = mysql_query($sql);
		return $query;
	}
	
	public function get_subcategory_menu_yes($id){
		$sql = "SELECT * FROM category WHERE parent_id!='0' and status='active' and category_menu='yes' ORDER BY orderno ASC LIMIT 12";
		$query = mysql_query($sql);
		return $query;
	}
	
	public function get_category_img($id){
		$sql = "SELECT * FROM category WHERE status='active' and category_id='$id' ORDER BY id DESC LIMIT 1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		$img = $row['category_image'];
		return $img;
	}
	
	public function get_category_banner($id){
		$sql = "SELECT * FROM category WHERE status='active' and category_id='$id' ORDER BY id DESC LIMIT 1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		$img = $row['category_banner'];
		return $img;
	}
	
	public function get_category_title($id){
		$sql = "SELECT * FROM category WHERE status='active' and category_id='$id' ORDER BY id DESC LIMIT 1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		$img = $row['category_title'];
		return $img;
	}
	
	public function get_category_keyword($id){
		$sql = "SELECT * FROM category WHERE status='active' and category_id='$id' ORDER BY id DESC LIMIT 1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		$img = $row['category_keyword'];
		return $img;
	}
	
	public function get_category_desc($id){
		$sql = "SELECT * FROM category WHERE status='active' and category_id='$id' ORDER BY id DESC LIMIT 1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		$img = $row['category_desc'];
		return $img;
	}
	
	public function get_category_information_by_id($id)
	{
		$sql = "SELECT * FROM category WHERE status='active' and category_id='$id'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		$img = $row['info'];
		return $img;
	}
	
/******************Content Get Functions*********************/		

	//Fetch Content Option
	public function get_content_option($mtch){
		$sql = "SELECT * FROM content WHERE parent_id='0' order by id asc";
		$query = mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			extract($row);
			 $select = ($row['content_id']==$mtch)?'selected':'';
			 $option .= "<option value='$content_id' $select>$page_name</option>";
		}
		return $option;
	}
	
	//Fetch Content  Title
	public function get_content_title($id){
		$sql = "SELECT * FROM content WHERE content_id='$id'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['page_name'];
	}

	//Fetch Content 
	public function get_content($id){
	$sql = "SELECT * FROM content WHERE content_id='$id'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	return $row['content_text'];
	}

	//Fetch Content img
	public function get_content_img($id){
	$sql = "SELECT * FROM content WHERE content_id='$id'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	return $row['image'];
	}	


	//Fetch Page  Title
	public function get_page_keywords($id){
	$sql = "SELECT * FROM content WHERE content_id='$id'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	return $row['page_keywords'];
	}

	//Fetch Page  Title
	public function get_page_description($id){
	$sql = "SELECT * FROM content WHERE content_id='$id'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	return $row['page_description'];
	}

	//Fetch Page  Title
	public function get_page_title($id){
	$sql = "SELECT * FROM content WHERE content_id='$id'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	return $row['page_title'];
	}
/******************Product Get Functions*********************/

	//Product Id
	function get_product_id($pid){
		$result=mysql_query("select prod_id from product where prod_id=$pid");
		$row=mysql_fetch_array($result);
		return $row['prod_id'];
	}

	//Poduct Name
	function get_product_name($pid){
		$result=mysql_query("select product_name from product where prod_id=$pid");
		$row=mysql_fetch_array($result);
		return $row['product_name'];
	}
	
	//Poduct detail
	function get_product_detail($pid)
	{
		$result=mysql_query("select details from product where prod_id=$pid");
		$row = mysql_fetch_array($result);
		
		if(strlen($row['details']) > 45)
		{
			return substr($row['details'], 0, 45).'...';
		}
		else
		{
			return $row['details'];
		}
	}
	
	
	
	//Poduct Name
	function get_combo_name($cid){
		$result=mysql_query("select combo_name from combo where combo_id=$cid");
		$row=mysql_fetch_array($result);
		return $row['combo_name'];
	}

	//Poduct Name
	function get_short_product_details($pid){
		$result=mysql_query("select details from product where prod_id=$pid");
		$row=mysql_fetch_array($result);
		if(strlen($row['details']) > 100) { return substr($row['details'],0,100).'...'; } else { return $row['details']; }
	}

	//Product Delivery in INR
	function get_product_delivered_price($pid){
		$result=mysql_query("select * from product where prod_id=$pid");
		$row=mysql_fetch_array($result);
		if($row['product_delivery'] == '') { return '0'; } else { return $row['product_delivery']; }
	}

	// Product Total Price

function get_product_amount($pid,$first,$second)
{
	
	if($first > 0)
	{
		if($first > 0 && $second >0)
		{
			$nowchecked = 	$first.'|'.$second; 	
		}
		elseif($first > 0)
		{
			$nowchecked = 	$first;
			
		}
		$result=mysql_query("select * from product_attribute where prod_id=$pid and attribute_option_id='$nowchecked' ");
		$row=mysql_fetch_array($result);
		extract($row);
		$product_delivery = $this->get_product_delivered_price($pid);
		if($attribute_dis_price != 0) 
		{ 
		  return $attribute_dis_price+$product_delivery; 
		} 
		else 
		{ 
		  return $attribute_price+$product_delivery; 
		}	
	}
	else
	{
		$result=mysql_query("select * from product where prod_id = $pid ");
		$row=mysql_fetch_array($result);
		extract($row);
		$product_delivery = $this->get_product_delivered_price($pid);
		if($prodcut_discount_rate != 0) 
		{ 
		  return $prodcut_discount_rate+$product_delivery; 
		} 
		else 
		{ 
		  return $prodcut_discount_rate+$product_delivery; 
		}	
	}
	
}
//Combo Delivery in INR
function get_combo_delivered_price($cid)
{
	$result=mysql_query("select * from combo where combo_id = '$cid' ");
	$row=mysql_fetch_array($result);
	if($row['combo_delivery'] == '') { return '0'; } else { return $row['combo_delivery']; }
}

	
	// Product Total Price
function get_combo_amount($cid)
{
	$result=mysql_query("select * from combo where combo_id = '$cid' ");
	$row=mysql_fetch_array($result);
	extract($row);
	
	$combo_delivery = $this->get_combo_delivered_price($cid);
	
	if($combo_discount_rate > 0) 
	{ 
      return $combo_discount_rate+$combo_delivery; 
	} 
	else 
	{ 
      return $combo_rate+$combo_delivery; 
	}
}

	// Product Total Price
	function get_product_price($pid,$first,$second)
	{
		
		if($first > 0)
		{
			if($first > 0 && $second >0)
			{
				$nowchecked = 	$first.'|'.$second; 	
			}
			elseif($first > 0)
			{
				$nowchecked = 	$first;
				
			}
			
			$result=mysql_query("select * from product_attribute where prod_id = '$pid' and attribute_option_id='$nowchecked' ");
			$row=mysql_fetch_array($result);
			extract($row);
			$product_delivery = $this->get_product_delivered_price($pid);
			if($attribute_dis_price != 0) 
			{ 
				return $attribute_dis_price+$product_delivery; 
			} 
			else 
			{ 
				return $attribute_price+$product_delivery; 
			}
			
		}
		else
		{
			$result=mysql_query("select * from product where prod_id=$pid");
			$row=mysql_fetch_array($result);
			extract($row);

				if($prodcut_discount_rate > 0)
				{
					return $prodcut_discount_rate;
				} 
				else 
				{
					return $product_rate;
				}
		}
		
	}
	
	// Product Total Price
	function get_product_selling_price($pid,$first,$second)
	{
		
		if($first > 0)
		{
			if($first > 0 && $second >0)
			{
				$nowchecked = 	$first.'|'.$second; 	
			}
			elseif($first > 0)
			{
				$nowchecked = 	$first;
				
			}
			
			$result=mysql_query("select * from product_attribute where prod_id = '$pid' and attribute_option_id='$nowchecked' ");
			$row=mysql_fetch_array($result);
			extract($row);
			$product_delivery = $this->get_product_delivered_price($pid);
			
			
				return $attribute_price+$product_delivery; 
			
			
		}
		else
		{
			$result=mysql_query("select * from product where prod_id=$pid");
			$row=mysql_fetch_array($result);
			extract($row);

			return $product_rate;
				
		}
		
	}
	
	
	
	
	
	
	//combo price
	function get_combo_price($comb_id)
	{
		$result=mysql_query("select * from combo where combo_id=$comb_id");
		$row=mysql_fetch_array($result);
		extract($row);

		if($combo_discount_rate > 0)
		{
			return $combo_discount_rate;
		} 
		else 
		{
			return $combo_rate;
		}
	}
	
	
	//combo orignal price
	function get_combo_price_without_diss($comb_id)
	{
		$result=mysql_query("select * from combo where combo_id = $comb_id");
		$row=mysql_fetch_array($result);
		extract($row);
			return $combo_rate;
	}

	//Product Discount in INR
	function get_product_discount_price($pid){
		$result=mysql_query("select * from product where prod_id=$pid");
		$row=mysql_fetch_array($result);
		if($row['prodcut_discount_rate'] == '') { return ''; } else { return $row['prodcut_discount_rate']; }
	}
	
	//Product price without discount
	function get_product_without_discount_price($pid)
	{
		$result=mysql_query("select * from product where prod_id=$pid");
		$row=mysql_fetch_array($result);
	    return $row['product_rate']; 
	}
	
	public function get_all_product(){
		$sql = "SELECT * FROM product WHERE status='active' ORDER BY id DESC ";
		$query = mysql_query($sql);
		return $query;
	}

	public function get_all_product_img($id){
		$sql = "SELECT * FROM product_image WHERE prod_id =$id ORDER BY postion ASC ";
		$query = mysql_query($sql);
		return $query;
	}

	public function get_single_product_img($id){
		$sql = "SELECT * FROM product_image WHERE prod_id=$id ORDER BY postion ASC LIMIT 1";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		$img = $row['product_img'];
		$site_url = SITE_URL;
		if($img !='' ) {
		$img = $row['product_img'];
		} else {
			$img = 'no_image.jpg';
		}
		return $img;
	}
	
	public function get_single_combo_img($cid){
		$sql = "SELECT * FROM combo WHERE combo_id=$cid ";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		$img = $row['image'];
		$site_url = SITE_URL;
		if($img !='' ) {
		$img = $row['image'];
		} else {
			$img = 'no_image.jpg';
		}
		return $img;
	}
	
	public function get_single_order_product_img($id){
		$sql = "SELECT * FROM order_prodcut_details WHERE orderid='$id' ORDER BY id ASC LIMIT 2";
		$query = mysql_query($sql);
		return $query;
	}

	public function get_product_menu(){
		$sql = "SELECT * FROM product WHERE status='active' ORDER BY product_name ASC";
		$query = mysql_query($sql);
		return $query;
	}
	
	
	//Admin Product Edit Related
	public function get_coupon_product($coupon_id,$prod_id){
		$sqlabc = "SELECT * FROM coupon WHERE FIND_IN_SET($prod_id,product_id) and coupon_id='$coupon_id' ";
			
		$queryabc = mysql_query($sqlabc);
		$count =   mysql_num_rows($queryabc);
		if($count > 0){
			return 'selected';
		}
		
	}
	
	public function get_new_product($limit){
		$sql = "SELECT * FROM product WHERE status='active' ORDER BY id DESC LIMIT $limit";
		$query = mysql_query($sql);
		return $query;
	}
	
	public function get_today_product($best,$limit,$disc){
		if($limit !='') { $limitadd = " LIMIT $limit"; } else { $limitadd = ""; }
                if($disc ==1) { $where = " and prodcut_discount_rate !=0 "; } 
		$sql = "SELECT * FROM product WHERE status='active' and FIND_IN_SET('$best',best_sales) $where ORDER BY rand() DESC $limitadd";
		$query = mysql_query($sql);
		return $query ;
	}
	
	public function product_delivery_day($id)
    {
        $select = mysql_query("SELECT * FROM product WHERE prod_id = '$id'");
        $row=mysql_fetch_array($select);
        $day = $row['product_delivery_day'];
        $NewDate=Date('M d, Y', strtotime("+$day days"));
        return  $NewDate;
    }

   public function product_delivery_for_order($oid,$id)
    {
        $select = mysql_query("SELECT * FROM product WHERE prod_id = '$id'");
        $row=mysql_fetch_array($select);
        $day = $row['product_delivery_day'];
		
		$select_date = mysql_query("SELECT * FROM order_details WHERE orderid = '$oid'");
		$row_date = mysql_fetch_array($select_date);
		$odrerdate = explode(' ',$row_date['orderdate']);
		$year = $odrerdate[0];
        $NewDate= date('M d, Y', strtotime($year. ' + '.$day.' days'));
        return  $NewDate;
    }
	
	 public function combo_delivery_for_order($oid,$id)
    {
        $select = mysql_query("SELECT * FROM combo WHERE combo_id = '$id'");
        $row=mysql_fetch_array($select);
        $day = $row['combo_delivery_day'];
		
		$select_date = mysql_query("SELECT * FROM order_details WHERE orderid = '$oid'");
		$row_date = mysql_fetch_array($select_date);
		$odrerdate = explode(' ',$row_date['orderdate']);
		$year = $odrerdate[0];
        $NewDate= date('M d, Y', strtotime($year. ' + '.$day.' days'));
        return  $NewDate;
    }
	
  //recent viewed products	
  public function get_recent_product($limit)
  {
       if($limit !='') { $limitadd = " LIMIT $limit"; } else { $limitadd = ""; }
       $ip = $this->get_user_ip();
       $sql = "select RVP.*,P.* from recent_viewproduct as RVP JOIN product as P ON RVP.prod_id=P.prod_id where RVP.status='active' and RVP.ip_address='$ip' ORDER BY RVP.id DESC $limitadd ";
       $query = mysql_query($sql);
       return $query;
   }
	
	/***Product qty by attribute*******/
    public function get_qty_sum($pid,$q,$first,$second)
	{
		
		  if($second > 0)
		  {
				$now = $first.'|'.$second;
		  }
		  else
		  {
				$now = $first; 
		  }
		
		  $qty = mysql_query("SELECT * FROM product_attribute WHERE prod_id = '$pid' and attribute_option_id = '$now'  and attri_group_id > 0 ");
		  $count = mysql_num_rows($qty);
		  if($count > 0)
		  {
				$qty_result = mysql_fetch_array($qty);
				return $qty_result['attribute_stock'];
		  }
	}
	
	public function get_qty_sum_product($q)
	{
				$qty = mysql_query("SELECT * FROM product WHERE prod_id = '$q' ");
				$qty_result = mysql_fetch_array($qty);
				$count = mysql_num_rows($qty);
				if($count > 0)
				{
					return $qty_result['product_qty'];
				}
	}
	
	/***combo qty *******/
    public function get_combo_qty_sum($q)
	{
		  $qty = mysql_query("SELECT * FROM combo WHERE combo_id = '$q' ");
		  $qty_result = mysql_fetch_array($qty);
		  return $qty_result['combo_qty'];
	}

/********************** Cart Product Details Functions ***************************/
//Cart Total
function get_order_total()
{
	
    $max=count($_SESSION['cart']);
	$sum=0;
	for($i=0;$i<$max;$i++)
	{
		$pid = $_SESSION['cart'][$i]['productid'];
		$q = $_SESSION['cart'][$i]['qty'];
		$attribute = $_SESSION['cart'][$i]['attribute'];	
		$combo = $_SESSION['cart'][$i]['combo'];
		$first= $attribute['first'];
		$second = $attribute['second'];
		$productprice = $this->get_product_price($pid,$first,$second);
		$combo_price = $this->get_combo_amount($combo);
		$sum += ($productprice*$q+$combo_price*$q);	
	}
	   return round($sum);
	
}


//Cart Product Qty
function get_product_qty($pid){
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
	if($pid==$_SESSION['cart'][$i]['productid']){
	$qty = $_SESSION['cart'][$i]['qty'];
	//break;
	}
	}
	return $qty;
}

//Cart combo Qty
function get_combo_qty($cid)
{
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++)
	{
		if($cid==$_SESSION['cart'][$i]['combo'])
		{
			$qty = $_SESSION['cart'][$i]['qty'];
			//break;
		}
	}
	return $qty;
}

//Cart Qty
function get_cart_qty(){
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
	$cartqty += $_SESSION['cart'][$i]['qty'];
	}	
	//$cartqty = count($_SESSION['cart']);
	return intval($cartqty);
}



/******************Attribute Get Functions*********************/

// All Attribute Group
	public function get_all_attribute_group(){
		$sql = "SELECT * FROM attribute_group WHERE status='active'";
		$query = mysql_query($sql);
		return $query;
	}



	// All Attribute Option Name
	public function get_all_attribute($id){
		$sql = "SELECT * FROM attribute_option WHERE attribute_id=$id";
		$query = mysql_query($sql);
		return $query;
	}
	

	
	// Attribute Name
	public function get_attribute_name($id){
		$sql = "SELECT * FROM attribute WHERE attribute_id=$id";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['attribute_name'];
	}
	
	
	// Attribute Name
	public function get_attribute_option_name($id){
		$sql = "SELECT * FROM attribute_option WHERE id=$id ";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['attribute_option_name'];
	}
	
	// Attribute Name
	public function get_attribute_hex_code($id){
		$sql = "SELECT * FROM attribute_option WHERE id=$id ";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['attribute_hex_code'];
	}
	
	
	// Attribute Name
	public function get_attribute_id_option_id($id){
		$sql = "SELECT * FROM attribute_option WHERE id=$id";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['attribute_id'];
	}
	
	// Check Attribute
	public function get_attribute($attribute_id,$related_prod_id){
		$sqlabc = "SELECT * FROM product_attribute WHERE attribute_id='$attribute_id' and prod_id='$related_prod_id' ";
		$queryabc = mysql_query($sqlabc);
		$count =   mysql_num_rows($queryabc);
		if($count > 0){
			return 'checked';
		}
	}
	
	// Check Attribute
	public function get_attribute_option_id($attribute_option_id,$related_prod_id){
		$sqlabc = "SELECT * FROM product_attribute WHERE attribute_option_id='$attribute_option_id' and prod_id='$related_prod_id' ";
		$queryabc = mysql_query($sqlabc);
		$count =   mysql_num_rows($queryabc);
		if($count > 0){
			return 'selected';
		}
	}
	
	// Check Attribute Price
	public function get_attribute_option_price($attribute_option_id,$related_prod_id){
		$sqlabc = "SELECT * FROM product_attribute WHERE attribute_option_id='$attribute_option_id' and prod_id='$related_prod_id' ";
		$queryabc = mysql_query($sqlabc);
		$count =   mysql_num_rows($queryabc);
		$row = mysql_fetch_array($queryabc);
		if($count > 0){
			return $row['attribute_price'];
		}
	}
	
	// Check Attribute Price
	public function get_attribute_option_disprice($attribute_option_id,$related_prod_id){
		$sqlabc = "SELECT * FROM product_attribute WHERE attribute_option_id='$attribute_option_id' 
		and prod_id='$related_prod_id' ";
		$queryabc = mysql_query($sqlabc);
		$count =   mysql_num_rows($queryabc);
		$row = mysql_fetch_array($queryabc);
		if($count > 0){
			return $row['attribute_dis_price'];
		}
	}
	
	//Get Required Atribute
	public function get_required_attribute(){
		$query = mysql_query("SELECT * FROM attribute WHERE attribute_required=1");
		return mysql_num_rows($query);
		
	}
	
	//Get Parent Atribute id
	public function get_parent_attribute_id($id){
		$query = mysql_query("SELECT * FROM attribute_option WHERE id=$id");
		$row = mysql_fetch_array($query);
		return $row['attribute_id'];
	}
	
	
/******************Website Get Functions*********************/	
	
	public function get_user_first_name($id){
		$sql = "SELECT * FROM user WHERE user_id=$id and status='active'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['first_name'];
	}
	
	public function get_user_name($id){
		$sql = "SELECT * FROM user WHERE user_id=$id and status='active'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['first_name'].' '.$row['last_name'];
	}
	
	public function get_user_email($id){
		$sql = "SELECT * FROM user WHERE user_id=$id and status='active'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['email'];
	}
	
	public function get_user_phone($id){
		$sql = "SELECT * FROM user WHERE user_id=$id and status='active'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['phone'];
	}
	
	// Get Website User
	public function get_website_session(){
		if($_SESSION['websiteuser'] !=''):
		return $_SESSION['websiteuser'];	
		else:
		return null;
		endif;
	}
	
	
	
	
/******************Slider Get Functions*********************/		
	

	public function get_slider(){
		$sql = "SELECT * FROM slider WHERE status='active' ORDER BY slider_order ASC";
		$query = mysql_query($sql);
		return $query;
	}


/******************Slider Get Functions*********************/		
	

	public function get_category_detail_by_id($main_cat_id,$limit){
		
		if($limit !='') { $limitadd = " LIMIT $limit"; } else { $limitadd = ""; }
		
		$sql = "SELECT * FROM  category WHERE status='active' and parent_id='$main_cat_id' ORDER BY orderno ASC $limitadd";
		$query = mysql_query($sql);
		return $query;
	}

	

/******************Brand Get Functions*********************/		
	
	public function get_brand(){
		if($limit !='') { $limitadd = " LIMIT $limit"; } else { $limitadd = ""; }
		$sql = "SELECT * FROM brand WHERE status='active' ORDER BY id DESC $limitadd ";
		$query = mysql_query($sql);
		return $query;
	}

		
/******************Ads Get Functions*********************/	
	
	// Get Add
	function get_ads($ad_postion,$ad_page,$ad_place){
		$selectads = " SELECT * FROM ads WHERE ad_postion='$ad_postion' and ad_page='$ad_page' and ad_place = '$ad_place' and status='active' ORDER BY RAND() LIMIT 1 ";
		$sql = mysql_query($selectads);
		$row = mysql_fetch_array($sql);
		extract($row);
		if($ad_img !=''){
			$url = SITE_URL;
			//$path = $url.'/upload/ads/'.$ad_img;
			return $ad_img;			
		}
		else {
			return $ad_code;
		}
	}

// Get Add Url
	function get_ads_url($ad_postion,$ad_page,$ad_place){
		$selectads = " SELECT ad_url FROM ads WHERE ad_postion='$ad_postion' and ad_page='$ad_page' and ad_place = '$ad_place' and status='active' ORDER BY RAND() LIMIT 1 ";
		$sql = mysql_query($selectads);
		$row = mysql_fetch_array($sql);
		extract($row);		
	    return $ad_url;
		
	}


/******************Admin Index Get Functions*********************/	


	//Get Total User
	function get_total_user(){
		$result=mysql_query("select * from user");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total User
	function get_total_coupon(){
		$result=mysql_query("select * from coupon");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total Page
	function get_total_page(){
		$result=mysql_query("select * from content");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total Slider
	function get_total_slider(){
		$result=mysql_query("select * from slider");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total Category
	function get_total_category(){
		$result=mysql_query("select * from category");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total Review
	function get_total_review(){
		$result=mysql_query("select * from review");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total Product
	function get_total_product(){
		$result=mysql_query("select * from product");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	
	//Get Total Pincode
	function get_total_pincode(){
		$result=mysql_query("select * from product_pincode");
		$count=mysql_num_rows($result);
		return round($count);
	}

	
	//Get Total Order
	function get_total_order(){
		$result=mysql_query("select * from order_details");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total Complete Order
	function get_total_complete_order(){
		$result=mysql_query("select * from order_details WHERE status='complete'");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total Complete Order
	function get_total_panding_order(){
		$result=mysql_query("select * from order_details WHERE status='panding'");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total Cancel Order
	function get_total_cancel_order(){
		$result=mysql_query("select * from order_details WHERE status='cancel'");
		$count=mysql_num_rows($result);
		return round($count);
	}
	
	//Get Total Amount Order
	function get_total_price_order(){
		$result=mysql_query("select sum(total_amount) as total FROM order_details WHERE status='complete'");
		$row=mysql_fetch_array($result);
		return round($row['total']);
	}
	
	//Get Total Pending Amount
	function get_total_pandding_price_order(){
		$result=mysql_query("select sum(total_amount) as total FROM order_details WHERE status='panding'");
		$row=mysql_fetch_array($result);
		return round($row['total']);
	}
	
	//Get User Total Order
	function get_user_total_order($id){
		$result=mysql_query("select id FROM order_details WHERE user_id='$id'");
		$count=mysql_num_rows($result);
		return $count;
	}

	
	
/******************Filter Get Functions*********************/		
	//Get Filter Min Minimum
	public function get_min($get)
	{
		$sql = $get." ORDER BY product_rate ASC LIMIT 1";
		$query = mysql_query($sql);
		$row=mysql_fetch_array($query);
		
		if($row['prodcut_discount_rate'] > 0)
		{
			return $row['prodcut_discount_rate'];
		}
		else
		{
			return $row['product_rate'];
		}
	}
	
	//Get Filter Max Maximum
	public function get_max($get)
	{
		$sql = $get." ORDER BY product_rate DESC LIMIT 1";
		$query = mysql_query($sql);
		$row=mysql_fetch_array($query);
		return $row['product_rate'];
	}
/******************Review Get Functions*********************/	
	
	//get total rating
	function get_product_rating($id){		
		$result=mysql_query("select * from review where status='active' and product_id='$id' ");
		$count=mysql_num_rows($result);
		if($count ==0){
			$count = 1;
		} else {
			$count = $count;
		}
		return round($count);
	}

	//get total rating
	function get_product_avg_rating($id){
		$resulta=mysql_query("select * from review where status='active' and product_id='$id' ");
		$count = mysql_num_rows($resulta);
		$result=mysql_query("select SUM(review_star) as total from review where status='active' and product_id='$id' ");
		$row=mysql_fetch_array($result);
		$avg = $row['total']/$count;
		if($avg == 0 ){
			$avg = 3;
		} else {
			$avg = $avg;
		}
		return round($avg);
	}
	

	
	
/******************Wishlist Get Functions*********************/	
	//Get Wishlist Details
	function get_wishlist($pid,$uid)
	{
		$sql = " SELECT * FROM wishlist WHERE prod_id='$pid' and user_id='$uid'";
		$query = mysql_query($sql);
		$count = mysql_num_rows($query);
		if($count == 1)
		{ 
			$active = 'pink-button-active'; 
		}
		return $active;
	}
	
/******************Pincode Get Functions*********************/		
	//Get Pincode
	function get_pincode($pid){
		$sql = " SELECT * FROM product_pincode WHERE pincode='$pid'";
		$query = mysql_query($sql);
		$count = mysql_num_rows($query);
		$result = mysql_fetch_array($query);
		extract($result);
		if($count > 0)
		{
			$array = array('active'=>'yes','cod_available'=>$cod_serviceable);
			return json_encode($array);
		} 
		else 
		{ 
			$array = array('active'=>'no','cod_available'=>$cod_serviceable);
			return json_encode($array);
		}
		return $active;
	}

/******************Address Get Functions*********************/		
	//Get Address
	function get_address($uid){
		$sql = " SELECT * FROM customer_details WHERE userid='$uid'";
		$query = mysql_query($sql);
		$count = mysql_num_rows($query);
		if($count > 0){ return $query; } else { return 'no'; }
	}	
	
/******************Get stock attribute*********************/			

	public	function get_stock_attribute($pid)
	{			
	
		$select_product = mysql_query("SELECT * FROM  product_attribute WHERE prod_id='$pid' and attri_group_id!=0");
		$count = mysql_num_rows($select_product);
		if($count > 0){ return $select_product; } else { return 'no'; }
    }
	
	/******************Get stock product attribute *********************/			

	public	function get_stock_product_attribute($pid,$attr_op_id)
	{			
		$select_product = mysql_query("SELECT * FROM  product_attribute WHERE prod_id='$pid' and attribute_option_id='$attr_op_id' and attri_group_id!=0");
		$count = mysql_num_rows($select_product);
		if($count > 0){ return $select_product; } else { return 'no'; }
    }
	
	
/******************Youtube Video*********************/			

	public	function get_youtube_embed($id)
	{			
		$listing_videos_array = explode(",",$id);
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$listing_videos_array[0],$matches);
		$path = "http://www.youtube.com/v/".$matches[1];
		return $path;
    }	
	
/******************Search*********************/

	public function get_search_categorys($q){
		$select_cat = "SELECT * FROM category WHERE category_name like '%$q%'";
		$select_cata = mysql_query($select_cat);
		while($row=mysql_fetch_array($select_cata)):
		$rowa[] = $row['category_id'];
		endwhile;
		return $rowa;
	}
	
	//Fetch youtube URL
	public function get_youtube_url_event($id)
	{
		$sql = "SELECT * FROM event WHERE id= '$id'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		return $row['video'];
	}
	public function attribute_group_name($id)
	{
		$sql = mysql_query("SELECT * FROM product_attribute WHERE prod_id = '$id' AND attri_group_id !='' ");
		$row = mysql_fetch_array($sql);
		return $row['attribute_id'];
	}
	public function attribute_option_name($id)
	{
		$sql = mysql_query("SELECT * FROM product_attribute WHERE prod_id = '$id' AND attri_group_id !='' ");
		$row = mysql_fetch_array($sql);
		return $row['attribute_option_id'];
	}
	
	public function get_product_attri_group_name($id)
	{
		$sql = mysql_query("SELECT * FROM product_detail_group WHERE id = '$id' AND status  = 'active' ");
		$row = mysql_fetch_array($sql);
		return $row['attri_group_name'];
		
	}
	
	public function get_product_attri_name($id)
	{
		$sql = mysql_query("SELECT * FROM product_detail_attribute WHERE id = '$id' AND status  = 'active' ");
		$row = mysql_fetch_array($sql);
		return $row['attri_group_name'];
		
	}
	
public function get_product_by_category($cat_id,$limit,$disc){
		if($limit !='') { $limitadd = " LIMIT $limit"; } else { $limitadd = ""; }
                if($disc ==1) { $where = " and prodcut_discount_rate !=0 "; } 
		$sql = "SELECT * FROM product WHERE status='active' and FIND_IN_SET('$cat_id',cat_id) $where ORDER BY rand() DESC $limitadd";
		$query = mysql_query($sql);
		return $query ;
	}	

public function get_combo_product($limit,$disc){
		if($limit !='') { $limitadd = " LIMIT $limit"; } else { $limitadd = ""; }
        if($disc ==1) { $where = " and combo_discount_rate !=0 "; } 
		$sql = "SELECT * FROM combo WHERE status = 'active' $where ORDER BY rand() DESC $limitadd";
		$query = mysql_query($sql);
		return $query ;
	}		


//Product Cancel And Return
public function is_cancel_order($order_id)
	{
		
		$sql = mysql_query("SELECT *  FROM cancel_order WHERE order_id = '".$order_id."' ");
		$count= mysql_num_rows($sql);

		if($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function cancel_date($order_id)
	{
		
		$sql = mysql_query("SELECT date  FROM cancel_order WHERE order_id = '".$order_id."' ");
		$count= mysql_num_rows($sql);

		if($count > 0)
		{
			$result = mysql_fetch_array($sql);
			return $result['date'];
		}
		
	}
	public function cancel_reason($order_id)
	{
		
		$sql = mysql_query("SELECT reason  FROM cancel_order WHERE order_id = '".$order_id."' ");
		$count= mysql_num_rows($sql);

		if($count > 0)
		{
			$result = mysql_fetch_array($sql);
			return $result['reason'];
		}
		
	}
	public function cancel_comment($order_id)
	{
		
		$sql = mysql_query("SELECT comment FROM cancel_order WHERE order_id = '".$order_id."' ");
		$count= mysql_num_rows($sql);

		if($count > 0)
		{
			$result = mysql_fetch_array($sql);
			return $result['comment'];
		}
		
	}
	public function is_return_order($order_id)
	{
		$sql = mysql_query("SELECT *  FROM return_order WHERE order_id = '".$order_id."' ");
		$count= mysql_num_rows($sql);

		if($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function return_date($order_id)
	{
		
		$sql = mysql_query("SELECT date  FROM return_order WHERE order_id = '".$order_id."' ");
		$count= mysql_num_rows($sql);

		if($count > 0)
		{
			$result = mysql_fetch_array($sql);
			return $result['date'];
		}
		
	}
	public function return_reason($order_id)
	{
		
		$sql = mysql_query("SELECT reason  FROM return_order WHERE order_id = '".$order_id."' ");
		$count= mysql_num_rows($sql);

		if($count > 0)
		{
			$result = mysql_fetch_array($sql);
			return $result['reason'];
		}
		
	}
	public function return_comment($order_id)
	{
		
		$sql = mysql_query("SELECT comment FROM return_order WHERE order_id = '".$order_id."' ");
		$count= mysql_num_rows($sql);

		if($count > 0)
		{
			$result = mysql_fetch_array($sql);
			return $result['comment'];
		}
		
	}
	

public function validate_image($filename,$min_img_width,$min_img_height,$min_img_size,$max_img_width,$max_img_height,$max_img_size)
{
	
//$filename = $_FILES['image']['tmp_name'];
//$size = getimagesize($filename);
// or
list($width, $height) = getimagesize($filename);
// USAGE:  echo $width; echo $height;


$file_size = filesize($filename); // Get file size in bytes
$file_size = $file_size / 1024; // Get file size in KB
$get_file_size= number_format($file_size, 2, '.', '');


$minimum = array('width' => $min_img_width, 'height' => $min_img_height, 'size' => $min_img_size);
$maximum = array('width' => $max_img_width, 'height' => $max_img_height, 'size' => $max_img_size);
   
     if($width < $minimum['width'] || $height <  $minimum['height'] || $file_size <  $minimum['size'] || $width > $maximum['width'] || $height >  $maximum['height'] || $file_size >  $maximum['size']){
		
	return array("error"=>"Image Uploading error. Required Width {$minimum['width']} X {$maximum['width']}px, Height {$minimum['height']} X {$maximum['height']}px And size should be less than {$maximum['size']}kb. Uploaded image width $width px And height is $height px And Size is $file_size");	
	}
	else if(($width < $minimum['width']) && ($height <  $minimum['height']) && ($file_size <  $minimum['size'])){
		
	return array("error"=>"Image dimensions are too small. Minimum width {$minimum['width']}px. And height {$minimum['height']}px. And size should be larger than {$minimum['size']}kb. Uploaded image width $width px And height is $height px And Size is $file_size");	
	}
	else if(($width > $maximum['width']) && ($height >  $maximum['height']) && ($file_size >  $maximum['size'])){
		
	return array("error"=>"Image dimensions are too large. Maximum width {$maximum['width']}px. And height {$maximum['height']}px. And size should be less than {$maximum['size']}kb. Uploaded image width $width px And height is $height px And Size is $file_size");	
	}
	else if (($width < $minimum['width']) && ($height <  $minimum['height'])){
	return array("error"=>"Image dimensions are too small. Minimum width {$minimum['width']}px. And height should be {$minimum['height']}px. Uploaded image width $width px And height is $height px");	
	}
	
	else if ($width < $minimum['width'] ){
		
      return  array("error"=>"Image dimensions are too small. Minimum width is {$minimum['width']}px. Uploaded image width is $width px");
	}
    else if ($height <  $minimum['height']){
        return array("error"=>"Image dimensions are too small. Minimum height is {$minimum['height']}px. Uploaded image height is $height px");
    } else if ($file_size >  $maximum['size']){
        return array("error"=>"Image size is too large. Maximum size {$maximum['size']}kb. Uploaded image size is $get_file_size kb");
    }else {
         return array("success"=>"Congratulation Image dimensions and size is good");		
         

		}	
	
}


#INVOICE 

public function generate_invoice_no($Oid)
	{
		
		$sql = mysql_query("SELECT * FROM order_details WHERE orderid = '$Oid' ");
		$result = mysql_fetch_array($sql);
		extract($result);
		
		//if($payment_method=='COD'){ $method = 'OFL/'; }else{$method ='OL/';};
		
		$method ='OL/';
		$text = 'BRI/';
		
		$month = $this->generate_hindi_month();
		
		$len = strlen($id);
		if($len < 4)
		{
		    $rem = 4-$len;
			
			for($i=1;$i<=$rem;$i++)
			{
				$full .= 0;
				
			}
			return $text.$method.$month.$full.$id;
			
		}
		else
		{
			return $text.$method.$month.$id;
		}
		
	}
	public function generate_hindi_month()
	{
		$date = date('m-y');
		$expdate = explode('-',$date);
		$next = $expdate[1]+1;
		$prev = $expdate[1]-1;
		
		if($expdate[0] < 3)
		{
			return $prev.'-'.$expdate[1].'/';
		}
		else
		{
			return $expdate[1].'-'.$next.'/';
		}
	}
	
	public function invoice_date($Oid)
	{
		$sql = mysql_query("SELECT * FROM order_tracking WHERE orderid = '$Oid' AND status = 'approval' ");
		$result = mysql_fetch_array($sql);
		$count = mysql_num_rows($sql);
		if($count > 0)
		{
			extract($result);
			return $date;
		}
	}
	
	
	public function check_cst_or_vat($zip)
	{
		$sql = mysql_query("SELECT * FROM product_pincode WHERE pincode ='$zip' ");
		$result = mysql_fetch_array($sql);
		extract($result);
		
		if($state == 'Delhi'){
		return 'vat';
		}else{
		return 'cst';
		}
		
	}
	
	public function get_local_charges($prod_id)
	{
		$sql = mysql_query("SELECT * FROM product WHERE prod_id ='$prod_id' ");
		$result = mysql_fetch_array($sql);
		extract($result);
		return $local_charges;
		
	}
	public function get_central_charges($prod_id)
	{
		$sql = mysql_query("SELECT * FROM product WHERE prod_id ='$prod_id' ");
		$result = mysql_fetch_array($sql);
		extract($result);
		return $central_charges;
	}

//Product code
	function get_product_code($pid)
	{
		$result=mysql_query("select product_code from product where prod_id=$pid");
		$row=mysql_fetch_array($result);
		return $row['product_code'];
	}
		
//class End
}
?>