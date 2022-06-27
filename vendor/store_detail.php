<? include ('../management/include/functions.php');

$user = new Admin();

if (!$user->get_session())
{
	header("location:login.php");
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Admin Area</title>

<link rel="stylesheet" type="text/css" href="css/custom.css" />
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<script type="text/javascript" src="<?=$site_url?>/js/min.js"></script>

</head>

<body>
<!-- popup start here -->
<div class="main-container">
	<div class="login-popup">
		<div class="tab bg-white">
			<div class="container">
				<ul class="tabs">
					<a href="business_detail.php"><li class="list">Business Detail</li></a>
					<a href="bank_detail.php"><li class="list">Bank Details</li></a>
					<a href="store_detail.php"><li class="list active">Store Details</li></a>
				</ul>
			</div>
		</div>

		<div class="container">
			<div class="pop-up-details">
				<div class="row margin-bottom-30px overflow-hide">

		<!-- step 3 start here -->
		<?
		$sql = mysql_query("SELECT * FROM  store_details WHERE vendor_id = '".$_SESSION['vendor_id']."' ");
		$count = mysql_num_rows($sql);
		$res = mysql_fetch_array($sql);
		if($count > 0)
		{
			extract($res);
		}
		?>
		
		
		<div class="popup">
		<div class="step-3 row" id="step-3">
		<form action=""  method="post" id="store_form" enctype="multipart/form-data">
		<div id="store_response"></div>
			<h2 class="main-heading">Store Details</h2>
            <input type="hidden" name="vendor_id" value="<?=$_SESSION['vendor_id']?>">
			<div class="row margin-top-10px">
				<span class="label">Display Name(Store Name)</span>
				<input type="text" name="dis_name" id="dis_name" value="<?=$dis_name?>" placeholder="Enter Your Business Name" class="input-box">
			</div>

			<div class="row margin-top-10px">
				<span class="label">Store Address with pincode</span>
					<textarea class="text-box" placeholder="Enter Your Business Discription" name="description" id="description"><?=$description?></textarea>
			</div>

			<div class="buttons">
			    <a class="home_btn" href="index.html">Dashboard</a>
				<?
				if($count > 0)
				{
					?>
					<input type="hidden" name="update_store">
					<input type="submit" value="Update" class="save-next" />
					<?
				}
				else
				{
					?>
					<input type="submit" value="Save" class="save-next" />
					<?
				}
				?>
			</div>
		
		</form>
		</div>
		</div>
		<!-- step 3 end here -->

				</div>
			</div>
		</div>
	</div>
</div>

<!-- popup end here -->
<script src="js/global_vendor.js"></script>
</body>
</html>