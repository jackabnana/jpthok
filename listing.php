<?
include 'management/include/functions.php';
extract($_REQUEST);

	$bid = explode("/",$id);
	$split_id = $bid[0];
	$split_name = $bid[1];
	$check_split_id = explode("-",$split_id);
	$nowaction = $check_split_id[0];
	$nowid = $check_split_id[1];
	
	
	$sql = " SELECT * from  product as P 
	JOIN category as C ON P.cat_id = C.category_id ";
	
	$sql .= " WHERE P.status = 'active' ";
	

	if($q !=''){
		$category = $get->get_search_categorys($q);
		if(!empty($category)){
			foreach($category as $cat):
			$sql_where .= " AND FIND_IN_SET($cat,P.cat_id) or FIND_IN_SET($cat,P.subcat_id) or FIND_IN_SET($cat,P.sub_subcat_id) or P.product_name like '$q%' ";
			endforeach;
		} else {
			$sql_where .= " AND P.product_name like '$q%'";
		}
	}
	
	if($nowaction == 'c' & $nowid !=''){
		$sql_where .= " and (FIND_IN_SET($nowid,P.cat_id) OR  FIND_IN_SET($nowid,P.subcat_id) OR FIND_IN_SET($nowid,P.sub_subcat_id) ) ";	
		
		$get_cat_banner = $get->get_category_banner($nowid);
	}
	
	//if($nowaction == 's' & $nowid !=''){
		//$sql_where .= " and FIND_IN_SET($nowid,P.subcat_id) ";	
	//}
	
	//if($nowaction == 'sc' & $nowid !=''){
		//$sql_where .= " and FIND_IN_SET($nowid,P.sub_subcat_id) ";	
	//}
	
	if($attribute !=''){
		$ab=1;
		$ba=sizeof($attribute);
		foreach($attribute as $attri){
			if($ab == 1) { $sql_where .= ' AND ('; } else { $sql_where .= ' OR '; }
			$sql_where .= " PA.attribute_option_id='$attri'";
			if($ba==$ab) { $sql_where .= ')'; }
			$ab++;
		}
	}
	
	$sql_group = " GROUP BY P.prod_id ";
	$sql_order = " ORDER BY P.product_rate ASC ";
	$query = $sql.$sql_where.$sql_group.$sql_order;
	
	
	$query = $sql.$sql_where.$sql_order;
	$amount_query = $sql.$sql_where.$sql_group;
	$getproduct = mysql_query($query);
	
	$getfilter = mysql_query($query);
	$getfilter_size = mysql_query($query);
	//$getfilter_color = mysql_query($query);
	
	$count = mysql_num_rows($getproduct);
	
	//if($q !=''){
		//$set->search_terms($q,$count);
	//}
	
	$min =  $get->get_min($amount_query);
    $max =  $get->get_max($amount_query);
	
//if($q!='' && $count<1)
//{
	//echo "<script>document.location.href='index.html'</script>";
//}

?>
<!DOCTYPE html>
<html>
<head>
	<title>online Vandy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?=$site_url?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/main.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/reset.css" rel="stylesheet">
	<link href="<?=$site_url?>/css/media.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font2.css" rel="stylesheet">
	<link href="<?=$site_url?>/font/font3.css" rel="stylesheet">
	
	<!--slider css-->
	<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/slider-pro.min.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/examples.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/jquery-ui.css" media="screen"/>
	
	<!-- Owl Carousel Assets -->
    <link href="<?=$site_url?>/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?=$site_url?>/owl-carousel/owl.theme.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?=$site_url?>/css/website.css" type="text/css" media="screen"/>

</head>


<body>

<!--header start here-->
   <? include 'inc/header.php'; ?>
<!--header end here-->


