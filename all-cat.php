<?include 'management/include/functions.php';?>
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
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
<!--header start here-->
   <? include 'inc/header.php'; ?>
<!--header end here-->

<div class="main-heading">
	<div class="container">
		<h2>Categories</h2>
		<div class="breadcrumb">
		<ul>
			<li><a href="<?=$site_url?>">Home</a></li>
			<li>All Categories</li>
		</ul>
		</div>
	</div>
</div>
<section id="all-cat">
  <div class="container">
    <div class="col-md-100 left">
	
	
	<ul class="see-all-catagoreis">
		<? 
		$getctmenu = $get->get_category_menu(); 
		$countcat = mysql_num_rows($getctmenu);
		if($countcat>0)
		{
			while($catrow=mysql_fetch_object($getctmenu))
			{
			?>
				<li class="catagory">
				<h3 class="main-heading">
					<a class="cat-item-link" href="<?=$site_url?>/listing/c-<?=$catrow->category_id?>/<?=str_replace(" ","-",strtolower($get->get_category_name_by_id($catrow->category_id)))?>" ><?=$catrow->category_name?></a>
				</h3>
				
				
				<?
				$getsubmenu = $get->get_subcategory_menu($catrow->category_id); 
				$countsub = mysql_num_rows($getsubmenu);
				if($countsub>0)
				{ 
					?>
					<ul class="sub-cat">
					<? while($subcatrow=mysql_fetch_object($getsubmenu)){?>
					<li class="list">
					
						<h4 class="sub-heading">
							<a  href="<?=$site_url?>/listing/c-<?=$subcatrow->category_id?>/<?=str_replace(" ","-",strtolower($get->get_category_name_by_id($subcatrow->category_id)))?>" >
							<?=$subcatrow->category_name?></a>	
						</h4>
						<?
						$getsubsubmenu = $get->get_subcategory_menu($subcatrow->category_id); 
						$countsubsub = mysql_num_rows($getsubsubmenu);
						if($countsubsub>0){?>
						<ul class="sub-sub-cat">
						<? while($subsubcatrow=mysql_fetch_object($getsubsubmenu)){ ?>
						<li class="all-list">
							<a class="link" href="<?=$site_url?>/listing/c-<?=$subsubcatrow->category_id?>/<?=str_replace(" ","-",strtolower($get->get_category_name_by_id($subcatrow->category_id)))?>/<?=str_replace(" ","-",strtolower($get->get_category_name_by_id($subsubcatrow->category_id)))?>" ><?=$subsubcatrow->category_name?></a>
						</li>
						<? } ?>	
						</ul>
						<? } ?>	
					</li>
					<? } ?>
					</ul>
					<?								
				}
				?>
				</li>
			<?
			}
		}
		?>						
	</ul>
	  
	  
	  
	</div>
  </div>
</section>
<!--footer start here-->
   <? include 'inc/footer.php'; ?>
<!--footer end here-->
<script src="<?=$site_url?>/js/jquery.min.js"></script>
<script src="<?=$site_url?>/js/globle.js"></script>
<script>
$('ul.sub-sub-cat').each(function(){
  
	  var LiN = $(this).find('li').length;
	  
	  if( LiN > 5){    
	    $('li', this).eq(4).nextAll().hide().addClass('toggleable');
	    $(this).append('<li class="more">More</li>');    
	  }
	  
	});

	$('ul.sub-sub-cat').on('click','.more', function(){
	  
	  if( $(this).hasClass('less') ){    
	    $(this).text('More').removeClass('less');    
	  }else{
	    $(this).text('Less').addClass('less'); 
	  }
	  $(this).siblings('li.toggleable').slideToggle();
	    
	}); 
</script>
</body>
</html>