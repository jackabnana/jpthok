var global_url = 'http://localhost/ezdayshop/';
var global_vendor_url = 'http://localhost/ezdayshop/vendor/';

//var global_url = 'http://www.ezdayshop.com/';
//var global_vendor_url = 'http://www.ezdayshop.com/vendor/';

//Email
function validateEmail(emailAddress) 
{
	var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
	//alert( pattern.test(emailAddress) );
	return pattern.test(emailAddress);
}

//Phone No.
function validatePhone(txtPhone) 
{
	var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
	if (filter.test(txtPhone)  && txtPhone.length == '10' && txtPhone[0] == '9' || txtPhone[0] == '8' || txtPhone[0] == '7' ) 
	{
		return true;
	}
	else 
	{
		return false;
	}
}

 //Text Only
function validateText(txtText) 
{
	var filter = /^[A-Za-z]/;
	if (filter.test(txtText)) {
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
				success:function(response, textStatus, jqXHR) 
				{
					  	 
					var obj = $.parseJSON(response);
					var pin = obj['active'];

					if(obj['active'] == 'yes')
					{
						
						
						
						if(obj['cod_available'] == 'COD')
						{
							$('#login-response').html('<div class="mgs success col-md-100"> Devilery is available at this pincode.</div>');
							
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
							
							
							$('#login-response').html('<div class="mgs success col-md-100"> Online Payment is available at this pincode.</div>');
						}
						
					} 
					else
					{
						
						$('#login-response').html('<div class="mgs error col-md-100"> Devilery is not available at this pincode. Please try with another...</div>');
					}
						
					$('#available_pin').val(pin);
					
				}
			});
		}
		else
		{
			
			$('#login-response').html('<div class="mgs error col-md-100"> Please try with correct pincode.</div>');
			$('#available_pin').val('no');
		}
}		



$("#step_one").click(function(e)
{
	
	    var full_name = $("#full_name").val();
	    var email = $('#email').val();
		var password = $('#password').val();
		var mobile = $("#mobile").val();
		var pincode = $("#pincode").val();

		validemail = validateEmail(email);
		validfname = validateText(full_name);
		validphone = validatePhone(mobile);
		
		var available_pin = $('#available_pin').val();
		
		check_reg_terms = $('input[name=check_reg_terms]:checked').length;
		
		
		if(full_name=='')
		{
			
			$("#login-response").html('<div class="mgs error col-md-40">Please enter full name in field.</div>');
			$('#full_name').focus();
			return false;
		}
		else if(validfname == false)
		{
			$("#login-response").html('<div class="mgs error col-md-40">Please enter valid full name.</div>');
			$('#full_name').focus();
			return false;
		}
		else if(email == '') 
		{
			$("#login-response").html('<div class="mgs error col-md-40">Please enter email in field.</div>');
			$('#email').focus();
			return false;
		} 
		else if (validemail == false)
		{
			$("#login-response").html('<div class="mgs error col-md-40">Please enter valid email in field.</div>');
			$('#email').focus();
			return false;
		} 
		else if (password == '')
		{
			$("#login-response").html('<div class="mgs error col-md-40">Please enter password.</div>');
			$('#password').focus();
			return false;
		}
        else if(mobile == '') 
		{
			$("#login-response").html('<div class="mgs error col-md-40">Please enter mobile in field.</div>');
			$('#mobile').focus();
			return false;
		} 
		else if (validphone == false)
		{
			$("#login-response").html('<div class="mgs error col-md-40">Please enter valid mobile in field.</div>');
			$('#mobile').focus();
			return false;
		}
        else if(pincode=='')
		{
			$("#login-response").html('<div class="mgs error col-md-40">Please enter pincode in field.</div>');
			$('#pincode').focus();
			return false;
		}
        else if(available_pin == 'no')
		{
				
			$("#form-response").html('<div class="mgs error col-md-100"> Devilery is not available at this pincode. Please try with another.</div>');
			$('#pincode').focus();
			return false;
		}else if(check_reg_terms <=0){
			$("#login-response").html('<div class="mgs error col-md-100"> Please accept our terms</div>');
			$('#check_reg_terms').focus();
			return false;			
		}			
		else 
		{ 	
			var postData = $("#form_first").serializeArray();
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
					//alert('==========================>'+data);
					$("#login-response").html(data);
					
					//$('#loading').hide();	
					//$("#login-response").html(data);
				}
			});
			e.preventDefault();	
		}
	
	
});	

$("#step_two").click(function(e)
{
	
	    var username = $("#username").val();
	    var user_password = $('#user_password').val();
		
		if(username =='')
		{
			
			$("#login_response").html('<div class="mgs error col-md-40">Please enter user name in field.</div>');
			$('#username').focus();
			return false;
		}
		else if(user_password == '') 
		{
			$("#login_response").html('<div class="mgs error col-md-40">Please enter password in field.</div>');
			$('#user_password').focus();
			return false;
		} 
		else 
		{ 	
			var postData = $("#login_form").serializeArray();
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
					
					 //alert(data);
					 $('#loading').hide();	
					
					if(data == 'success')
					{
						window.location.href = global_vendor_url+"index.php";
					}
				 	else
					{
						$("#login_response").html('<div class="mgs error col-md-40">ERROR: Invalid details.</div>');
					}
					
					
					
					//$("#login-response").html(data);
				}
			});
			e.preventDefault();	
		}
	
	
});	