<div class="main-heading">
	<div class="container">
		<h2><?=ucfirst($get->get_category_name_by_id($nowid))?></h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="<?=$site_url?>">Home</a></li>
			<?
			$parent_id = $get->get_parent_category_id_by_id($nowid);
			$super_parent_id = $get->get_parent_category_id_by_id($parent_id);
			
			if($super_parent_id >0)
			{ 
		        $super_parent_name = $get->seo_friendly_url($get->get_category_name_by_id($super_parent_id));
				?>
				<li>
				<a href="<?=$site_url?>/listing/c-<?=$super_parent_id?>/<?=$super_parent_name?>"><?=ucfirst($get->get_category_name_by_id($super_parent_id))?></a>
				</li>
				<?
			}
			
			if($parent_id >0)
			{ 
		        $parent_name = $get->seo_friendly_url($get->get_category_name_by_id($parent_id));
		        ?>
				<li>
				<a href="<?=$site_url?>/listing/c-<?=$parent_id?>/<?=$parent_name?>"><?=ucfirst($get->get_category_name_by_id($parent_id))?></a>
				</li>
				<?
			}
			?>
			
		    <li><a href="#"><?=ucfirst($get->get_category_name_by_id($nowid))?></a></li>
		</ul>
		</div>
	</div>
</div>


<section class="categories-section">

<div class="filter_loading" id="filter_loading">
	<img src="<?=$site_url?>/img/loading-x.gif"><br>loading...
