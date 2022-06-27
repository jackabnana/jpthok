<?
mysql_connect('localhost','zolito_user','OyV.G}eC&Vah');
mysql_select_db('zolito_database');

if(isset($_POST['submit']))
{
/*	
	
	$date = $_POST['name'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$vehical_type = $_POST['vehical_type'];
	$make = $_POST['make'];
	$model = $_POST['model'];
	$register_number = $_POST['register_number'];
	$register_date = $_POST['register_date'];
	$next_serv_date = $_POST['next_serv_date'];
	$next_insurance_date = $_POST['next_insurance_date'];
	$next_pollution_date = $_POST['next_pollution_date'];
	$vehical_number = $_POST['vehical_number'];
	$remarks = $_POST['remarks'];
	

$email = mysql_real_escape_string(trim($usr_email));
$to = "info@zolito.in";
		$subject = 'Query:Sent By '.$usrName.'';
		$headers = "From: $email \r\n";
		$headers .= "Reply-To: $email \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
		$message = '<html><body>';
		$message .= '<h4>Detail Of Sender <br/>';
		$message .= 'Sender Name:'.$fname."".$lname."<br>";
		$message .= 'Sender Mail-Id:'.$email."<br>";
		$message .= 'Sender Mobile Number:'.$mobile."<br>";
		$message .= 'Vehical Type:'.$vehical_type."<br>";
		$message .= 'Brand:'.$make."<br>";		
		$message .= 'Senders Car Model:'.$model."<br>";
		$message .= 'Register Number:'.$register_number."<br>";
		$message .= 'Register Date:'.$register_date."<br>";
		$message .= 'Next Service Date:'.$next_serv_date."<br>";
		$message .= 'Next Insurance Date:'.$next_insurance_date."<br>";
		$message .= 'Next Pollution Date:'.$next_pollution_date."<br>";
		$message .= 'Vehical Number:'.$vehical_number."<br>";		
		$message .= 'Sender Remarks:'.$remarks."<br>";		
		$message .= '</h4>';
		$message .= '</body></html>';
		if(@mail($to, $subject, $message, $headers)){
			
	$msg11= "Thank you for registering with us, we will remind you for your upcoming service, pollution certificate renewal and car insurance.";
    $msg2=urlencode($msg11);		
			
		$url1 ="http://121.241.247.190:7501/failsafe/HttpLink?aid=ZOLITO&pin=Zolito123&mnumber=".$mobile."&message=message=".$msg2."";
		$ch1 = curl_init($url1);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		$curl_scraped_page1 = curl_exec($ch1);
		curl_close($ch1);
		echo "<script>alert('Messgae and Mail sent to you please check');window.location.href='index.php'</script>";
		
		}else{
			echo "<script>alert('Opps Something went wrong')</script>";
			}
	
*/
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bike Insurance</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/calender.css" type="text/css">

</head>


<body>
	<header>
		<div class="container">
			<div class="logo">
				<a href="#"><img src="img/logo.png"></a>
			</div>
			<!--<div class="logout-sec">
				<a href="#"><i class="fa fa-sign-out"></i> Logout</a>
			</div>-->
		</div>
	</header>
	
	<div class="form">
		<div class="transparent">
			<div class="inner-container">
				<h1>KEEP YOUR BIKE INSURED</h1>

				
				<form action="" name="form" id="insurance_form" onsubmit="return validateForm()" class="index-srch" method="post">
				<ul class="form-fields">
				
				<li><label><i class="fa fa-car"></i> Policy Type</label>
				<select onchange="change_manufacture(this.value)" name="policy_type" id="policy_type" placeholder="Policy type">
				<option value="">Select type</option>
				<option value="New">New</option>
				<option value="Renew">Renew</option>
				</select>
				</li>
				<li><label><i class="fa fa-user"></i>First Name</label> <input type="text" name="first_name" id="first_name"></li>
				<li><label><i class="fa fa-user"></i>Last Name</label> <input type="text" name="last_name" id="last_name"></li>
				<li><label><i class="fa fa-envelope"></i> Email</label> <input type="text" name="femail" id="femail"></li>
				<li><label><i class="fa fa-phone"></i> Your Mobile</label> <input type="text" name="mobile_number" id="mobile_number"></li>
				<li><label><i class="fa fa-calendar"></i> Date of first purchase/registration</label> <input type="text" name="initial_date_of_purchase" value=""></li>
				<li><label><i class="fa fa-pencil-square-o"></i>RTO Number</label> <input type="text" id="rto_number" name="rto_number" class="ui-autocomplete-input" autocomplete="off" ></li>
				
				
				<li><label><i class="fa fa-cogs"></i> Brand</label>
				<select name="brand" id="brand" onchange="showcarmodel_api(this.value)">
				<option value="">Brand</option>
				<?
				$brand = mysql_query("select * from manufacturer");
				while($databrand = mysql_fetch_array($brand)){
				?>															
				<option  <? if($databrand['manf_id'] == $rscar['brand']){ ?> selected <? } ?> value="<?=$databrand['manf_id']?>" >
				<?=$databrand['manf_name']?></option>
				<? } ?>	
				</select>
				</li>
				
				<li>
				<div id="searchcarmodel">
				<label><i class="fa fa-truck"></i> Model</label>
				<select name="carmodelid" id="carmodelid" onchange="showversion_api(this.value)" >
				<option value="">Car model</option>
				</select>
				</div>	
				</li>
				
				<li>
				<div id="searchversion">
				<label><i class="fa fa-key"></i>Version</label>
				<select name="version" id="version">
				<option value="">Version</option>
				</select>
				</div>													
				</li>
				
				<li>
				<div id="searchmanufactureyear">
				<label><i class="fa fa-clock-o"></i>Manufacture Year</label>
				<select name="manufacture_year" id="manufacture_year">
				<option value="">Select year</option>
				</select>
				</div>
				</li>
				
				<li><label><i class="fa fa-user"></i>Code</label> <input type="text" name="code" id="code"></li>
				
				<li><input type="submit" name="step1" id="step1" value="Submit" ></li>
				
				</ul>
				</form>
				
				
				
			</div>
		</div>
	</div>
	
	
	
	
	
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/calender.js"></script>
<script type="text/javascript">
function validatemyform1()
	{
		
		if(!document.getElementById("brand").value || !document.getElementById("carmodel").value || !document.getElementById("searchs1").value)
			{
			  alert("All column Are required please fill It");
			  //document.getElementById("searchs").focus();
			  return false;						  
			}
								
		return true;	
	}
				
</script> 
<script>
function showCustomer(str)
{

if (str=="")
{
document.getElementById("bandone").innerHTML="";
return;
}
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("bandone").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","getcarmodel.php?q="+str,true);
xmlhttp.send();
}
</script>


	
</body>
</html>