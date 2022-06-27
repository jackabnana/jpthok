//var global_url = 'http://localhost/onlinevandy/';
var global_url = 'https://www.thokvikreta.com/';

//document.write('<script type="text/javascript" src="'+global_url+'js/jquery.bxslider.min.js" ></script>');
//document.write('<script type="text/javascript" src="'+global_url+'js/jquery.autocomplete.js" ></script>');



$("#navigation").change(function()
{
    document.location.href = $(this).val();
});

function search_result(srt){
	if(srt.length > 1){
		$('#search_response').show();
	$.ajax(
	{
		url : global_url+"action.php?q="+srt,
		type: "POST",
		data : 'HTML',
		beforeSend: function() {
		// setting a timeout
		$('#search_loading').show();
		},
		success:function(data, textStatus, jqXHR) 
		{
			//alert(data);
			$('#search_loading').hide();	
			$("#search_response").html(data);
		}
	});
	} else {
		$('#search_response').hide();
	}
}

$(document).ready(function()
{
	//Search 
	//$("#search").autocomplete("action.php", {
		//selectFirst: false
	//});
	
	 //Slider	
	/*$('#slider').bxSlider({
		mode: 'fade',
		captions: true,
		auto: true,
		pager:false,
		nextSelector: '#slider-next',
		prevSelector: '#slider-prev',
		nextText: '<img src="'+global_url+'images/right.png">',
		prevText: '<img src="'+global_url+'images/left.png">'
	});*/
	
	$(".currency-select-drop > .selected").click(function(){
		$(this).next(".currency-select").fadeToggle(200);
	});

	
    //alert('dsad');

	// Popup
	$("#login").click(function() { 
		
		$('#loginform')[0].reset();
		$('#signform')[0].reset();

		$("#login-response").html('');
		$('#popup-login').show();
		$('#popup-login').addClass('effect');
		
	});
	
	$("#signup-login").click(function() {
		$('#loginform')[0].reset();
		$('#signform')[0].reset();

		$("#login-response").html('');
		$('#popup-login').show();
		$('#popup-signup').hide();
	});
	$("#signup-vendor").click(function() {
		$('#loginform')[0].reset();
		$('#signform')[0].reset();

		$("#vendor_response").html('');
		$('#popup-signup-vendor').show();
		$('#popup-signup').hide();
		$('#popup-signup').hide();
	});

	$("#login_close").click(function() {
		$("#login-response").html('');
		$('#popup-login').hide();
	});
	
	$("#signup_close_vendor").click(function() {
		$("#login-response").html('');
		$('#popup-signup-vendor').hide();
	})

	$("#signup").click(function() { 
		$('#loginform')[0].reset();
		$('#signform')[0].reset();

		$("#login-response").html('');
		$('#popup-signup').show();
		$('#popup-login').hide();
	});
	
	$("#login-signup").click(function() {
		$('#loginform')[0].reset();
		$('#signform')[0].reset();

		$("#login-response").html('');
		$('#popup-login').hide();
		$('#popup-signup').show();
	});

	$("#signup_close").click(function() {
		$("#login-response").html('');
		$('#popup-signup').hide();
	});

	$("#forget-pass").click(function() {
		$('#loginform')[0].reset();
		$('#signform')[0].reset();

		$('#login-heading').html('FORGET PASSWORD');
		$('#login-password').hide();
		$('#password-field').attr("disabled", true);
		$('#login-field').attr("disabled", true);
		$('#forget-field').removeAttr('disabled');
		$('#forget-pass').hide();
		$('#login-pass').show();
		$('#login-button').hide();
		$('#forget-button').show();
	});


	$("#login-pass").click(function() {
		$('#loginform')[0].reset();
		$('#signform')[0].reset();

		$('#login-heading').html('LOGIN');
		$('#login-password').show();
		$('#password-field').removeAttr('disabled');
		$('#login-button').show();
		$('#forget-button').hide();
		$('#login-field').removeAttr('disabled');
		$('#forget-field').attr("disabled", true);
		$('#forget-pass').show();
		$('#login-pass').hide();
	});
	
	$("#track").click(function() {
		$('#trackform')[0].reset();
		
		$("#track-response").html('');
		$('#popup-track').show();
	});
	
	$("#track_close").click(function() {
		$("#track-response").html('');
		$('#popup-track').hide();
	});

	//Login
	$("#login-button").click(function(e)
	{
		email_id = $('#login_email').val();
		password = $('#login_password').val();

		validemail = validateEmail(email_id);
		if(email_id == '') {
			$("#login-response").html('<div class="mgs error col-md-40">Please enter email in field...</div>');
			$('#login_email').focus();
			return false;
		} else if (validemail == false){
			$("#login-response").html('<div class="mgs error col-md-40">Please enter valid email in field.</div>');
			$('#login_email').focus();
			return false;
		} else if (password == ''){
			$("#login-response").html('<div class="mgs error col-md-40">Please enter password.</div>');
			$('#login_password').focus();
			return false;
		}	
		else { 	
			var postData = $("#loginform").serializeArray();
			console.log(postData);
			$.ajax(
			{
				url : global_url+"action.php",
				type: "POST",
				data : postData,
				beforeSend: function() {
				// setting a timeout
				$('#loading').show();
				},
				success:function(data, textStatus, jqXHR) 
				{
					$('#loading').hide();	
					$("#login-response").html(data);
				}
			});
			e.preventDefault();	
		}

	});
	
	
	//Forget Password
	$("#forget-button").click(function(e)
	{

		email_id = $('#login_email').val();
		validemail = validateEmail(email_id);

		if(email_id == '') {
			$("#login-response").html('<div class="mgs error col-md-40">Please enter email in field.</div>');
			$('#email').focus();
			return false;
		} else if (validemail == false){
			$("#login-response").html('<div class="mgs error col-md-40">Please enter valid email in field.</div>');
			$('#email').focus();
			return false;
		} else { 	
			var postData = $("#loginform").serializeArray();
			console.log(postData);
			$.ajax(
			{
				url : global_url+"action.php",
				type: "POST",
				data : postData,
				beforeSend: function() {
				// setting a timeout
				$('#loading').show();
				},
				success:function(data, textStatus, jqXHR) 
				{
					$('#loading').hide();	
					$("#login-response").html(data);
				}
			});
			e.preventDefault();	
		}

	});
	
	//Sign up
	$("#signup-button").click(function(e)
	{
		fname = $('#fname').val();
		lname = $('#lname').val();
		email_id = $('#signup_email').val();
		phoneno = $('#signup_phoneno').val();
		password = $('#signup_password').val();
	
		validfname = validateText(fname);
		validlname = validateText(lname);
		validemail = validateEmail(email_id);
		validphone = validatePhone(phoneno);
		
		if(fname == '') {
			$("#signup-response").html('<div class="mgs error col-md-40">Please enter first name in field.</div>');
			$('#fname').focus();
			return false;
		} else if(validfname == false) {
			$("#signup-response").html('<div class="mgs error col-md-40">Please enter valid first name.</div>');
			$('#fname').focus();
			return false;
		} else if(lname == '') {
			$("#signup-response").html('<div class="mgs error col-md-40">Please enter last name in field.</div>');
			$('#lname').focus();
			return false;
		} else if(validlname == false) {
			$("#signup-response").html('<div class="mgs error col-md-40">Please enter valid first name.</div>');
			$('#fname').focus();
			return false;
		} else if(email_id == '') {
			$("#signup-response").html('<div class="mgs error col-md-40">Please enter email in field.</div>');
			$('#signup_email').focus();
			return false;
		} else if (validemail == false){
			$("#signup-response").html('<div class="mgs error col-md-40">Please enter valid email in field.</div>');
			$('#signup_email').focus();
			return false;
		} else if(phoneno == '') {
			$("#signup-response").html('<div class="mgs error col-md-40">Please enter phone no. in field.</div>');
			$('#signup_phoneno').focus();
			return false;
		} else if (validphone == false){
			$("#signup-response").html('<div class="mgs error col-md-40">Please enter valid phone in field.</div>');
			$('#signup_phoneno').val('');
			$('#signup_phoneno').focus();
			return false;
		} else if (password == ''){
			$("#signup-response").html('<div class="mgs error col-md-40">Please enter password.</div>');
			$('#signup_password').focus();
			return false;
		}	
		else {
			var postData = $("#signform").serializeArray();
			console.log(postData);
			$.ajax(
			{
				url : global_url+"action.php",
				type: "POST",
				data : postData,
				beforeSend: function() {
				// setting a timeout
				$('#loading').show();
				},
				success:function(data, textStatus, jqXHR) 
				{
					$('#loading').hide();	
					$("#signup-response").html(data);
				}
			});
			e.preventDefault();	
		}
	});



// Service Request Form
$("#submit_request").click(function(e)
{
       fname = $('#fname1').val();
		lname = $('#lname1').val();
		email_id = $('#email1').val();
		phoneno = $('#phone1').val();
		pincode = $('#pincode1').val();
		city = $('#city1').val();
		brand = $('#brand1').val();
		model = $('#model1').val();
		date = $('#date1').val();
		no_of_product = $('#no_of_product1').val();
		address = $('#address1').val();
	
		validfname = validateText(fname);
		validlname = validateText(lname);
		validemail = validateEmail(email_id);
		validphone = validatePhone(phoneno);
		validpincode = validatePincode(pincode);
		
		if(fname == '') {
			$("#service-response").html('<div class="mgs error col-md-40">Please enter first name in field.</div>');
			$('#fname1').focus();
			return false;
		} else if(lname == '') {
			$("#service-response").html('<div class="mgs error col-md-40">Please enter last name in field.</div>');
			$('#lname1').focus();
			return false;
		}else if(email_id == '') {
			$("#service-response").html('<div class="mgs error col-md-40">Please enter Email in field.</div>');
			$('#email1').focus();
			return false;
		}else if (validemail == false){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter valid email in field.</div>');
			$('#email1').focus();
			return false;
		}else if (phoneno == ''){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter phone number in field.</div>');
			$('#phone1').focus();
			return false;
		}else if (validphone == false){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter valid phone number in field.</div>');
			$('#phone1').focus();
			return false;
		}else if (pincode == ''){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter Pincode in field.</div>');
			$('#pincode1').focus();
			return false;
		}else if (validpincode == false){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter valid Pincode in field.</div>');
			$('#pincode1').focus();
			return false;
		}else if (city == ''){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter city in field.</div>');
			$('#city1').focus();
			return false;
		}else if (brand == ''){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter brand in field.</div>');
			$('#brand1').focus();
			return false;
		}else if (model == ''){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter model in field.</div>');
			$('#model1').focus();
			return false;
		}else if (date == ''){
			$("#service-response").html('<div class="mgs error col-md-40">Please Select date in field.</div>');
			$('#date1').focus();
			return false;
		}else if (no_of_product == ''){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter name of product.</div>');
			$('#no_of_product1').focus();
			return false;
		}else if (address == ''){
			$("#service-response").html('<div class="mgs error col-md-40">Please enter address in field.</div>');
			$('#address1').focus();
			return false;
		}
		else {
			var postData = $("#service_request").serializeArray();
			console.log(postData);
			$.ajax(
			{
				url : global_url+"action.php?funcname="+service_form,
				type: "POST",
				data : postData,
				beforeSend: function() {
				// setting a timeout
				$('#loading').show();
				},
				success:function(data, textStatus, jqXHR) 
				{
                    alert(data);
					$('#loading').hide();	
					$("#service-response").html(data);
				}
			});
			e.preventDefault();	
		}
	});

//Buy Full Catalog
$("#buy_full_catalog").click(function(e)
{
	
	   // alert('--------------->');
	
	    $('#add_red').val(1);		
		var postData = $("#buy_ful_form").serializeArray();
		console.log(postData);
		$.ajax(
		{
			url : global_url+"action.php",
			type: "POST",
			data : postData,
			beforeSend: function() {
			// setting a timeout
			$('#filter_loading').show();	
			},
			success:function(data, textStatus, jqXHR) 
			{
				$('#filter_loading').hide();				
				//alert(data);
				if(data == 'red')
				{
					window.location.href = global_url+'checkout.html';
				}
				else
				{
					$('#cart_value').text(data);
					window.location.href = global_url+'checkout.html';
				}				
			}
		});
		e.preventDefault();		
});		
	
});	