function validatePan(str)
{
	
	var filter =  /(^([A-Z]{5})([0-9]{4})([A-Z]{1})$)/;
	
	if(filter.test(str))
	{
		return true;
	}
    else
	{
		return false;
	}	
	
}
// Available Pincode
function check_ifsc(str) 
{
	    if(str.length == 11)
		{
	 
			//console.log(postData);
			$.ajax(
			{
				url : global_url+"action.php",
				type: "POST",
				data:'ifsc_code_check='+str,
				beforeSend: function() {
				 // setting a timeout
				  $('#filter_loading').show();	
				},
				success:function(data, textStatus, jqXHR) 
				{
				alert(data);	
				 $('#filter_loading').hide();	
				  
				 var obj = $.parseJSON(data);
					
					if(obj['status'] == 'success')
					{
						
						
							$('#bank_name').val(obj['bank']);
							$('#state').val(obj['state']);
							$('#city').val(obj['city']);
							$('#branch').val(obj['branch']);
							$(".error").html('');
					} 
					else
					{
						
						$('#bank_response').html('<div class="mgs error col-md-100"> Ifsc code is not correct. Please try with another.</div>');
						$('#bank_name').val('');
						$('#state').val('');
						$('#city').val('');
						$('#branch').val('');
					}
						
					//$('#ifsc_code').val(pin);
				
					
				}
			});
		}
		else
		{
			//alert('wrong');
			
			$('#bank_response').html('<div class="mgs error col-md-100"> Please try with correct ifsc code.</div>');
			$('#bank_name').val('');
			$('#state').val('');
			$('#city').val('');
			$('#branch').val('');
			
		}
}		
$(document).ready(function (e) 
{
	$("#buss_form").on('submit',(function(e) 
	{	
	
		var buss_name = $("#buss_name").val();
		var pan_card = $("#pan_card").val();
		var validPan = validatePan(pan_card);
		var pan_card_file = $("#pan_card_file").val();
		var pan_image = $("#pan_image").val();
		var tin_vat = $("#tin_vat").val();
		var tin_vat_file = $("#tin_vat_file").val();
		var tan = $("#tan").val();
		var tan_file = $("#tan_file").val();
	
	
	    if(buss_name =='')
		{
			$("#buss_response").html('<div class="mgs error col-md-40">Please enter business name in field.</div>');
			$('#buss_name').focus();
			return false;
			
		}
	    else if(pan_card == '')
		{
			
			$("#buss_response").html('<div class="mgs error col-md-40">Please enter Pan number in field.</div>');
			$('#pan_card').focus();
			return false;
		}
		else if(validPan == false)
		{
			$("#buss_response").html('<div class="mgs error col-md-40">Please enter valid pan number.</div>');
			$('#pan_card').focus();
			return false;
		}
	    else if(pan_image == '' && pan_card_file == '')
		{
				$("#buss_response").html('<div class="mgs error col-md-40">Please upload pan card image.</div>');
				$('#pan_card_file').focus();
				return false;
		}		
		else if(!$("#vat_check").is(':checked'))
		{
				if(tin_vat == '')
				{
					$("#buss_response").html('<div class="mgs error col-md-40">Please enter TIN/VAT number.</div>');
					$('#tin_vat').focus();
					return false;
				}
				else if(tin_vat_file=='')
				{
					$("#buss_response").html('<div class="mgs error col-md-40">Please upload TIN/VAT  image.</div>');
					$('#tin_vat_file').focus();
					return false;
					
				}
				else if(!$("#tan_check").is(':checked'))
				{
   
					if(tan == '')
					{
						$("#buss_response").html('<div class="mgs error col-md-40">Please enter Tan number.</div>');
						$('#tan').focus();
						return false;
					}
					else if(tan_file=='')
					{
						
						$("#buss_response").html('<div class="mgs error col-md-40">Please upload Tan card image.</div>');
						$('#tan_file').focus();
						return false;
						
					}
					
						e.preventDefault();
						$.ajax(
						{
						url: global_url+"action.php",
						type: "POST",
						data:  new FormData(this),
						contentType: false,
						cache: false,
						processData:false,
						beforeSend: function() 
						{
						$('#loading').show();
						},
						success: function(data)
						{
						//alert(data);
						$('#loading').hide();
						$("#buss_response").addClass("success");
						$("#buss_response").html(data);
						$('#buss_form')[0].reset();
						setTimeout(function() { window.location.reload(true); }, 2000); 

						}	        
						});
						
				}

						e.preventDefault();
						$.ajax(
						{
						url: global_url+"action.php",
						type: "POST",
						data:  new FormData(this),
						contentType: false,
						cache: false,
						processData:false,
						beforeSend: function() 
						{
						$('#loading').show();
						},
						success: function(data)
						{
						//alert(data);
						$('#loading').hide();
						$("#buss_response").addClass("success");
						$("#buss_response").html(data);
						$('#buss_form')[0].reset();
						setTimeout(function() { window.location.reload(true); }, 2000); 

						}	        
						});		
		}
		else if(!$("#tan_check").is(':checked'))
		{

			if(tan == '')
			{
				$("#buss_response").html('<div class="mgs error col-md-40">Please enter Tan number.</div>');
				$('#tan').focus();
				return false;
			}
			else if(tan_file=='')
			{
				
				$("#buss_response").html('<div class="mgs error col-md-40">Please upload Tan card image.</div>');
				$('#tan_file').focus();
				return false;
				
			}
			
					e.preventDefault();
					$.ajax(
					{
					url: global_url+"action.php",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function() 
					{
					$('#loading').show();
					},
					success: function(data)
					{
					//alert(data);
					$('#loading').hide();
					$("#buss_response").addClass("success");
					$("#buss_response").html(data);
					$('#buss_form')[0].reset();
					setTimeout(function() { window.location.reload(true); }, 2000); 

					}	        
					});
				
		}
		else
		{
			
				e.preventDefault();
				$.ajax(
				{
				url: global_url+"action.php",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function() 
				{
					$('#loading').show();
				},
				success: function(data)
				{
					//alert(data);
					$('#loading').hide();
					$("#buss_response").addClass("success");
					$("#buss_response").html(data);
					$('#buss_form')[0].reset();
					setTimeout(function() { window.location.reload(true); }, 2000); 
					
				}	        
			});
		}
		
		
	}));
});


