<?
if (!$user->get_session())
{
	//$red = "login.php?red=".$get->get_current_url();
	$red = "login.php";
	header("location: $red");
}
?>
<div id="AdminHeader">
	<div class="logo">
	<a href="index.php">
	
	
	<link rel="stylesheet" type="text/css" href="<?=$site_url?>/fonts/font-awesome/css/font-awesome.min.css"/>
	
	
	<img src="<?=$site_url?>/upload/comman/<?=$get->get_logo()?>" height="60"/>
	</a>
	</div>
	<div class="searcharea">
	<form action="" method="" onsubmit=''>
	<input type="text" class="top-input" placeholder="Type to search ..."/>
	<input type="submit" class="top-input-search" value="" />
	</form>
	</div>
	<div class="logout">
	Welcome <?=$get->get_vendor_name($_SESSION['vendor_id'])?>&nbsp;&nbsp;&nbsp;
	<a href="<?=VENDOR_PATH?>/index.php?getmeout=ok"><strong>Logout</strong><img src="<?=VENDOR_PATH?>/images/logout.png" width="22" /></a>
	</div>
	<div style="clear:both;"></div>
</div>


		<!-- step 3 start here -->
		<div class="popup">
		
		<div class="step-3 row dp-none slide-back" id="step-3">
		
		<a href="javascript:vol();" id="login_close_buss" style="float:right"><i style="color:#000" class="fa fa-close"></i></a>
		
		<form action=""  method="post" id="buss_form" enctype="multipart/form-data">
		
		<div id="buss_response"></div>
		
			<h2 class="main-heading">Business Details</h2>
            <input type="hidden" name="vendor_id" value="<?=$_SESSION['checkadmin']?>">
			<div class="row margin-top-10px">
				<span class="label">Business Name</span>
				<input type="text" name="buss_name" id="buss_name" placeholder="Enter Your Business Name" class="input-box">
			</div>

			<div class="row margin-top-10px">
				<span class="label">Business type</span>
				<select class="select-option" name="buss_type" id="buss_type">
					<option value="proprietor">Proprietor</option>
                    <option value="company">Company</option>
				</select>
			</div>

			<div class="row margin-top-10px">
				<span class="label">Personal PAN</span>
				<input type="text" placeholder="Enter Your Personal PAN" class="input-box" name="pan_card" id="pan_card">
				<div class="row margin-top-10px"><span class="sub-label">Accepted file formats: jpg, jpeg, png & pdf</span> 
				<input type="file" name="pan_card_file" id="pan_card_file" accept="image/jpeg, image/png, application/pdf" class="right">
				</div>
			</div>

			<div class="row margin-top-10px">
				<span class="label">TIN/VAT</span>
				<input type="text" placeholder="Enter Your TIN/VAT" class="input-box" name="tin_vat" id="tin_vat">
				<div class="row margin-top-10px"><span class="sub-label">Accepted file formats: jpg, jpeg, png & pdf</span> 
				<input type="file" class="right" name="tin_vat_file" accept="image/jpg, image/jpeg, image/png, application/pdf" id="tin_vat_file">
				</div>
				
				<input type="checkbox"  name="vat_check" id="vat_check" value="Yes" onclick="get_vat_tin()" class="checkbox" >
                <label for="vat-check">I don't have TIN/VAT</label>
				
				<div id="check1" style="display:none;">
				<p>Because of</p>
				<label class="sub-label">My TIN application is in process.</label><br/>
				<label class="sub-label">I need help in applying for TIN.</label>
				</div>
				
			</div>

			<div class="row margin-top-10px">
				<span class="label">TAN</span>
				<input type="text" placeholder="Enter Your TAN" class="input-box" name="tan" id="tan">
				<div class="row margin-top-10px"><span class="sub-label">Accepted file formats: jpg, jpeg, png & pdf</span> 
				<input type="file" class="right" name="tan_file" id="tan_file" accept="image/jpg, image/jpeg, image/png, application/pdf">
				</div>
				
				 <input id="tan_check"  type="checkbox"  name="tan_check" class="checkbox" value="Yes" onclick="get_tan()">
                 <label for="tan-check">I don't have TAN</label>
				 
				<div id="check2" style="display:none;">
				<p>Because of</p>
				<label class="sub-label">We will not be able to reimburse the TDS claims of seller for reimbursement of TDS deposited by seller.</label><br/>
				<label class="sub-label">We will not be able to issue NIL WHT Certificate/Lower deduction certificate for exemption of TDS payment by seller.</label>
				</div>
				
				
			</div>

			<div class="buttons">
				<input type="submit" value="Save & Proceed" class="save-next" />
				
			</div>
		
		</form>
		</div>
		</div>
		<!-- step 3 end here -->