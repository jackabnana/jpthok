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

<div class="filter_loading" id="filter_loading" style="display: none;">
	<img src="http://www.fitnessbulls.com/images/bx_loader.gif"><br>
	loading...
</div>
	<div class="login-popup">
		<div class="tab bg-white">
			<div class="container">
				<ul class="tabs">
					<a href="business_detail.php"><li class="list">Business Detail</li></a>
					<a href="bank_detail.php"><li class="list active">Bank Details</li></a>
					<a href="store_detail.php"><li class="list">Store Details</li></a>
				</ul>
			</div>
		</div>

		<div class="container">
		
		
		
			<div class="pop-up-details">
				<div class="row margin-bottom-30px overflow-hide">

		<!-- step 3 start here -->
		<?
		
		$sql = mysql_query("SELECT * FROM  bank_detail WHERE vendor_id = '".$_SESSION['vendor_id']."' ");
		$count = mysql_num_rows($sql);
		$res = mysql_fetch_array($sql);
		if($count > 0)
		{
			extract($res);
		}
		?>
		
		
		<div class="popup">
		<div class="step-3 row" id="step-3">
		<a href="javascript:vol();" id="login_close_buss" style="float:right"><i style="color:#000" class="fa fa-close"></i></a>
		<form action=""  method="post" id="bank_form" enctype="multipart/form-data">
		<div id="bank_response"></div>
		
			<h2 class="main-heading">Bank Details
				<!--<span class="heading-lable">A simple amount will be transferred</span>-->
			</h2>
            <input type="hidden" name="vendor_id" value="<?=$_SESSION['vendor_id']?>">
			<div class="row">
				<span class="label">Account Holder Name</span>
				<input type="text" name="account_name" id="account_name" value="<?=$account_name?>" placeholder="Account Holder Name" class="input-box">
			</div>

			<div class="row margin-top-10px">
				<span class="label">Account Number</span>
				<input type="text" name="account_no" id="account_no" value="<?=$account_no?>" placeholder="Account Number" class="input-box">
			</div>

			<div class="row margin-top-10px">
				<span class="label">Retype Account Number</span>
				<input type="text" name="retype_account_no" id="retype_account_no" value="<?=$account_no?>" placeholder="Retype Account Number" class="input-box">
			</div>

			<div class="row margin-top-10px">
				<span class="label">IFSC Code</span>
				<input type="text" name="ifsc_code" id="ifsc_code" onkeyup="check_ifsc(this.value)" value="<?=$ifsc_code?>" placeholder="IFSC Code" class="input-box">
				<!--<a href="#0" class="additional-link right margin-top-5px">i don't know IFSC code</a>-->
			</div>

			<div class="row margin-top-10px">
				<div class="col-md-50 left padding-right-10px">
					<span class="label">Bank Name</span>
					<input type="text" name="bank_name" id="bank_name" value="<?=$bank_name?>" placeholder="Bank Name" readonly class="input-box">
				</div>
		
				<div class="col-md-50 left padding-left-10px">
				<span class="label">State</span>
				<input type="text" name="state" id="state" value="<?=$state?>" placeholder="State" readonly class="input-box">
				</div>
			</div>

			<div class="row margin-top-10px">
				<div class="col-md-50 left padding-right-10px">
					<span class="label">City</span>
					<input type="text" name="city" id="city" value="<?=$city?>" placeholder="City" readonly class="input-box">
				</div>

				<div class="col-md-50 left padding-left-10px">
					<span class="label">Branch</span>
					<input type="text" name="branch" id="branch" value="<?=$branch?>" placeholder="Branch" readonly class="input-box">
				</div>
			</div>

			<div class="buttons">
			    <a class="home_btn" href="index.html">Dashboard</a>
				<?
				if($count > 0)
				{
					?>
					<input type="hidden" name="update_bank">
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