$(document).ready(function (e) 
{
	$("#bank_form").on('submit',(function(e) 
	{	
	
		var account_name = $("#account_name").val();
		var account_no = $("#account_no").val();
		var retype_account_no = $("#retype_account_no").val();
		var ifsc_code = $("#ifsc_code").val();
		var bank_name = $("#bank_name").val();
		
	
	
	    if(account_name =='')
		{
			$("#bank_response").html('<div class="mgs error col-md-40">Please enter account name in field.</div>');
			$('#account_name').focus();
			return false;
		}
	    else if(account_no =='')
		{
			$("#bank_response").html('<div class="mgs error col-md-40">Please enter account number in field.</div>');
			$('#account_no').focus();
			return false;
		}
		else if(retype_account_no == '')
		{
			$("#bank_response").html('<div class="mgs error col-md-40">Please enter retype account number.</div>');
			$('#retype_account_no').focus();
			return false;
		}
		else if(account_no != retype_account_no)
		{
			
			$("#bank_response").html('<div class="mgs error col-md-40">Please enter valid retype account number.</div>');
			$('#pan_card').focus();
			return false;
			
		}
		else if (ifsc_code == '')
		{
			$("#bank_response").html('<div class="mgs error col-md-40">Please enter IFSC code .</div>');
			$('#ifsc_code').focus();
			return false;
					
		}
		
		else if (bank_name == '')
	    {
			$("#bank_response").html('<div class="mgs error col-md-40">Please enter valid IFSC code .</div>');
			$('#ifsc_code').focus();
			return false;
				
		}
		else
		{
			
				e.preventDefault();
				$.ajax(
				{
					url: global_url+"action.php",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function() 
					{
						$('#loading').show();
					},
					success: function(data)
					{
						$('#loading').hide();
						$("#bank_response").addClass("success");
						$("#bank_response").html(data);
						$('#bank_form')[0].reset();
						
						setTimeout(function() { window.location.reload(true); }, 3000); 
						
					}	        
				});
			
		}
		
		
	}));
});
$(document).ready(function (e) 
{
	$("#store_form").on('submit',(function(e) 
	{	
	
		var dis_name = $("#dis_name").val();
		var description = $("#description").val();
		
	
	
	    if(dis_name =='')
		{
			$("#store_response").html('<div class="mgs error col-md-40">Please enter store name in field.</div>');
			$('#dis_name').focus();
			return false;
			
		}
	    else if(description =='')
		{
			
			$("#store_response").html('<div class="mgs error col-md-40">Please enter store description in field.</div>');
			$('#description').focus();
			return false;
		}
		else
		{
			
				e.preventDefault();
				$.ajax(
				{
					url: global_url+"action.php",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function() 
					{
						$('#loading').show();
					},
					success: function(data)
					{
						//alert(data);
						
						$('#loading').hide();
						$("#store_response").addClass("success");
						$("#store_response").html(data);
						$('#store_form')[0].reset();
						setTimeout(function() { window.location.reload(true); }, 3000); 
						
					}	        
				});
			
		}
		
		
	}));
});



function business_details()
{
	$("#step-3").show();
	$(".popup").show();
}
$("#login_close_buss").click(function(e)
{

	$("#step-3").hide();
	$(".popup").hide();
});


function get_vat_tin()
{

	if ($("#vat_check").is(':checked'))
	{
		
		  $("#check1").show();
	}
	else
	{
		  $("#check1").hide();
	}
}
function get_tan()
{
	
	if ($("#tan_check").is(':checked'))
	{
		
		  $("#check2").show();
	}
	else
	{
		  $("#check2").hide();
	}
	
}




