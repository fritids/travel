/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/
var ajax_load = "<img class='loading' src='images/load.gif' alt='loading...' />";
$(document).ready(function(){
	//global vars
	
	var changepassword_form = $("#change_password");
	var pass0 = $("#old_password");
	var pass0Info = $("#pass0Info");
	var pass1 = $("#password");
	var pass1Info = $("#pass1Info");
	var pass2 = $("#retype_password");
	var pass2Info = $("#pass2Info");
	var check_old_password = false;
	var check_new_password = false;
	var check_retype_password = false;
	
	pass0.blur(validateOldpassword);
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);
	
	pass1.keyup(validatePass1);
	pass2.keyup(validatePass2);
	
	changepassword_form.submit(function(){
		var just_check = validateOldpassword();
		check_new_password = validatePass1();
		check_retype_password = validatePass2();
		if(check_old_password & check_new_password & check_retype_password)
			return true;
		else
			return false;
	});
	
	function validateOldpassword(){
		//if it's NOT valid
		if(pass0.val().length > 0){
			//name.addClass("error");
			$.post(baseurl+"account/changepassword/validate_old_password_by_ajax", {
        											old_password: pass0.val()
      											 }, function(response){
																		if(response=="1")
																			{
																				pass0Info.text("Old Password is perfect!");
																				pass0Info.removeClass("error");
																				pass0Info.addClass("success");
																				//alert("assign");
																				check_old_password = true;
																			}
																		else
																			{
																				pass0Info.text("Old Password not matched!");
																				pass0Info.removeClass("success");
																				pass0Info.addClass("error");
																				//alert("return username true");
																				check_old_password = false;
																			}
																		}
									);
			
			
			
		}
		//if it's valid
		else{
			//name.removeClass("error");
			pass0Info.text("Old Password not be left blank!");
			pass0Info.removeClass("success");
			pass0Info.addClass("error");
			return false;
		}
	}
	
	function validatePass1(){
		var a = $("#password1");
		var b = $("#password2");

		//it's NOT valid
		if(pass1.val().length <6){
			//pass1.addClass("error");
			pass1Info.text("Password must be at least 6 characters.");
			pass1Info.removeClass("success");
			pass1Info.addClass("error");
			return false;
		}
		//it's valid
		else{			
			//pass1.removeClass("error");
			pass1Info.text("Password is perfect!");
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
			return false;
		}
		else if((pass1.val() != pass2.val()) ){
			//pass2.addClass("error");
			pass2Info.removeClass("success");
			pass2Info.text("Retype passwords doesn't match!");
			pass2Info.addClass("error");
			return false;
		}
		//are valid
		else{
			pass2Info.removeClass("error");
			pass2Info.text("Retype password matched");
			pass2Info.addClass("success");
			return true;
		}
	}
	
});