//Submit Review
$("#submit-review").click(function(e)
{
	$('#review-response-error').show();
	var review_title = $('#review_title').val();
	var review_msg = $('#review_msg').val();
	var rating = $('input:radio[name="review_star"]');
	if(review_title == '') {
		$("#review-response-error").html('<div class="mgs error col-md-40">Please enter title in field.</div>');
		$('#review_title').focus();
		return false;
	} else if(review_msg == '') {
		$("#review-response-error").html('<div class="mgs error col-md-40">Please enter review in field.</div>');
		$('#review_msg').focus();
		return false;
	} else if(rating == '') {
		$("#review-response-error").html('<div class="mgs error col-md-40">Please enter star in field.</div>');
		$('#review_msg').focus();
		return false;
	} else { 	
		return true;
	}

});	
		
	
	
//Checkout
function showareaonload(str)
{
	
	if(str == 1)
	{
		$("#payment_method").val( "ONLINE" );	
	}
	else
	{
		$("#payment_method").val( "COD" );
		
	}
	
	$(".tabs_payment").removeClass( "active" );
	$( "#tabs_"+str ).addClass( "active" );
	
	$('.cards').css("display","none");
	$('#credit_card_'+str).css("display","block");
	
}

$("#add_address").click(function(e)
	{
		$(".address_detail").hide();
		$("#address_form").show();
		$("#form_validation").val('required');
		$('#get_address_id').val('');
		$('.tick-icon').hide();
	});
	
