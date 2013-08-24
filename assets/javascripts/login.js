var ajax_load = "<img class='loading' src='../images/load.gif' alt='loading...' />";

$(document).ready(function(){
	//global vars
	var form = $("#login");
	var signinusername = $("#username_email");
	var signinpassword = $("#password");
	
	signinusername.blur(validate_login_username);
	signinpassword.blur(validate_login_password);

	form.submit(function(){
		var check1 = validate_login_username();
		var check2 = validate_login_password(); 
		if( check1 && check2 )
			return true;
		else
			return false;
	});
	
	function validate_login_username(){
		var v_return
		if($('#username_email').val()==''){
			$("#login_username_error").text(CI.login_username_email_blank);
			$("#login_username_error").addClass("error");
			v_return = false;
		}
		else{
			$("#login_username_error").html("&nbsp;");
			$("#login_username_error").removeClass("error");
			v_return = true;
		}
		return v_return;
	}

	function validate_login_password(){
		var v_return;
		if($('#password').val()==''){
			$("#login_password_error").text(CI.login_password_blank);
			$("#login_password_error").addClass("error");
			v_return = false;
		}
		else{
			$("#login_password_error").html("&nbsp;");
			$("#login_password_error").removeClass("error");
			v_return = true;
		}
		return v_return;
	}
	
	function validate_email(email_address)
	{
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		if(filter.test(email_address)){
			return true;
		}
		else{
			return false;
		}
	}
	
	function is_numeric(input){
		return !isNaN(input);
	 }


});







