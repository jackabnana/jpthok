<?
include 'management/include/functions.php';
extract($_REQUEST);

	$bid = explode("/",$id);
	$split_id = $bid[0];
	$split_name = $bid[1];
	$check_split_id = explode("-",$split_id);
	$nowaction = $check_split_id[0];
	$nowid = $check_split_id[1];
	$check = $set->recent_view_product($nowid);	
	
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
	<link rel="stylesheet" href="<?=$site_url?>/plugin/zoom/css/bzoom.css" type="text/css" />
	
	<!-- Owl Carousel Assets -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/website.css" type="text/css" media="screen"/>
</head>


<body>

<!--header start here-->
   <? include 'inc/header.php'; ?>
<!--header end here-->
<?
$product = mysql_query("SELECT * FROM product WHERE prod_id = '".$nowid."' ");
$result_prod = mysql_fetch_array($product);


//echo '<pre>';
//print_r($result_prod);
//echo '</pre>';

?>


<div class="main-heading">
	<div class="container">
		<h2><?=$result_prod['product_name']?></h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="<?=$site_url?>">Home</a></li>
			<?if($result_prod['cat_id']!='')
			{
				$seo_name1 = $get->seo_friendly_url($get->get_category_name_by_id($result_prod['cat_id']));
				?>
				<li>
				<a href="<?=$site_url?>/listing/c-<?=$result_prod['cat_id']?>/<?=$seo_name1?>"><?=$get->get_category_name_by_id($result_prod['cat_id'])?></a>
				</li>
				<?
			}
			?>
			<?if($result_prod['subcat_id']!='')
			{
				$seo_name2 = $get->seo_friendly_url($get->get_category_name_by_id($result_prod['subcat_id']));
				?>
				<li>
				<a href="<?=$site_url?>/listing/c-<?=$result_prod['subcat_id']?>/<?=$seo_name2?>"><?=$get->get_category_name_by_id($result_prod['subcat_id'])?></a>
				</li>
				<?
			}
			?>
			<?if($result_prod['sub_subcat_id']!='')
			{
				$seo_name3 = $get->seo_friendly_url($get->get_category_name_by_id($result_prod['sub_subcat_id']));
				?>
				<li>
				<a href="<?=$site_url?>/listing/c-<?=$result_prod['sub_subcat_id']?>/<?=$seo_name3?>"><?=$get->get_category_name_by_id($result_prod['sub_subcat_id'])?></a>
				</li>
				<?
			}
			?>
			<li><?=$result_prod['product_name']?></li>
		</ul>
		</div>
	</div>