$("#back_address").click(function(e)
	{
		$("#form_validation").val('');
		$(".address_detail").show();
		$("#address_form").hide();
		
	});
//Buy now
$("#buy_now").click(function(e)
{
	
	var option_id = $("#option_id").val();
	var attribute_name = $("#attribute_name").val();

	if(option_id == '' && attribute_name != '')
	{
			$("#error_msg").html('<span style="color:red;font-size:12px" class="col-md-100">(Please select '+attribute_name+')</span>');
			$('.remove_color').focus();
			return false;
	}
	else
	{
	
		$('#add_red').val(1);
		var postData = $("#addcart").serializeArray();
		console.log(postData);
		$.ajax(
		{
			url : global_url+"action.php",
			type: "POST",
			data : postData,
			beforeSend: function() {
			// setting a timeout
			$('#filter_loading').show();	
			},
			success:function(data, textStatus, jqXHR) 
			{
				
				if(data == 'red')
				{
					window.location.href = global_url+'checkout.html';
				}
				else
				{
					$('#cart_value').text(data);
					window.location.href = global_url+'checkout.html';
				}	
				
			}
		});
		e.preventDefault();	
	}	
});	

$(".pay_now").click(function(e)
{	

    var online_method = $(this).attr("alt");
	$("#online_method").val(online_method);


	var payment_method = $("#payment_method").val();
	var getCaptcha = $("#getCaptcha").val();
	var txtCaptcha = $("#txtCaptcha").val();
	var value = $("#form_validation").val();
	var get_address_id = $("#get_address_id").val();
	
	if(value == 'required')
	{

			var billname = $('#billname').val();
			var billaddress = $('#billaddress').val().length;
			var billlandmark = $('#billlandmark').val();
					
			var billstate = $('#billstate').val();
			var billcity = $('#billcity').val();
			
			var billzip = $('#billzip').val();
			var billcontact = $('#billcontact').val();
			
			var validname = validateText(billname);
			var validcity = validateText(billcity);
			var validcontact = validatePhone(billcontact);
			var validpin = validatePincode(billzip);
			//var available_pincode = availablePincode(billzip);
			
			var available_pin = $('#available_pin').val();
		
			if(billname == '') 
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please enter name in field.</div>');
				$('#billname').focus();
				return false;
			}
			else if (validname == false)
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please enter valid name in field.</div>');
				$('#billname').focus();
				return false;
			}
			else if (billzip == '')
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please enter pincode in field.</div>');
				$('#billzip').focus();
				return false;
			}
			else if (billaddress < 1)
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please enter address in field.</div>');
				$('#billaddress').focus();
				return false;
			} 
			else if (billlandmark == '')
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please enter landmark in field.</div>');
				$('#billlandmark').focus();
				return false;
			}
			else if (billstate == '')
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please select state in field.</div>');
				$('#billstate').focus();
				return false;
			}	
			else if (billcity == '')
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please enter city in field.</div>');
				$('#billcity').focus();
				return false;
			}
			else if (validcity == false)
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please enter valid city in field.</div>');
				$('#billcity').focus();
				return false;
			}				
			else if (billcontact == '')
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please enter contact number in field.</div>');
				$('#billcontact').focus();
				return false;
			}
			else if (validcontact == false)
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please enter valid contact in field.</div>');
				$('#validcontact').focus();
				return false;
			}	
			else if(payment_method == 'COD')
			{
				
				if (getCaptcha == '')
				{
					
						$("#form-response").html('<div class="mgs error col-md-100">Please enter captcha in field..</div>');
						$('#getCaptcha').focus();
						return false;
				}
				else if(txtCaptcha != getCaptcha)
				{
					
					$("#form-response").html('<div class="mgs error col-md-100">Please enter correct captcha in field..</div>');
					$('#txtCaptcha').focus();
					return false;
					
				}
				else
				{	
						submit_order();		
				}
				
			}				
			else 
			{ 	   
				submit_order();
			}
	}
	else
	{
		
		if(payment_method == 'COD')
		{
			if(get_address_id < 1)
			{
					$("#form-response").html('<div class="mgs error col-md-100">Please select atleast one delivery address.</div>');
					$('#get_address_id').focus();
					return false;
			}
			else if(getCaptcha=='')
			{
					$("#form-response").html('<div class="mgs error col-md-100">Please enter captcha in field.</div>');
					$('#getCaptcha').focus();
					return false;
			}
			else if(txtCaptcha != getCaptcha)
			{
				
				$("#form-response").html('<div class="mgs error col-md-100">Please enter correct captcha in field.</div>');
				$('#txtCaptcha').focus();
				return false;
				
			}
			else
			{
			
				submit_order();
			}
		}
		else if(payment_method == 'ONLINE')
		{
			if(get_address_id < 1)
			{
				$("#form-response").html('<div class="mgs error col-md-100">Please select atleast one delivery address.</div>');
				$('#get_address_id').focus();
				return false;
			}
			else
			{
			   submit_order();
			}	
			
		}
	}
});

