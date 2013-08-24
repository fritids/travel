$(document).ready(function(){
	
	/* ============ FORM LABEL HANDLING  ==================== */
    
$("form.main_style input, form.main_style textarea, div.topbar form input, form#update_match_post input").each(function () {
    	
    if($(this).val() != "") {
    	$(this).prev(".inlined").hide();
    } 
    
    $(this).prev("label.inlined").click(function(){
    	$(this).next("input, textarea").focus();
    });
    
    $(this).focus(function () {
    	if($(this).val() == "") {
    		$(this).prev(".inlined").fadeTo(200, 0.45);
    	}
    });
     
    $(this).keypress(function () {
    	$(this).prev(".inlined").hide();
    });
     
    $(this).blur(function () {
    	if($(this).val() == "") {
    		$(this).prev(".inlined").fadeTo(200, 1);
    	}
    });

    
});
	if($('#date_picker_popup').val() != "") {
    	$('#date_picker_popup').prev("label").hide();
    }

	$('#fd-but-date_picker_popup').click(function(){
    	$('#date_picker_popup').prev("label").stop().fadeOut();
    	$('#date_picker_popup').focus();
    });
    $('#date_picker_popup').focus(function () {
    	if($(this).val() == "") {
    		$(this).prev("label").fadeTo(200, 0.45);;
    	}
    });
    
    $('#date_picker_popup').blur(function () {
    	if($(this).val() == "") {
    		$(this).prev("label").fadeTo(200, 1);
    	}
    });
    $('#date_picker_popup').keypress(function () {
    	$(this).prev("label").hide();
    });
    
    /* ============ SHOW/HIDE VALTUE ATTRIBUTE  ==================== */
    
    if($("#searchform input").val() == "") $("#searchform input").attr("value", "cerca...");

	$("#searchform input").focus(function() {
		if($(this).val() == "cerca...") $(this).attr("value", "");
	});

	$("#searchform input").blur(function() {
		if($(this).val() == "") $(this).attr("value", "cerca...");
	});
	
	
	// load popup script
	initPopups();
	
	/*$('#user_avatar, #guestteamlogo, #home_logo_popup, #guestteamlogo_page, #hometeamlogo_page').filestyle({ 
     image: "http://www.foooblr.com/assets/images/load_file.png",
     imageheight : 22,
     imagewidth : 57,
     width : 120
 });
	//$('#guestteamlogo_page input').customFileInput();
	*/
	
    
});