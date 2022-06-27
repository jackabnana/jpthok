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
					<a href="business_detail.php"><li class="list active">Business Detail</li></a>
					<a href="bank_detail.php"><li class="list">Bank Details</li></a>
					<a href="store_detail.php"><li class="list">Store Details</li></a>
				</ul>
			</div>
		</div>

		<div class="container">
			<div class="pop-up-details">
				<div class="row margin-bottom-30px overflow-hide">

		<!-- step 3 start here -->
		<?
		$sql = mysql_query("SELECT * FROM  business_details WHERE vendor_id = '".$_SESSION['vendor_id']."' ");
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
		<form action=""  method="post" id="buss_form" enctype="multipart/form-data">
		<div id="buss_response"></div>
			<h2 class="main-heading">Business Details</h2>
            <input type="hidden" name="vendor_id" value="<?=$_SESSION['vendor_id']?>">
			<div class="row margin-top-10px">
				<span class="label">Business Name</span>
				<input type="text" name="buss_name" id="buss_name" value="<?=$buss_name?>" placeholder="Enter Your Business Name" class="input-box">
			</div>

			<div class="row margin-top-10px">
				<span class="label">Business type</span>
				<select class="select-option" name="buss_type" id="buss_type">
					<option <?if($buss_type=='proprietor'){?> selected <? } ?> value="proprietor">Proprietor</option>
                    <option <?if($buss_type=='company'){?> selected <? } ?> value="company">Company</option>
				</select>
			</div>

			<div class="row margin-top-10px">
				<span class="label">Personal PAN</span>
				<input type="text" placeholder="Enter Your Personal PAN" value="<?=$pan_card?>" class="input-box" name="pan_card" id="pan_card">
				<div class="row margin-top-10px"><span class="sub-label">Accepted file formats: jpg, jpeg, png & pdf</span> 
				
				<?if($pan_card_file!=''){?>
				<a class="view" href="#0" onClick=window.open("<?=$site_url?>/upload/vendor/<?=$pan_card_file?>","Image","width=600,height=600,0,status=0,");>View Image</a>
				<?}?>
				
				<input type="file" name="pan_card_file" id="pan_card_file" accept="image/jpeg, image/png, application/pdf" class="right">
				<input type="hidden" name="pan_image" id="pan_image" value="<?=$pan_card_file?>">
				
				</div>
			</div>

			<div class="row margin-top-10px">
				<span class="label">TIN/VAT</span>
				<input type="text" placeholder="Enter Your TIN/VAT" value="<?=$tin_vat?>" class="input-box" name="tin_vat" id="tin_vat">
				<div class="row margin-top-10px"><span class="sub-label">Accepted file formats: jpg, jpeg, png & pdf</span> 
				
				<?if($tin_vat_file!=''){?>
				<a class="view" href="#0" onClick=window.open("<?=$site_url?>/upload/vendor/<?=$tin_vat_file?>","Image","width=600,height=600,0,status=0,");>View Image</a>
				<?}?>
				
				<input type="file" class="right" value="<?=$tin_vat_file?>" name="tin_vat_file" accept="image/jpg, image/jpeg, image/png, application/pdf" id="tin_vat_file">
				</div>
				
				<input type="checkbox"  <?if($vat_check=='Yes'){?> checked <? } ?> name="vat_check" id="vat_check" value="Yes" onclick="get_vat_tin()" class="checkbox" >
                <label class="lab" for="vat-check">I don't have TIN/VAT</label>
				
				<div id="check1" style="display:none;">
				<p class="f-12">Because of</p>
				<label class="sub-label">My TIN application is in process.</label><br/>
				<label class="sub-label">I need help in applying for TIN.</label>
				</div>
				
			</div>

			<div class="row margin-top-10px">
				<span class="label">TAN</span>
				<input type="text" placeholder="Enter Your TAN" value="<?=$tan?>" class="input-box" name="tan" id="tan">
				<div class="row margin-top-10px"><span class="sub-label">Accepted file formats: jpg, jpeg, png & pdf</span> 
				
				<?if($tan_file!=''){?>
				<a class="view" href="#0" onClick=window.open("<?=$site_url?>/upload/vendor/<?=$tan_file?>","Image","width=600,height=600,0,status=0,");>View Image</a>
				<?}?>
				
				<input type="file" class="right" value="<?=$tan_file?>" name="tan_file" id="tan_file" accept="image/jpg, image/jpeg, image/png, application/pdf">
				</div>
				
				 <input id="tan_check"  type="checkbox"  <?if($tan_check=='Yes'){?> checked <? } ?> name="tan_check" class="checkbox" value="Yes" onclick="get_tan()">
                 <label class="lab" for="tan-check">I don't have TAN</label>
				 
				<div id="check2" style="display:none;">
				<p class="f-12">Because of</p>
				<label class="sub-label">We will not be able to reimburse the TDS claims of seller for reimbursement of TDS deposited by seller.</label><br/>
				<label class="sub-label">We will not be able to issue NIL WHT Certificate/Lower deduction certificate for exemption of TDS payment by seller.</label>
				</div>
				
				
			</div>

			<div class="buttons">
			    <a class="home_btn" href="index.html">Dashboard</a>
				<?
				if($count > 0)
				{
					?>
					<input type="hidden" name="update_business">
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