//Submit Order 
function submit_order()
{
	var postData = $("#address_form").serializeArray();
	$.ajax(
	{
		url : global_url+"action.php",
		type: "POST",
		data : postData,
		beforeSend: function() {

		$('#filter_loading').show();                              								
		},
		success:function(data, textStatus, jqXHR) 
		{
				
			     var obj = $.parseJSON(data);
								  
				if(obj['nowreturn'] == 'ONLINE')
				{
					var method = obj['online_method'];
					window.location.href = global_url+"online-payment.php?method="+method;
				} 
				else if(obj['nowreturn'] == 'COD')
				{
					window.location.href = global_url+"order-history.php";
				}
				else
				{
					alert('Some thing worng please try again later');
				}
			

		}
	});
}
function change_address(str)
{
	$("#get_address_id").val(str);
	$(".tick-mark").hide();
	$("#select_"+str).show();
}
//captcha start
function DrawCaptcha()
{
	
	var a = Math.ceil(Math.random() * 10)+ '';
	var b = Math.ceil(Math.random() * 10)+ '';       
	var c = Math.ceil(Math.random() * 10)+ '';  
	var d = Math.ceil(Math.random() * 10)+ '';  
	var e = Math.ceil(Math.random() * 10)+ '';  
	var code = a + b  + c + d + e;
	document.getElementById("txtCaptcha").value = code
}		

//Pincode
function validatePincode(txtPincode) {
	var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
	if (filter.test(txtPincode)  && txtPincode.length == '6' ) {
		return true;
	}
	else {
		return false;
	}
}
// Available Pincode
function availablePincode(str) 
{
	    if(str.length==6)
		{
	 
			//console.log(postData);
			$.ajax(
			{
				url : global_url+"action.php",
				type: "POST",
				data:'pin='+str,
				beforeSend: function() {
				// setting a timeout
				//$('#forget-button').html('Loading...');	
				},
				success:function(data, textStatus, jqXHR) 
				{
					 
					 
				var obj = $.parseJSON(data);
				var pin = obj['active'];
				
				if(obj['active'] == 'yes')
				{
					
					if(obj['cod_available'] == 'COD')
					{
						$('#form-response').html('<div class="mgs success col-md-100"> Devilery is available at this pincode.</div>');
						
						$("#payment_method").val('COD');
						
						$("#tabs_3").css({"display": "block"});
						$(".tabs_payment").removeClass( "active" );
						$("#tabs_3").addClass("active");
						$('.cards').css("display","block");
						$('#credit_card_3').css("display","block");
						$('#credit_card_1').css("display","none");
						
					}
					else
					{
						$("#payment_method").val('ONLINE');
						$("#tabs_3").css({"display": "none"});
						$(".tabs_payment").removeClass( "active" );
						$("#tabs_1").addClass("active");
						$('.cards').css("display","none");
						$('#credit_card_1').css("display","block");
						$('#credit_card_3').css("display","none");
						
						
						
						
						$('#form-response').html('<div class="mgs success col-md-100"> Online Payment is available at this pincode.</div>');
					}
					
				} 
				else
				{
					
					$('#form-response').html('<div class="mgs error col-md-100"> Devilery is not available at this pincode. Please try with another...</div>');
				}
					
					
				/*	
				if(data=='yes')
				{
					$('#form-response').html('<div class="mgs success col-md-100"> Devilery is available at this pincode.</div>');
				}
				else
				{
					
					$('#form-response').html('<div class="mgs error col-md-100"> Devilery is not available at this pincode. Please try with another...</div>');
				}
				*/	
					
				$('#available_pin').val(pin);
					
				}
			});
		}
		else
		{
			
			$('#form-response').html('<div class="mgs error col-md-100"> Please try with correct pincode.</div>');
			
		}
}																  
//Big Menu
$('.all-links').click(function (a) {
	$('.sub-cat').toggle();
});

//copy text 
function textcopy(id){
	var vartext = $('#'+id).text();
	$('#search_text').val(vartext);
	$('#search_form').submit();
}


$('.sub-sub-cat-div').first().show();
$('.sub-sub-cat-div .sub-sub-cat-list .sub-sub-cat-list-div').first().show();

