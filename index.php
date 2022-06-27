<?
include 'management/include/functions.php';
if($_REQUEST['logout'] == 'yes')
{
	$set->logout_user();
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
	<link href="<?=$site_url?>/css/media.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font2.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font3.css" rel="stylesheet">
	<link rel="shortcut icon" href="<?=$site_url?>/upload/comman/<?=$get->get_favicon()?>" type="image/x-icon" />

	
	<!--slider css-->
	<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/slider-pro.min.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/examples.css" media="screen"/>
	
	<!-- Owl Carousel Assets -->
    <link href="<?=$site_url?>/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?=$site_url?>/owl-carousel/owl.theme.css" rel="stylesheet">
	<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'> -->

</head>


<body class="body-bg">

<!--header start here-->
   <? include 'inc/header.php'; ?>
<!--header end here-->


<?
//session_destroy();
?>

<section class="slider-section">
	<div class="categories">
		<ul>
		<?
		$cat_sql = mysql_query("SELECT * FROM category WHERE parent_id = 0 AND status = 'active' order by orderno ASC LIMIT 7");
		while($res_cat = mysql_fetch_array($cat_sql)){?>
			<li><a href="<?=$site_url?>/listing/c-<?=$res_cat['category_id']?>/<?=$res_cat['category_name']?>"><?=$res_cat['category_name']?></a></li>
		<? } ?>
		</ul>
		<a href="<?=$site_url?>/all-cat.php" class="view-more">View All</a>
	</div>
	<div class="slider">
		<div id="example1" class="slider-pro">
			<div class="sp-slides">
			
			<?
			$slider = mysql_query("SELECT * FROM slider WHERE status = 'active' ");
			while($res = mysql_fetch_array($slider)){?>
				<div class="sp-slide">
					<a href="<?=$res['slider_url']?>" target="_BLANK"><img class="sp-image" data-src="<?=$site_url?>/upload/slider/<?=$res['slider_img']?>"/></a>
				</div>
			<? } ?>
				
			</div>

			<div class="sp-thumbnails">
				<?
				$slider_text = mysql_query("SELECT slider_txt_top FROM slider WHERE status = 'active' ");
				while($res_text = mysql_fetch_array($slider_text)){?>
				<div class="sp-thumbnail">
					<div class="sp-thumbnail-title"><?=$res_text['slider_txt_top']?></div>
				</div>
				<? } ?>
			</div>
		</div>
	</div>
	
	<div class="slider-left-banners">
		<div class="banner-top">
		    <?
			$imgup1 = $get->get_ads('top','home','1');
			$adurl1 = $get->get_ads_url('top','home','1');
			?>
			<a href="<?=$adurl1?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$imgup1?>"></a>
		</div>
		<div class="banner-left">
		     <?
			 $imgup2 = $get->get_ads('top','home','2');
			 $adurl2 = $get->get_ads_url('top','home','2');
			 ?>
			<a href="<?=$adurl2?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$imgup2?>"></a>
		</div>
		<div class="banner-right">
		     <?
			 $imgup3 = $get->get_ads('top','home','3');
			 $adurl3 = $get->get_ads_url('top','home','3');
			 
			 ?>
			<a href="<?=$adurl3?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$imgup3?>"></a>
		</div>
	</div>
	
	
</section>

<!--products section start here-->

<section class="all-products">
	<div class="container">
		<div class="cat-products">
			<div id="tabs-container">
				<ul class="tabs-menu">
					<li class="current"><a href="#tab-1">Spotlight</a></li>
					<li><a href="#tab-2">Daily Deals</a></li>
					<li><a href="#tab-3">Vandy's Special</a></li>
				</ul>
				<div class="tab">
					<div id="tab-1" class="tab-content">
						<ul id="owl-example">
						<?
						$sql_product = mysql_query("SELECT * FROM  product WHERE best_sales LIKE '%BS%' AND status = 'active' ORDER BY id DESC");
						while($sql_result = mysql_fetch_array($sql_product)){
							
							$seo_name = $get->seo_friendly_url($sql_result['product_name']);
							$url = $site_url.'/detail/pid-'.$sql_result['prod_id'].'/'.$seo_name;
							?>
							<li><a href="<?=$url?>">
								<div class="box">
									<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$sql_result['prod_id']."'  ORDER BY rand() LIMIT 1");
									while($res_image = mysql_fetch_array($prod_image))
									{
									?>
										<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
									} 
									?>
									</div>
									<div class="box-content">
										<h4>
										<?
										if(strlen($sql_result['product_name']) > 23)
										{ 
											echo substr($sql_result['product_name'],0,23).'...';
										}else{
											echo $sql_result['product_name'];
										}?>
										</h4>
										<p><span class="price">Rs <?=$sql_result['prodcut_discount_rate']?></span><del>Rs <?=$sql_result['product_rate']?></del></p>
									</div>
									<?
									$getrs = $sql_result['product_rate']-$sql_result['prodcut_discount_rate'];
									$getoff = ($getrs/$sql_result['product_rate'])*100;?>
									<span class="off"><?=round($getoff,2)?>% off</span>
								</div>
								</a>
							</li>
						<? } ?>
						</ul>
					</div>
					<div id="tab-2" class="tab-content">
						<ul id="owl-example2">
						<?
						$sql_product = mysql_query("SELECT * FROM  product WHERE best_sales LIKE '%PP%' AND status = 'active' ORDER BY id DESC");
						while($sql_result = mysql_fetch_array($sql_product)){
							
							$seo_name1 = $get->seo_friendly_url($sql_result['product_name']);
							$url = $site_url.'/detail/pid-'.$sql_result['prod_id'].'/'.$seo_name1;
							?>
							<li><a href="<?=$url?>">
								<div class="box">
									<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$sql_result['prod_id']."'  ORDER BY rand() LIMIT 1");
									while($res_image = mysql_fetch_array($prod_image))
									{
									?>
										<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
									} 
									?>
									</div>
									<div class="box-content">
										<h4>
										<?
										if(strlen($sql_result['product_name']) > 23)
										{ 
											echo substr($sql_result['product_name'],0,23).'...';
										}else{
											echo $sql_result['product_name'];
										}?>
										</h4>
										<p><span class="price">Rs <?=$sql_result['prodcut_discount_rate']?></span><del>Rs <?=$sql_result['product_rate']?></del></p>
									</div>
									<?
									$getrs = $sql_result['product_rate']-$sql_result['prodcut_discount_rate'];
									$getoff = ($getrs/$sql_result['product_rate'])*100;?>
									<span class="off"><?=round($getoff,2)?>% off</span>
								</div></a>
							</li>
						<? } ?>
						</ul>					
					</div>
					<div id="tab-3" class="tab-content">
						<ul id="owl-example3">
						<?
						$sql_product = mysql_query("SELECT * FROM  product WHERE best_sales LIKE '%VPC%' AND status = 'active' ORDER BY id DESC");
						while($sql_result = mysql_fetch_array($sql_product)){
							
							$seo_name2 = $get->seo_friendly_url($sql_result['product_name']);
							$url = $site_url.'/detail/pid-'.$sql_result['prod_id'].'/'.$seo_name2;
							?>
							<li><a href="<?=$url?>">
								<div class="box">
									<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$sql_result['prod_id']."'  ORDER BY rand() LIMIT 1");
									while($res_image = mysql_fetch_array($prod_image))
									{
									?>
										<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
									} 
									?>
									</div>
									<div class="box-content">
										<h4>
										<?
										if(strlen($sql_result['product_name']) > 23)
										{ 
											echo substr($sql_result['product_name'],0,23).'...';
										}else{
											echo $sql_result['product_name'];
										}?>
										</h4>
										<p><span class="price">Rs <?=$sql_result['prodcut_discount_rate']?></span><del>Rs <?=$sql_result['product_rate']?></del></p>
									</div>
									<?
									$getrs = $sql_result['product_rate']-$sql_result['prodcut_discount_rate'];
									$getoff = ($getrs/$sql_result['product_rate'])*100;?>
									<span class="off"><?=round($getoff,2)?>% off</span>
								</div></a>
							</li>
						<? } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<!--computer service-->
		
		<div class="computer-service">
			<div class="container">
				<div class="sec1">
				    <?