</div>
	<div class="container">
		<div class="section-left">
		
			
			<form method="post" id="filter-form">
			<input type="hidden" name="nowid" value="<?=$nowid?>">
			<input type="hidden" name="nowaction" value="<?=$nowaction?>">
			
			<div class="brands price">
				<h3>Price</h3>
				<ul class="all-filter" style="height:auto;">
				<div class="filter_box" >
				<div id="slider-range"></div>
				<center>
				<input type="text" value="" id="amount" name="amount"  style="border:none; background:#E9E9E9; color:#505050; margin:0 auto;"></center>
				</div>
				</ul>
				<p class="appfilter change-font"><a style="color:#000;" href="javascript:vol();" class="col-md-50 text-center f-13 padding-10px applyfilter" id="filterbtn">Apply Filter</a></p>
			</div>
			
			
			<?
			$main_cat = mysql_query("SELECT * FROM category WHERE category_id = '$nowid' AND status = 'active' ");
			$count_main_cat = mysql_fetch_array($main_cat);
			$pId = $count_main_cat['parent_id'];
			
			$sql_cat = mysql_query("SELECT * FROM category WHERE parent_id = '$nowid' AND status = 'active' ");
			$count_cat = mysql_num_rows($sql_cat);
			
			if($count_cat > 0 && $pId > 0)
			{
				?>
				<div class="brands types">
				<h3>Sub Categories</h3>
				<ul>
				<?
				while($res_cat = mysql_fetch_array($sql_cat))
				{ 
					    ?>
							<li><a href="#0"><input name="category[]" value="<?=$res_cat['category_id']?>" type="checkbox" class="fancy-checkbox"><?=$res_cat['category_name']?></a></li>
						<?
				} 
				?>
				</ul>
				</div>
				<? 
			}
			else if($count_cat > 0)
			{
				while($res_cat = mysql_fetch_array($sql_cat))
				{ 
					?>
					<div class="brands types">
					<h3><a style="color:#fff;" href="<?=$site_url?>/listing/c-<?=$res_cat['category_id']?>/<?=$res_cat['category_name']?>"><?=$res_cat['category_name']?></a></h3>
					<?
					$sql_subcat = mysql_query("SELECT * FROM category WHERE parent_id = '".$res_cat['category_id']."' AND status = 'active' ");
					$count_subcat = mysql_num_rows($sql_subcat);
					if($count_subcat > 0)
					{
						?>
						<div id="scrollbar3">
						<div class="viewport">
						<div class="overview">
						<ul>
						<?
						while($res_subcat = mysql_fetch_array($sql_subcat))
						{ 
							?>
							<li><a href="#0"><input name="category[]" value="<?=$res_subcat['category_id']?>" type="checkbox" class="fancy-checkbox"><?=$res_subcat['category_name']?></a></li>
							<? 
						}
						?>
						</ul>
						</div>
						</div>
						</div>
						<?
					}
					?>
					</div>
					<? 
				} 
			}
			?>
			
			<?
			while($rowpro=mysql_fetch_array($getfilter))
			{	
				extract($rowpro);
				$query ="SELECT * from  product_attribute WHERE prod_id='$prod_id' group by attribute_id ";
				$query = mysql_query($query);
				while($result = mysql_fetch_array($query))
				{
					$attribute_array[] = $result['attribute_id'];	
				}
			}
			$x=1;
			$attribute_array = array_unique($attribute_array);
			
			for($a=0;$a<sizeof($attribute_array);$a++):
			if($get->get_attribute_name($attribute_array[$a]) !='')
			{
				?>
				<div class="brands">
					<h3><?=$get->get_attribute_name($attribute_array[$a])?></h3>
					<div id="scrollbar2">
						<div class="viewport">
							<div class="overview">
								<ul>
								<?
								$query1 = "SELECT PA.*,P.* FROM product_attribute as PA JOIN product as P ON P.prod_id=PA.prod_id WHERE PA.attribute_id='".$attribute_array[$a]."' group by PA.attribute_option_id";
								$query1 = mysql_query($query1);
								$ch=1;
								while($result1 = mysql_fetch_array($query1))
								{
									if($get->get_attribute_option_name($result1['attribute_option_id'])!='')
									{
									?>
										<li><a href="#0"><input type="checkbox" name="attribute[]" id="attribute_<?=$ch?>_<?=$x?>" value="<?=$result1['attribute_option_id']?>" class="fancy-checkbox"><?=$get->get_attribute_option_name($result1['attribute_option_id'])?></a></li>
										
									<? 
								    }
									$ch++;									
								}  
			                    ?>
								</ul>		
							</div>
						</div>
					</div>
				</div>
				<? 
			} 
			$x++;  
			endfor; 
			?>    
			</form>
		</div>
		
		<div class="section-right">
		
			<div class="main-banner">
			
			<? $banner = $get->get_category_banner($nowid);
			
			    if($banner!=''){?>
				<img src="<?=$site_url?>/upload/category/<?=$banner?>">
				<?}else{?>
				<img src="<?=$site_url?>/img/main-banner.jpg">
				<?}?>
			</div>
				
			<div class="banner-right">
				<ul>
				    <?
					$img1 = $get->get_ads('top','listing','1');
					$img2 = $get->get_ads('top','listing','2');
					?>
					<li><a href="#"><img src="<?=$site_url?>/upload/ads/<?=$img1?>"></a></li>
					<li><a href="#"><img src="<?=$site_url?>/upload/ads/<?=$img2?>"></a></li>
				</ul>
			</div>
			
			
			<!--desktop computers listing-->
			<div class="desktop-listing">
				<div class="desktop-listing-products">
					<h3><span><?=ucfirst($get->get_category_name_by_id($nowid))?></span></h3>
					<ul id="owl-example4" class="comman">
					
					    <?
						if($count > 0)
						{ 
					       ?><div class="row" id="filter-div"><?
					
							while($res_product = mysql_fetch_array($getproduct))
							{
								$seo_name = $get->seo_friendly_url($res_product['product_name']);
								$url = $site_url.'/detail/pid-'.$res_product['prod_id'].'/'.$seo_name;
							?>
							<li class="123"><a href="<?=$url?>">
								<div class="box">
									<div class="box-img">
									<?
									$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_product['prod_id']."'  ORDER BY rand() LIMIT 1");
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
										if(strlen($res_product['product_name']) > 23)
										{ 
											echo substr($res_product['product_name'],0,23).'...';
										}else{
											echo $res_product['product_name'];
										}
										?>
										</h4>
										<p><span class="price">Rs <?=$res_product['prodcut_discount_rate']?></span><del>Rs <?=$res_product['product_rate']?></del></p>
									</div>
									<?
									$getrs = $res_product['product_rate']-$res_product['prodcut_discount_rate'];
									$getoff = ($getrs/$res_product['product_rate'])*100;?>
									<span class="off"><?=round($getoff,2)?>% off</span>
								</div></a>
							</li>
							<? 
							}
							?>
							</div>
							<?							
						}
						else
						{
							?>
						    <p style="text-align:center;padding:20px;">No result(s) found.</p>
						    <? 
						} 
						?>
					</ul>
				</div>
			</div>
			<?
			if($count > 0)
			{	
				$cat_info = $get->get_category_information_by_id($nowid);
				if($cat_info!='')
				{	
					?> 
					<div class="information">
						<h3>Information</h3>
						<div class="info-box">
							<div id="scrollbar1">
								<div class="viewport">
									 <div style="top: 0px;" class="overview">
										<?=$cat_info?>			
									</div>
								</div>
							</div>	
						</div>
					</div>
					<? 
				} 
			}?>
			
		</div>
		
	</div>