//Notifi
$("#register_notifi").click(function(e)
{
	email = $('#notify_me').val();
	validemail = validateEmail(email);
	if(email == '') {
		alert('Please enter email in field.');
		$('#notify_me').focus();
		return false;
	} else if (validemail == false){
		alert('Please enter valid email in field.');
		$('#notify_me').focus();
		return false;
	} else { 	
		var postData = $("#notify-form").serializeArray();
		console.log(postData);
		$.ajax(
		{
			url : global_url+"action.php",
			type: "POST",
			data : postData,
			beforeSend: function() {
			// setting a timeout
			$('#filter_loading').show();
			},
			success:function(data, textStatus, jqXHR) 
			{
				$('#filter_loading').hide();
				$('#notify-form').hide();
				$("#notifi-response").html('<br><i class="fa fa fa-check-circle green f-16"></i> <span class="f-16">Thank you for your interest</span><br>You will be notified when this product will be in stock');
				$('#notify-form')[0].reset();
			}
		});
		e.preventDefault();	
	}

});	
	
	//Email
	function validateEmail(emailAddress) {
	    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
	    //alert( pattern.test(emailAddress) );
	    return pattern.test(emailAddress);
	}

	//Phone No.
	function validatePhone(txtPhone) {
	    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
	    if (filter.test(txtPhone)  && txtPhone.length == '10' && txtPhone[0] == '9' || txtPhone[0] == '8' || txtPhone[0] == '7' ) {
	        return true;
	    }
	    else {
	        return false;
	    }
	}
	
	 //Text Only
	function validateText(txtText) {
	    var filter = /^[A-Za-z]/;
	    if (filter.test(txtText)) {
	        return true;
	    }
	    else {
	        return false;
	    }
	}
	
$("#wishlist-button").click(function() {
		$('#loginform')[0].reset();
		$('#signform')[0].reset();
		
		$("#signup-response").hide();	
		$("#login-response").hide();
		$("#login-response").html('');
		$('#popup-login').show();
	});	
	$("#trackOrder").click(function() {
		$('#loginform')[0].reset();
		$('#signform')[0].reset();
		
		$("#signup-response").hide();	
		$("#login-response").hide();
		$("#login-response").html('');
		$('#popup-login').show();
	});
	$("#addwishlist").click(function() {
		$('#loginform')[0].reset();
		$('#signform')[0].reset();
		
		$("#signup-response").hide();	
		$("#login-response").hide();
		$("#login-response").html('');
		$('#popup-login').show();
	});
	
//Add to wishlist
function add_to_wish(uid,pid){
	
	if (uid == '' || pid == '')
	{
		alert('Some thing worng please try again later');
		return false;
	} 
	else 
	{
		$.ajax(
		{
			url : global_url+"action.php?uid=" + uid + "&pid=" + pid +"&wish=yes",
			type: "POST",
			data : "html",
			beforeSend: function() {
			// setting a timeout
			$('#wishlist_text').text('loading...');
			//$('#filter_loading').show();
			},
			success:function(data, textStatus, jqXHR) 
			{
				//alert(data);
				
				$('#wishlist_text').text('Added to wishlist');	
				if(data == 'add')
				{
					$('#wishlist_text').addClass('pink-button-active');	
				}
				
			}
		});
	}	
}

//Remove to wishlist
function remove_wishlist(id,pid){
	if (id == '' || pid == '')
	{
		alert('Some thing worng please try again later');
		return false;
	} else {
		$.ajax(
		{
			url : global_url+"action.php?pid=" + pid +"&wish=no",
			type: "POST",
			data : "html",
			beforeSend: function() {
			// setting a timeout
				//$('#wishlist_text').text('loading...');
			},
			success:function(data, textStatus, jqXHR) 
			{
				
				//alert(data);
				
				
				var obj = $.parseJSON(data);
				if(obj['nowreturn'] == 'remove')
				{
					$('#'+id).slideUp();
					//$('#count').text(obj['count']);	
					//if(obj['count'] == 0)
					//{
						//$('.no-wishlist').removeClass('dp-none');
					//}
				} 
				else 
				{
					alert('Some thing worng please try again later');
				}
				
				
				
			}
		});
	}	
}
//Add to cart combo	
function add_to_cart(id,qty)
{

	req = $.ajax({
		type: "POST",
		url: global_url+"action.php?combo_id=" + id,
		datatype: "html",
		 beforeSend: function() {
		$("#filter_loading").show();
		},
		success: function(data){
			
			//alert(data);
			var obj = $.parseJSON(data);
			$("#filter_loading").hide();
			$('#cart-drop').html(obj['cart_div']);
			$('#link').html(obj['top_cart']);
		}
	});	
}
//buy now combo	
function buy_now_combo(id,qty)
{
	req = $.ajax({
		type: "POST",
		url: global_url+"action.php?combo_id=" + id,
		datatype: "html",
		 beforeSend: function() {
		$("#filter_loading").show();
		},
		success: function(data){
			
			//alert(data);
			var obj = $.parseJSON(data);
			$("#filter_loading").hide();
			$('#cart-drop').html(obj['cart_div']);
			$('#link').html(obj['top_cart']);
			window.location.href = global_url+'checkout.html';
		}
	});	
}
//Add to cart product
//Add to cart product
function add_to_cart_product(id)
{
	
	/*var first = $('select[id=first_arrtibute]').val();
	if(first == '')
	{
		alert('Please select attribute first.');
		return false;
	}
	
	var second = $('select[id=result_att]').val();
	if(second == '')
	{
		alert('Please select second attribute.');
		return false;
	}*/
//var qty = $('#product_qty').val();
var qty = 1;
var option_id = $("#option_id").val();
var attribute_name = $("#attribute_name").val();
var first = $("#option_id").val();
var second = '';
	
	if(option_id == '' && attribute_name != '')
	{
			//$("#error_msg").html('<span style="color:red;font-size:14px" class="col-md-100">(Please select '+attribute_name+')</span>');
			alert("Please select "+attribute_name);
			$('.remove_color').focus();
			return false;
	}
	else
	{

	req = $.ajax({
		type: "POST",
		url: global_url+"action.php?prod_id=" + id + "&first=" + first + "&second=" + second+"&qty="+qty,
		datatype: "html",
		 beforeSend: function() {
		$("#filter_loading").show();
		},
		success: function(data){
			
			//alert(data);
			//$("#cart-drop").css("display","block");
								  
			var obj = $.parseJSON(data);
			$("#filter_loading").hide();
			if(obj['status'] == 'ERROR')
			{
				alert(obj['message']);
					
			}
			else
			{
				//$('#link').html(obj['top_cart']);
				$('#cart_amt').text(obj['top_cart']);
				$('#cart_price').text(obj['return_amt']);
			 }
		}
	});
  }	
}
//Add to cart product
function buy_now_product(id)
{
	
	/*var first = $('select[id=first_arrtibute]').val();
	if(first == '')
	{
		alert('Please select attribute first.');
		return false;
	}
	
	var second = $('select[id=result_att]').val();
	if(second == '')
	{
		alert('Please select second attribute.');
		return false;
	}*/
	
var qty = 1;	
var option_id = $("#option_id").val();
var attribute_name = $("#attribute_name").val();
var first = $("#option_id").val();
var second = '';
	
	if(option_id == '' && attribute_name != '')
	{
			//$("#error_msg").html('<span style="color:red;font-size:14px" class="col-md-100">(Please select '+attribute_name+')</span>');
			alert("Please select "+attribute_name);
			$('.remove_color').focus();
			return false;
	}
	else
	{
	
	req = $.ajax({
		type: "POST",
		url: global_url+"action.php?prod_id=" + id + "&first=" + first + "&second=" + second+"&qty="+qty,
		datatype: "html",
		 beforeSend: function() {
		$("#filter_loading").show();
		},
		success: function(data){
			
			//alert(data);
			
			var obj = $.parseJSON(data);
			$("#filter_loading").hide();
			//$('#cart-drop').html(obj['cart_div']);
			//$('#link').html(obj['top_cart']);
			//$('#cart_value').text(obj['return_qty']);
			//$('#cart_amount').text(obj['return_amt']);
			$('#cart_amt').text(obj['top_cart']);
			$('#cart_price').text(obj['return_amt']);
			
			window.location.href = global_url+'checkout.php';
			
		}
	});	
  }
}