$img1 = $get->get_ads('bottom','home','1');
$you_url1 = $get->get_ads_url('bottom','home','1');
?>
<iframe width="335" height="385" src="<?=$you_url1?>" frameborder="0" allowfullscreen></iframe>
					<!--<a href="#"><img src="<?=$site_url?>/upload/ads/<?=$img1?>"></a>-->
				</div>
				<div class="sec2">
					<ul>
						<?
						$img2 = $get->get_ads('bottom','home','2');
						$imgadurl2 = $get->get_ads_url('bottom','home','2');
						
						$img3 = $get->get_ads('bottom','home','3');
						$imgadurl3 = $get->get_ads_url('bottom','home','3');
						
						$img4 = $get->get_ads('bottom','home','4');
						$imgadurl4 = $get->get_ads_url('bottom','home','4');
						
						?>
						
						<li><a href="<?=$imgadurl2?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$img2?>"></a></li>
						<li><a href="<?=$imgadurl3?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$img3?>"></a></li>
						<li><a href="<?=$imgadurl4?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$img4?>"></a></li>
					</ul>
				</div>
				
				<div class="sec3">
				    <?
					$img5 = $get->get_ads('bottom','home','5');
					$imgadurl5 = $get->get_ads_url('bottom','home','5');
					?>
					<a href="<?=$imgadurl5?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$img5?>"></a>
				</div>
				
				<div class="sec4">
				    <?
					$img6 = $get->get_ads('bottom','home','6');
					$imgadurl6 = $get->get_ads_url('bottom','home','6');
					
					?>
					<iframe width="335" height="385" src="<?=$imgadurl6?>" frameborder="0" allowfullscreen></iframe>
					<!--<a href="<?=$imgadurl6?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$img6?>"></a>-->
				</div>
				<div class="sec5">
					<ul>
					    <?
						$img7 = $get->get_ads('bottom','home','7');
						$imgadurl7 = $get->get_ads_url('bottom','home','7');
						
						$img8 = $get->get_ads('bottom','home','8');
					    $imgadurl8 = $get->get_ads_url('bottom','home','8');
					
					    $img9 = $get->get_ads('bottom','home','9');
						$imgadurl9 = $get->get_ads_url('bottom','home','9');
						
						?>
						<li><a href="<?=$imgadurl7?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$img7?>"></a></li>
						<li><a href="<?=$imgadurl8?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$img8?>"></a></li>
						<li><a href="<?=$imgadurl9?>" target="_BLANK"><img src="<?=$site_url?>/upload/ads/<?=$img9?>"></a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<!--computer service-->
		
		<!-- Category Menu Home Page Products -->
		
		<?php 
		$home_page_cat_sql = "SELECT * FROM category WHERE category_home = 'yes' order by orderno ASC";
		$home_page_cat_query = mysql_query($home_page_cat_sql) or die(mysql_error());
		$display_num = mysql_num_rows($home_page_cat_query);
		if($display_num>0){
			$ssn=1;
		while($display_record = mysql_fetch_object($home_page_cat_query)){
		?>	
		
		<div class="mobile">
			<div class="container">
				<div class="mobile-cat">
				    <?
					$display_cat_id = $display_record->category_id;
					
					
					$mobile = mysql_query("SELECT * FROM category WHERE category_id = '$display_cat_id' ");
					$res_mobile = mysql_fetch_array($mobile);?>
					<h3><a style="color:#fff" href="<?=$site_url?>/listing/c-<?=$res_mobile['category_id']?>/<?=$res_mobile['category_name']?>"><?=$res_mobile['category_name']?></a></h3>
					<ul>
						<?
						$mobile_cat = mysql_query("SELECT * FROM category WHERE parent_id = '$display_cat_id' ORDER By rand() LIMIT 9");
						while($res_mobile_cat = mysql_fetch_array($mobile_cat)){
						?>
						<li><a href="<?=$site_url?>/listing/c-<?=$res_mobile_cat['category_id']?>/<?=$res_mobile_cat['category_name']?>"><?=$res_mobile_cat['category_name']?></a></li>
						<? } ?>
					</ul>
				</div>
				
				<div class="mobile-products">
					<ul class="owlexamplecommon">
					<?
					//$mobile = mysql_query("SELECT * FROM product WHERE subcat_id = '$display_cat_id' AND status = 'active' ");
					$mobile = mysql_query("SELECT * FROM product WHERE cat_id = '$display_cat_id' AND status = 'active' ");

					//$mobile = mysql_query("SELECT * FROM product WHERE status = 'active'");


					while($res_mobile = mysql_fetch_array($mobile)){
						
						$seo_name3 = $get->seo_friendly_url($res_mobile['product_name']);
						$url = $site_url.'/detail/pid-'.$res_mobile['prod_id'].'/'.$seo_name3;
						?>
						<li><a href="<?=$url?>">
							<div class="box">
								<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_mobile['prod_id']."'  ORDER BY rand() LIMIT 1");
									while($res_image = mysql_fetch_array($prod_image))
									{
									?>
										<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
									} 
									?>
									</div>
								<div class="box-content">
										<h4>
										<?
										if(strlen($res_mobile['product_name']) > 23)
										{ 
											echo substr($res_mobile['product_name'],0,23).'...';
										}else{
											echo $res_mobile['product_name'];
										}?>
										</h4>
										<p><span class="price">Rs <?=$res_mobile['prodcut_discount_rate']?></span><del>Rs <?=$res_mobile['product_rate']?></del></p>
								</div>
								<?
								$getrs = $res_mobile['product_rate']-$res_mobile['prodcut_discount_rate'];
								$getoff = ($getrs/$res_mobile['product_rate'])*100;?>
								<span class="off"><?=round($getoff,2)?>% off</span>
							</div></a>
						</li>
					<? } ?>	
					</ul>
				</div>
				
				
				
			</div>
		</div>
		
		<?php } } ?>
		
		
		
		
		
		
		
		<!-- END Category Menu Home Page Products -->
		
		
		
		<!--mobile products start-->
		<!--<div class="mobile">
			<div class="container">
				<div class="mobile-cat">
				    <?
					$mobile = mysql_query("SELECT * FROM category WHERE category_id = '32329' ");
					$res_mobile = mysql_fetch_array($mobile);?>
					<h3><a style="color:#fff" href="<?=$site_url?>/listing/c-<?=$res_mobile['category_id']?>/<?=$res_mobile['category_name']?>"><?=$res_mobile['category_name']?></a></h3>
					<ul>
						<?
						$mobile_cat = mysql_query("SELECT * FROM category WHERE parent_id = '32329' ORDER By rand() LIMIT 6");
						while($res_mobile_cat = mysql_fetch_array($mobile_cat)){
						?>
						<li><a href="<?=$site_url?>/listing/c-<?=$res_mobile_cat['category_id']?>/<?=$res_mobile_cat['category_name']?>"><?=$res_mobile_cat['category_name']?></a></li>
						<? } ?>
					</ul>
				</div>
				
				<div class="mobile-products">
					<ul id="owl-example4">
					<?
					$mobile = mysql_query("SELECT * FROM product WHERE subcat_id = '32329' AND status = 'active' ");
					while($res_mobile = mysql_fetch_array($mobile)){
						
						$seo_name3 = $get->seo_friendly_url($res_mobile['product_name']);
						$url = $site_url.'/detail/pid-'.$res_mobile['prod_id'].'/'.$seo_name3;
						?>
						<li><a href="<?=$url?>">
							<div class="box">
								<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_mobile['prod_id']."'  ORDER BY rand() LIMIT 1");
									while($res_image = mysql_fetch_array($prod_image))
									{
									?>
										<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
									} 
									?>
									</div>
								<div class="box-content">
										<h4>
										<?
										if(strlen($res_mobile['product_name']) > 23)
										{ 
											echo substr($res_mobile['product_name'],0,23).'...';
										}else{
											echo $res_mobile['product_name'];
										}?>
										</h4>
										<p><span class="price">Rs <?=$res_mobile['prodcut_discount_rate']?></span><del>Rs <?=$res_mobile['product_rate']?></del></p>
								</div>
								<?
								$getrs = $res_mobile['product_rate']-$res_mobile['prodcut_discount_rate'];
								$getoff = ($getrs/$res_mobile['product_rate'])*100;?>
								<span class="off"><?=round($getoff,2)?>% off</span>
							</div></a>
						</li>
					<? } ?>	
					</ul>
				</div>
				
			</div>
		</div>-->
		<!--mobile products end-->
		
		<!--computer products start-->
		<!--<div class="computer">
			<div class="container">
				<div class="computer-cat">
				    <?
					$computer = mysql_query("SELECT * FROM category WHERE category_id = '2637' ");
					$res_computer = mysql_fetch_array($computer);?>
					<h3><a style="color:#fff" href="<?=$site_url?>/listing/c-<?=$res_computer['category_id']?>/<?=$res_computer['category_name']?>"><?=$res_computer['category_name']?></a></h3>
					
					<ul>
						<?
						$computer_cat = mysql_query("SELECT * FROM category WHERE parent_id = '2637' ORDER By rand() LIMIT 6");
						while($res_computer_cat = mysql_fetch_array($computer_cat)){
						?>
						<li><a href="<?=$site_url?>/listing/c-<?=$res_computer_cat['category_id']?>/<?=$res_computer_cat['category_name']?>"><?=$res_computer_cat['category_name']?></a></li>
						<? } ?>
					</ul>
				</div>
				
				<div class="computer-products">
					<ul id="owl-example5">
					<?
					$computer_cat = mysql_query("SELECT * FROM product WHERE subcat_id = '2637' AND status = 'active' ");
					while($res_computer_cat = mysql_fetch_array($computer_cat)){
						
						$seo_name4 = $get->seo_friendly_url($res_computer_cat['product_name']);
						$url = $site_url.'/detail/pid-'.$res_computer_cat['prod_id'].'/'.$seo_name4;
						?>
						<li><a href="<?=$url?>">
							<div class="box">
								<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_computer_cat['prod_id']."'  ORDER BY rand() LIMIT 1");
									while($res_image = mysql_fetch_array($prod_image))
									{
									?>
										<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
									} 
									?>
									</div>
								<div class="box-content">
										<h4>
										<?
										if(strlen($res_computer_cat['product_name']) > 23)
										{ 
											echo substr($res_computer_cat['product_name'],0,23).'...';
										}else{
											echo $res_computer_cat['product_name'];
										}?>
										</h4>
										<p><span class="price">Rs <?=$res_computer_cat['prodcut_discount_rate']?></span><del>Rs <?=$res_computer_cat['product_rate']?></del></p>
								</div>
								<?
								$getrs = $res_computer_cat['product_rate']-$res_computer_cat['prodcut_discount_rate'];
								$getoff = ($getrs/$res_computer_cat['product_rate'])*100;?>
								<span class="off"><?=round($getoff,2)?>% off</span>
							</div></a>
						</li>
					<? } ?>	
					</ul>
				</div>
				
			</div>
		</div>-->
		<!--computer products end-->
		
		<!--appliance products start-->
		<!--<div class="appliance">
			<div class="container">
				<div class="appliance-cat">
				    <?
					$Applince = mysql_query("SELECT * FROM category WHERE category_id = '18891' ");
					$res_Applince = mysql_fetch_array($Applince);?>
					<h3><a style="color:#fff" href="<?=$site_url?>/listing/c-<?=$res_Applince['category_id']?>/<?=$res_Applince['category_name']?>"><?=$res_Applince['category_name']?></a></h3>
					<ul>
						<?
						$Applince_cat = mysql_query("SELECT * FROM category WHERE parent_id = '18891' ORDER By rand() LIMIT 6");
						while($res_Applince_cat = mysql_fetch_array($Applince_cat)){
						?>
						<li><a href="<?=$site_url?>/listing/c-<?=$res_Applince_cat['category_id']?>/<?=$res_Applince_cat['category_name']?>"><?=$res_Applince_cat['category_name']?></a></li>
						<? } ?>
					</ul>
				</div>
				
				<div class="appliance-products">
					<ul id="owl-example6">
					<?
					$Applince_cat = mysql_query("SELECT * FROM product WHERE subcat_id = '18891' AND status = 'active' ");
					while($res_Applince_cat = mysql_fetch_array($Applince_cat)){
						
						$seo_name5 = $get->seo_friendly_url($res_Applince_cat['product_name']);
						$url = $site_url.'/detail/pid-'.$res_Applince_cat['prod_id'].'/'.$seo_name5;
						?>
						<li><a href="<?=$url?>">
							<div class="box">
								<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_Applince_cat['prod_id']."'  ORDER BY rand() LIMIT 1");
									while($res_image = mysql_fetch_array($prod_image))
									{
									?>
										<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
									} 
									?>
									</div>
								<div class="box-content">
										<h4>
										<?
										if(strlen($res_Applince_cat['product_name']) > 23)
										{ 
											echo substr($res_Applince_cat['product_name'],0,23).'...';
										}else{
											echo $res_Applince_cat['product_name'];
										}?>
										</h4>
										<p><span class="price">Rs <?=$res_Applince_cat['prodcut_discount_rate']?></span><del>Rs <?=$res_Applince_cat['product_rate']?></del></p>
								</div>
								<?
								$getrs = $res_Applince_cat['product_rate']-$res_Applince_cat['prodcut_discount_rate'];
								$getoff = ($getrs/$res_Applince_cat['product_rate'])*100;?>
								<span class="off"><?=round($getoff,2)?>% off</span>
							</div></a>
						</li>
					<? } ?>	
					</ul>
				</div>
				
			</div>
		</div>-->
		<!--appliance products end-->
		
		<!--appliance products start-->
		<!--<div class="toys">
			<div class="container">
				<div class="toys-cat">
				     <?
				    $Toys = mysql_query("SELECT * FROM category WHERE category_id = '17657' ");
					$res_Toys = mysql_fetch_array($Toys);?>
					<h3><a style="color:#fff" href="<?=$site_url?>/listing/c-<?=$res_Toys['category_id']?>/<?=$res_Toys['category_name']?>"><?=$res_Toys['category_name']?></a></h3>
					
					<ul>
						<?
						$Toys_cat = mysql_query("SELECT * FROM category WHERE parent_id = '17657' ORDER By rand() LIMIT 6");
						while($res_Toys_cat = mysql_fetch_array($Toys_cat)){
						?>
						<li><a  href="<?=$site_url?>/listing/c-<?=$res_Toys_cat['category_id']?>/<?=$res_Toys_cat['category_name']?>"><?=$res_Toys_cat['category_name']?></a></li>
						<? } ?>
					</ul>
				</div>
				
				<div class="toys-products">
					<ul id="owl-example7">
					<?
					$toys_cat = mysql_query("SELECT * FROM product WHERE subcat_id = '17657' AND status = 'active' ");
					while($res_toys_cat = mysql_fetch_array($toys_cat)){
						
						$seo_name6 = $get->seo_friendly_url($res_toys_cat['product_name']);
						$url = $site_url.'/detail/pid-'.$res_toys_cat['prod_id'].'/'.$seo_name6;
						?>
						<li><a href="<?=$url?>">
							<div class="box">
								<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_toys_cat['prod_id']."'  ORDER BY rand() LIMIT 1");
									while($res_image = mysql_fetch_array($prod_image))
									{
									?>
										<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
									} 
									?>
									</div>
								<div class="box-content">
										<h4>
										<?
										if(strlen($res_toys_cat['product_name']) > 23)
										{ 
											echo substr($res_toys_cat['product_name'],0,23).'...';
										}else{
											echo $res_toys_cat['product_name'];
										}?>
										</h4>
										<p><span class="price">Rs <?=$res_toys_cat['prodcut_discount_rate']?></span><del>Rs <?=$res_toys_cat['product_rate']?></del></p>
								</div>
								<?
								$getrs = $res_toys_cat['product_rate']-$res_toys_cat['prodcut_discount_rate'];
								$getoff = ($getrs/$res_toys_cat['product_rate'])*100;?>
								<span class="off"><?=round($getoff,2)?>% off</span>
							</div>
						</li></a>
					<? } ?>	
					</ul>
				</div>
				
			</div>
		</div>-->
		<!--toys products end-->
		
		<!--history and recommended products start-->
		<div class="other-products">
			<div class="container">
				<div class="recent" id="recent">
					<h3>Latest Products</h3>
					<ul>
					    <?
			$Latest_Products = mysql_query("SELECT * FROM product WHERE best_sales LIKE '%LL%' AND status = 'active' ORDER BY rand() LIMIT 2");
						while($res_Latest_Products = mysql_fetch_array($Latest_Products)){
							
							$seo_name7 = $get->seo_friendly_url($res_Latest_Products['product_name']);
						    $url = $site_url.'/detail/pid-'.$res_Latest_Products['prod_id'].'/'.$seo_name7;
							?>
						<li><a href="<?=$url?>">
							<div class="sec1">
								<?
								$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_Latest_Products['prod_id']."'  ORDER BY rand() LIMIT 1");
								while($res_image = mysql_fetch_array($prod_image))
								{
									?>
									<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
								} 
								?>
							</div>
							<div class="sec2">
								<p class="p-name">
								<?
								if(strlen($res_Latest_Products['product_name']) > 15)
								{ 
								echo substr($res_Latest_Products['product_name'],0,15).'.';
								}else{
								echo $res_Latest_Products['product_name'];
								}?>
								</p>
								<p><span class="price">Rs <?=$res_Latest_Products['prodcut_discount_rate']?></span><del>Rs <?=$res_Latest_Products['product_rate']?></del></p>
							</div></a>
						</li>
						<? }?>
					</ul>
				</div>
				
				<div class="recommended" id="new_arrival">
					<h3>Discount Offers</h3>
					<ul id="owl-example8">
						<?
						$Discount_Offers = mysql_query("SELECT * FROM product WHERE best_sales LIKE '%DO%' AND status = 'active' ");
						while($res_Discount_Offers = mysql_fetch_array($Discount_Offers)){
							
							$seo_name8 = $get->seo_friendly_url($res_Discount_Offers['product_name']);
						    $url = $site_url.'/detail/pid-'.$res_Discount_Offers['prod_id'].'/'.$seo_name8;
							?>
						<li><a href="<?=$url?>">
							<div class="box">
								<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_Discount_Offers['prod_id']."'  ORDER BY rand() LIMIT 1");
									while($res_image = mysql_fetch_array($prod_image))
									{
									?>
										<img src="<?=$site_url?>/upload/product/thumb/th_<?=$res_image['product_img']?>">
									<? 
									} 
									?>
								</div>
								<div class="box-content">
										<h4>
										<?
										if(strlen($res_Discount_Offers['product_name']) > 23)
										{ 
											echo substr($res_Discount_Offers['product_name'],0,23).'...';
										}else{
											echo $res_Discount_Offers['product_name'];
										}?>
										</h4>
										<p><span class="price">Rs <?=$res_Discount_Offers['prodcut_discount_rate']?></span><del>Rs <?=$res_Discount_Offers['product_rate']?></del></p>
								</div>
								<?
								$getrs = $res_Discount_Offers['product_rate']-$res_Discount_Offers['prodcut_discount_rate'];
								$getoff = ($getrs/$res_Discount_Offers['product_rate'])*100;?>
								<span class="off"><?=round($getoff,2)?>% off</span>
							</div></a>
						</li>
					<? } ?>	
					</ul>
				</div>
				
			</div>
		</div>
		<!--history and recommended products end-->
	</div>