</section>

<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->
	<script src="<?=$site_url?>/js/jquery.min.js"></script>
	<script src="<?=$site_url?>/js/globle.js"></script>
	<script src="<?=$site_url?>/js/jquery-ui.js"></script>
	<!--<script>
	   $(document).ready(function(){
			   if ( $().width() < 550) {
				  $(".price h3").click(function(){
					$(".all-filter, .appfilter").slideToggle();
				  });
			   } });
    </script>-->
	<script>
	$('#filterbtn').click(
	function(event)
	{
		
		var Data = $("#filter-form").serializeArray();
		console.log(Data);
		$.ajax(
		{
			url: "<?=$site_url?>/filter.php",
			type: "POST",
			data : Data,
			beforeSend: function() {
			// setting a timeout
			$('#filter_loading').show();
			},
			success:function(data, textStatus, jqXHR)
			{
				$("#filter_loading").hide();
				//alert(data);
				//$('#filter-count').html(data);
				var obj = $.parseJSON(data);
				//alert(obj['count_product']);
				
				$('#filter-div').html(obj['search_div']);
				//$('#filter-count').html(obj['count_product']);
			}
		});
			//$("#filter-div").slideDown("slow");
			e.preventDefault();
	}
	);
	
	
$(".fancy-checkbox").change(function(e){
var Data = $("#filter-form").serializeArray();
console.log(Data);
$.ajax(
{
	url: "<?=$site_url?>/filter.php",
	type: "POST",
	data : Data,
	beforeSend: function() {
	// setting a timeout
	$('#filter_loading').show();
	},
	success:function(data, textStatus, jqXHR)
	{
	    //alert(data);
		var obj = $.parseJSON(data);
		$("#filter_loading").hide();
		//$('#filter-div').html(data);
		$('#filter-div').html(obj['search_div']);
		//$('#filter-count').html(obj['count_product']);
			
	}
});
$("#filter-div").slideDown("slow");
e.preventDefault();
});
</script>
<script>
		  $(function() {
			$( "#slider-range" ).slider({
			  range: true,
			  min: <?=$min?>,
			  max: <?=$max?>,
			  values: [ <?=$min?>, <?=$max?> ],
			  slide: function( event, ui ) {
			  $("#amount" ).val( "Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ] );
			  }
			});
			$( "#amount" ).val( "Rs." + $( "#slider-range" ).slider( "values", 0 ) +
			  " - Rs." + $( "#slider-range" ).slider( "values", 1 ) );
		  });
</script>
<script type="text/javascript" src="<?=$site_url?>/js/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript" src="<?=$site_url?>/js/website.js"></script>


</body>
</html>