//Detail Product Price change on change 

  
$(".qty-controler").click(function() {
var qty = $('#product_qty').val();
var prod_id = $('#product_id').val();	
var option_id = $("#option_id").val();
var attribute_name = $("#attribute_name").val();
var attribute = $("#option_id").val();

	
	if(option_id == '' && attribute_name != '')
	{
			//$("#error_msg").html('<span style="color:red;font-size:14px" class="col-md-100">(Please select '+attribute_name+')</span>');
			alert("Please select "+attribute_name);
			$('.remove_color').focus();
			return false;
	}
	else
	{
		

		
		var dataString = "change_product_price=" + prod_id + "&attribute=" + attribute+"&qty="+qty;
			$.ajax({  
			type: "POST",  
			url:  global_url+"action.php",  
			data: dataString,
			beforeSend: function() 
			{
				$("#filter_loading").show();
			},  
			success: function(data)
			{
				//alert(data);
				$("#filter_loading").hide();
				
				var obj = $.parseJSON(data);
				var status = obj['status']
				
				if(status ==  'success')
				{
					var attribute_price = obj['attribute_price'] * qty;
					var attribute_dis_price = obj['attribute_dis_price'] * qty;
					var save = attribute_price - attribute_dis_price;
					var off =  Math.round((save/attribute_price)*100);
					//alert(off);
					
						$("#discount").html(attribute_dis_price);
						$("#actual_price").html(attribute_price);
						$("#option_id").val(option_id);
						$("#option_id").val(option_id);
						$("#disoff").text(off);
						$("#save_amt").html(save);

					
				
					
				}
			}
		});
		
}
	


 }); 