</div>
<section id="details-page" class="detail-page ">
   <div class="container">

		<!-- details -->
		<div class="product-detail">
			<div class="bzoom_wrap" >
				<ul id="bzoom">
				<?
				$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$nowid."' ");
				$count_image = mysql_num_rows($prod_image);
				while($res_image = mysql_fetch_array($prod_image))
				{
					?>
					<li>
						<img class="bzoom_thumb_image" src="<?=$site_url?>/upload/product/<?=$res_image['product_img']?>" title="first img" />
						<img class="bzoom_big_image" src="<?=$site_url?>/upload/product/<?=$res_image['product_img']?>"/>
					</li>
					<? 
				} 
				?>
				</ul>
			</div>

			<div class="product-text col-md-65 right">
				<h1 class="col-md-85 product-name"><?=$result_prod['product_name']?></h1>
				
				<?$url = $get->seo_friendly_url($result_prod['product_name']);?>
				
				<span><a class="grey" href="<?=$site_url?>/write-review/<?=$nowid?>/<?=$url?>" class="pink-button"><i class="fa fa-pencil"></i> Write a review</a></span>
				
				<span class="product-code">PRODUCT CODE: <?=$result_prod['product_code']?></span>
				
				
				<!-- Review Count And Rating Counting By NK -->
				<p style="font-size: 13px; color: rgb(180, 180, 180); line-height: 25px;"></p>
						<span class="wishlist-icon"></span>
						<?
						$selectreview = mysql_query("SELECT * FROM review WHERE product_id='$nowid' and status='active' ORDER BY id DESC ");
						$countreview = mysql_num_rows($selectreview);
						if($countreview > 0 )
						{
							$sum = 0;	
							while($res = mysql_fetch_array($selectreview))
							{ 
								extract($res);
								$sum += $review_star;
							}
							$avg = round($sum/$countreview);
							?>	
							<div class="given-rate">
								<div class="star">
								<?
								for($x=0;$x<$avg;$x++)
								{
									?>
									<i class="fa fa-star my-star"></i>
									<? 
								} 
								for($j=0;$j<5-$avg;$j++)
								{ 
									?>
									<i class="fa fa-star star-rem"></i>
									<? 
								} 
									?>
								</div>
								<span class="total-rating-number"><?=$avg?> Ratings</span>
								<span class="total-review-number"><?=$countreview?> Reviews</span>
							</div>
						<? 
						} 
						?>
				<!-- END Review Count And Rating Counting By NK -->
				
				
				
				<p class="product-detial-view"><?=$result_prod['details']?></p>
				<?
				$getrs = $result_prod['product_rate']-$result_prod['prodcut_discount_rate'];
				$getoff = ($getrs/$result_prod['product_rate'])*100;?>

				<div class="price-div">
					<div class="net-price">Rs. <span id="discount"><?=number_format($result_prod['prodcut_discount_rate'])?> </span><span class="cut-price">Rs. <span id="actual_price"><?=number_format($result_prod['product_rate'])?></span> </span></div>
					<div class="you-save">You are saving Rs. <span id="save_amt"><?=number_format($getrs)?></span> <span class="discount">[<span id="disoff"><?=round($getoff,2)?></span>% off]</span></div>
				</div>
				
				<div class="check-pincode">
					
					<div id="pincode-div">
					<span class="title">Shipping from  </span>
						New Delhi Warehouse
					</div>
					
					<!--<div id="pincode-div">
					<span class="title">Availability at</span>
						<form id="pincode-form">
						<div class="pincode-input">
						<input type="text" id="pincode" name="check_pincode" placeholder="Enter Pincode" class="input-box">
						<input type="submit" value="check" id="check_pincode" class="submit-btn">
						</div>
						</form>
					</div>--> 
					<div class="messages serviceable text-center dp-none">
						<div class="avil-msg">
							<span class="yes"></span>
							<span class="title pincode-title"></span>
							<span class="checked-pincode"></span>&nbsp;&nbsp;
							<a class="btn-change grey" href="#0">Change</a>
							<!--<span class="not">SHIPPING TO THIS PINCODE NOT AVAILABLE</span>-->
						</div>
					</div>
				</div>
				
				<!--<div class="size-qty">
					<ul class="select-size">
						<?
						$result = $get->get_stock_attribute($result_prod['prod_id']);
						while($res_id = mysql_fetch_array($result))
						{
							extract($res_id);
							$name = $get->get_attribute_option_name($attribute_option_id);
							
							$getrs1 = $attribute_price-$attribute_dis_price;
							$getoff1 = ($getrs1/$attribute_price)*100;
							
							?>
							
							
							<li class="list" onclick="change_price('<?=number_format($attribute_dis_price)?>','<?=number_format($attribute_price)?>','<?=$attribute_option_id?>','<?=round($getoff1)?>','<?=$getrs1?>')">
							<a href="#0" id="color_<?=$attribute_option_id?>" class="size remove_color  active">
							<?=$name?>
							</a>
							</li>
							<?
						}
						$attname = $get->get_attribute_name($attribute_id);
				        ?>
					    <input type="hidden" name="prod_id" value="<?=$nowid?>" >
						<input type="hidden" name="attribute" id="option_id" value="" >
						<input type ="hidden" id="attribute_name" value="<?=$attname?>">
						<input type="hidden" name="red" id="add_red">
						<input type="hidden" name="product_id" id="product_id" value="<?=$nowid?>" >
					</ul>
				</div>-->
                 <div class="size-qty details-select-option">
				  <form>
				    <label>Select Options</label>
					<select name="range_product" onchange="change_range_price(this.value);">
					<?
						$result = $get->get_stock_attribute($result_prod['prod_id']);
						while($res_id = mysql_fetch_array($result))
						{
							extract($res_id);
							$name = $get->get_attribute_option_name($attribute_option_id);
							
							$getrs1 = $attribute_price-$attribute_dis_price;
							$getoff1 = ($getrs1/$attribute_price)*100;
							
							?>
					  <option value="<?=number_format($attribute_dis_price)."-".number_format($attribute_price)."-".$attribute_option_id."-".round($getoff1)."-".$getrs1?>"><?=$name?></option>
					  <?
						}
						$attname = $get->get_attribute_name($attribute_id);
				        ?>
					  
					</select>
					<input type="hidden" name="prod_id" value="<?=$nowid?>" >
					<input type="hidden" name="attribute" id="option_id" value="" >
					<input type ="hidden" id="attribute_name" value="<?=$attname?>">
					<input type="hidden" name="red" id="add_red">
					<input type="hidden" name="product_id" id="product_id" value="<?=$nowid?>" >
				  </form>
				 </div>
				<div class="buttons">
					<a href="#0" onclick="buy_now_product('<?=$nowid?>')" class="buy-now">Buy Now</a>
					<a href="#0" onclick="add_to_cart_product('<?=$nowid?>')" class="add-to-cart">Add to cart</a>
					
					
					
					<? if($get->get_wishlist($nowid,$get->get_website_session()) == '')
					 { 
							
							if($get->get_website_session() !='')
							{ 
						      ?><a href="javascript:add_to_wish(<?=$get->get_website_session()?>,<?=$nowid?>)" class="wishlist-btn" id="wishlist_text"><? 
							} 
							else 
							{ 
						       ?><a href="javascript:add_to_wish(<?=$get->get_website_session()?>,<?=$nowid?>)" class="wishlist-btn" id="wishlist-button"><? 
							} 
							?>
							SAVE TO WISHLIST
							</a>
					 <? 
					 }
					 else
					 {
							?><a href="javascript:vol();" class="wishlist-btn pink-button-active" id="">
							<span id="wishlist_text">ADDED TO WISHLIST</span></a><?
					 } 
					 ?>
				
				</div>

			</div>
		</div>

		<!-- details -->
	</div>
	<div id="products-details">
	  <div class="container">
        <div class="col-md-70 left">
		  <h3>Specifictions of <?=$result_prod['product_name']?></h3>
		 
		<?				 
		$groupsql = mysql_query("SELECT * FROM detail_product_attribute  WHERE prod_id = '$nowid' AND product_attri_group_id > 0 GROUP BY product_attri_group_id");
		$countgroup = mysql_num_rows($groupsql);
		if($countgroup > 0)
		{
			while($resultsql = mysql_fetch_array($groupsql))
			{
			?>  
			  <div class="info-row">
					<div class="head"><?=$get->get_product_attri_group_name($resultsql['product_attri_group_id'])?></div>
					<?
					$productsql = mysql_query("SELECT * FROM detail_product_attribute  WHERE prod_id = '$nowid' AND  product_attri_group_id > 0 AND product_attri_group_id = '".$resultsql['product_attri_group_id']."' ");
					$countproduct = mysql_num_rows($productsql);
					if($countproduct > 0)
					{
						while($resultproductsql = mysql_fetch_array($productsql))
						{
							?>
							<div class="row">
							<div class="propty"><?=$get->get_product_attri_name($resultproductsql['detail_product_att_name'])?></div>
							<div class="value"><?=$resultproductsql['detail_product_att_value']?></div>
							</div>
							<?
						}
					}	
					?>	
			  </div>
			<? 
			} 
		}	
			?>
		</div>
		
        <div class="col-md-25 right">
		  <h3>Simlier Products</h3>
		 <div class="simlier-products">
		 
		 
		 <?$no_of_prod = explode(',',$result_prod['related_prod_id']);?>
					<ul class="single-products slider-5-items">
						<?
						if($result_prod['related_prod_id']!='')
						{
							for($i=0;$i<count($no_of_prod);$i++)
							{
								$pId = $no_of_prod[$i];
								
								$prod_qry = mysql_query("SELECT * FROM product WHERE prod_id = '$pId' AND status= 'active' ");
								$result = mysql_fetch_array($prod_qry);
								extract($result);
								$url = $get->seo_friendly_url($product_name);
								?> 
								<li>
								<a href="<?=$site_url?>/detail/pid-<?=$prod_id?>/<?=$url?>" class="grey">
								
								<div class="sec1">
								<img src="<?=$site_url?>/upload/product/thumb/th_<?=$get->get_single_product_img($prod_id)?>"></div>
								<div class="sec2">
									<p class="p-name">
									    <?
									    if (strlen($product_name) >= 20){ 
										echo $get->get_match_text(substr($product_name, 0, 20),$search_text).'...';
										} else {
										echo $get->get_match_text($product_name,$search_text);
										}
										?>
									</p>
									<p class="star-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									</p>
									<p class="price"><span>Rs <?=number_format($get->get_product_price($prod_id,''))?></span><del>Rs <?=number_format($get->get_product_without_discount_price($prod_id))?></del></p>
								</div>
							<?	
							} 
						}
						else 
						{
							?>
							<p>No similar product(s) found.</p>
							<? 
						} 
						?>
					</ul>
				</div>
				 <div style="clear:both;"></div>
				<h3 class="margin-top-20px">Recents View Products</h3>
				<div class="simlier-products">
				<?
				$recentview = $get->get_recent_product(5);
				$countrecentview=mysql_num_rows($recentview);
				if($countrecentview >0)
				{ 
					?>
					<ul class="single-products slider-5-items">
					<?	
					while($datarecent = mysql_fetch_object($recentview))
					{
						
						$imgr = $get->get_single_product_img($datarecent->prod_id);
						$productname= $get->get_product_name($datarecent->prod_id);
						$productprice= $get->get_product_price($datarecent->prod_id);				
						$productdiscountprice= $get->get_product_discount_price($datarecent->prod_id);
						$url = $get->seo_friendly_url($datarecent->product_name);
						
						$getrs = $datarecent->product_rate-$datarecent->prodcut_discount_rate;
						$getoff = round(($getrs/$datarecent->product_rate)*100);
						?>
						
					<li>
					<a href="<?=$site_url?>/detail/pid-<?=$datarecent->prod_id?>/<?=$url?>" class="grey style">
					<div class="sec1">
								<img src="<?=$site_url?>/upload/product/thumb/th_<?=$imgr?>">
					</div>
					<div class="sec2">
						<p class="p-name">
						<?					
									if (strlen($productname) >= 20){ 
									echo $get->get_match_text(substr($productname, 0, 20),$search_text).'...';
									} else {
									echo $get->get_match_text($productname,$search_text);
									}
									?>
						</p>
						<p class="star-rating">
								  <i class="fa fa-star"></i>
								  <i class="fa fa-star"></i>
								  <i class="fa fa-star"></i>
								  <i class="fa fa-star"></i>
								  <i class="fa fa-star"></i>
                        </p>
						<p class="price"><span>Rs <?=number_format($get->get_product_price($datarecent->prod_id))?></span><del>Rs <?=number_format($get->get_product_without_discount_price($datarecent->prod_id))?></del></p>
					</div>
					</a>
					</li>
					<? 
					} 
					?> 

					</ul>
					<? 
				} 
				?>
				</div>
		</div>
		<!-- review Start -->
		<?
		$x=0;
		$selectreview = mysql_query("SELECT * FROM review WHERE product_id='$nowid' and status='active' ORDER BY id DESC ");
		$countreview = mysql_num_rows($selectreview);
		?>
		<div class="review-sections col-md-100 left margin-top-bottom-20px framing">
			<h2 class="col-md-60 left f-14">Rating & Reviews <span class="total-number-review"><?=round($countreview)?></span></h2>
			<a href="<?=$site_url?>/write-review/<?=$prod_id?>/<?=$url?>" style="background-color: #888; color: #fff; padding: 5px 15px; border-radius: 3px; " class="f-12 right">Write a review</a>

			<ul class="reviews">
		<?
						$x=1;
						if($countreview > 0):
						while($rowreview=mysql_fetch_array($selectreview)){
						extract($rowreview);
						if($x <= 5 ){
					?>
			<li class="reviews-list">
				<div class="name">
					<span class="first-letter color-<?=strtolower($review_name[0])?> "><?=strtoupper($review_name[0])?></span>
					<span class="full-name"><?=$review_name?></span>
				</div>

				<div class="review-section">
					<div class="text">
						<div class="star-rate">
							<div class="star">
								<? for($i=1;$i<=$review_star;$i++) { ?>
								<i class="fa fa-star"></i>
								<? } for($i=1;$i<=(5-$review_star);$i++) { ?>
								<i style="color:#CCC;" class="fa fa-star"></i>
								<? } ?>
							</div>
							<div class="date"><?=$review_date?></div>
						</div>
						<div class="title"><?=$review_title?></div>
						<p class="comment"><?=$review_msg?></p>
					</div>
				</div>
			</li>
			<? } $x++; } else: ?>
			<li class="reviews-list f-12">No reviews available.</li>
			<? endif; ?>
			
			
			<? if($x > 5): ?>
			<div class="clear-both"></div>
				<div class="col-md-100 text-center margin-top-20px margin-bottom-20px">
					<a href="#0" class="view-all-reviews"> - View All Reviews -</a>
				</div>
				<? endif; ?>
			</ul>
		</div>

			<!-- review section -->
		
	  </div>
	</div>
	
	
