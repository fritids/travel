var ajax_load = "<img class='loading' src='images/load.gif' alt='loading...' />";
$(document).ready(function(){
	//global vars
	var form = $("#account_profile_form");
	var name = $("#full_name");
	var nameInfo = $("#full_nameInfo");
	var username = $("#username");
	var usernameInfo = $("#usernameInfo");
	var existing_username = $("#existing_username");
	
	var oldpassword = $("#old_password");
	var oldpassInfo = $("#old_pass_info");
	
	var pass1 = $("#new_password");
	var pass1Info = $("#new_password_info");
	
	var pass2 = $("#confirm_password");
	var pass2Info = $("#confirm_pass_info");
	
	var check1 = false;
	var check2 = false;
	
	var check3 = false;
	var check4 = false;
	var check5 = false;
	
	//On blur
	name.blur(validateName);
	name.keyup(validateName);
	username.blur(validateUsername);
	oldpassword.blur(validate_old_password);
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);
	//On key press

	pass1.keyup(validatePass1);
	pass2.keyup(validatePass2);
	//message.keyup(validateMessage);
	//On Submitting
	form.submit(function(){
		check1=validateName();
		var check6=validateUsername();
		var check7=validate_old_password();
		if(oldpassword.val().length != 0){
			check4=validatePass1();
			check5=validatePass2();
		}
		else{
			check4=true;
			check5=true;
		}
		if( check1 && check2 && check3 && check4 && check5){
			nameInfo.removeClass('success');
			pass1Info.removeClass('success');
			pass2Info.removeClass('success');
			return true;
		}
		else
			return false;
	});
	
	function isAlphanumeric(inputValue){  
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
			nameInfo.text(CI.use_3_letter_in_name_message);
			nameInfo.removeClass("success");
			nameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			//name.removeClass("error");
			nameInfo.text(CI.name_looks_good_message);
			nameInfo.removeClass("error");
			nameInfo.addClass("success");
			return true;
		}
	}
	
	function validateUsername(){
		if(existing_username.val()!= username.val()){
			if(username.val().length != 0 & isAlphanumeric(username.val())){
				$.post(CI.base_url+"users/is_exist_username", {
        											username: username.val()
      											 }, function(response){
        																if(response=="1"){
																				usernameInfo.text(CI.username_available_message);
																				usernameInfo.removeClass("error");
																				usernameInfo.addClass("success");
																				//alert("return username true");
																				check2 = true;
																		}
																		else{
																				usernameInfo.text(CI.username_already_exists_message);
																				usernameInfo.removeClass("success");
																				usernameInfo.addClass("error");
																				check2 = false;
																		}
													}
									);			
			}
			else{
				//name.removeClass("error");
				usernameInfo.text(CI.invalid_username_message);
				usernameInfo.removeClass("success");
				usernameInfo.addClass("error");
				return false;
			}
		}
		else{
			check2 = true;
			usernameInfo.text(CI.valid_username_message);
			usernameInfo.removeClass("error");
			usernameInfo.removeClass("success");
		}
	}
	
	function validate_old_password(){
		if(oldpassword.val().length != 0){
			//name.addClass("error");
			$.post(CI.base_url+"users/is_valid_old_password", {
        											old_password: oldpassword.val()
      											 }, function(response){
        																if(response=="0"){
																				oldpassInfo.text("");
																				oldpassInfo.removeClass("success");
																				oldpassInfo.removeClass("error");
																				check3 = true;
																		}
																		else{
																				oldpassInfo.text(CI.old_password_not_correct);
																				oldpassInfo.removeClass("success");
																				oldpassInfo.addClass("error");
																				check3 = false;
																			}
																		}
									);	
		}
		else{
			check3 = true;
		}
	}
	
	function validatePass1(){
		//it's NOT valid
		if(pass1.val().length <6){
			//pass1.addClass("error");
			pass1Info.text(CI.password_sugession_message);
			pass1Info.removeClass("success");
			pass1Info.addClass("error");
			return false;
		}
		//it's valid
		else{			
			//pass1.removeClass("error");
			pass1Info.text(CI.password_acceptable_message);
			pass1Info.removeClass("error");
			pass1Info.addClass("success");
			validatePass2();
			return true;
		}
	}
	
	function validatePass2(){
		//are NOT valid
		if(pass2.val().length < 1)
		{
			//alert("here");
			pass2Info.removeClass("success");
			pass2Info.text(CI.password_are_different_message);
			pass2Info.addClass("error");
			return false;
		}
		else if((pass1.val() != pass2.val()) ){
			//pass2.addClass("error");
			pass2Info.removeClass("success");
			pass2Info.text(CI.password_are_different_message);
			pass2Info.addClass("error");
			return false;
		}
		//are valid
		else{
			pass2Info.removeClass("error");
			pass2Info.text(CI.password_are_same_message);
			pass2Info.addClass("success");
			return true;
		}
	}
	
});