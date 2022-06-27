<?php
include 'get-functions.php';

class Set extends Get
{
//Class Start

/***********************Main Functions********************/
	
	//Edit Setting
	public function update_setting(){
		extract($_POST);
		if($_FILES['website_logo']['name'] != '' ){
			$dir = '../upload/comman/';
			$newname = 'logo_'.rand();
			$website_logo_img = $_FILES['website_logo']['name'];
			$extension = end(explode(".", $website_logo_img));
			$newfilename = $newname.".".$extension;
			move_uploaded_file($_FILES['website_logo']['tmp_name'],$dir.$newfilename);
			$unlinkpath = $dir.$this->get_logo();
			unlink($unlinkpath);
			$website_logo = "website_logo='$newfilename',"	;
		}
		if($_FILES['website_favicon']['name'] != ''){
			$dir = '../upload/comman/';
			$newname = 'favicon_'.rand();
			$website_favicon_img = $_FILES['website_favicon']['name'];
			$extension = end(explode(".", $website_favicon_img));
			$newfilename = $newname.".".$extension;
			move_uploaded_file($_FILES['website_favicon']['tmp_name'],$dir.$newfilename);
			$unlinkpath = $dir.$this->get_favicon();
			unlink($unlinkpath);
			$website_favicon = "website_favicon='$newfilename',";
		}
		$google_analytics =  $this->get_input($google_analytics);	
		
		
		$sql = "UPDATE global_setting 
		SET
		email='$email',
		phone_no='$phone_no',
		whatsup_no='$whatsup_no',
		address='$address',
		website_name='$website_name',
		website_url='$website_url',
		$website_logo
		$website_favicon
		copyright='$copyright',
		facebook_url='$facebook_url',
		twitter_url='$twitter_url',
		google_plus_url='$google_plus_url',
		linkedin_url='$linkedin_url',
		youtube_url='$youtube_url',
		google_analytics='$google_analytics',
		google_map='$google_map',
		site_per_page='$site_per_page',
		site_per_page_description='$site_per_page_description',
		admin_per_page='$admin_per_page',
		review_allow='$review_allow',
		guest_review_allow='$guest_review_allow',
		coupan_allow='$coupan_allow',
		guest_checkout='$guest_checkout',
		display_stock='$display_stock',
		cashondelivery='$cashondelivery',
		minimum_cart_value='$minimum_cart_value',
		delivery_charges='$delivery_charges'
		WHERE id='1'
		";
		
		if(mysql_query($sql)){
			header('location:setting.php?msg=success');
		} else {
			header('location:setting.php?msg=error');
		}
	}
	
	
	// Do action 
	public function do_action($do,$actioncheck,$tbname){
		$del=array();
		$del = $actioncheck;
		if($do == 'delete'):
		for($x=0;$x<sizeof($del);$x++){
		mysql_query("DELETE FROM $tbname WHERE id='".$del[$x]."'");
		}
		else:
		for($x=0;$x<sizeof($del);$x++){
		mysql_query("UPDATE $tbname SET status='$do' WHERE id='".$del[$x]."'");
		}
		endif;
		return true;
	}
	