</section>


<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->




	<script src="<?=$site_url?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=$site_url?>/plugin/zoom/js/jqzoom.js"></script>
	<script src="<?=$site_url?>/js/globle.js"></script>

<script src="<?=$site_url?>/plugin/number-plus-minus/number.js" ></script>
<script type="text/javascript" src="<?=$site_url?>/js/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript" src="<?=$site_url?>/js/website.js"></script>
<script type="text/javascript">
$('.after').bootstrapNumber();
$('.colorful').bootstrapNumber({
	upClass: 'success',
	downClass: 'danger'
});

$("#bzoom").zoom({
	zoom_area_width: 410,
	autoplay_interval :3000,
	small_thumbs : <?=$count_image?>,
	autoplay : false
});

function change_price(str,price,aid,getdis,save_val)
{
	alert("Attribute Dis Price "+str+" Attribute Price= "+price+" Attribute Option Id "+aid+" Get Off "+getdis+" Get Gear "+save_val);
	$("#discount").html(str);
	$("#actual_price").html(price);
	$("#option_id").val(aid);
	$("#disoff").text(getdis);
	$("#save_amt").html(save_val);
	$('#product_qty').val(1);
	$('.remove_color').css("background","none");
	$('#color_'+aid).css("background","#fc8b6d");
	$('#color_'+aid).css("color","#bf2764");
	
}


function change_range_price(str_value)
{
	var att = str_value.split('-');
	
	var str = att[0];
	var price = att[1];
	var aid = att[2];
	var getdis = att[3];
	var save_val = att[4];	
	
	//alert("Attribute Dis Price "+str+" Attribute Price= "+price+" Attribute Option Id "+aid+" Get Off "+getdis+" Get Gear "+save_val);
	
	$("#discount").html(str);
	$("#actual_price").html(price);
	$("#option_id").val(aid);
	$("#disoff").text(getdis);
	$("#save_amt").html(save_val);
	$('#product_qty').val(1);
	$('.remove_color').css("background","none");
	$('#color_'+aid).css("background","#fc8b6d");
	$('#color_'+aid).css("color","#bf2764");
	
}



</script>


</body>
</html>