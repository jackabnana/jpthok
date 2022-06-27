<?
include 'management/include/functions.php';

$bid = explode("/",$_REQUEST['id']);
$split_id = $bid[0];
$split_name = $bid[1];

if(isset($_POST['add_review']) && $_POST['add_review']=='Submit')
{
	
	$review = $set->add_review();	
	if($review == true):
	$msg = " <font style='color:white; font-weight:bold'>Review submit successfully. our review moderators will check and approve.</font> ";
	unset($_POST);
	$page = $page = $site_url."/"."write-review/".$split_id."/";
	echo '<meta http-equiv="refresh" content="3;URL='.$page.'">';
	
	else:
	$msg = " <font style='color:white; font-weight:bold'>Error in review submit. Please try again.</font> ";
	endif;
	
}

//Select Product Details
$sql = " SELECT * FROM product WHERE prod_id='$split_id' ";
$query = mysql_query($sql);
$count = mysql_num_rows($query);
$fetchdetails = mysql_fetch_array($query);
extract($fetchdetails);

?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$get->get_website_name()?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?=$site_url?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/main.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/media.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/reset.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font2.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font3.css" rel="stylesheet">
	<script src="<?=$site_url?>/js/min.js" type="text/javascript" language="javascript"></script>
	<script src="<?=$site_url?>/plugin/star-rate/js/1.js" type="text/javascript" language="javascript"></script>
	<script src="<?=$site_url?>/plugin/star-rate/js/2.js" type="text/javascript" language="javascript"></script>
	<link href="<?=$site_url?>/plugin/star-rate/css/1.css" type="text/css" rel="stylesheet"/>
	<style>
	.mgs-area
	{
	height:40px;
	}
	</style>
	

	  <!----star rate----->
	<link href="plugin/star-rate/css/1.css" type="text/css" rel="stylesheet"/>

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

</head>
<body>
<!--header start here-->
   <? include 'inc/header.php'; ?>
<!--header end here-->

<div class="main-heading">
	<div class="container">
		<h2>Write Review</h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="#">Home</a></li>
			<li>Write Review</li>
		</ul>
		</div>
	</div>