	//Create Thumb
	function create_thumb($thum_width,$thum_height,$img_path,$thumb_path,$new_thumbname1)
	{
		$url = $img_path.$new_thumbname1;
		$extension = end(explode(".", $new_thumbname1));
		if($extension == 'jpeg' || $extension == 'jpg' || $extension == 'JPEG' || $extension == 'JPG'){
			$src = imagecreatefromjpeg($url);
		} else {
			$src = imagecreatefrompng($url);
		}
		$maxwidth = $thum_width;
		$maxheight = $thum_height;

		$width = imagesx($src);
		$height = imagesy($src);
		if ($height > $width) 
		{  
		$ratio = $maxheight / $height; 
			if($ratio>1)
				{
				$newheight = $height;
				$newwidth = $width;
				$writex = round(($maxwidth - $newwidth) / 2);
				$writey = round(($maxheight - $newheight) / 2);
				}
				else
				{
				$newheight = $maxheight;
				$newwidth = $width * $ratio; 
				$writex = round(($maxwidth - $newwidth) / 2);
				$writey = 0;
				}
			}
			else 
			{

			$ratio = $maxwidth / $width;   
				if($ratio>1)
				{
				$newheight = $height;
				$newwidth = $width;
				$writex = round(($maxwidth - $newwidth) / 2);
				$writey = round(($maxheight - $newheight) / 2);
				}
				else
				{
				$newwidth = $maxwidth;  
				$newheight = $height * $ratio;   
				$writex = 0;
				$writey = round(($maxheight - $newheight) / 2);
				}
			}
				$clear = array('red'=>255,'green'=>255,'blue'=>255);
				$dst = imagecreatetruecolor($maxwidth, $maxheight);
				$clear = imagecolorallocate( $dst, $clear["red"], $clear["green"], $clear["blue"]);
				imagefill($dst, 0, 0, $clear);
				imagecopyresampled($dst, $src, $writex, $writey, 0, 0, $newwidth, $newheight, $width, $height);
				 $pth = $img_path.$thumb_path.$new_thumbname1;
				imagejpeg($dst, $pth, 90);

	}
	
	
	
		
		// Create Folder
		function createPath($path) {
			if (!file_exists($path) && !is_dir($path)) {
				mkdir($path, 0755, true);
				return true;				
			}
			else {
				return false;
			}
		}

/***********************Category Add/Update/Delete Functions********************/
	
//////////// Add Category ////////////
public function add_category(){
	extract($_POST);
	$category_url = $this->seo_friendly_url($category_name);
	if($_FILES['category_image']['name'] != '' ){
			$dir = '../upload/category/';
			$newname = 'category_'.rand();
			$img = $_FILES['category_image']['name'];
			$extension = end(explode(".", $img));
			$newfilename = $newname.".".$extension;
			move_uploaded_file($_FILES['category_image']['tmp_name'],$dir.$newfilename);
			$imgab = "category_image='$newfilename',"	;
		}
		if($_FILES['category_banner']['name'] != '' ){
			$dir = '../upload/category/';
			$newname = 'category_'.rand();
			$img = $_FILES['category_banner']['name'];
			$extension = end(explode(".", $img));
			$newfilename = $newname.".".$extension;
			move_uploaded_file($_FILES['category_banner']['tmp_name'],$dir.$newfilename);
			$imga = "category_banner='$newfilename',"	;
		}
	$sql = "
	INSERT INTO category 
	SET
	category_id='$category_id',
	parent_id='$parent_id',
	category_name='$category_name',
	category_url='$category_url',
	$imgab
	$imga
	category_title='$category_title',
	category_keyword='$category_keyword',
	category_desc='$category_desc',
	info = '$info',
	orderno='$orderno',
	category_home='$category_home',
	category_menu='$category_menu',
	status='$category_status'
	";
	if(mysql_query($sql)){
		header('Location: category.php?role=view&msg=succes');
	}
	else {
		header('Location: category.php?role=view&msg=error');
	}
}

///////////// Update Category ///////////
//Update Page
	public function update_category($id){
		extract($_POST);
		$category_url = $this->seo_friendly_url($category_name);
		if($_FILES['category_image']['name'] != '' ){
			$dir = '../upload/category/';
			$newname = 'category_'.rand();
			$img = $_FILES['category_image']['name'];
			$extension = end(explode(".", $img));
			$newfilename = $newname.".".$extension;
			move_uploaded_file($_FILES['category_image']['tmp_name'],$dir.$newfilename);
			$this->create_thumb(210,250,$dir,'thumb/th_',$newfilename);
			$imgab = "category_image='$newfilename',"	;
		}
		if($_FILES['category_banner']['name'] != '' ){
			$dir = '../upload/category/';
			$newname = 'category_'.rand();
			$img = $_FILES['category_banner']['name'];
			$extension = end(explode(".", $img));
			$newfilename = $newname.".".$extension;
			move_uploaded_file($_FILES['category_banner']['tmp_name'],$dir.$newfilename);
			$imga = "category_banner='$newfilename',"	;
		}
		$sql = "UPDATE category 
		SET 
		parent_id='$parent_id',
		category_name='$category_name',
		category_url='$category_url',
		$imgab
		$imga
		category_title='$category_title',
		category_keyword='$category_keyword',
		category_desc='$category_desc',
		info = '$info',
		category_menu='$category_menu',
		orderno='$orderno',
		category_home='$category_home',
		status='$category_status'
		WHERE id='$id'
		";
		if(mysql_query($sql)){
		header('Location: category.php?role=view&msg=succes');
		}
		else {
		header('Location: category.php?role=view&msg=error');
		}
	}
	
/***********************Product Add/Update/Delete Functions********************/	
//////////// Add Product ////////////
public function add_product(){
	
	extract($_POST);
	// ADD PRODUCT DETAILS
	$cat_id = implode(",",$cat_id);
	$subcat_id = implode(",",$subcat_id);
	$sub_subcat_id = implode(",",$sub_subcat_id);
	$related_prod_id = implode(",",$related_prod_id);
	$related_color_prod_id = implode(",",$related_color_prod_id);
	$checkedproduct_name = $this->get_input($product_name);
	$checkedproduct_code = $this->get_input($product_code);
	$checkedprodcut_title = $this->get_input($prodcut_title);
	$checkedprodcut_keyword = $this->get_input($prodcut_keyword);
	$checkedprodcut_desc = $this->get_input($prodcut_desc);
	$best_salesa = implode(",",$best_sales);
	
	$product_details = $this->get_input($details);
	$product_details_one = $this->get_input($details1);
	$product_details_two = $this->get_input($details2);
	$product_details_three = $this->get_input($details3);
	$product_details_four = $this->get_input($details4);
	
	if($_FILES['size_chart']['name'] !=''):
			$dir = '../upload/product/sizechart/';
			$newname = 'chart_'.rand();
			$website_event_img = $_FILES['size_chart']['name'];
			$extension = end(explode(".", $website_event_img));
			$newfilename = $newname.".".$extension;
			move_uploaded_file($_FILES['size_chart']['tmp_name'],$dir.$newfilename);
			$sizeimg = "size_chart='$newfilename',";
		endif;
	
	$sql = "
	INSERT INTO product 
	SET
	prod_id='$prod_id',
	cat_id='$cat_id',
	subcat_id='$subcat_id',
	sub_subcat_id='$sub_subcat_id',
	product_name='$checkedproduct_name',
	product_code='$checkedproduct_code',
	product_url='$product_url',
	product_qty='$product_qty',
	product_rate='$product_rate',
	prodcut_discount_rate='$prodcut_discount_rate',
	product_delivery='$product_delivery',
	product_delivery_day='$product_delivery_day',
	details='$product_details',
	details_one='$product_details_one',
	details_two='$product_details_two',
	details_three='$product_details_three',
	details_four='$product_details_four',
	prodcut_title='$checkedprodcut_title',
	prodcut_keyword='$checkedprodcut_keyword',
	prodcut_desc='$checkedprodcut_desc',
	instock='$instock',
	related_prod_id='$related_prod_id',
	related_color_prod_id='$related_color_prod_id',
	best_sales='$best_salesa',
	$sizeimg
	status='$status'
	";
	
	
	//ADD IMAGE
	$dir = "../upload/product/";
	$img = $_FILES['prodcut_img']['name'];
	for($a=0;$a<sizeof($_FILES['prodcut_img']['name']);$a++)
	{
		if($_FILES['prodcut_img']['name'][$a] !='' )
		{
			$newname = 'product_'.rand();
			$img = $_FILES['prodcut_img']['name'][$a];
			$extension = end(explode(".", $img));
			$newfilename = $newname.$a.".".$extension;
			move_uploaded_file($_FILES['prodcut_img']['tmp_name'][$a],$dir.$newfilename);
			$this->create_thumb(200,200,$dir,'thumb/th_',$newfilename);
			$this->create_thumb(1080,1140,$dir,'large/th_',$newfilename);
		    $sql_img =  "INSERT INTO product_image	 
			SET 
			prod_id='".$prod_id."',
			product_img='".$newfilename."',
			postion='".$imgpostion[$a]."',
			defaultimg='".$default[$a]."',
			status='1'
			";
			
			mysql_query($sql_img);
		}
	}
	
	
	//Add Stock
	$sql_group = mysql_query("SELECT * FROM attribute_group WHERE attri_group_id  = '".$stock_group_id."' ");
	$result_group = mysql_fetch_array($sql_group);
	
	for($i=0;$i<sizeof($stock_price);$i++)
	{
		$now_stock_option = $stock_option_id[$i];
		 
		if($stock_required > 1)
		{			
			$stock = '';
			$stock_option = '';
			for($x=0;$x<$stock_required;$x++)
			{
				$stock .= $stock_id[$x+$i*$stock_required]."|";
				$stock_option .= $stock_option_id[$x+$i*$stock_required]."|";
			}
			
			$now_stock = rtrim($stock,"|");
			$now_stock_option = rtrim($stock_option,"|");
		}
		else
		{
			
			$now_stock_option = $stock_option_id[$i];
			
		}
		
		
	    $stocksql = "INSERT INTO product_attribute 
		SET 
		prod_id='".$prod_id."',
		attri_group_id='".$stock_group_id."',
		attribute_id='".$result_group['attribute_ids']."',
		attribute_option_id='".$now_stock_option."',
		attribute_price='".$stock_price[$i]."',
		attribute_dis_price='".$stock_dis_price[$i]."',
		attribute_stock='".$stock_stock[$i]."',
		status='active'
		";	
		
		mysql_query($stocksql);
		
	}
	
	//ADD Product Attributes
	for($i=0;$i<sizeof($attribute_option_id);$i++)
	{				
		$attribute_id = $this->get_parent_attribute_id($attribute_option_id[$i]);
		$prodattributesql = "INSERT INTO  product_attribute 
		SET 
		prod_id='".$prod_id."',
		attribute_id='".$attribute_id."',
		attribute_option_id='".$attribute_option_id[$i]."'
		"; 
		mysql_query($prodattributesql);
	}

	//Add detail product attribute
	for($i=0;$i<sizeof($product_attri_group_id);$i++)
	{
		$product_att_sql = "INSERT INTO detail_product_attribute 
		SET 
		prod_id='".$prod_id."',
		product_attri_group_id='".$product_attri_group_id[$i]."',
		detail_product_att_name='".$detail_product_att_name[$i]."',
		detail_product_att_value='".$detail_product_att_value[$i]."'
		";	
		
		mysql_query($product_att_sql);
	}
	
	//die;
	
	if(mysql_query($sql))
	{
		header('Location: product.php?role=view&msg=succes');
	}
	else 
	{
		header('Location: product.php?role=view&msg=error');
	}
}

//////////// Update Product ////////////
public function update_product($ids,$request_prod_id,$page){
	//var_dump($_POST);
	extract($_POST);
	$cat_id = implode(",",$cat_id);
	$subcat_id = implode(",",$subcat_id);
	$sub_subcat_id = implode(",",$sub_subcat_id);
	$related_prod_id = implode(",",$related_prod_id);
	$related_color_prod_id = implode(",",$related_color_prod_id);
	$checkedproduct_name = $this->get_input($product_name);
	$checkedproduct_code = $this->get_input($product_code);
	$checkedprodcut_title = $this->get_input($prodcut_title);
	$checkedprodcut_keyword = $this->get_input($prodcut_keyword);
	$checkedprodcut_desc = $this->get_input($prodcut_desc);
	$best_salesa = implode(",",$best_sales);
	
	$product_details = $this->get_input($details);
	$product_details_one = $this->get_input($details1);
	$product_details_two = $this->get_input($details2);
	$product_details_three = $this->get_input($details3);
	$product_details_four = $this->get_input($details4);
	
	
	if($_FILES['size_chart']['name'] !=''):
			$dir = '../upload/product/sizechart/';
			$newname = 'chart_'.rand();
			$website_event_img = $_FILES['size_chart']['name'];
			$extension = end(explode(".", $website_event_img));
			$newfilename = $newname.".".$extension;
			move_uploaded_file($_FILES['size_chart']['tmp_name'],$dir.$newfilename);
			$sizeimg = "size_chart='$newfilename',";
		endif;
	
	
	$sql = "
	UPDATE product 
	SET
	cat_id='$cat_id',
	subcat_id='$subcat_id',
	sub_subcat_id='$sub_subcat_id',
	product_name='$checkedproduct_name',
	product_code='$checkedproduct_code',
	product_url='$product_url',
	product_qty='$product_qty',
	product_rate='$product_rate',
	prodcut_discount_rate='$prodcut_discount_rate',	
	product_delivery='$product_delivery',
	product_delivery_day='$product_delivery_day',
	details='$product_details',
	details_one='$product_details_one',
	details_two='$product_details_two',
	details_three='$product_details_three',
	details_four='$product_details_four',
	prodcut_title='$checkedprodcut_title',
	prodcut_keyword='$checkedprodcut_keyword',
	prodcut_desc='$checkedprodcut_desc',
	instock='$instock',
	related_prod_id='$related_prod_id',
	related_color_prod_id='$related_color_prod_id',
	best_sales='$best_salesa',
	$sizeimg
	status='$status'
	WHERE id=$ids
	";
	
	//ADD IMAGE
	$dir = "../upload/product/";
	$img = $_FILES['prodcut_img']['name'];
	for($ab=0;$ab<sizeof($_FILES['prodcut_img']['name']);$ab++)
	{
		if($_FILES['prodcut_img']['name'][$ab] !=''){
		$newname = 'product_'.rand();
		$img = $_FILES['prodcut_img']['name'][$ab];
		$extension = end(explode(".", $img));
		$newfilename = $newname.$ab.".".$extension;
		move_uploaded_file($_FILES['prodcut_img']['tmp_name'][$ab],$dir.$newfilename);
		$this->create_thumb(200,200,$dir,'thumb/th_',$newfilename);
		$this->create_thumb(1080,1140,$dir,'large/th_',$newfilename);
		$prodimg = "INSERT INTO product_image	 
		SET 
		prod_id='".$request_prod_id."',
		product_img='".$newfilename."',
		postion='".$imgpostion[$ab]."',
		defaultimg='".$default[$ab]."',
		status='1'
		";
		mysql_query($prodimg);
		}
	}
	
	
	//ADD stock
	mysql_query("DELETE FROM product_attribute WHERE prod_id='".$request_prod_id."' ");
	
	$sql_group = mysql_query("SELECT * FROM attribute_group WHERE attri_group_id  = '".$stock_group_id."' ");
	$result_group = mysql_fetch_array($sql_group);
	
	
	for($i=0;$i<sizeof($stock_price);$i++)
	{
		 
		if($stock_required > 1)
		{			
			$stock = '';
			$stock_option = '';
			for($x=0;$x<$stock_required;$x++)
			{
				$stock .= $stock_id[$x+$i*$stock_required]."|";
				$stock_option .= $stock_option_id[$x+$i*$stock_required]."|";
			}
			
			$now_stock = rtrim($stock,"|");
			$now_stock_option = rtrim($stock_option,"|");
		}
		else
		{
			
			$now_stock_option = $stock_option_id[$i];
			
		}
		
		
	    $stocksql = "INSERT INTO product_attribute 
		SET 
		prod_id='".$request_prod_id."',
		attri_group_id='".$stock_group_id."',
		attribute_id='".$result_group['attribute_ids']."',
		attribute_option_id='".$now_stock_option."',
		attribute_price='".$stock_price[$i]."',
		attribute_dis_price='".$stock_dis_price[$i]."',
		attribute_stock='".$stock_stock[$i]."',
		status='active'
		";	
		
		
		mysql_query($stocksql);
		
	}

	//ADD Product Attributes
	mysql_query("DELETE FROM product_attribute WHERE prod_id='$request_prod_id' AND attri_group_id = 0 ");
	
	for($i=0;$i<sizeof($attribute_option_id);$i++)
		{				
		    $attribute_id = $this->get_parent_attribute_id($attribute_option_id[$i]);
		    $prodattributesql = "INSERT INTO  product_attribute 
			SET 
			prod_id='".$request_prod_id."',
			attribute_id='".$attribute_id."',
			attribute_option_id='".$attribute_option_id[$i]."'
			"; 
			mysql_query($prodattributesql);
		}
	
	//Add detail product attribute
	mysql_query("DELETE FROM detail_product_attribute WHERE prod_id='".$request_prod_id."' ");
	for($i=0;$i<sizeof($product_attri_group_id);$i++)
	{
		$product_att_sql = "INSERT INTO detail_product_attribute 
		SET 
		prod_id='".$request_prod_id."',
		product_attri_group_id='".$product_attri_group_id[$i]."',
		detail_product_att_name='".$detail_product_att_name[$i]."',
		detail_product_att_value='".$detail_product_att_value[$i]."'
		";	
		
		mysql_query($product_att_sql);
	}
	
	//ADD RELATED
	mysql_query(" DELETE FROM product_related WHERE prod_id='".$request_prod_id."'  ");
	for($b=0;$b<sizeof($related_prod_id);$b++)
	{
	$relatedsql = "INSERT INTO product_related 
	SET 
	prod_id='".$request_prod_id."',
	related_prod_id='".$related_prod_id[$b]."'
	";
	mysql_query($relatedsql);
	}
	//echo $sql;
	if(mysql_query($sql)){
		header('Location: product.php?role=view&page='.$page.'&msg=succes');
	}
	else {
		header('Location: product.php?role=view&page='.$page.'&msg=error');
	}
}
//Add combo
public function add_combo()
{
	extract($_POST);
	$related_combo_id = implode(",",$related_combo_id);
	$checkedcombo_name = $this->get_input($combo_name);
	$checkedcombo_code = $this->get_input($combo_code);
	$checkedcombo_title = $this->get_input($combo_title);
	$checkedcombo_keyword = $this->get_input($combo_keyword);
	$checkedcombo_desc = $this->get_input($combo_desc);
	$combo_details = $this->get_input($details);
	
	
	if($_FILES['image']['name'] !='' )
	{
		$dir = "../upload/combo/";
		$img = $_FILES['image']['name'];
		$newname = 'combo_'.rand();
		$img = $_FILES['image']['name'];
		$extension = end(explode(".", $img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['image']['tmp_name'],$dir.$newfilename);
		$this->create_thumb(360,380,$dir,'thumb/th_',$newfilename);
		$this->create_thumb(1080,1140,$dir,'large/th_',$newfilename);
	}
	
	
	$sql = "
	INSERT INTO combo 
	SET
	combo_id='$combo_id',
	combo_name='$checkedcombo_name',
	combo_code='$checkedcombo_code',
	combo_qty='$combo_qty',
	combo_rate='$combo_rate',
	combo_discount_rate='$combo_discount_rate',
	combo_delivery='$combo_delivery',
	combo_delivery_day='$combo_delivery_day',
	details='$combo_details',
	combo_title='$checkedcombo_title',
	combo_keyword='$checkedcombo_keyword',
	combo_desc='$checkedcombo_desc',
	instock='$instock',
	image ='$newfilename',
	related_combo_id='$related_combo_id',
	status='$status'
	";
	
	
	if(mysql_query($sql))
	{
		header('Location: manage-combo.php?role=view&msg=succes');
	}
	else 
	{
		header('Location: manage-combo.php?role=view&msg=error');
	}
	
}
public function update_combo($id,$comb_id)
{
	extract($_POST);
	$related_combo_id = implode(",",$related_combo_id);
	$checkedcombo_name = $this->get_input($combo_name);
	$checkedcombo_code = $this->get_input($combo_code);
	$checkedcombo_title = $this->get_input($combo_title);
	$checkedcombo_keyword = $this->get_input($combo_keyword);
	$checkedcombo_desc = $this->get_input($combo_desc);
	$combo_details = $this->get_input($details);
	
	
	
	if($_FILES['image']['name'] !='' )
	{
		$dir = "../upload/combo/";
		$img = $_FILES['image']['name'];
		$newname = 'combo_'.rand();
		$img = $_FILES['image']['name'];
		$extension = end(explode(".", $img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['image']['tmp_name'],$dir.$newfilename);
		$this->create_thumb(360,380,$dir,'thumb/th_',$newfilename);
		$this->create_thumb(1080,1140,$dir,'large/th_',$newfilename);
		$img = "image='$newfilename',";
	}
	
	
	$sql = "Update combo 
	SET
	combo_name='$checkedcombo_name',
	combo_code='$checkedcombo_code',
	combo_qty='$combo_qty',
	combo_rate='$combo_rate',
	combo_discount_rate='$combo_discount_rate',
	combo_delivery='$combo_delivery',
	combo_delivery_day='$combo_delivery_day',
	details='$combo_details',
	combo_title='$checkedcombo_title',
	combo_keyword='$checkedcombo_keyword',
	combo_desc='$checkedcombo_desc',
	instock='$instock',
	$img
	related_combo_id='$related_combo_id',
	status='$status'
	WHERE id='$id'
	";
	
	
	if(mysql_query($sql))
	{
		header('Location: manage-combo.php?role=view&msg=succes');
	}
	else 
	{
		header('Location: manage-combo.php?role=view&msg=error');
	}
}	

//REcenet Viwed Product
public function recent_view_product($prod_id)
{        
	$recent_view = $this->get_user_ip(); 
	$time = date('Y-m-d H:i:s');


	$ab="select * from recent_viewproduct where prod_id='$prod_id' and ip_address='$recent_view'";    
	$rab=mysql_query($ab);
	$countab=mysql_num_rows($rab);
	if($countab == 0){

	$sql = "INSERT into recent_viewproduct
	SET prod_id='$prod_id',
		ip_address='$recent_view',
		datetime='$time',
		status='active'    
	"; 
	mysql_query($sql);
	}
}   

/***********************Attributes Add/Update/Delete Functions********************/

//////////// Add Attributes Group ////////////
public function add_attribute_group(){
	extract($_POST);
	$attribute = implode(",",$attribute_ids);
	$sql = "
	INSERT INTO attribute_group
	SET
	attri_group_id='$attri_group_id',
	attri_group_name='$attri_group_name',
	cat_id='$category',
	subcat_id='$subcategory',
	attribute_ids='$attribute',
	status='$status'
	";
	if(mysql_query($sql)){
		header('Location: attributes-group.php?role=view&msg=succes');
	}
	else {
		header('Location: attributes-group.php?role=view&msg=error');
	}
}


//////////// Add Attributes Group ////////////
public function update_attribute_group($attri_group_id){
	extract($_POST);
	$attribute = implode(",",$attribute_ids);
	$sql = "
	UPDATE attribute_group
	SET
	attri_group_name='$attri_group_name',
	cat_id='$category',
	subcat_id='$subcategory',
	attribute_ids='$attribute',
	status='$status'
	WHERE id='$attri_group_id'
	";
	if(mysql_query($sql)){
		header('Location: attributes-group.php?role=view&msg=succes');
	}
	else {
		header('Location: attributes-group.php?role=view&msg=error');
	}
}

//////////// Add Attributes ////////////
public function add_attribute(){
	extract($_POST);
	$sql = "
	INSERT INTO attribute 
	SET
	attribute_id='$attribute_id',
	attri_group_id='$attri_group_id',
	attribute_required='$attribute_required',
	attribute_name='$attribute_name',
	cat_id='$category',
	subcat_id='$subcategory',
	status='active'
	";
	for($a=0;$a<sizeof($attribute_option_name);$a++)
	{
	mysql_query("INSERT INTO attribute_option 
	SET 
	attribute_id='$attribute_id',
	attri_group_id='$attri_group_id',
	attribute_option_name='$attribute_option_name[$a]',
	attribute_position='$attribute_position[$a]',
	cat_id='$category',
	subcat_id='$subcategory',
	status='active'
	");
	}

	if(mysql_query($sql)){
		header('Location: attributes.php?role=view&msg=succes');
	}
	else {
		header('Location: attributes.php?role=view&msg=error');
	}
}


//////////// Update Attributes ////////////
public function update_attribute($id){
	$get_id = $id;
	extract($_POST);
	$sql = "
	UPDATE attribute 
	SET
	attribute_name='$attribute_name',
	attri_group_id='$attri_group_id',
	attribute_required='$attribute_required',
	cat_id='$category',
	subcat_id='$subcategory',
	status='active'
	WHERE id='$get_id'
	";
	mysql_query($sql);
	
	//mysql_query("DELETE FROM attribute_option WHERE attribute_id='$attribute_id'");
	
	for($a=0;$a<sizeof($attribute_option_name);$a++)
	{
		if($attribute_action[$a] == 'edit'){
			mysql_query("UPDATE attribute_option 
			SET 
			attribute_id='$attribute_id',
			attri_group_id='$attri_group_id',
			attribute_option_name='$attribute_option_name[$a]',
			attribute_hex_code='$attribute_hex_code[$a]',
			attribute_position='$attribute_position[$a]',
			cat_id='$category',
	        subcat_id='$subcategory',
			status='active'
			WHERE id='$id[$a]'
			");
		} else {
			mysql_query("INSERT INTO attribute_option 
			SET 
			attribute_id='$attribute_id',
			attri_group_id='$attri_group_id',
			attribute_option_name='$attribute_option_name[$a]',
			attribute_hex_code='$attribute_hex_code[$a]',
			attribute_position='$attribute_position[$a]',
			cat_id='$category',
			subcat_id='$subcategory',
			status='active'
			");
		}
	}

	if(mysql_query($sql)){
		header('Location: attributes.php?role=view&msg=succes');
	}
	else {
		header('Location: attributes.php?role=view&msg=error');
	}
}

//Delete Attributes
public function delete_attribute($id){
	$sql = "DELETE FROM attribute_option WHERE id='$id'";
	mysql_query($sql);
}

/***********************Static Page Add/Update/Delete Functions********************/

//Add Page
	public function add_page(){
		extract($_POST);
		//if($parent_id )
		$content_id = rand();
		$pagepic = $_FILES['file']['name'];
		$upload = '../upload/pages/';
		move_uploaded_file($_FILES['file']['tmp_name'],$upload.$_FILES['file']['name']);
		$sql = " INSERT INTO content 
		SET 
		content_id='$content_id',
		parent_id='$parent_id',
		page_name='$page_name',
		page_title='$page_title',
		page_description='$page_description',
		page_keywords='$page_keywords',
		content_text='$text',
		image='$pagepic',
		deleted='1'	
		";
if(mysql_query($sql)){
		header('Location: content.php?role=view&msg=succes');
	}
	else {
		header('Location: content.php?role=view&msg=error');
	}
	}

	//Update Page
	public function update_page($id){
		extract($_POST);
		if($_FILES['file']['name'] !=''):
		$dir = '../upload/pages/';
		$newname = 'pages_'.rand();
		$website_event_img = $_FILES['file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['file']['tmp_name'],$dir.$newfilename);
		$img = "image='$newfilename',";
		endif;
		$sql = "UPDATE content 
		SET 
		parent_id='$parent_id',
		page_name='$page_name',
		page_title='$page_title',
		page_description='$page_description',
		page_keywords='$page_keywords',
		$img
		content_text='$text'
		WHERE id='$id'
		";
		if(mysql_query($sql)){
		header('Location: content.php?role=view&msg=succes');
	}
	else {
		header('Location: content.php?role=view&msg=error');
	}
	}

	//Delete Page
	public function delete_page($id){
		mysql_query("DELETE FROM content WHERE content_id='$id'");
	}
	
	//Delete Page Image
	public function delete_page_img($id){
		mysql_query("UPDATE content SET image='' WHERE id='$id'");
	}
	
	
		

	

/***********************Login Functions********************/
	
//////////// Sign Up ////////////
	public function signup(){
		$_POST = $this->get_input($_POST);
		extract($_POST);
		$sql = "SELECT * FROM user WHERE email='$email' ";
		$checked = mysql_query($sql);
		$count = mysql_num_rows($checked);
		if($count == 0){
		$last_modify = date('Y-m-d H:i:s');
		$user_id = rand();
	    $sql = " INSERT INTO user 
		SET 
		user_id='$user_id',
		first_name='$fname',
		last_name='$lname',
		email='$email',
		password='$password',
		phone='$phoneno',
		register_type='$register_type',
		lastlogin='$last_modify',
		status='$status'
		";
		mysql_query($sql);
		$_SESSION['websiteuser'] =  $user_id;
		
		if($_SESSION['websiteuser']!=''){
			
		$this->send_signupmail($_SESSION['websiteuser']);
		
		}
		
		}else{
		return false;
		}
	}
	
		
//////////// Login ////////////
	public function check_login(){
		$_POST = $this->get_input($_POST);
		extract($_POST);
		$sql = "SELECT * FROM user WHERE (email='$login_email' or phone='$login_email') and password='$login_password' and status='active' ";
		$checked = mysql_query($sql);
		$count = mysql_num_rows($checked);
		if($count == 1):
		$last_modify = date('Y-m-d H:i:s');
		$row=mysql_fetch_array($checked);
		mysql_query("UPDATE user SET lastlogin='$last_modify' WHERE user_id='{$row['user_id']}'");
		$_SESSION['websiteuser'] = $row['user_id'];
		return true;
		else:
		return false;
		endif;
	}


	
	//////////// Existing User ////////////
	public function check_user($email)
	{
		
		$sql = "SELECT * FROM user WHERE email='$email' and status='active' ";
		$checked = mysql_query($sql);
		$count = mysql_num_rows($checked);
		if($count == 1):
		$last_modify = date('Y-m-d H:i:s');
		$row=mysql_fetch_array($checked);
		mysql_query("UPDATE user SET lastlogin='$last_modify' WHERE user_id='{$row['user_id']}'");
		$_SESSION['websiteuser'] = $row['user_id'];
		return true;
		else:
		return false;
		endif;
	}
	
	
	
//////// Forget Password /////////////
	public function check_forget(){
	extract($_POST);
	$check = mysql_query("SELECT * FROM user WHERE (email='$login_email' or phone='$email') and status='active' ");
	$count = mysql_num_rows($check);
	if($count > 0){
		$row=mysql_fetch_object($check);
		$to = $_POST['login_email'];
		$from = "From: info@onlinevandy.com";
		$msg = "
		Hello $row->full_name,
		
		Your login details are given below\n
		Email:- $row->email
		Password is: $row->password

		If you have any questions or trouble logging on please contact a site administrator.
		
		Thank you!
		www.onlinevandy.com
		";
		if(mail($to,'onlinevandy Password Recover',$msg,$from)){
			//echo "<script type='text/javascript'>alert('Password has been send on your email!!');</script>";
			return true;
		}
	}
	else {
		return false;
	} 
	}
	
	// Change Password
	public function change_password()
	{
		extract($_POST);
		$user_id = $this->get_website_session();
		$selectpass = mysql_query("SELECT * FROM user WHERE user_id='$user_id' and password='$old_pass' and status='active'");
		$count = mysql_num_rows($selectpass);
		
		if($count > 0)
		{
			if($new_pass != $re_pass)
			{
				$url = SITE_URL.'/change-password.php?ownername=f9e54aa256b98af7abe9d1dd35e545cc&msg=error';
			    header('location: '.$url.'');
			}
			else
			{
				mysql_query(" UPDATE user SET password='$new_pass' WHERE user_id='$user_id' ");
				$url = SITE_URL.'/change-password.php?ownername=f9e54aa256b98af7abe9d1dd35e545cc&msg=success';
				header('location: '.$url.'');
			}
		}
		else
		{
			$url = SITE_URL.'/change-password.php?ownername=f9e54aa256b98af7abe9d1dd35e545cc&msg=error';
			header('location: '.$url.'');
		}
	}
	
	/////// Logout ///////
	public function logout_user(){
		session_destroy();
		header('location:'.SITE_URL.'');
	}
	
	public function deactivation_account(){
		extract($_REQUEST);
		$user_id = $_SESSION['websiteuser'];
		$select_password = mysql_query("SELECT * FROM user WHERE user_id='$user_id' and password='$deactivation_password' ");
		$count = mysql_num_rows($select_password);
		if($count == 1):
		$query = mysql_query("UPDATE user SET status='deactivation' WHERE user_id='$user_id' ");
		if($query){
			session_destroy();
			echo 'success';
		} else {
			echo 'error';
		}
		else:
			echo 'password not match';
		endif;
	}
	
	
/******************Customer Payment Details*********************/	
	
	// Default  Address
	public function add_customer_details()
	{
		extract($_POST);
		$user_id=$this->get_website_session();
		$sql = " INSERT INTO customer_details
		SET userid='$user_id',
		billname='$billname',
		billaddress='$billaddress',
		billlandmark = '$billlandmark',
		billcountry='$billcountry',
		billstate='$billstate',
		billcity='$billcity',
		billzip='$billzip',
		billcontact='$billcontact',
		shipname='$billname',
		shipaddress='$billaddress',
		shiplandmark='$billlandmark',
		shipcountry='$billcountry',
		shipstate='$billstate',
		shipcity='$billcity',
		shipzip='$billzip',
		shipcontact='$billcontact'
		";
		mysql_query($sql);
	}
	
	 // Update  Address
	public function update_customer_details(){
		extract($_POST);
		$user_id=$this->get_website_session();
		$sql = " UPDATE customer_details
		SET
		billname='$billlname',
		billaddress='$billaddress',
		billlandmark = '$billlandmark',
		billcountry='$billcountry',
		billstate='$billstate',
		billcity='$billcity',
		billzip='$billzip',
		billcontact='$billcontact',
		shiplname='$billlname',
		shipaddress='$billaddress',
		shiplandmark='$billlandmark',
		shipcountry='$billcountry',
		shipstate='$billstate',
		shipcity='$billcity',
		shipzip='$billzip',
		shipcontact='$billcontact'
		WHERE userid='$user_id'
		";
		mysql_query($sql);
	}
	
	//////// Order Details /////////////
	function order_details($data)
	{	
		//var_dump($data);
		$data = $this->get_input($data);
		extract($data);
		
		$orderdate = date('Y-m-d H:i:s');
		$user_id = $this->get_website_session();
		$total_amount = $this->get_order_total();
		$orderid = 'OD00'.rand(10000000,99999999);
		
		
		if($this->get_minimum_cart_value() <= $this->get_order_total())
		{
			$shipping_amount = 0;
		} 
		else 
		{
			if($_SESSION['free_shiping'] != 'yes')
			{ 
				$shipping_amount = $this->get_delivery_charges(); 
			} 
			else 
			{ 
				$shipping_amount = 0;
			}
		}
	
		
		for($i=0;$i<$this->get_cart_qty();$i++)
		{
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$attribute=$_SESSION['cart'][$i]['attribute'];
			$combo=$_SESSION['cart'][$i]['combo'];
			$sale=$_SESSION['cart'][$i]['sale'];
			$first = $attribute['first'];
			$second = $attribute['second'];
			
			$subtotal = $this->get_product_price($pid,$first,$second)*$q;
			$price = $this->get_product_price($pid,$first,$second);

			$subtotalcombo = $this->get_combo_price($combo)*$q;
		    $pricecombo = $this->get_combo_price($combo);
			
			
			if($pid > 0)
			{
				 
				 
				
				
				if($first > 0){
				$qry = mysql_query("SELECT * FROM attribute_option WHERE id ='$first' ");
				$res = mysql_fetch_array($qry);
				$aid = $res['attribute_id'];
				mysql_query("INSERT INTO order_prodcut_attribute SET userid='$user_id',orderid='$orderid',prod_id='$pid',attribute_id='$aid',attribute_option_id='$first', attribute_price='$price' ");
				 } 
				
				if($second!='' && $second > 0){
				$qry = mysql_query("SELECT * FROM attribute_option WHERE id ='$second' ");
				$res = mysql_fetch_array($qry);
				$aid = $res['attribute_id'];
				mysql_query("INSERT INTO order_prodcut_attribute SET userid='$user_id',orderid='$orderid',prod_id='$pid',attribute_id='$aid',attribute_option_id='$second', attribute_price='$price' ");
				} 
				
				 mysql_query("INSERT INTO order_prodcut_details SET userid='$user_id', orderid='$orderid', prod_id='$pid',attribute_option_id='$first',attribute_id='$aid', price='$price', qty='$q', subtotal='$subtotal' ");
				 
				
			}
			if($combo > 0)
			{
				mysql_query("INSERT INTO order_prodcut_details SET userid='$user_id', orderid='$orderid', prod_id='$combo', price='$pricecombo', qty='$q', subtotal='$subtotalcombo' ");
			}
			
			
		}
		
		if($get_address_id !='' )
		{
			
			$querya = mysql_query("SELECT * FROM customer_details WHERE id = '$get_address_id' ");
			$res = mysql_fetch_array($querya);
			extract($res);
			
			$sql =  "INSERT INTO order_customer_details 
					SET userid='$user_id',
					orderid='$orderid',
					billname='$billname',
					billaddress='$billaddress',
					billlandmark = '$billlandmark',
					billcountry='$billcountry',
					billstate='$billstate',
					billcity='$billcity',
					billzip='$billzip',
					billcontact='$billcontact',
					shipname='$billname',
					shipaddress='$billaddress',
					shiplandmark='$billlandmark',
					shipcountry='$billcountry',
					shipstate='$billstate',
					shipcity='$billcity',
					shipzip='$billzip',
					shipcontact='$billcontact'
					";
		           mysql_query($sql);
		}
		else 
		{
		$sql =  "INSERT INTO order_customer_details 
					SET userid='$user_id',
					orderid='$orderid',
					billname='$billname',
					billaddress='$billaddress',
					billlandmark = '$billlandmark',
					billcountry='$billcountry',
					billstate='$billstate',
					billcity='$billcity',
					billzip='$billzip',
					billcontact='$billcontact',
					shipname='$billname',
					shipaddress='$billaddress',
					shiplandmark='$billlandmark',
					shipcountry='$billcountry',
					shipstate='$billstate',
					shipcity='$billcity',
					shipzip='$billzip',
					shipcontact='$billcontact'
					";
		           mysql_query($sql);
		}
		
		$coupon_amount = round($_SESSION['coupen_dis']);
		$coupon_code = $_SESSION['coupon_code'];
		if($payment_method == 'ONLINE')
		{
			$sql_detail = "INSERT INTO order_details SET userid='$user_id',orderid='$orderid',shipping_amount='$shipping_amount',total_amount='$total_amount',payment_method='$payment_method',status='payment_pending',orderdate='$orderdate',coupon_amount='$coupon_amount',coupon_code='$coupon_code',paymentgateway ='$online_method' ";
			
			if(mysql_query($sql_detail))
			{
				$_SESSION['order_id'] = $orderid;
				$array = array('nowreturn'=>'ONLINE','online_method'=>$online_method);
				return json_encode($array);
			} 
			else
			{
				 $array = array('nowreturn'=>'error');
				 return json_encode($array);
			}
		} 
		else if($payment_method == 'COD')
		{
			$sql_detail = "INSERT INTO order_details SET userid='$user_id',orderid='$orderid',shipping_amount='$shipping_amount',total_amount='$total_amount',payment_method='$payment_method',status='pending',orderdate='$orderdate',coupon_amount='$coupon_amount',coupon_code='$coupon_code'";
			
			if(mysql_query($sql_detail))
			{
				
				$_SESSION['order_id'] = $orderid;
				$deliveryamount = $this->get_delivery_charges();
				if($coupon_amount !=0)
				{
					$amount = ($total_amount+$deliveryamount);
				} 
				else 
				{
					$amount = ($total_amount+$deliveryamount)-$coupon_amount;
				}
				
				$_SESSION['order_id'] = $orderid;
					//Stock Sub
				for($i=0;$i<$this->get_cart_qty();$i++)
				{
					
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$attribute=$_SESSION['cart'][$i]['attribute'];
					$combo=$_SESSION['cart'][$i]['combo'];
					$first = $attribute['first'];
					$second = $attribute['second'];
					
					if($second > 0){
						$now_attribute = $first.'|'.$second;
					}
					else
					{
						$now_attribute = $first;
					}
					
					
					$qty_attr = $this->get_qty_sum($pid,$q,$first,$second);
					$now_product_attr_qty = $qty_attr-$q;
				
					$product_qty = $this->get_qty_sum_product($pid);
					$now_product_qty = $product_qty-$q;

					$combo_qty_attr = $this->get_combo_qty_sum($combo);
					$now_combo_qty = $combo_qty_attr-$q;
					
						if($now_product_qty > 0 ){
							mysql_query(" UPDATE product SET product_qty='$now_product_qty' WHERE prod_id='$pid' ");
						}	

                        if($now_product_attr_qty > 0){
							mysql_query(" UPDATE product_attribute SET attribute_stock='$now_product_attr_qty' WHERE prod_id='$pid' and attribute_option_id='$now_attribute' and attri_group_id > 0 ");
						}
						
						if($now_combo_qty > 0)
						{
							mysql_query("UPDATE combo SET combo_qty ='$now_combo_qty' WHERE combo_id='$combo' ");
						}
						
				}
				
					
					unset($_SESSION['cart']);
					unset($_SESSION['payment_mode']);
					unset($_SESSION['coupon_code']);
					unset($_SESSION['coupen_dis']);
					unset($_SESSION['free_shiping']);
					
					
					//start mail for order for admin and user
				   	//$this->order_success();
					$site_url = SITE_URL;

					$mailmsg = "<html>
					<head>
					<meta charset='utf-8'>
					<title>www.onlinevandy.com</title>
					</head>

					<body>
					<div style='width:100%;min-height:100%;margin:10px auto;padding:0;background-color:#ffffff;font-family:Arial,Tahoma,Verdana,sans-serif;font-weight:299px;font-size:13px;text-align:center' bgcolor='#ffffff'>
					<table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px; width:100%;'>
					<tbody>
					<tr>
					<td valign='middle' align='left' height='auto'  style='background-color:#efefef;padding:10px;margin:0'><a style='text-decoration:none;outline:none;font-size:13px' href='http://www.onlinevandy.com/' target='_blank'> <img border='0' src='http://www.onlinevandy.com/upload/comman/logo_795001016.png' alt='onlinevandy' style='border:none; padding-top: 5px;' class='CToWUd'> </a></td>
					<td valign='middle' align='right' height='auto' style='background-color:#efefef;padding:10px;margin:0'><table border='0' style='text-align:right; float:right; width:auto; padding-top:5px;'>
					<tr>
					<td style='width:30px; margin-left:10px;'><a href='https://www.facebook.com/onlinevandy' target='_blank'><img src='http://www.onlinevandy.com/images/facebook.png' width='30' height='30' alt='facebook'></a></td>
					<td style='width:30px; margin-left:10px;'><a href='https://twitter.com/onlinevandy' target='_blank'><img src='http://www.onlinevandy.com/images/twiiter.png' width='30' height='30' alt='twiiter'></a></td>
					<td style='width:30px; margin-left:10px;'><a href='https://plus.google.com/+onlinevandy/posts' target='_blank'><img src='http://www.onlinevandy.com/images/Google-plus-icon.png' width='30' height='30' alt='linkedin+'></a></td>
					</tr>
					</table></td>
					</tr>
					</tbody>
					</table>
					<table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
					<tbody>
					<tr>
					<td align='left' valign='top' style='color:#2c2c2c;line-height:20px;font-weight:300;margin:0 auto;clear:both;background-color:#ffffff;padding:20px 20px 0 20px' bgcolor='#ffffff'><p style='padding:0;margin:0;font-size:16px;font-weight:bold;font-size:13px'> Hi $billname, </p>
					<br>
					<p style='padding:0;margin:0;color:#565656;font-size:13px'>Greeting from onlinevandy!</p>
					<br>
					<p style='padding:0;margin:0;color:#565656;font-size:13px'> We have received your order <a style='text-decoration:none' alt='onlinevandy.com' href='#' target='_blank'><span style='color:#666;font-size:13px'>$orderid</span></a> </p></td>
					</tr>
					<tr>
					<td align='center' valign='top' style='line-height:20px;font-weight:300;margin:0;clear:both;background-color:#fff;padding:10px 20px 0 20px;font-size:13px' bgcolor='#F9F9F9'><p style='padding:5px 10px;background-color:#fffed5;border:1px solid #f9e2b2;color:#565656;margin:0;font-size:13px;text-align:center'> Order Date: $orderdate</p></td>
					</tr>
					<tr>
					<td align='center' valign='top' style='color:#2c2c2c;line-height:20px;font-weight:300;margin:0;clear:both;background-color:#fff;padding:10px 20px 0 20px;font-size:13px' bgcolor='#F9F9F9'><table width='100%' cellspacing='0' cellpadding='0' style='border:solid 1px #e6e6e6'>
					</table>
					</td>
					</tr>
					</tbody>
					</table>
					<table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
					<tbody>
					<tr>
					<td align='left' valign='top' style='background-color:#ffffff;display:block;margin:0 auto;clear:both;padding:20px 20px 0 20px' bgcolor=''><table border='0' cellspacing='0' cellpadding='0' width='100%' style='margin:0'>
					<tbody>
					<tr>
					<td colspan='4' width='100%' align='left' valign='top'><p style='padding:0;margin:0;color:#565656;line-height:22px;font-size:13px'> The following item has been received: </p>
					<br></td>
					</tr>
					<tr>
					<td colspan='4' align='left' valign='top'><table border='0' cellspacing='0' cellpadding='0' width='100%' style='margin-bottom:10px;'>
					<tbody>
					<tr>
					<td valign='middle' align='left' rowspan='2' style='white-space:nowrap;padding-right:5px;font-size:13px; margin-bottom:10px;'>Seller: onlinevandy.com</td>
					<td valign='middle' align='left' style='border-bottom:solid 2px #565656;width:90%; margin-bottom:10px;'></td>
					</tr>
					<tr>
					<td valign='middle' align='left'></td>
					</tr>
					</tbody>
					</table></td>
					</tr>
					</tbody>
					</table></td>
					</tr>
					</tbody>
					</table>";



					//Start code for product
					$selectorder = "SELECT * FROM order_prodcut_details WHERE orderid='$orderid'";
					$query = mysql_query($selectorder);

					$select_option = mysql_query("SELECT * FROM order_prodcut_attribute WHERE orderid='$orderid'");
					$result_option = mysql_fetch_array($select_option);
					$count_option =  mysql_num_rows($select_option);
					$aid = $result_option['attribute_id'];	
					$aoid = $result_option['attribute_option_id'];					

					while($row=mysql_fetch_array($query))
					{
						extract($row);
						$url = $this->seo_friendly_url($this->get_product_name($prod_id));
						$IMG = $this->get_single_product_img($prod_id);
						$delivery = $this->product_delivery_for_order($orderid,$prod_id);
						$SUB = $price*$qty;
						
						$mailmsg .="<table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-bottom:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6;padding:2px 0;'>
						<tbody>
						<tr>
						<td valign='top' align='center' width='350' style='background-color:#ffffff'><table border='0' cellspacing='0' cellpadding='0' width='100%'>
						<tbody>
						<tr>
						
						<td style='vertical-align:top'><a href='".$site_url."/detail/$prod_id/$url'><img border='0' src='".$site_url."/upload/product/$IMG' width='100px' class='CToWUd'> </a>
						</td>
						
						<td style='vertical-align:top'>
						<p style='padding:0;margin:0'> 
						<a style='text-decoration:none;color:#565656' href='#' target='_blank'><span style='color:#565656;font-size:13px'>$url</span></a> </p>
						</td>
						
						<td style='vertical-align:top'>
						<p style='white-space:nowrap;padding:0;margin:0;color:#848484;font-size:12px'>Item Price</p>
						<p style='white-space:nowrap;margin:0;padding:7px 0 0 0;color:#565656;font-size:13px'>Rs. $price </p>
						</td>
						
						<td style='vertical-align:top'>
						<p style='padding:0;margin:0;color:#848484;font-size:12px'>Qty</p>
						<p style='padding:7px 0 0 0;margin:0;color:#565656;font-size:13px'>$qty</p>
						</td>
						
						<td style='vertical-align:top'>
						<p style='white-space:nowrap;padding:0;margin:0;color:#848484;font-size:12px'>Subtotal</p>
						<p style='white-space:nowrap;padding:7px 0 0 0;margin:0;color:#565656;font-size:13px'>Rs. $SUB </p>
						</td>

						</tr>
						</tbody>
						</table></td>
						</tr>
						</tbody>
						</table>";
						//End code for product

					} 



					$mailmsg .="<table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
					<tbody>
					<tr>
					<td valign='top' align='center' style='background-color:#ffffff;display:block;margin:0 auto;clear:both;padding:5px 20px 0 20px' bgcolor='#fff'><table border='0' cellspacing='0' cellpadding='0' width='100%' style='margin:0'>
					<tbody>
					<tr>
					<td colspan='4' align='center' valign='top' style='border-bottom:#ccc dashed 1px;padding:0 0 17px 0'>
					<p style='padding:5px;background-color:#fffed5;border:1px solid #f9e2b2;color:#565656;margin:10px 0 0 0;text-align:center;font-size:13px'> Delivery by $delivery </p></td>
					</tr>
					</tbody>
					</table></td>
					</tr>
					</tbody>
					</table>";

					$mailmsg .="<table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
					<tbody>
					<tr>
					<td align='right' valign='top' style='background-color:#ffffff;display:block;margin:0 auto;clear:both;padding:5px 20px 0 20px' bgcolor=''><table border='0' cellspacing='0' cellpadding='0' width='100%' style='margin:0'>
					<tbody>";

					if($deliveryamount > 0){ 
					$mailmsg .= "<tr>
					<td colspan='4' align='right' valign='top' style='padding:10px 0 0 0'><p style='text-align:right;padding:0;margin:0;color:#565656;font-size:13px'> Shipping Charge Rs. $deliveryamount </p></td>
					</tr>
					</tbody>
					</table></td>
					</tr>";
					}

					$mailmsg .= "</tbody>
					</table>
					<table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
					<tbody>
					<tr>
					<td valign='top' align='right' bgcolor='' style='clear:both;display:block;margin:0 auto;padding:10px 1px 0 1px;background-color:#ffffff'><table cellspacing='0' cellpadding='0' width='100%'>
					<tbody>
					<tr>
					<td bgcolor='#f9f9f9' valign='top' align='right' style='border-top:2px solid #565656;border-bottom:1px solid #e6e6e6;padding:15px 0;margin:0;background-color:#f9f9f9'><p style='padding:0;margin:0;text-align:right;color:#565656;line-height:22px;white-space:nowrap;font-size:13px'> Grand total <span style='font-size:21px'>Rs. $amount</span> </p></td>
					</tr>
					</tbody>
					</table></td>
					</tr>
					</tbody>
					</table>";



					$mailmsg .="<table width='100%' cellspacing='0' cellpadding='0' style='border-top:#e6e6e6 solid 1px;max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
					<tbody>
					<tr>
					<td valign='top' align='center' width='300' style='background-color:#f9f9f9'><br>
					<table width='100%' cellspacing='0' cellpadding='0'>
					<tbody>
					<tr>
					<td valign='top' align='left' style='padding:0 10px 15px 20px;margin:0;border-right:dashed 1px #b3b3b3'><p style='padding:0;margin:0 0 7px 0;font-size:16px;color:#565656'>What Next?</p>
					<p style='padding:0;margin:0;font-size:11px;color:#565656;line-height:20px'>Your order is being processed and will be shipped in due time. If you have any enquiry you may call at our 24x7 helpline. </p></td>
					</tr>
					</tbody>
					</table></td>
					<td valign='top' align='center' width='300' style='background-color:#f9f9f9'><br>
					<table width='100%' cellspacing='0' cellpadding='0'>
					<tbody>
					<tr>
					<td valign='top' align='left' style='padding:0 10px 15px 20px;margin:0'><p style='padding:0;margin:0 0 7px 0;font-size:16px;color:#565656'>Any Questions?</p>
					<p style='padding:0;margin:0;font-size:11px;color:#565656;line-height:20px'> Please reply to this email or get in touch with our 24x7 </p></td>
					</tr>
					</tbody>
					</table></td>
					</tr>
					</tbody>
					</table>
					<table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border:solid 1px #e6e6e6;border-top:none'>
					<tbody>
					<tr>
					<td valign='top' align='center' style='text-align:center;background-color:#f9f9f9;display:block;margin:0 auto;clear:both;padding:15px 40px' bgcolor=''><p style='padding:0;margin:0 0 7px 0'> <a title='onlinevandy.com' style='text-decoration:none;color:#565656' href='http://www.onlinevandy.com/' target='_blank'><span style='color:#565656;font-size:13px'>onlinevandy.com</span></a> </p>
					<p style='padding:10px 0 0 0;margin:0;border-top:solid 1px #cccccc;font-size:11px;color:#565656'> 24x7 Customer Support | Buyer Protection | Flexible Payment Options | Largest Collection </p></td>
					</tr>
					</tbody>
					</table>
					</div>";


					$USER = mysql_query("SELECT * FROM user WHERE user_id = '$user_id' ");
					$Res = mysql_fetch_array($USER);
					$Email = $Res['email']; 

					$subject = 'Order at onlinevandy.com';
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= 'From: <info@onlinevandy.com>' . "\r\n";

					if($Email !='')
					{
					mail($Email,$subject,$mailmsg,$headers);
					}


					$adminemail  = $this->get_email();
					$subject1 = 'Order received at onlinevandy.com.';
					$headers1 = "From: " . strip_tags($Email) . "\r\n";
					$headers1 .= "MIME-Version: 1.0\r\n";
					$headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

					mail($adminemail,$subject1,$mailmsg,$headers1);

					
					
					//End mail for order for admin and user
				
					$array = array('nowreturn'=>'COD');
					return json_encode($array);
			} 
			else
			{
				 $array = array('nowreturn'=>'error');
				 return json_encode($array);
			}
		}
		
				
	}
	
	
	
	//////// Update Order Details /////////////
	function update_order_details()
	{
		$_POST = $this->get_input($_POST);
		extract($_POST);
		$orderdate = date('Y-m-d H:i:s');
		$user_id = $this->get_website_session();
		$total_amount = $this->get_order_total();
		
		if($this->get_minimum_cart_value() <= $this->get_order_total()){
			$shipping_amount = 0;
		}
		else 
		{
			$shipping_amount = $this->get_delivery_charges();
		}
		
		mysql_query("UPDATE order_details SET userid='$user_id',shipping_amount='$shipping_amount',total_amount='$total_amount',payment_method='$payment_method',status='pending',orderdate='$orderdate' WHERE orderid='".$_SESSION['order_id']."' ");
		
		$sql = " UPDATE order_customer_details
		SET userid='$user_id',
		orderid='$orderid',
		billname='$billlname',
		billaddress='$billaddress',
		billlandmark = '$billlandmark',
		billcountry='$billcountry',
		billstate='$billstate',
		billcity='$billcity',
		billzip='$billzip',
		billcontact='$billcontact',
		shiplname='$billlname',
		shipaddress='$billaddress',
		shiplandmark='$billlandmark',
		shipcountry='$billcountry',
		shipstate='$billstate',
		shipcity='$billcity',
		shipzip='$billzip',
		shipcontact='$billcontact'
		WHERE orderid='".$_SESSION['order_id']."'
		";
		if(mysql_query($sql)){
			header('location:checkout.html');
		}
	}
	
/*****************************************Add To Cart******************************************************/

//Add to Cart

function add_to_cart($pid,$q,$attribute,$combo,$sale)
{
	
	if($combo == '')
	{	
		if($pid<1 or $q<1) return false;
	}
	if(is_array($_SESSION['cart'])){
		
	if($this->product_exists($pid,$q,$combo,$attribute)) return false;
	
	$max=count($_SESSION['cart']);
	$_SESSION['cart'][$max]['productid']=$pid;
	$_SESSION['cart'][$max]['qty']=$q;
	$_SESSION['cart'][$max]['attribute']=$attribute;
	$_SESSION['cart'][$max]['combo']=$combo;
	$_SESSION['cart'][$max]['sale']=$sale;
	return true;
	}
	else{
	$_SESSION['cart']=array();
	$_SESSION['cart'][0]['productid']=$pid;
	$_SESSION['cart'][0]['qty']=$q;
	$_SESSION['cart'][0]['attribute']=$attribute;
	$_SESSION['cart'][0]['combo']=$combo;
	$_SESSION['cart'][0]['sale']=$sale;
	return true;
	}
}

//Product Exists
function product_exists($pid,$q,$combo,$attribute){
	$pid=intval($pid);
	$max=count($_SESSION['cart']);
	$flag=0;
	for($i=0;$i<$max;$i++){
	if($pid==$_SESSION['cart'][$i]['productid'] & $combo==$_SESSION['cart'][$i]['combo'] & $attribute == $_SESSION['cart'][$i]['attribute']){
		if($q > 0){
			$_SESSION['cart'][$i]['qty']=$_SESSION['cart'][$i]['qty'] + $q;
		}
		else {
			$_SESSION['cart'][$i]['qty']=$_SESSION['cart'][$i]['qty'];
		}
	
	$flag=1;
	break;
	}
	}
	return $flag;
}


//Stock quantity check
function product_stock_quantity($pid,$q,$attribute,$combo){ 
	
 if($attribute['first']=='' || $attribute['first']=='undefined'){
	$sql = mysql_query("SELECT * FROM product WHERE prod_id = '$pid'");
	$res = mysql_fetch_array($sql);
	return $maximum = $res['product_qty']; 
	
	 }else{
	$now = $attribute['first'];
	
	$sql = mysql_query("SELECT * FROM product_attribute WHERE 	prod_id = '$pid' AND attri_group_id > 0 AND attribute_option_id = '$now' ");
	$res = mysql_fetch_array($sql);
	return $maximum = $res['attribute_stock'];
	 }

}

//Product Quantity Position 
function product_quantity_exists($pid,$q,$attribute,$combo){
	$pid=intval($pid);
	$max=count($_SESSION['cart']);
	$flag=0;
	for($i=0;$i<$max;$i++){
	if($pid==$_SESSION['cart'][$i]['productid'] & $attribute==$_SESSION['cart'][$i]['attribute']){
		if($q > 0){
			return $new_qnty=$_SESSION['cart'][$i]['qty'] + $q;
		}
		else {
			return $q;
		}
	
	$flag=1;
	break;
	}
	}
	return $q;
}


//Remove Product From Cart
function remove_product($i)
{
	unset($_SESSION['cart'][$i]);
	$_SESSION['cart']=array_values($_SESSION['cart']);
}


//Update Cart product
function update_cart($prod_id,$first,$second,$i,$q)
{
	
	if($second > 0)
	{
		$now = $first.'|'.$second;
	}
	else
	{
		$now = $first;
	}
   
	//return "SELECT * FROM product_attribute WHERE prod_id = '$prod_id' AND attri_group_id > 0 AND attribute_option_id = '$now' ";
	
	$sql = mysql_query("SELECT * FROM product_attribute WHERE 	prod_id = '$prod_id' AND attri_group_id > 0 AND attribute_option_id = '$now' ");
	$res = mysql_fetch_array($sql);
	$max = $res['attribute_stock'];
	
	//return $max.'=========>'.$q;
	
	if($q > 0 && $q <= $max)
	{
		$_SESSION['cart'][$i]['qty'] = $q;	
	}
	else
	{	
		return $max;
	}
	
}
	
	
	
//Update Cart Combo
function update_cart_combo($prod_id,$i,$q)
{
	
	$sql = mysql_query("SELECT * FROM combo WHERE 	combo_id = '$prod_id' AND status = 'active' ");
	$res = mysql_fetch_array($sql);
	$max = $res['combo_qty'];
	
	if($q > 0 && $q <= $max)
	{
		$_SESSION['cart'][$i]['qty'] = $q;	
	}
	else
	{	
		return $max;
	}
	
}


	//Order Total In INR
	function get_order_totalinr(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['productid'];
		$q=$_SESSION['cart'][$i]['qty'];
		$price=get_priceinr($pid);
		$sum+=$price*$q;
		}
		return $sum;
	}

	
	// Extra
	
/******************Checkout Functions*********************/	
	
//////////// Guest ////////////
    public function check_guest(){
	$_POST = $this->get_input($_POST);
	extract($_POST);
	$sql = "SELECT * FROM user WHERE email='$guestemail' ";
	$checked = mysql_query($sql);
	$count = mysql_num_rows($checked);
	if($count == 0):
	$last_modify = date('Y-m-d H:i:s');
	$user_id = rand();
	$password = rand();
	$row=mysql_fetch_array($checked);
	mysql_query("INSERT INTO user SET 
		full_name='$guestname',
		user_id='$user_id',
		email='$guestemail',
		password='$password',
		register_type='form',
		status='active',
		lastlogin='$last_modify'
	");
		$to = $guestemail;
		$from = "From: info@onlinevandy.com";
		$msg = "
		Hello $guestname,
		
		Your login details are given below\n
		Email:- $guestemail
		Password is: $password

		If you have any questions or trouble logging on please contact a site administrator.
		
		Thank you!
		www.onlinevandy.com
		";
		mail($to,$from,$msg);
	$_SESSION['websiteuser'] = $user_id;
	header ('location: '.$red.'');
	else:
	return false;
	endif;
}

/******************Add Pincode Functions*********************/

//////////// Add Pincode ////////////
public function add_pincode(){
	extract($_POST);
	$sql = "
	INSERT INTO product_pincode 
	SET
	pincode='$pincode',
	status='active'
	";
	if(mysql_query($sql)){
		header('Location: pincode.php?role=view&msg=succes');
	}
	else {
		header('Location: pincode.php?role=view&msg=error');
	}
}


/******************Add Brand Functions*********************/

//////////// Add brand ////////////
public function add_brand(){
	extract($_POST);
	if($_FILES['file']['name'] !=''):
		$dir = '../upload/brand/';
		$newname = 'brand_'.rand();
		$website_event_img = $_FILES['file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['file']['tmp_name'],$dir.$newfilename);
		$img = "brand_img='$newfilename',";
	endif;
	$sql = "
	INSERT INTO brand 
	SET
	brand_id='$brand_id',
	brand_name='$brand_name',
	brand_url='$brand_url',
	$img
	status='$status'
	";
	//echo $sql;
	if(mysql_query($sql)){
		header('Location: brands.php?role=view&msg=succes');
	}
	else {
		header('Location: brands.php?role=view&msg=error');
	}
}



/******************Add Slider Functions*********************/	

//////////// Add Slider ////////////
public function add_slider(){
	extract($_POST);
	if($_FILES['file']['name'] !=''):
		$dir = '../upload/slider/';
		$newname = 'slider_'.rand();
		$website_event_img = $_FILES['file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['file']['tmp_name'],$dir.$newfilename);
		$img = "slider_img='$newfilename',";
	endif;
	$sql = "
	INSERT INTO slider 
	SET
	slider_id='$slider_id',
	slider_txt_top='$slider_txt_top',
	slider_txt_bottom='$slider_txt_bottom',
	slider_url='$slider_url',
	slider_order='$slider_order',
	$img
	status='$status'
	";
	//echo $sql;
	if(mysql_query($sql)){
		header('Location: slider.php?role=view&msg=succes');
	}
	else {
		header('Location: slider.php?role=view&msg=error');
	}
}


//////////// UPDATE Slider ////////////
	public function update_slider($id){
	extract($_POST);
	if($_FILES['file']['name'] !=''):
		$dir = '../upload/slider/';
		$newname = 'slider_'.rand();
		$website_event_img = $_FILES['file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['file']['tmp_name'],$dir.$newfilename);
		$img = "slider_img='$newfilename',";
		endif;
		$sql = "
		UPDATE slider 
		SET
		slider_txt_top='$slider_txt_top',
		slider_txt_bottom='$slider_txt_bottom',
		slider_url='$slider_url',
		slider_order='$slider_order',
		$img
		status='$status'
		WHERE slider_id='$id'
		";
		//echo $sql;
		if(mysql_query($sql)){
			header('Location: slider.php?role=view&msg=succes');
		}
		else {
			header('Location: slider.php?role=view&msg=error');
		}
	}



/******************Add Category slider Functions*********************/

//////////// Add Slider ////////////
public function add_cat_slider(){
	extract($_POST);
	if($_FILES['file']['name'] !=''):
		$dir = '../upload/cat_slider/';
		$newname = 'cat_slider_'.rand();
		$website_event_img = $_FILES['file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['file']['tmp_name'],$dir.$newfilename);
		$img = "cat_slider_img='$newfilename',";
	endif;
	$sql = "
	INSERT INTO cat_slider 
	SET
	cat_slider_id='$cat_slider_id',
	cat_slider_txt_top='$cat_slider_txt_top',
	cat_slider_txt_bottom='$cat_slider_txt_bottom',
	cat_slider_url='$cat_slider_url',
	$img
	status='$status'
	";
	//echo $sql;
	if(mysql_query($sql)){
		header('Location: cat_slider.php?role=view&msg=succes');
	}
	else {
		header('Location: cat_slider.php?role=view&msg=error');
	}
}

//////////// UPDATE Slider ////////////
	public function update_cat_slider($id){
	extract($_POST);
	if($_FILES['file']['name'] !=''):
		$dir = '../upload/cat_slider/';
		$newname = 'cat_slider_'.rand();
		$website_event_img = $_FILES['file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['file']['tmp_name'],$dir.$newfilename);
		$img = "cat_slider_img='$newfilename',";
	endif;
	$sql = "
	UPDATE cat_slider 
	SET
	cat_slider_txt_top='$cat_slider_txt_top',
	cat_slider_txt_bottom='$cat_slider_txt_bottom',
	cat_slider_url='$cat_slider_url',
	$img
	status='$status'
	WHERE cat_slider_id='$id'
	";
	//echo $sql;
	if(mysql_query($sql)){
		header('Location: cat_slider.php?role=view&msg=succes');
	}
	else {
		header('Location: cat_slider.php?role=view&msg=error');
	}
}


	
/******************Coupon Functions*********************/	
	
//////////// Add Coupon ////////////
	public function add_coupon(){
	extract($_POST);
	$product_id = implode(",",$product_id);
	$coupon_date = date('Y-m-d H:i:s');
	$sql = "
	INSERT INTO coupon 
	SET
	coupon_id='$coupon_id',
	product_id='$product_id',
	coupon_name='$coupon_name',
	coupon_code='$coupon_code',
	coupon_type='$coupon_type',
	discount_amount='$discount_amount',
	cart_amount='$cart_amount',
	customer_login='$customer_login',
	free_shiping='$free_shiping',
	per_coupon='$per_coupon',
	date_start='$date_start',
	date_end='$date_end',
	per_customer='$per_customer',
	status='$status'
	";
	//echo $sql;
	if(mysql_query($sql)){
		header('Location: coupon.php?role=view&msg=succes');
	}
	else {
		header('Location: coupon.php?role=view&msg=error');
	}
}


//////////// UPDATE Coupon ////////////
	public function update_coupon($id){
	extract($_POST);
	$product_id = implode(",",$product_id);
	$coupon_date = date('Y-m-d H:i:s');
	$sql = "
	UPDATE coupon 
	SET
	product_id='$product_id',
	coupon_name='$coupon_name',
	coupon_code='$coupon_code',
	coupon_type='$coupon_type',
	discount_amount='$discount_amount',
	cart_amount='$cart_amount',
	customer_login='$customer_login',
	free_shiping='$free_shiping',
	per_coupon='$per_coupon',
	date_start='$date_start',
	date_end='$date_end',
	per_customer='$per_customer',
	status='$status'
	WHERE id='$id'
	";
	//echo $sql;
	if(mysql_query($sql)){
		header('Location: coupon.php?role=view&msg=succes');
	}
	else {
		header('Location: coupon.php?role=view&msg=error');
	}
}
	
	
	function apply_coupon(){
		extract($_POST);
		$selectcoupen = mysql_query(" SELECT * FROM coupon WHERE coupon_code='$coupon_code' and status='active' ");
		$count = mysql_num_rows($selectcoupen);
		$user_id= $this->get_website_session();
		$selectusercoupen = mysql_query(" SELECT * FROM order_details WHERE coupon_code='$coupon_code' and userid='$user_id' ");
		$count_used = mysql_num_rows($selectusercoupen);
		if($count > 0){
		$row=mysql_fetch_array($selectcoupen);
		
		if($count_used < $row['per_customer']){
		if($this->get_order_total() >=  $row['cart_amount']){
			
			if($row['product_id'] == ''){
				if($row['coupon_type'] == 'F'){
					$_SESSION['coupon_code'] = $coupon_code;
					$_SESSION['coupen_dis']  = $row['discount_amount'];
					$_SESSION['free_shiping']  = $row['free_shiping'];
					$_SESSION['coupon_msg']  = "success";
				} else if($row['coupon_type'] == 'P'){
					$_SESSION['coupon_code'] = $coupon_code;
					$discount_amount = round(($this->get_order_total()*$row['discount_amount'])/100);
					$_SESSION['coupen_dis']  = $discount_amount;
					$_SESSION['free_shiping']  = $row['free_shiping'];
					$_SESSION['coupon_msg']  = "success";
				}
			} else {
				$product_id = explode(",",$row['product_id']);
				for($x=0;$x<sizeof($_SESSION['cart']);$x++){
					if(in_array($_SESSION['cart'][$x]['productid'],$product_id)){
						$_SESSION['product_found'] = 'yes';
						break;
					} else {
						$_SESSION['product_found'] = 'no';
					}
				}
				
				 if($_SESSION['product_found'] == 'yes'){
					if($row['coupon_type'] == 'F'){
						$_SESSION['coupon_code'] = $coupon_code;
						$_SESSION['coupen_dis']  = $row['discount_amount'];
						$_SESSION['free_shiping']  = $row['free_shiping'];
						$_SESSION['coupon_msg']  = "success";
					} else if($row['coupon_type'] == 'P'){
						$_SESSION['coupon_code'] = $coupon_code;
						$discount_amount = round(($this->get_order_total()*$row['discount_amount'])/100);
						$_SESSION['coupen_dis']  = $discount_amount;
						$_SESSION['free_shiping']  = $row['free_shiping'];
						$_SESSION['coupon_msg']  = "success";
					} 
				 } else {
					unset($_SESSION['coupon_code']);
					unset($_SESSION['coupen_dis']);
					$_SESSION['coupon_msg'] = "product-missmatch"; 
				 }
				
			}	 
			
			
			
		}
		else {
			unset($_SESSION['coupon_code']);
			unset($_SESSION['coupen_dis']);
			$_SESSION['coupon_msg'] = "cart-amount";
		}
			} else {
				unset($_SESSION['coupon_code']);
				unset($_SESSION['coupen_dis']);
				$_SESSION['coupon_msg'] = "already-use";
			}

		}
		else {
			unset($_SESSION['coupon_code']);
			unset($_SESSION['coupen_dis']);
			$_SESSION['coupon_msg'] = "not-match";
		}
		return $_SESSION['coupon_msg'];
	}
	
	
	
/******************Add Ads Functions*********************/

//////////// Add Ads ////////////
	public function add_ads(){
		$_POST = $this->get_input($_POST);
		extract($_POST);
		if($_FILES['file']['name'] !=''):
			$dir = '../upload/ads/';
			$newname = 'brand_'.rand();
			$website_event_img = $_FILES['file']['name'];
			$extension = end(explode(".", $website_event_img));
			$newfilename = $newname.".".$extension;
			move_uploaded_file($_FILES['file']['tmp_name'],$dir.$newfilename);
			$img = "ad_img='$newfilename',";
		endif;
		$sql = "
		INSERT INTO ads 
		SET
		ad_url='$ads_url',
		ad_code='$ad_code',
		ad_postion='$ad_postion',
		ad_page='$ad_page',
		ad_place='$ad_place',
		$img
		status='active'
		";
		//echo $sql;
		if(mysql_query($sql)){
			header('Location: ads.php?role=view&msg=succes');
		}
		else {
			header('Location: ads.php?role=view&msg=error');
		}
	}

//////////// Update Ads ////////////
	public function update_ads($id){
		$_POST = $this->get_input($_POST);
		extract($_POST);
		if($_FILES['file']['name'] !=''):
			$dir = '../upload/ads/';
			$newname = 'brand_'.rand();
			$website_event_img = $_FILES['file']['name'];
			$extension = end(explode(".", $website_event_img));
			$newfilename = $newname.".".$extension;
			if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'PNG' || $extension == 'png' || $extension == 'gif' || $extension == 'GIF'){
			move_uploaded_file($_FILES['file']['tmp_name'],$dir.$newfilename);
			$img = "ad_img='$newfilename',";
			}
		endif;
		$sql = "
		UPDATE ads 
		SET
		ad_url='$ads_url',
		ad_code='$ad_code',
		ad_postion='$ad_postion',
		ad_page='$ad_page',
		ad_place='$ad_place',
		$img
		status='$status'
		WHERE id='$id'
		";
		//echo $sql;
		if(mysql_query($sql)){
			header('Location: ads.php?role=view&msg=succes');
		}
		else {
			header('Location: ads.php?role=view&msg=error');
		}
	}

	
/******************Add/Update Reviews Functions*********************/	

		function add_review(){
		$_POST = $this->get_input($_POST);
		extract($_POST);
		$review_id = rand();
		$review_date = date('M d, Y');
		$sql = "
		INSERT INTO review
		SET 
		review_id='$review_id',
		product_id='$product_id',
		user_id='$user_id',
		review_name='$review_name',
		review_email='$review_email',
		review_title='$review_title',
		review_msg='$review_msg',
		review_star='$review_star',
		review_date='$review_date',
		status='pendding'
		";
		if(mysql_query($sql)){
			$url = SITE_URL.$red;
			return true;
		}
		else {
			$url = SITE_URL.$red;
			return false;
		}
	}
	
	
	//////////// Update Review ////////////
	public function update_review($id){
	extract($_POST);
	$sql = "
	UPDATE review 
	SET
	review_name='$review_name',
	review_email='$review_email',
	review_msg='$review_msg',
	review_star='$review_star',
	status='$status'
	WHERE id=$id
	";

	if(mysql_query($sql)){
		header('Location: review.php?role=view&msg=succes');
	}
	else {
		header('Location: review.php?role=view&msg=error');
	}
}



/******************Wish List Functions*********************/

//////////// Add wishlist ////////////
public	function add_wishlist($data){		
	extract($data);	
	$wishlist_id = rand();		
	$time = date('Y-m-d H:i:s');
	$user_id= $this->get_website_session();
	$select_wish = mysql_query("SELECT * FROM wishlist WHERE prod_id='$pid' and user_id='$user_id' ");
	$count = mysql_num_rows($select_wish);
	if($count == 0){
	$sql = "INSERT INTO wishlist
		SET 
		wishlist_id='$wishlist_id',
		prod_id='$pid',
		user_id='$user_id',				
		time='$time',
		status='active'
		";  
		if(mysql_query($sql))
		{
			return 'add';
		}
		} else {
			return 'already';
		}
			
}

//////////// Remove wishlist ////////////
public	function remove_wishlist($data)
{		
	extract($data);
	$user_id= $this->get_website_session();
	
	$select_wish = "DELETE FROM wishlist WHERE prod_id='$pid' and user_id='$user_id' ";
	
	if(mysql_query($select_wish))
	{
		$query_a = mysql_query("SELECT * FROM wishlist WHERE user_id='$user_id'");
		$count_a = mysql_num_rows($query_a);
		$array = array('nowreturn'=>'remove','count'=>$count_a-1);
		return json_encode($array);
	}
	else {
		$query = mysql_query("SELECT * FROM wishlist WHERE user_id='$user_id'");
		$count = mysql_num_rows($query);
		$array = array('nowreturn'=>'already','count'=>$count-1);
		return json_encode($array);
	}
			
}
		
/******************Add testimonial Functions*********************/		
		public function add_testimonial(){
		extract($_POST);
				
		if($_FILES['image']['name'] !=''):
		$dir = '../upload/testimonial/';
		$newname = 'testimonial_'.rand();
		$website_event_img = $_FILES['image']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['image']['tmp_name'],$dir.$newfilename);
		$imgsdt = "image='$newfilename',";
		endif;
		
		$sql= " INSERT INTO testimonial 
				SET 
				name='$name',
				email='$email',
				phone='$phone',
				city='$city',
				$imgsdt
				country='$country',
				computer_name='$computer_name',
				testimonial='$testimonial',
				status='active'
				"; 

		if(mysql_query($sql)){
			header('Location: testimonial.php?role=view&msg=succes');
		}
		else {
			header('Location: testimonial.php?role=view&msg=error');
		}
		
	}
	
	//Update Page
	public function update_testimonial($id){
		extract($_POST);
		
		if($_FILES['image']['name'] !=''):
		$dir = '../upload/testimonial/';
		$newname = 'testimonial_'.rand();
		$website_event_img = $_FILES['image']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['image']['tmp_name'],$dir.$newfilename);
		$imgacv = "image='$newfilename',";
		endif;
		
		$sql = "UPDATE testimonial 
				SET 
				name='$name',
				email='$email',
				phone='$phone',
				city='$city',
				$imgacv
				country='$country',
				computer_name='$computer_name',
				testimonial='$testimonial',
				status='active'
				WHERE id='$id'
				";
		
		if(mysql_query($sql)){
			header('Location: testimonial.php?role=view&msg=succes');
		}
		else {
			header('Location: testimonial.php?role=view&msg=error');
		}
		
	}
	
	    //Delete Page Image
	public function delete_testimonial_img($id){
		$sql=mysql_query("DELETE FROM testimonial WHERE id='$id'");
		if($sql){
		header('Location: testimonial.php?role=view&msg=succes');
		}
		else {
		header('Location: testimonial.php?role=view&msg=error');
		}
	}
	
/******************Add Address Functions*********************/		
		public function add_address(){
		extract($_POST);
		$userid = $_SESSION['websiteuser'];
		$sql= " INSERT INTO customer_details 
				SET 
				userid='$userid',
				billname='$address_name',
				billaddress='$address_street',
				billlandmark='$address_landmark',
				billcountry='$address_country',
				billstate='$address_state',
				billcity='$address_city',
				billzip='$address_pincode',
				billcontact='$address_phoneno',
				shipname='$address_name',
				shipaddress='$address_street',
				shiplandmark='$address_landmark',
				shillcountry='$address_country',
				shipstate='$address_state',
				shipcity='$address_city',
				shipzip='$address_pincode',
				shipcontact='$address_phoneno'
				"; 

		if(mysql_query($sql)){
			//header('Location: testimonial.php?role=view&msg=succes');
			return true;
		}
		else {
			//header('Location: testimonial.php?role=view&msg=error');
			return false;
		}
		
	}
	
	//Update Page
	public function update_address($id){
		extract($_POST);	
		$userid = $_SESSION['websiteuser'];		
		$sql = "UPDATE customer_details 
				SET 
				userid='$userid',
				billname='$address_name',
				billaddress='$address_street',
				billlandmark='$address_landmark',
				billcountry='$address_country',
				billstate='$address_state',
				billcity='$address_city',
				billzip='$address_pincode',
				billcontact='$address_phoneno',
				shipname='$address_name',
				shipaddress='$address_street',
				shiplandmark='$address_landmark',
				shillcountry='$address_country',
				shipstate='$address_state',
				shipcity='$address_city',
				shipzip='$address_pincode',
				shipcontact='$address_phoneno'
				WHERE id='$id'
				";
		
		if(mysql_query($sql)){
			//header('Location: testimonial.php?role=view&msg=succes');
			return true;
		}
		else {
			//header('Location: testimonial.php?role=view&msg=error');
			return false;
		}
		
	}
	
	    //Delete Page Image
	public function delete_address($id)
	{
		
		//return "DELETE FROM customer_details WHERE id='$id' ";
		
		$sql=mysql_query("DELETE FROM customer_details WHERE id='$id'");
		if($sql)
		{
			return 'remove';
		}
		else {
			return 'error';
		}
	}
/******************Search Functions*********************/
	public function search_terms($search_keyword,$result_count){
		$user_id = $this->get_website_session();
		$ip = $this->get_user_ip();
		$select_search = mysql_query(" SELECT * FROM user_searches WHERE search_keyword='$search_keyword' ");
		$count = mysql_num_rows($select_search);
		if($count == 0){
			$sql = "INSERT INTO user_searches SET 
			search_keyword='$search_keyword',
			result_count='$result_count',
			no_of_user='1',
			status='active'";
			mysql_query($sql);			
		} else {
			$select_search_row = mysql_fetch_array($select_search);
			$users_count = $select_search_row['no_of_user'];
			$no_of_user = $users_count+1;
			$sql = "UPDATE user_searches SET 
			no_of_user='$no_of_user',
			result_count='$result_count'
			WHERE search_keyword='$search_keyword'
			";
			mysql_query($sql);	
		}
		
	}
         
        public function change_order_status()
	{
		
		extract($_POST);
		$date = date('M d, Y h:i:sa');
		
		//$userid = $_SESSION['websiteuser'];
		$sql= " INSERT INTO order_tracking 
				SET 
				userid='',
				orderid='$orderid',
				status='$status',
				date='$date',
				comment='$comment'
				"; 
				
		$update_order_details = mysql_query("UPDATE order_details SET status = '$status' WHERE orderid = '$orderid' ");		
				
		if(mysql_query($sql)){
			header('Location: track-order.php?role=view-invoice&page=1&id='.$orderid);
		}
		else {
			header('Location: track-order.php?role=view-invoice&page=1&id='.$orderid);
		}		
	}
	public function add_notification()
	{
		extract($_POST);
		if($count == 0)
		{
			$sql = "INSERT INTO product_noti SET
			email='$notify_me',
			status='active'";
			mysql_query($sql);
			return true;
		}
	}

     /******************Add Event Functions*********************/		
		public function add_event(){
		extract($_POST);
				
		if($_FILES['image']['name'] !=''):
		$dir = '../upload/event/';
		$newname = 'event_'.rand();
		$website_event_img = $_FILES['image']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['image']['tmp_name'],$dir.$newfilename);
		$imgsdt = "image='$newfilename',";
		endif;
		
		$sql= " INSERT INTO event 
				SET 
				title='$title',
				video='$video',
				$imgsdt
				detail='$detail',
				time='$time',
				date='$date',
				status='active'
				"; 

		if(mysql_query($sql)){
			header('Location: event.php?role=view&msg=succes');
		}
		else {
			header('Location: event.php?role=view&msg=error');
		}
		
	}
	
	//Update Page
	public function update_event($id){
		extract($_POST);
		
		if($_FILES['image']['name'] !=''):
		$dir = '../upload/event/';
		$newname = 'event_'.rand();
		$website_event_img = $_FILES['image']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['image']['tmp_name'],$dir.$newfilename);
		$imgacv = "image='$newfilename',";
		endif;
		
		$sql = "UPDATE event 
				SET 
				title='$title',
				video='$video',
				$imgacv
				detail='$detail',
				time='$time',
				date='$date',
				status='active'
				WHERE id='$id'
				";
		
		if(mysql_query($sql)){
			header('Location: event.php?role=view&msg=succes');
		}
		else {
			header('Location: event.php?role=view&msg=error');
		}
		
	}
	
//Update Cart 
function less_to_cart($id)
{
	$cid=$id;
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++)
	{
		$qty=$_SESSION['cart'][$i]['qty'];
		if($cid==$_SESSION['cart'][$i]['combo'])
		{
			$_SESSION['cart'][$i]['qty']=$qty-1;
	    break;
		}
	}
	$_SESSION['cart']=array_values($_SESSION['cart']);
}

//Add to compair
function add_to_compair($pid)
{
	$max=count($_SESSION['compair']);
	if($max >= 4)
	{
		return false;
	}
	else
	{
		if(is_array($_SESSION['compair']))
		{
			if($this->compair_product_exists($pid)) return false;
			
			$_SESSION['compair'][$max]['productid']=$pid;
			return true;
		}
		else
		{
			$_SESSION['compair']=array();
			$_SESSION['compair'][0]['productid']=$pid;
			return true;
		}
	}
}
//Compair Exists
function compair_product_exists($pid)
{
	$pid=intval($pid);
	$max=count($_SESSION['compair']);
	for($i=0;$i<$max;$i++)
	{
		if($pid==$_SESSION['compair'][$i]['productid'])
		{
			return true;	
		}
	}
}


//############################################
//#-----------MAILER START HERE--------------#
public function GetMailerValue() {

$site_url = SITE_URL;

$weburl = $this->get_website_url();
$logo_url = $site_url."/upload/comman/".$this->get_logo();

$fb_url = $this->get_facebook_url();
$twit_url = $this->get_twitter_url();
$gp_url = $this->get_google_plus_url();
$link_url=$this->get_linkedin_url();
$yout_url = $this->get_youtube_url();

$mail_title = $this->get_website_name();

$f_icon_url = $site_url."/images/mailer/icon1.png";
$t_icon_url = $site_url."/images/mailer/icon2.png";
$g_icon_url = $site_url."/images/mailer/icon3.png";
$l_icon_url = $site_url."/images/mailer/icon4.png";
$y_icon_url = $site_url."/images/mailer/icon5.png";

$f_img_url = $site_url."/images/mailer/img1.png";
$s_img_url = $site_url."/images/mailer/img2.png";
$t_img_url = $site_url."/images/mailer/img3.png";
  
  
  return array('site_url' => $site_url, 'weburl' => $weburl, 'logo_url' => $logo_url, 'fb_url' => $fb_url, 'twit_url' => $twit_url, 'gp_url' => $gp_url, 'link_url' => $link_url, 'yout_url' => $yout_url, 'mail_title' => $mail_title, 'f_icon_url' => $f_icon_url, 't_icon_url' => $t_icon_url, 'g_icon_url' => $g_icon_url, 'l_icon_url' => $l_icon_url, 'y_icon_url' => $y_icon_url, 'f_img_url' => $f_img_url, 's_img_url' => $s_img_url, 't_img_url' => $t_img_url);
    
}


// SEND SIGNUP EMAIL
	
public function send_signupmail($user_id){
//$get_val = $this->GetMailerValue();
//return  $get_val['weburl'];

$site_url = SITE_URL;

$weburl = $this->get_website_url();
$logo_url = $site_url."/upload/comman/".$this->get_logo();
$logo_url_two = $site_url."/upload/comman/".$this->get_logo();
//$logo_url_two = $site_url."/images/logo1.png";

$fb_url = $this->get_facebook_url();
$twit_url = $this->get_twitter_url();
$gp_url = $this->get_google_plus_url();
$link_url=$this->get_linkedin_url();
$yout_url = $this->get_youtube_url();

$mail_title = $this->get_website_name();

$f_icon_url = $site_url."/img/mailer/icon1.png";
$t_icon_url = $site_url."/img/mailer/icon2.png";
$g_icon_url = $site_url."/img/mailer/icon3.png";
$l_icon_url = $site_url."/img/mailer/icon4.png";
$y_icon_url = $site_url."/img/mailer/icon5.png";

$f_img_url = $site_url."/img/mailer/img1.png";
$s_img_url = $site_url."/img/mailer/img2.png";
$t_img_url = $site_url."/img/mailer/img3.png";


	
	
$USER = mysql_query("SELECT * FROM user WHERE user_id = '$user_id' ");
$Res = mysql_fetch_array($USER);
$Email = $Res['email'];
$UserName = $Res['first_name'] ;
$FullName = $Res['first_name']." ".$Res['last_name'];
$UserPassword = $Res['password'] ; 


$ToEmail = $Email;
//$ToEmail = 'nagendra101289@hotmail'; 
$FromEmail = $this->get_email();
$subject = "Registration:$mail_title";



$mailmsg = "<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>$mail_title</title>
</head>
<body style='margin:0px; padding:0px;background:#d5d5d5;'>
   <table width='510' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#d5d5d5' style='border:1px solid #f8f8f6;'>
      <tbody width='510' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#fff' >
         <tr>
            <td width='28' height='30'></td>
            <td></td>
            <td ></td>
            <td ></td>
			<td ></td>
         </tr>
         <tr>
            <td ></td>
            <td colspan='2' align='left' > <img src='$logo_url_two' style='max-width:144px;'> </td>
            
         <td align='right'style='font-size:16px;font-family:arial;color:#6c6c6c;margin-top:8px;'>
               <p style='margin:0px; font-weight:700;'>Hello $UserName,</p>
               <p style='margin:0px;font-size:14px;color:#7d7d7d; '><a style='text-decoration:none;color:#7d7d7d !important;'>$Email</a></p>
            </td>
            <td width='28' height='30'></td>
         </tr>
         <tr>
            <td colspan='5' height='31'></td>
			
         </tr>
         
         <tr>
            <td colspan='5' height='18' ></td>
         </tr>
		 <tr>
            
            <td colspan='5' align='center' style=' margin: 0 auto;'><img src='$f_img_url'></td>
            
         </tr>
		 <tr>
            <td colspan='5' height='12' ></td>
         </tr>
         <tr>
            
            <td colspan='5' align='center' style='font-size:15pt;font-family:arial;color:#70c120;font-weight:700; '>Your account has been successfully created</td>
            
         </tr>
		 <tr>
            <td colspan='5' height='10'></td>
         </tr>
		<tr>
            <td colspan='5' align='center' style='font-size:14pt;font-family:arial;color:#979797; '>Thanks for joining with onlinevandy.com</td>
            <tr>
				<td colspan='5' height='26'></td>
			</tr>
			  <form>
  <tr>
	<td colspan='5'><input type='text'value='User Name : $FullName'  style='width:90%; padding:8px;border:1px solid #d7d7d7; border-radius:5px;color:#7d7d7d; background:transparent;' disabled></td>
    </tr>
	<tr>	
    <td colspan='5' height='5'  ></td>
	</tr>
	<tr>
	<td colspan='5' ><input type='text' value='Email : $Email' style='width:90%; padding:8px;border:1px solid #d7d7d7;border-radius:5px;color:#7d7d7d;background:transparent;' disabled></td>
    </tr>
	<tr>	
    <td colspan='5' height='5' ></td>
   </tr>
	<tr>
	<td colspan='5'><input value='Password : $UserPassword'  style='width:90%; padding:8px;border:1px solid #d7d7d7;border-radius:5px;color:#7d7d7d; background:transparent;' disabled></td>
    </tr>
	<tr>	
    <td colspan='5' height='21'></td>
   </tr>
   <tr>
   <td colspan='4'><a  href='$site_url'><input type='submit' value='Login' class='input_submit' style='width:20%; padding:8px 10px; border-radius:5px; background-color:#ff1027;border-style:none;font-weight:bold;color:#fff;'></a></td>
   <td></td>
    </tr>
  </form>
         
		 
         <tr>
            <td colspan='5' height='18'></td>
         </tr>
		 <tr>
		 <td></td>
            <td colspan='3' height='1'bgcolor='e0e0e0'></td>
			<td></td>
         </tr>
         
         <tr>
            <td colspan='5' height='28'></td>
         </tr>
         <tr>
         <td colspan='5' align='center' style='text:decoration;font-family:Arial;font-size:14px;color:#4a97ff;font-weight:bold;'><a  href='$site_url'>www.onlinevandy.com</a></td>
         </tr>
         <tr>
            <td colspan='5' height='22'></td>
         </tr>
         <tr>
            <td colspan='3' align='right' style='color:#848484;font-family:Arial;font-size:14px;'>Keep In Touch</td>
            <td align='left'>
              <a href='$fb_url'> <img src='$f_icon_url'></a>
              <a href='$gp_url'> <img src='$g_icon_url'></a>
              <a href='$link_url'> <img src='$l_icon_url'></a>
              <a href='$twit_url'> <img src='$t_icon_url'></a>
				
            </td>
            <td></td>
         </tr>
         <tr>
            <td colspan='5' height='19'></td>
         </tr>
         <tr>
		 
            <td colspan='5' height='52' bgcolor='212121' style='color:#fff;font-family:Arial;font-size:8pt;' style='padding:0px 5px;'>If you have any questions or trouble logging on <a  href='http://www.onlinevandy.com/page/17633/contact-us'>www.onlinevandy.com</a></td>
			
         </tr>
      </tbody>
   </table>
</body>
</html>
";
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			//$headers .= 'From: <$FromEmail>' . "\r\n";
			$headers .= 'From: '.$FromEmail."\r\n".'Reply-To: '.$FromEmail."\r\n" .'X-Mailer: PHP/' . phpversion();
			
			if($ToEmail !='')
			{
				mail($ToEmail,$subject,$mailmsg,$headers);
			}
	
		
	}

//############################################
//#-------------MAILER END HERE--------------#
//////////// Add Attributes Group ////////////




//////////// Add Attributes Group ////////////
public function add_product_detail_group()
{
	extract($_POST);
	$attribute = implode(",",$attribute_ids);
	$sql = "
	INSERT INTO product_detail_group
	SET
	attri_group_name='$attri_group_name',
	status='$status'
	";
	if(mysql_query($sql)){
		header('Location: product_detail_group.php?role=view&msg=succes');
	}
	else {
		header('Location: product_detail_group.php?role=view&msg=error');
	}
}


//////////// Add Attributes Group ////////////
public function update_product_detail_group($attri_group_id)
{
	extract($_POST);
	$attribute = implode(",",$attribute_ids);
	$sql = "
	UPDATE product_detail_group
	SET
	attri_group_name='$attri_group_name',
	status='$status'
	WHERE id='$attri_group_id'
	";
	if(mysql_query($sql)){
		header('Location: product_detail_group.php?role=view&msg=succes');
	}
	else {
		header('Location: product_detail_group.php?role=view&msg=error');
	}
}


//////////// Add Attributes Group ////////////
public function add_product_detail_attribute()
{
	extract($_POST);
	$attribute = implode(",",$attribute_ids);
	$sql = "
	INSERT INTO product_detail_attribute
	SET
	attri_group_name='$attri_group_name',
	status='$status'
	";
	if(mysql_query($sql)){
		header('Location: product_detail_attribute.php?role=view&msg=succes');
	}
	else {
		header('Location: product_detail_attribute.php?role=view&msg=error');
	}
}


//////////// Add Attributes Group ////////////
public function update_product_detail_attribute($attri_group_id)
{
	extract($_POST);
	$attribute = implode(",",$attribute_ids);
	$sql = "
	UPDATE product_detail_attribute
	SET
	attri_group_name='$attri_group_name',
	status='$status'
	WHERE id='$attri_group_id'
	";
	if(mysql_query($sql)){
		header('Location: product_detail_attribute.php?role=view&msg=succes');
	}
	else {
		header('Location: product_detail_attribute.php?role=view&msg=error');
	}
}


//get unique User id
	function genrateuniqueuserid()
	{
 	    $input_query = mysql_query("select * from user order by id DESC");
		$input_query_num = mysql_num_rows();
		$input_user_details = mysql_fetch_array($input_query);
		$userid = rand(10000,99999);
		
		$query=mysql_query("select * from user where user_id='$userid'");
		$querynum = mysql_num_rows($query);
			if($querynum<1){ 
				return $userid;
			}else{
				return $this->genrateuniqueuserid();
				}
		}
		

//User Registration And Updation
	public function add_user(){
		$_POST = $this->get_input($_POST);
		extract($_POST);
		$sql = "SELECT * FROM user WHERE (email='$email' or phone='$phoneno') ";
		$checked = mysql_query($sql);
		$count = mysql_num_rows($checked);
		if($count == 0):
		
		$date_of_birth=$year.'-'.$month.'-'.$date;
		
			#Age Calculation
			list($year,$month,$day) = explode("-",$date_of_birth);
			$year_diff  = date("Y") - $year;
			$month_diff = date("m") - $month;
			$day_diff   = date("d") - $day;
			if ($day_diff < 0 || $month_diff < 0)
			{
			$year_diff--;
			}
			$age=$year_diff;
			
		$last_modify = date('Y-m-d H:i:s');
		$register_ip = $this->get_user_ip();		
		$user_id= $this->genrateuniqueuserid();
		$verification_code = rand(00000,99999);
		$sql = " INSERT INTO user 
		SET 
		user_id='$user_id',
		first_name='$fname',
		last_name='$lname',
		email='$email',
		gender='$gender',
		phone='$phoneno',
		password='$password',
		user_type='$user_type',
		register_type='Backend',
		company_name='$company_name',
		date_of_birth='$date_of_birth',
		age='$age',
		website='$website',
		address='$address',	
		lastlogin='$last_modify',
		verification_code='$verification_code',
		register_ip='$register_ip',
		status='$status'
		";
		mysql_query($sql);
		//$_SESSION['websiteuser'] =  $user_id;
		//$this->send_signupmail($user_id);
		header('Location: user.php?role=view&msg=succes');
		else:
		header('Location: user.php?role=view&msg=error');
		endif;
	}

public function update_user($id,$user_id){
		$_POST = $this->get_input($_POST);
		extract($_POST);
		
	  $date_of_birth=$year.'-'.$month.'-'.$date;
		
			#Age Calculation
			list($year,$month,$day) = explode("-",$date_of_birth);
			$year_diff  = date("Y") - $year;
			$month_diff = date("m") - $month;
			$day_diff   = date("d") - $day;
			if ($day_diff < 0 || $month_diff < 0)
			{
			$year_diff--;
			}
			$age=$year_diff;
			
		$last_modify = date('Y-m-d H:i:s');
		$register_ip = $this->get_user_ip(); 
		//$user_id = rand();
		//$user_id= $this->genrateuniqueuserid();
		$verification_code = rand(00000,99999);
		$sql = " UPDATE user 
		SET 		
		first_name='$fname',
		last_name='$lname',
		email='$email',
		gender='$gender',
		phone='$phoneno',
		password='$password',
		user_type='$user_type',		
		company_name='$company_name',
		date_of_birth='$date_of_birth',
		age='$age',
		website='$website',
		address='$address',	
		lastlogin='$last_modify',
		verification_code='$verification_code',
		register_ip='$register_ip',
		status='$status'
		WHERE id=$id
		";
		if(mysql_query($sql)){
		//$_SESSION['websiteuser'] =  $user_id;
		//$this->send_signupmail($user_id);
		header('Location: user.php?role=view&msg=succes');
		}else{
		header('Location: user.php?role=view&msg=error');
		}
	}

//class End



/* VENDOR CODE START */

public function checkExistVenderUserName($getusername){
		
		$sql ="SELECT * FROM admin_login WHERE username='$getusername'";
		$query = mysql_query($sql)or die(mysql_error());
		$numrow = mysql_num_rows($query);
		
		if ($numrow > 0){
			return 1;
		}
		else{
			return 0;
		}	

	}
	
	
//get unique Vendor id
	function genrateuniquevendorid()
	{
 	    $input_query = mysql_query("select * from admin_login order by id DESC");
		$input_query_num = mysql_num_rows();
		$input_user_details = mysql_fetch_array($input_query);
		$vendorid = rand(10000,99999);
		
		$query=mysql_query("select * from admin_login where vendor_id='$vendorid'");
		$querynum = mysql_num_rows($query);
			if($querynum<1){ 
				return $vendorid;
			}else{
				return $this->genrateuniquevendorid();
				}
		}

	
	public function signup_vendor()
	{
		$_POST = $this->get_input($_POST);
		extract($_POST);
	    $sql = "SELECT * FROM admin_login WHERE email='$email' AND type = 'vendor' ";
		$checked = mysql_query($sql);
		$count = mysql_num_rows($checked);
		if($count == 0):
		$last_modify = date('Y-m-d H:i:s');
		//$vendor_id = rand();
		$vendor_id= $this->genrateuniquevendorid();
		
		$register_ip = $this->get_user_ip();
		
	    $sql_login = " INSERT INTO admin_login 
		SET 
		vendor_id='$vendor_id',
		username='$register_username',
		name='$full_name',
		email='$email',
		type='vendor',
		password='$password',
		mobile='$mobile',
		pincode='$pincode',
		lastlogin='$last_modify',
		register_ip='$register_ip',
		status='active'
		";
		
		mysql_query($sql_login);
		$_SESSION['vendor_id'] =  $vendor_id;
		$_SESSION['checkadmin'] = $full_name;
		
		
		$this->send_vendor_signupmail($vendor_id);
		
		else:
		return false;
		endif;
	}

	
	function add_business_detail()
{
    extract($_POST);
	
	if($_FILES['pan_card_file']['name'] !='')
	{
		$dir = 'upload/vendor/';
		$newname = 'pan_'.rand();
		$website_event_img = $_FILES['pan_card_file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;		
		move_uploaded_file($_FILES['pan_card_file']['tmp_name'],$dir.$newfilename);
		$imagepan = "pan_card_file='$newfilename',";
	}
	
	if($_FILES['tin_vat_file']['name'] !='')
	{
		$dir = '../upload/vendor/';
		$newname = 'tin_'.rand();
		$website_event_img = $_FILES['tin_vat_file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['tin_vat_file']['tmp_name'],$dir.$newfilename);
		$imagetin = "tin_vat_file='$newfilename',";
	}
	if($_FILES['tan_file']['name'] !='')
	{
		$dir = '../upload/vendor/';
		$newname = 'tan_'.rand();
		$website_event_img = $_FILES['tan_file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['tan_file']['tmp_name'],$dir.$newfilename);
		$imagetan = "tan_file='$newfilename',";
	}
	
	
	$sql = "INSERT INTO business_details
	        SET
	        vendor_id    = '$vendor_id',
			buss_name    = '$buss_name', 
			buss_type    = '$buss_type', 
			pan_card     = '$pan_card', 
			$imagepan
			tin_vat      = '$tin_vat', 
			$imagetin
			vat_check    = '$vat_check', 
			tan          = '$tan', 
			$imagetan
			tan_check    = '$tan_check',
            status       = 'pending' ";
			
	if(mysql_query($sql))
	{
		return true;
	}
	else 
	{
		return false;
	}
			
}


function update_business_detail()
{
    extract($_POST);
	
	if($_FILES['pan_card_file']['name'] !='')
	{
		$dir = 'upload/vendor/';
		$newname = 'pan_'.rand();
		$website_event_img = $_FILES['pan_card_file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;		
		move_uploaded_file($_FILES['pan_card_file']['tmp_name'],$dir.$newfilename);
		$imagepan = "pan_card_file='$newfilename',";
	}
	
	if($_FILES['tin_vat_file']['name'] !='')
	{
		$dir = '../upload/vendor/';
		$newname = 'tin_'.rand();
		$website_event_img = $_FILES['tin_vat_file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['tin_vat_file']['tmp_name'],$dir.$newfilename);
		$imagetin = "tin_vat_file='$newfilename',";
	}
	if($_FILES['tan_file']['name'] !='')
	{
		$dir = '../upload/vendor/';
		$newname = 'tan_'.rand();
		$website_event_img = $_FILES['tan_file']['name'];
		$extension = end(explode(".", $website_event_img));
		$newfilename = $newname.".".$extension;
		move_uploaded_file($_FILES['tan_file']['tmp_name'],$dir.$newfilename);
		$imagetan = "tan_file='$newfilename',";
	}
	
    $sql = "Update business_details
	        SET
	        vendor_id    = '$vendor_id',
			buss_name    = '$buss_name', 
			buss_type    = '$buss_type', 
			pan_card     = '$pan_card', 
			$imagepan
			tin_vat      = '$tin_vat', 
			$imagetin
			vat_check    = '$vat_check', 
			tan          = '$tan', 
			$imagetan
			tan_check    = '$tan_check',
            status       = 'pending' 
			WHERE 
			vendor_id    = '$vendor_id'
			";
	
	if(isset($admin_side))
	{
		if(mysql_query($sql))
		{
			header('Location: business_detail.php?role=view&msg=succes');
		}
		else {
			header('Location: business_detail.php?role=view&msg=error');
		}
		
	}		
	else
	{
			
		if(mysql_query($sql)){
			return true;
		}
		else{
			return false;
		}
	}

			
}
function add_store_detail()
{
	
	extract($_POST);
	
    $sql = "INSERT INTO store_details
	        SET
	        vendor_id   = '$vendor_id',
			dis_name    = '$dis_name', 
			description = '$description', 
            status      = 'pending' ";
			
	if(mysql_query($sql))
	{
		return true;
	}
	else 
	{
		return false;
	}
	
}
function update_store_detail()
{
	extract($_POST);
    $sql = "Update store_details
	        SET
	        vendor_id   = '$vendor_id',
			dis_name    = '$dis_name', 
			description = '$description', 
            status      = 'pending' 
			WHERE
			vendor_id   = '$vendor_id' ";
			
	if(isset($admin_side))
	{
		if(mysql_query($sql))
		{
			header('Location: store_detail.php?role=view&msg=succes');
		}
		else {
			header('Location: store_detail.php?role=view&msg=error');
		}
		
	}		
	else
	{
			
		if(mysql_query($sql)){
			return true;
		}
		else{
			return false;
		}
	}
}
function add_bank_detail()
{
	
	extract($_POST);
    $sql = "INSERT into bank_detail
	        SET
			vendor_id       = '$vendor_id',
			account_name    = '$account_name', 
			account_no      = '$account_no',
			ifsc_code       = '$ifsc_code',
			bank_name       = '$bank_name',
			state           = '$state',
			city            = '$city',
			branch          = '$branch',	
			status          = 'pending' ";
			
	if(mysql_query($sql))
	{
		return true;
	}
	else 
	{
		return false;
	}
	
}
function update_bank_detail()
{
	
	extract($_POST);
    $sql = "Update bank_detail
	        SET
			vendor_id       = '$vendor_id',
			account_name    = '$account_name', 
			account_no      = '$account_no',
			ifsc_code       = '$ifsc_code',
			bank_name       = '$bank_name',
			state           = '$state',
			city            = '$city',
			branch          = '$branch',	
			status          = 'pending' 
			WHERE 
			vendor_id       = '$vendor_id' ";
			
	
	if(isset($admin_side))
	{
		if(mysql_query($sql))
		{
			header('Location: bank_detail.php?role=view&msg=succes');
		}
		else {
			header('Location: bank_detail.php?role=view&msg=error');
		}
		
	}		
	else
	{
			
		if(mysql_query($sql)){
			return true;
		}
		else{
			return false;
		}
	}
	
	
}

	function update_vendor($id){
		
		extract($_POST);
		
		 $sql = "Update admin_login
				SET
				name    = '$username',
				email       = '$email', 
				mobile      = '$mobile',
				pincode     = '$pincode'
				WHERE 
				id       = '$id' ";
				
				
		if(mysql_query($sql))
		{
			header('Location: vendor.php?role=view&msg=succes');
		}
		else {
			header('Location: vendor.php?role=view&msg=error');
		}
		
		
	}

	#SEND VENDOR SIGNUP MAILER
	
public function send_vendor_signupmail($vendor_id){
//$get_val = $this->GetMailerValue();
//return  $get_val['weburl'];

$site_url = SITE_URL;

$vendor_url = VENDOR_PATH;

$weburl = $this->get_website_url();
$logo_url = $site_url."/upload/comman/".$this->get_logo();
//$logo_url_two = $site_url."/images/logo1.png";
$logo_url_two =$site_url."/upload/comman/".$this->get_logo();
$fb_url = $this->get_facebook_url();
$twit_url = $this->get_twitter_url();
$gp_url = $this->get_google_plus_url();
$link_url=$this->get_linkedin_url();
$pint_url=$this->get_pinterest_url();
$insta_url=$this->get_instagram_url();
$yout_url = $this->get_youtube_url();

$mail_title = $this->get_website_name();

$helpline_no= $this->get_phone_no();

$f_icon_url = $site_url."/images/mailer/icon1.png";
$t_icon_url = $site_url."/images/mailer/icon2.png";
$g_icon_url = $site_url."/images/mailer/icon3.png";
$l_icon_url = $site_url."/images/mailer/icon4.png";
$p_icon_url = $site_url."/images/mailer/icon6.png";
$i_icon_url = $site_url."/images/mailer/icon7.png";
$y_icon_url = $site_url."/images/mailer/icon5.png";

$f_img_url = $site_url."/images/mailer/img1.png";
$s_img_url = $site_url."/images/mailer/img2.png";
$t_img_url = $site_url."/images/mailer/img3.png";

	
$USER = mysql_query("SELECT * FROM admin_login WHERE vendor_id = '$vendor_id' ");
$Res = mysql_fetch_array($USER);
$Email = $Res['email'];
$UserName = $Res['username'] ;
$FullName = $Res['name'];
$UserPassword = $Res['password'] ;

//$verify_user_id = base64_encode($user_id);
//$verification_code =  base64_encode($Res['verification_code']);
//$verify_url = $site_url.'/verify.html?verifyuser='.$verify_user_id.'&verifycode='.$verification_code;

$ToEmail = $Email;
$FromEmail = $this->get_email();
$subject = 'Registration: onlinevandy.com';



$mailmsg = "<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>$mail_title</title>
</head>
<body style='margin:0px; padding:0px;background:#d5d5d5;'>
   <table width='510' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#d5d5d5' style='border:1px solid #f8f8f6;'>
      <tbody width='510' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#fff' >
         <tr>
            <td width='28' height='30'></td>
            <td></td>
            <td ></td>
            <td ></td>
			<td ></td>
         </tr>
         <tr>
            <td ></td>
            <td colspan='2' align='left' > <img src='$logo_url_two' style='max-width:144px;'> </td>
            
         <td align='right'style='font-size:16px;font-family:arial;color:#6c6c6c;margin-top:8px;'>
               <p style='margin:0px; font-weight:700;'>Hello $UserName,</p>
               <p style='margin:0px;font-size:14px;color:#7d7d7d; '><a style='text-decoration:none;color:#7d7d7d !important;'>$Email</a></p>
            </td>
            <td width='28' height='30'></td>
         </tr>
         <tr>
            <td colspan='5' height='31'></td>
			
         </tr>
         
         <tr>
            <td colspan='5' height='18' ></td>
         </tr>
		 <tr>
            
            <td colspan='5' align='center' style=' margin: 0 auto;'><img src='$f_img_url'></td>
            
         </tr>
		 <tr>
            <td colspan='5' height='12' ></td>
         </tr>
         <tr>
            
            <td colspan='5' align='center' style='font-size:15pt;font-family:arial;color:#70c120;font-weight:700; '>Your account has been successfully created</td>
            
         </tr>
		 <tr>
            <td colspan='5' height='10'></td>
         </tr>
		<tr>
            <td colspan='5' align='center' style='font-size:14pt;font-family:arial;color:#979797; '>Thanks for joining with $mail_title</td>
            <tr>
				<td colspan='5' height='26'></td>
			</tr>
			  <form>
  <tr>
	<td colspan='5'><input type='text'value='User Name : $FullName'  style='width:90%; padding:8px;border:1px solid #d7d7d7; border-radius:5px;color:#7d7d7d; background:transparent;' disabled></td>
    </tr>
	<tr>	
    <td colspan='5' height='5'  ></td>
	</tr>
	<tr>
	<td colspan='5' ><input type='text' value='Email : $Email' style='width:90%; padding:8px;border:1px solid #d7d7d7;border-radius:5px;color:#7d7d7d;background:transparent;' disabled></td>
    </tr>
	<tr>	
    <td colspan='5' height='5' ></td>
   </tr>
	<tr>
	<td colspan='5'><input value='Password : $UserPassword'  style='width:90%; padding:8px;border:1px solid #d7d7d7;border-radius:5px;color:#7d7d7d; background:transparent;' disabled></td>
    </tr>
	<tr>	
    <td colspan='5' height='5'  ></td>
	</tr>";
	
	
	
	/*$mailmsg .= "<tr>	
    <td colspan='5' height='21'></td>
   </tr>
   <tr>
   <td colspan='4'><a href='$verify_url' style='padding:8px 10px;border-style:none;font-weight:bold;color:#15c;'>Please click to verify your email. Ignore if already verify.
   </a></td>
   <td></td>
    </tr>";*/
	
	
	
	$mailmsg .="<tr>	
    <td colspan='5' height='21'></td>
   </tr>
   <tr>
   <td colspan='4'><a href='$vendor_url'><input type='submit' value='Login' class='input_submit' style='width:20%; padding:8px 10px; border-radius:5px; background-color:#ff1027;border-style:none;font-weight:bold;color:#fff;'></a></td>
   <td></td>
    </tr>
  </form>
         
		 
         <tr>
            <td colspan='5' height='18'></td>
         </tr>
		 <tr>
		 <td></td>
            <td colspan='3' height='1'bgcolor='e0e0e0'></td>
			<td></td>
         </tr>
         
         <tr>
            <td colspan='5' height='28'></td>
         </tr>
         <tr>
         <td colspan='5' align='center' style='text:decoration;font-family:Arial;font-size:14px;color:#4a97ff;font-weight:bold;'><a  href='$site_url'>$weburl</a></td>
         </tr>
         <tr>
            <td colspan='5' height='22'></td>
         </tr>
         <tr>
            <td colspan='3' align='right' style='color:#848484;font-family:Arial;font-size:14px;'>Keep In Touch</td>
            <td align='left'>
              <a href='$fb_url'> <img src='$f_icon_url'></a>
			  <a href='$twit_url'> <img src='$t_icon_url'></a>
			  <a href='$link_url'> <img src='$l_icon_url'></a>
              <a href='$gp_url'> <img src='$g_icon_url'></a>                            
				
            </td>
            <td></td>
         </tr>
         <tr>
            <td colspan='5' height='19'></td>
         </tr>
         <tr>
		 
            <td colspan='5' height='52' bgcolor='212121' style='color:#fff;font-family:Arial;font-size:8pt;' style='padding:0px 5px;'>If you have any questions or trouble logging on please choose our helpline:- $helpline_no</td>
			
         </tr>
      </tbody>
   </table>
</body>
</html>
";
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			//$headers .= 'From: <$FromEmail>' . "\r\n";
			$headers .= 'From: '.$FromEmail."\r\n".'Reply-To: '.$FromEmail."\r\n" .'X-Mailer: PHP/' . phpversion();
			
			if($ToEmail !='')
			{
				mail($ToEmail,$subject,$mailmsg,$headers);
			}
	
		
	}


#END VENDOR SIGNUP MAILER
#SHIPPING CHARGES
//////////// Add Shipping ////////////
public function add_shipping(){
	
	$_POST = $this->get_input($_POST);	
	extract($_POST);
	
	$sql = "
	INSERT INTO shipping_charges 
	SET	
	weight='$weight',
	amount='$amount',	
	status='$status'
	";
	//echo $sql;
	if(mysql_query($sql)){
		header('Location: shipping_charges.php?role=view&msg=succes');
	}
	else {
		header('Location: shipping_charges.php?role=view&msg=error');
	}
}
//////////// UPDATE Shipping ////////////
	public function update_shipping($id){
	
	$_POST = $this->get_input($_POST);
	
	extract($_POST);
	
		$sql = "
		UPDATE shipping_charges 
		SET
		weight='$weight',
		amount='$amount',
		status='$status'
		WHERE id='$id'
		";
		//echo $sql;
		if(mysql_query($sql)){
			header('Location: shipping_charges.php?role=view&msg=succes');
		}
		else {
			header('Location: shipping_charges.php?role=view&msg=error');
		}
	}
#END SHIPPING	
/* VENDOR CODE END */

}
?>