</section>


<!--footer start here-->
   <? include 'inc/footer.php'; ?>
   
<!--footer end here-->
<script src="<?=$site_url?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$site_url?>/js/jquery.sliderPro.min.js"></script>
<script src="<?=$site_url?>/js/globle.js"></script>
<script type="text/javascript">
	$( document ).ready(function( $ ) {
		$( '#example1' ).sliderPro({
             width: 960,
			height: 500,
			arrows: true,
			buttons: false,
			waitForLayers: true,
			fade: true,
			thumbnailWidth: 170,
			thumbnailHeight: 100,
			thumbnailPointer: true,
			autoplay: true,
			autoScaleLayers: true,
			breakpoints: {
				500: {
					thumbnailWidth: 120,
					thumbnailHeight: 50
				}
			}
		});
	});
</script>
<script>
	$(document).ready(function(){
		$(".tab-heading li").click(function(){
			$(".tab-heading li").removeClass('current');
			$(this).addClass('current');
		});
	});
</script>
  <!-- Include js plugin -->
	<script src="<?=$site_url?>/owl-carousel/owl.carousel.js"></script>
	<script>
	$(document).ready(function(){
		$("#owl-example").owlCarousel({
			items:5,
			navigation:true,
			autoPlay:true,
			pagination:false,
			navigationText: ["<img src='<?=$site_url?>/img/icon/arrow-left.png'>","<img src='<?=$site_url?>/img/icon/arrow-right.png'>"]
		});
		$("#owl-example2").owlCarousel({
			items:5,
			navigation:true,
			pagination:false,
			autoPlay:true,
			navigationText: ["<img src='<?=$site_url?>/img/icon/arrow-left.png'>","<img src='<?=$site_url?>/img/icon/arrow-right.png'>"]
		});
		$("#owl-example3").owlCarousel({
			items:5,
			navigation:true,
			autoPlay:true,
			pagination:false,
			navigationText: ["<img src='<?=$site_url?>/img/icon/arrow-left.png'>","<img src='<?=$site_url?>/img/icon/arrow-right.png'>"]
		});
		$("#owl-example4").owlCarousel({
			items:4,
			navigation:true,
			autoPlay:true,
			pagination:false,
			navigationText: ["<img src='<?=$site_url?>/img/icon/arrow-left.png'>","<img src='<?=$site_url?>/img/icon/arrow-right.png'>"]
		});
		$("#owl-example5").owlCarousel({
			items:4,
			navigation:true,
			autoPlay:true,
			pagination:false,
			navigationText: ["<img src='<?=$site_url?>/img/icon/arrow-left.png'>","<img src='<?=$site_url?>/img/icon/arrow-right.png'>"]
		});
		$("#owl-example6").owlCarousel({
			items:4,
			navigation:true,
			autoPlay:true,
			pagination:false,
			navigationText: ["<img src='<?=$site_url?>/img/icon/arrow-left.png'>","<img src='<?=$site_url?>/img/icon/arrow-right.png'>"]
		});
		$("#owl-example7").owlCarousel({
			items:4,
			navigation:true,
			autoPlay:true,
			pagination:false,
			navigationText: ["<img src='<?=$site_url?>/img/icon/arrow-left.png'>","<img src='<?=$site_url?>/img/icon/arrow-right.png'>"]
		});
		$("#owl-example8").owlCarousel({
			items:4,
			navigation:true,
			autoPlay:true,
			pagination:false,
			navigationText: ["<img src='<?=$site_url?>/img/icon/arrow-left.png'>","<img src='<?=$site_url?>/img/icon/arrow-right.png'>"]
		});



$(".owlexamplecommon").owlCarousel({
			items:4,
			navigation:true,
			autoPlay:true,
			pagination:false,
			navigationText: ["<img src='<?=$site_url?>/img/icon/arrow-left.png'>","<img src='<?=$site_url?>/img/icon/arrow-right.png'>"]
		});


		
	})
	</script>
	
	<script>
		$(document).ready(function() {
			$(".tabs-menu a").click(function(event) {
				event.preventDefault();
				$(this).parent().addClass("current");
				$(this).parent().siblings().removeClass("current");
				var tab = $(this).attr("href");
				$(".tab-content").not(tab).css("display", "none");
				$(tab).fadeIn();
			});
		});
	</script>

	<script>
	//jQuery('a[href^="#"]').click(function(e) {
     //   jQuery('html,body').animate({ scrollTop: jQuery(this.hash).offset().top}, 500);
       //return false;
	//e.preventDefault();

	});
</script>

<script>
   $(document).ready(function(){
      	   if ( $(window).width() < 550) {
			  $(".category-h").click(function(){
				$(".categories").slideToggle();
			  });
		   } });
</script>
</body>
</html>