</div>
<section id="write-review">
  <div class="container">
    <div class="review-write">
	
	
	
	    <div class="col-md-25 review-write-left">
		  <h4>You have chosen to review</h4>
		  <div class="review-product-summary">
		    <div class="unit-image">
			<?$url = $get->seo_friendly_url($product_name);?>
			  <a href="<?=$site_url?>/detail/pid-<?=$prod_id?>/<?=$url?>" class="left"><img src="<?=$site_url?>/upload/product/thumb/th_<?=$get->get_single_product_img($prod_id)?>"></a>
			</div>
			 <div class="col-md-100 unit-image-name"><a href="#"><?=$product_name?></a></div>
			<div class="fk-box-white">
			 <h4>What makes a good review</h4>
			 <p>
			   <strong>Have you used this product?</strong><br>
			   It's always better to review a product you have personally experienced.
			 </p>
			 
			 <p>
			   <strong>Educate your readers</strong><br>
			   Provide a relevant, unbiased overview of the product. Readers are interested in the pros and the cons of the product.
			 </p>
			 
			  <p>
			   <strong>Be yourself, be informative</strong><br>
			   Let your personality shine through, but it's equally important to provide facts to back up your opinion.
			 </p>
			 
			 <p>
			   <strong>Get your facts right!</strong><br>
			   Nothing is worse than inaccurate information. If you're not really sure, research always helps.
			 </p>
			 
			 <p>
			   <strong>Stay concise</strong><br>
			   NBe creative but also remember to stay on topic. A catchy title will always get attention!
			 </p>
			 
			 <p>
			   <strong>Easy to read, easy on the eyes</strong><br>
			   A quick edit and spell check will work wonders for your credibility. Also, break reviews into small, digestible paragraphs.
			 </p>
			</div><!--fk-box-white is close--> 
		  </div><!--review-product-summary is close--> 
		</div><!--col-md-25 review-write-left is close--> 
		
		
		
		
		<div class="col-md-75 review-write-right">
		 <h3>Help others! Write a product Name review</h3>
		 <span class="help_message">All fields are mandatory</span>
		 <div class="user-review-form">
		 <div id="review-response-error" class="mgs-area" style="display:none;" ></div>
		 <? if($msg !=''): ?><div id="review-response-error" class="mgs-area"><div class="mgs success col-md-100"><?=$msg?></div></div><? endif; ?>
		    <form action="" name="reviewpage" method="post"> 
			  <ul>
			    <li>
				  <div class="user-review-left">
				    <span class="form-part-number">1</span>
					<span class="form-part-name">Review Title:</span>
				  </div><!--user-review-left is close--> 
				  <div class="user-review-right">
				    <input type="text" name="review_title" id="review_title">
					<p>(Maximum 60 characters.)</p>
 
				  </div><!--user-review-right is close--> 
				  <div class="clear-both"></div>
				</li>
				
				<li>
				  <div class="user-review-left">
				    <span class="form-part-number">2</span>
					<span class="form-part-name">Your Review:</span>
				  </div><!--user-review-left is close--> 
				  <div class="user-review-right">
				     <p class="user-review-input-des">Please do not include: HTML, references to other retailers, pricing, personal information, any profane, 
					 inflammatory or copyrighted comments, or any copied content.
					 </p>
				    <textarea type="textfield" name="review_msg" id="review_msg"></textarea>
					<p>(Maximum 60 characters.)</p>
 
				  </div><!--user-review-right is close--> 
				  <div class="clear-both"></div>
				</li>
				
				<li>
				  <div class="user-review-left">
				    <span class="form-part-number">3</span>
					<span class="form-part-name">Your Rating:</span>
				  </div><!--user-review-left is close--> 
				  <div class="user-review-right">
				    <ul class="rating-star">
					  <li>
					    <input name="review_star" type="radio" required value="1" class="star" checked />
						<input name="review_star" type="radio" required  value="2" class="star"/>
						<input name="review_star" type="radio" required  value="3" class="star"/>
						<input name="review_star" type="radio" required value="4" class="star"/>
						<input name="review_star" type="radio" required value="5" class="star"/>
					  </li>
					</ul>
				    <ul class="clear-both"></ul>
					<p>(Click to rate on scale of 1-5)</p>
				  </div><!--user-review-right is close--> 
				  <div class="clear-both"></div>
				</li>
				<?
					if($_SESSION['websiteuser']==''){
				?>
				<li>
				  <div class="user-review-left">
				    <span class="form-part-number">4</span>
					<span class="form-part-name">Your Name:</span>
				  </div><!--user-review-left is close--> 
				  <div class="user-review-right">
				    <input type="text" name="review_name">
					<p>(Maximum 60 characters.)</p>
 
				  </div><!--user-review-right is close--> 
				  <div class="clear-both"></div>
				</li>
				<? } else {
					?>
					<input type="hidden" name="review_name"  value="<?=$get->get_user_name($_SESSION['websiteuser'])?>">
					<?
				} ?>
				
				<input type="hidden" name="product_id" value="<?=$split_id?>">
				<input type="hidden" name="user_id" value="<?=$_SESSION['websiteuser']?>">
				<input type="hidden" name="review_email" value="<?=$get->get_user_email($_SESSION['websiteuser'])?>">
				<li>
				  <div class="user-review-left">
				  </div><!--user-review-left is close--> 
				  <div class="user-review-right">
				    <input type="submit" value="Submit" name="add_review" id="submit-review">

				  </div><!--user-review-right is close--> 
				  <div class="clear-both"></div>
				</li>
				
			  </ul>
			</form>
			
		 </div><!--user-review-form is close--> 
		</div><!--col-md-75 review-write-right is close--> 
		
		<div class="clear-both"></div>
	 </div>
   </div>
 </section>

<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->
	<script src="<?=$site_url?>/js/jquery.min.js"></script>
	<script src="<?=$site_url?>/js/globle.js"></script>
	<!----star rate----->
	<script src="<?=$site_url?>/plugin/star-rate/js/1.js" type="text/javascript" language="javascript"></script>
	<script src="<?=$site_url?>/plugin/star-rate/js/2.js" type="text/javascript" language="javascript"></script>
</body>
</html>