//Drop Down
$('.login-btn').click(function() {
  $(".drop-div").slideToggle();
  if($('.down-icon').hasClass('fa-angle-up') == true){
		$('.down-icon').removeClass('fa-angle-up');
		$('.down-icon').addClass('fa-angle-down');
	}
	else {
		$('.down-icon').removeClass('fa-angle-down');
		$('.down-icon').addClass('fa-angle-up');
	}
});
//Check Pincode
$("#check_pincode").click(function(e)
{
	pincode = $('#pincode').val();
	validpincode = validatePincode(pincode);

	if(pincode == '') {
		alert('Please enter pincode.');
		$('#pincode').focus();
		return false;
	} else if (validpincode == false){
		alert('Please enter valid pincode.');
		return false;
	} else { 	
		var postData = $("#pincode-form").serializeArray();
		console.log(postData);
		$.ajax(
		{
			url : global_url+"action.php",
			type: "POST",
			data : postData,
			beforeSend: function() {
			// setting a timeout
			//$('#forget-button').html('Loading...');	
			},
			success:function(data, textStatus, jqXHR) 
			{
				$('#pincode-div').hide();
				$('.serviceable').show();
				$('.checked-pincode').html(pincode);
								  
				var obj = $.parseJSON(data);
				if(obj['active'] == 'no'){
					$('.pincode-title').html('<i class="fa fa-times-circle red"></i> Not Available at');
					$('#available_product').css("display","none");

				} else {
					$('.pincode-title').html('<i class="fa fa-check-circle green"></i> Available at');
					$('#available_product').css("display","block");
				}
				
			}
		});
		e.preventDefault();	
	}

});
//reCheck Pincode
$('.btn-change').click(function(e)
{	
   //alert('------------>');

	$('#pincode-form')[0].reset();
	$('#pincode').focus();
	$('#pincode-div').show();
	$('.serviceable').hide();	
});
$("#add-to-compair").click(function(e)
{	
		
		req = $.ajax({
		type: "POST",
		url: global_url+"action.php?compair_prod_id=" + id,
		datatype: "html",
		 beforeSend: function() {
		$("#filter_loading").show();
		},
		success: function(data){
			
			//alert(data);
			
			var obj = $.parseJSON(data);
			$("#filter_loading").hide();
			$('#cart-drop').html(obj['cart_div']);
			$('#link').html(obj['top_cart']);
			
			window.location.href = global_url+'checkout.html';
			
		}
	});	
});
function add_to_compair(id)
{
	req = $.ajax({
		type: "POST",
		url: global_url+"action.php?compair_id=" + id,
		datatype: "html",
		 beforeSend: function() {
		$("#filter_loading").show();
		},
		success: function(data)
		{
			$("#filter_loading").hide();
			//alert(data);
			if(data == 'error' )
			{
				alert('Product is already in compair or have Max 4 product.');
			}
			else
			{
				$("#compair-products1").html(data);
			}	
			//var obj = $.parseJSON(data);
			//$("#filter_loading").hide();
			//$('#cart-drop').html(obj['cart_div']);
			//$('#link').html(obj['top_cart']);
			//window.location.href = global_url+'checkout.html';
			
		}
	});	
}
function update_cart(pid,first,second,i)
{
								  
	var qty = $("#update_qty"+i).val();
	
	//alert('++++++++++>>>>>'+qty);
	
	if(qty == 0)
	{   
        
		window.location.href = global_url+'cart.php';
	}
	else
	{	

   //alert('xxxxxxxxxx');
 
	req = $.ajax({
		type: "POST",
		url: global_url+"action.php?update_cart_prod_id=" + pid + "&first=" + first + "&second=" + second + "&i=" + i + "&qty=" + qty,
		datatype: "html",
		 beforeSend: function() {
		    $("#filter_loading").show();
		},
		success: function(data)
		{
			$("#filter_loading").hide();
								  
			//alert('=============xxxxxxxxx'+data);					  
			
			if(data=='error')
			{
				window.location.href = global_url+'cart.php';
			}
			else
			{
				
				$("#cart_update_msg").html(data);
			}
			
			
		}
	});	
	}
}
function update_cart_combo(combo,i)
{
	var qty = $("#update_combo_qty"+i).val();
							
	if(qty == 0)
	{   
        
		window.location.href = global_url+'cart.html';
	}
	else
	{
	
	req = $.ajax({
		type: "POST",
		url: global_url+"action.php?update_combo_id=" + combo + "&i=" + i + "&qty=" + qty,
		datatype: "html",
		 beforeSend: function() {
		    $("#filter_loading").show();
		},
		success: function(data)
		{
			$("#filter_loading").hide();
			
			if(data=='error')
			{
				window.location.href = global_url+'cart.html';
			}
			else
			{
				
				$("#cart_update_msg").html(data);
			}
			
			
		}
	});	
   }
}
								  
//Remove to Address
function deleteadd(id)
{
	
	if (id == '')
	{
		alert('Some thing worng please try again later...');
		return false;
	} else {
		$.ajax(
		{
			url : global_url+"action.php?addressid=" + id +"&delete=yes",
			type: "POST",
			data : "html",
			beforeSend: function() {
			// setting a timeout
				$('#add_form_loading_'+id).show();
			},
			success:function(data, textStatus, jqXHR) 
			{
				
				
				
				if(data == 'remove'){
					$('#add_form_id_'+id).slideUp();
				} else 
				{
					alert('Some thing worng please try again later');
				}
				
			}
		});
	}	
}
//Search 
function search(srt)
{
	var type = $("#product_type").val();
	if(srt.length >= 1)
	{
	    $('#search_response').show();
		$.ajax(
		{
			url : global_url+"action.php?q="+srt+"&cat="+type,
			type: "POST",
			data : 'HTML',
			beforeSend: function() {
			// setting a timeout
			$('#search_loading').show();
			},
			success:function(data, textStatus, jqXHR) 
			{
				//alert(data);
				$('#search_loading').hide();	
				$("#search_response").html(data);
			}
		});
	} 
	else 
	{
		$('#search_response').hide();
	}
}					  
function hide_cart()
{										  								  
	$("#cart-drop").css("display","none");								  							  								  
}
								  
$(".toggle-menu-resp").click(function(){
	$(".menu-cat").toggle();
});	



$(".header .menu-toogle-btn").click(function(){
	$(".fixed-menu ").toggle();
});


$("#services-btn").click(function(){
	$("#services-pop-up, .services-overlay").fadeIn();
});

$("#request-product, #request-right-product-btn").click(function(){
	$("#request-product-pop-up, .services-overlay").fadeIn();
});

$(".reset-all-btn").click(function(){
	$("#request-product-pop-up, #services-pop-up, .services-overlay").fadeOut();
});


//Header Dropdown
function show_subcategory(str) 
{
	//alert(str);	
    reqq = $.ajax({
    type: "GET",
    url: global_url+"action.php?main_category_id=" + str,
    datatype: "html",
     beforeSend: function() {	
		$("#filter_loading").show();	 
    },
    success: function(data){
//alert(data);
		$("#filter_loading").hide();
        $('#display_sub_category').html(data);
    }
    });
}


function show_sub_subcategory(maincatid,str) 
{
	//alert("Sub Category ==>"+str+" Mai Category ===>"+maincatid);	
    reqq = $.ajax({
    type: "GET",
    url: global_url+"action.php?sub_category_id=" + str+"&maincatid="+maincatid,
    datatype: "html",
     beforeSend: function() {	
		$("#filter_loading").show();	 
    },
    success: function(data){
//alert(data);
		$("#filter_loading").hide();
        $('#display_sub_subcategory').html(data);
    }
    });
}



