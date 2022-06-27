<?
include 'management/include/functions.php';
extract($_REQUEST);
$id = explode("/",$id);
$id = $id[0];
if(!is_numeric($id)){
header("Location: $site_url/404.html");	
}
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
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
<!--header start here-->
   <? include 'inc/header.php'; ?>
<!--header end here-->

<div class="main-heading">
	<div class="container">
		<div class="breadcrumb">
		<ul>
			<li><a href="<?=$site_url?>">Home</a></li>
			<li><?=$get->get_content_title($id)?></li>
		</ul>
		</div>
	</div>
</div>
<section id="all-cat">
  <div class="container">
    <div class="col-md-100 left">
		<h2 style="font-size: 24px;color:#545454;"><?=$get->get_content_title($id)?></h2>
		<span style="font-size:13px;color:#888;text-align:justify;"><?=$get->get_content($id)?></span>
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