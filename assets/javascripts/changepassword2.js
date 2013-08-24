var ajax_load = "<img class='loading' src='images/load.gif' alt='loading...' />";$(document).ready(function(){	//global vars	var changepassword_form = $("#login");
	var pass1 = $("#password");
	var pass1Info = $("#pass1Info");
	var pass2 = $("#retype_password");
	var pass2Info = $("#pass2Info");
	var check_new_password = false;
	var check_retype_password = false;
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);
	pass1.keyup(validatePass1);
	pass2.keyup(validatePass2);
	changepassword_form.submit(function(){
		check_new_password = validatePass1();
		check_retype_password = validatePass2();
		if(check_new_password & check_retype_password)
			return true;
		else
			return false;
	});
	function validatePass1(){
		//it's NOT valid
		if(pass1.val().length <6){
			//pass1.addClass("error");
			pass1Info.text("Password must be at least 6 characters.");
			pass1Info.removeClass("success");
			pass1Info.addClass("error");
			return false;
		}		else{						//pass1.removeClass("error");			pass1Info.text("Password is perfect!");			pass1Info.removeClass("error");			pass1Info.addClass("success");			validatePass2();			return true;		}	}	function validatePass2(){		if(pass2.val().length < 1){			pass2Info.removeClass("success");			pass2Info.text("Retype passwords doesn't match!");			pass2Info.addClass("error");			return false;		}		else if((pass1.val() != pass2.val()) ){			//pass2.addClass("error");			pass2Info.removeClass("success");			pass2Info.text("Retype passwords doesn't match!");			pass2Info.addClass("error");			return false;		}		else{			pass2Info.removeClass("error");			pass2Info.text("Retype password matched");			pass2Info.addClass("success");			return true;		}	}
});