function show_productby(maincatid,mainsubcatid,mainsubsubcatid) 
{
	//alert("Main Category==>"+maincatid+"  Category Id ====> "+mainsubcatid+" Sub Category===>"+mainsubsubcatid);	
    reqq = $.ajax({
    type: "GET",
    url: global_url+"action.php?product_by_category=display"+"&main_category=" + maincatid+"&category="+mainsubcatid+"&subcategory="+mainsubsubcatid,
    datatype: "html",
     beforeSend: function() {	
		$("#filter_loading").show();	 
    },
    success: function(data){
//alert(data);
		$("#filter_loading").hide();
        $('#display_product_by_cat').html(data);
    }
    });
}

//REQUEST FOR PRODUCTS

$("#product-button").click(function(e)
{
	//alert('hello');
	$("#show_response").show();
	
	
	name = $('#request_name').val();
	email = $('#request_email').val();
	phone = $('#request_phone').val();
	
	company = $('#request_company_name').val();
	main_category = $('#main_category').val();	
	sub_category = $("#sub_category").val();
	sub_subcategory = $("#sub_subcategory").val();

	
	
	product_info = $("#product_info").val();
	request_message = $("#request_message").val();
	
	//check = $('input[name=check]:checked').length;
	
	
	
	validname = validateText(name);
	validphone_no = validatePhone(phone);
	validemail = validateEmail(email);
	
	
		
	if(name == '') 
	{
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter Name in field.</div>');
		$('#request_name').focus();
		return false;
	} 
	else if (validname == false)
	{
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter valid name in field.</div>');
		$('#request_name').focus();
		return false;
	}else if(email == '') 
	{
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter email in field.</div>');
		$('#request_email').focus();
		return false;
	}
	else if (validemail == false){
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter valid email in field.</div>');
		$('#request_email').focus();
		return false;
	}else if(phone == '') {
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter phone no. in field.</div>');
		$('#request_phone').focus();
		return false;
	} 
	else if (validphone_no == false){
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter valid phone no. in field.</div>');
		$('#request_phone').focus();
		return false;
	}else if(company == '') 
	{
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please write company/store name.</div>');
		$('#request_company_name').focus();
		return false;
	}else if(main_category == '') 
	{
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please select Main Category.</div>');
		$('#main_category').focus();
		return false;
	}else if(sub_category == '') 
	{
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please select Category.</div>');
		$('#sub_category').focus();
		return false;
	}else if(sub_subcategory == '') 
	{
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please select Subcategory.</div>');
		$('#sub_subcategory').focus();
		return false;
	}else if(product_info == '') 
	{
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please select Any Product.</div>');
		$('#product_info').focus();
		return false;
	}else if(request_message == '') 
	{
		$("#show_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please write your message.</div>');
		$('#request_message').focus();
		return false;
	}else { 	
		var postData = $("#product_form").serializeArray();
		console.log(postData);
		$.ajax(
		{
			url : global_url+"action.php",
			type: "POST",
			data : postData,
			beforeSend: function() {
			// setting a timeout
			$('#filter_loading').show();
			$('#forget-button').html('Loading...');	
			},
			success:function(data, textStatus, jqXHR) 
			{
					 //alert("==========>"+data);
					 
					 $("#show_response").html('');
					
				
					$('#filter_loading').hide();
					$("#alert-poup").css("display","block");
					$( "#alert-poup" ).delay(2000).fadeOut( 400 );
					$("#request-product-pop-up, #services-pop-up, .services-overlay").fadeOut();
					document.getElementById("product_form").reset();
					
					
			}
		});
		e.preventDefault();	
	}

});

//VENDOR REQUEST FORM
$("#vendor-button").click(function(e)
{
	//alert('hello');
	$("#vendor_response").show();
	
	name = $('#vendor_name').val();
	email = $('#vendor_email').val();
	phone = $('#vendor_phoneno').val();	
	request_message = $("#vendor_message").val();
	validname = validateText(name);
	validphone_no = validatePhone(phone);
	validemail = validateEmail(email);
	
	
		
	if(name == '') 
	{
		$("#vendor_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter Name in field.</div>');
		$('#vendor_name').focus();
		return false;
	} 
	else if (validname == false)
	{
		$("#vendor_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter valid name in field.</div>');
		$('#vendor_name').focus();
		return false;
	}else if(email == '') 
	{
		$("#vendor_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter email in field.</div>');
		$('#vendor_email').focus();
		return false;
	}
	else if (validemail == false){
		$("#vendor_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter valid email in field.</div>');
		$('#vendor_email').focus();
		return false;
	}else if(phone == '') {
		$("#vendor_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter phone no. in field.</div>');
		$('#vendor_phoneno').focus();
		return false;
	} 
	else if (validphone_no == false){
		$("#vendor_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please enter valid phone no. in field.</div>');
		$('#vendor_phoneno').focus();
		return false;
	}else if(request_message == '') 
	{
		$("#vendor_response").html('<div class="error_message"><i class="fa-exclamation-triangle fa"></i> Please write your message.</div>');
		$('#vendor_message').focus();
		return false;
	}else { 	
		var postData = $("#vendor_form").serializeArray();
		console.log(postData);
		$.ajax(
		{
			url : global_url+"action.php",
			type: "POST",
			data : postData,
			beforeSend: function() {
			// setting a timeout
			$('#filter_loading').show();
			$('#forget-button').html('Loading...');	
			},
			success:function(data, textStatus, jqXHR) 
			{
					alert("==========>"+data);					 
					$("#vendor_response").html('');				
					$('#filter_loading').hide();
					$("#popup-signup-vendor").css("display","none");
					$("#alert-poup").css("display","block");
					$( "#alert-poup" ).delay(2000).fadeOut( 400 );
					//$("#request-product-pop-up, #services-pop-up, .popup_inner").fadeOut();
					document.getElementById("vendor_form").reset();
					
					
			}
		});
		e.preventDefault();	
	}

});	
