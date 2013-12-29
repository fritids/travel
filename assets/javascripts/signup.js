/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/
var ajax_load = "<img class='loading' src='images/load.gif' alt='loading...' />";
$(document).ready(function(){
	//global vars
	var form = $("#login");
	var name = $("#full_name");
	var nameInfo = $("#full_nameInfo");
	var username = $("#username");
	var usernameInfo = $("#usernameInfo");
	var email = $("#email");
	var emailInfo = $("#emailInfo");
	var pass1 = $("#password");
	var pass1Info = $("#pass1Info");
	var pass2 = $("#retype_password");
	var pass2Info = $("#pass2Info");
	//var message = $("#message");
	
	var check1 = false;
	var check2 = false;
	var check3 = false;
	var check4 = false;
	var check5 = false;
	var check6 = false;
	
	//On blur
	name.blur(validateName);
	username.blur(validateUsername);
	email.blur(validateEmail);
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);
	//On key press
	name.keyup(validateName);
	pass1.keyup(validatePass1);
	pass2.keyup(validatePass2);
	//message.keyup(validateMessage);
	//On Submitting
	form.submit(function(){
		check1=validateName();
		var check6=validateUsername();
		var check7=validateEmail();
		check4=validatePass1();
		check5=validatePass2();
		check6= validate_privacy_policy();
		if($('#account_type').val()=="1"){
			var check7 = true;
			if($('#invitation_code').val()=="" || $('#invitation_code').val()==null){
				check7=false;
				$("#invitation_codeInfo").text("codice");
				$("#invitation_codeInfo").css('color','red');
				$('#invitation_code').focus();
			}
			else{
				$("#invitation_codeInfo").text("This code will be sent to you via e-mail. Check your email address !");
				$("#invitation_codeInfo").css('color','#949494');
			}
			
			if( check1 && check2 && check3 && check4 && check5 && check6 && check7)
				return true;
			else
				return false;
		}
		else{
			if( check1 && check2 && check3 && check4 && check5 && check6)
				return true;
			else
				return false;
		}
	});
	
	function validate_privacy_policy(){
		if($('#accept_privacy_conditions').is(':checked')){
			$('#signup_error_message').hide();	
			return true;
		}
		else{
			$('#signup_error_message').show();
			$('#signup_error_message').text('Please accepts policy and terms.');
			return false;
		}
			
	}
	
	function isAlphanumeric(inputValue)  
 	{  
		var regexp = /^[a-zA-Z0-9-_]+$/;
		//alert(inputValue);
		if (inputValue.search(regexp) == -1)
    		return false;
		else
    		return true;
 	}
	
	
	function validateName(){
		//if it's NOT valid
		if(name.val().length < 3){
			//name.addClass("error");
			nameInfo.text("Use at least 3 letters");
			nameInfo.removeClass("success");
			nameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			//name.removeClass("error");
			nameInfo.text("Your name sounds great !");
			nameInfo.removeClass("error");
			nameInfo.addClass("success");
			return true;
		}
	}
	
	function validateUsername(){
		//if it's NOT valid
		if(username.val().length != 0 & isAlphanumeric(username.val())){
			//name.addClass("error");
			$.post(CI.base_url+"users/is_exist_username", {
        											username: username.val()
      											 }, function(response){
        																if(response=="1")
																			{
																				usernameInfo.text("Username available");
																				usernameInfo.removeClass("error");
																				usernameInfo.addClass("success");
																				//alert("return username true");
																				check2 = true;
																			}
																		else
																			{
																				usernameInfo.text("This username already exists !");
																				usernameInfo.removeClass("success");
																				usernameInfo.addClass("error");
																				check2 = false;
																			}
																		}
									);
			
			
			
		}
		//if it's valid
		else{
			//name.removeClass("error");
			usernameInfo.text("Invalid username !");
			usernameInfo.removeClass("success");
			usernameInfo.addClass("error");
			return false;
		}
	}
	
	//validation functions
	function validateEmail(){
		//testing regular expression
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			$.post(CI.base_url+"users/is_exist_email", {
        											email: a
      											 }, function(response){
        																if(response=="1")
																			{
																				//email.removeClass("error");
																				emailInfo.text("We will send you a confirmation email");
																				emailInfo.removeClass("error");
																				emailInfo.addClass("success");
																				//alert("return email true");
																				check3 = true;	
																			}
																		else
																			{
																				//email.removeClass("error");
																				emailInfo.html("Email already registered. You can <a href='"+baseurl+"user/login'>access your account</a> or <a href='"+baseurl+"user/recover'>reset your password</a>");
																				emailInfo.removeClass("success");
																				emailInfo.addClass("error");
																				check3 = false;	
																			}
																		});
			
			
		}
		//if it's NOT valid
		else{
			//email.addClass("error");
			emailInfo.text("Invalid Email !");
			emailInfo.removeClass("success");
			emailInfo.addClass("error");
			return false;
		}
	}
	
	function validatePass1(){
		var a = $("#password1");
		var b = $("#password2");

		//it's NOT valid
		if(pass1.val().length <6){
			//pass1.addClass("error");
			pass1Info.text("Use at least 6 characters for the password");
			pass1Info.removeClass("success");
			pass1Info.addClass("error");
			return false;
		}
		//it's valid
		else{			
			//pass1.removeClass("error");
			pass1Info.text("Your password seems OK.");
			pass1Info.removeClass("error");
			pass1Info.addClass("success");
			validatePass2();
			return true;
		}
	}
	function validatePass2(){
		var a = $("#password1");
		var b = $("#password2");
		//are NOT valid
		if(pass2.val().length < 1)
		{
			//alert("here");
			pass2Info.removeClass("success");
			pass2Info.text("Your retyped password not matched.");
			pass2Info.addClass("error");
			return false;
		}
		else if((pass1.val() != pass2.val()) ){
			//pass2.addClass("error");
			pass2Info.removeClass("success");
			pass2Info.text("Your retyped password not matched.");
			pass2Info.addClass("error");
			return false;
		}
		//are valid
		else{
			pass2Info.removeClass("error");
			pass2Info.text("Retyped password is OK.");
			pass2Info.addClass("success");
			return true;
		}
	}
});



