/* Author: Piervincenzo Madeo

*/

//create post and match popup form
$('.first_login_action_match').click(function(){
	var open_match = $("div.open_match");
	var is_open = $(open_match).css("display");
		if (is_open == "none"){
			$(open_match).fadeOut()
			$(open_match).stop().fadeIn();
		}
		return false;
});
$('.first_login_action_post').click(function(){
	var open_post = $("div.open_post");
	var is_open = $(open_post).css("display");
		if (is_open == "none"){
			$(open_post).fadeOut()
			$(open_post).stop().fadeIn();
		}
		return false;
});
$('.popup_form').each(function(){
	
	var open_box = $("div.create_box");
	
	$(this).click(function(){
		var is_open = $(this).next(open_box).css("display");
		if (is_open == "none"){
			$(open_box).fadeOut();
			$(this).next(open_box).stop().fadeIn();
		}
		return false;
	});
	$('.create_box_head a.close').click(function(){
		$(open_box).fadeOut();
		return false;
	});
   /* $(document).mousedown(function(event) {
    	var is_open
        switch (event.which) {
            case 1:
                $(open_box).fadeOut("fast");
                break;
            case 2:
                $(open_box).fadeOut("fast");
                break;
            case 3:
                return false;
                break;
        }
    });*/
    $(open_box).mousedown(function(event) {
        switch (event.which) {
            case 1:
                event.stopPropagation();
                break;
            case 2:
                event.stopPropagation();
                break;
            case 3:
                return false;
                break;
        }
    });
    $(open_box).mouseup(function(event) {
        switch (event.which) {
            case 1:
                event.stopPropagation();
                break;
            case 2:
                event.stopPropagation();
                break;
            case 3:
                return false;
                break;
        }
    });
	
});

//create post not required input fields

$('a.add_image').click(function(){
	$(this).toggleClass('add_active');
	$('form#post_popup .upload_box').fadeToggle();
	return false;
});
$('a.add_link').click(function(){
	$(this).toggleClass('add_active');
	$('form.create_post_popup .related_url_p').fadeToggle();
	return false;
});
$('a.add_tag').click(function(){
	$(this).toggleClass('add_active');
	$('form.create_post_popup .post_tags_p').fadeToggle();
	return false;
});
$('.add_field a').click(function(){
	$(this).parent().next('div').fadeToggle();
	return false;
});
$('a.add_logo').click(function(){
	$(this).toggleClass('add_active');
	$('form#match_popup .upload_box').fadeToggle();
	return false;
});

//Tags input style
$('#post_tags_2').tagsInput({
   'height':'100px',
   'width':'350px',
   'unique':true,
   'defaultText':'add a tag'
});
$('#post_tags_popup').tagsInput({
   'height':'32px',
   'width':'392px',
   'unique':true,
   'defaultText':'Tags'
});

// radio buttons add event

var event_check = $("form#update_match_post .event_check label");
var event_check_input = $("input[name='event']");
$(event_check_input).removeAttr('checked');
$(event_check).click(function(e){
	e.preventDefault();
	var check = $(this).children(event_check_input).is(':checked');
	if(check) {
		$(event_check_input).removeAttr('checked');
		$(this).children(event_check_input).removeAttr('checked');	
		$(this).css({'background-color' : 'transparent'});		
		$('form#update_match_post .event_player_cont').fadeOut();
		return;
	}
		$(event_check_input).removeAttr('checked');
		$(this).children(event_check_input).attr('checked', true);	
		$(event_check).css({'background-color' : 'transparent'});
		$(this).css({'background-color' : '#fff'});
		$('form#update_match_post .event_player_cont').fadeIn();
});

var team_check = $("form#update_match_post .team_check label");
var team_check_input = $("input[name='team_radio']");
$(team_check_input).removeAttr('checked');
$(team_check).click(function(e){
	e.preventDefault();
	var check = $(this).children(team_check_input).is(':checked');
	if(check) {
		$(team_check_input).removeAttr('checked');
		$(this).children(team_check_input).removeAttr('checked');	
		$(this).css({'background-color' : 'transparent', 'color': '#949494', 'border': '1px solid #eee'});
		return;
	}
		$(team_check_input).removeAttr('checked');
		$(this).children(team_check_input).attr('checked', true);	
		$(team_check).css({'background-color' : 'transparent', 'color': '#949494', 'border': '1px solid #eee'});
		$(this).css({'background-color' : '#BDDC6F', 'color' : '#fff', 'border': '1px solid #9ba965'});
});


// What's happening in the match form
$('.update_editor').each(function(){
	$(this).val('');
	//$("#post_now_update").attr("disabled", true); //changed by ashish .post_now to #post_now_update
	$(this).focus(function(){
	    $(this).animate({ height: '60px' }, 80); 
   	});
    var init_length = 340 - $(this).val().length;
    var count = $('.chars_counter');
    $(count).val(init_length);
    $(this).keyup(function(){  
        var new_length = 340 - $(this).val().length;
        $(count).val( new_length );
        //$("#post_now_update").removeAttr('disabled'); //changed by ashish .post_now to #post_now_update 
    });  
}); 
$('#comment_cont, #new_comment_reply textarea').each(function(){
$(this).focus(function(){
	    $(this).animate({ height: '60px' }, 80); 
 });
 });

$('.time_counter').each(function(){
	if($(this).val() == "" || $(this).val() < 1) { //add the <1 condition by ashish
		$(this).val("1'"); 
	}
	$(this).focus(function(){
	    $(this).val(''); 
   	});
   	$(this).blur(function(){
   		var new_val = $(this).val();
   		if($(this).val() == "" || $(this).val() < 1) { //add the <1 condition by ashish
			$(this).val("1'"); 
		} else {
	    	$(this).val( new_val + "'"); 
	    }
   	});
});

// Delete icon and popup single match
$('.delete_ico_js').each(function(){
	$(this).hover(
		function(){
			$(this).find('.delete a.del').stop().show();
		},
		function(){
			$(this).find('.delete a.del').stop().hide();
		}
	);
});
$('.delete a.del, .flag a, .delete_toolbar, .end_of_the_match .del').live("click", function(e){ /* ashish remove the class .deactivate a, */
		e.preventDefault();
		$('.popover').fadeOut();
		$(this).next().fadeIn();		
});
$('a.no, .popover a.close').live("click", function() {
		$('.popover').hide();
		return false;
});

/*$('.add_event_launcher').mouseover(function(){
	$(this).next().fadeIn('fast');
});

$('.event_toolbar').mouseleave(function(){
	if(!$("input[type='radio']").is(':checked')){
	$(this).find(".check_list_event").fadeOut('fast');
	}
});*/
$("a[rel=twipsy], .event_check label, input.time_counter, .min span, .team_check label, .end_of_the_match .del, .match_archive, .match_archived").twipsy({delayIn:80,offset: 2});
$(".time_container_popup").twipsy({delayIn:80,offset: -15});





// match update on dashboard part

$(".live_match_headline h4 a").each(function() {
$(this).hover(function(){
	$(this).children().fadeIn(80);
},function(){
	$("span.likes, span.comments").fadeOut(80);
});

});

$(window).scroll(function(){
        var distance = 1350 - $(window).height();
 
        if  ($(window).scrollTop() > distance)
            $('.back_to_top').animate({'right':'0px'},300);
        else
            $('.back_to_top').stop(true).animate({'right':'-430px'},100);
    });
 
    $('.back_to_top a').bind('click',function(){
        $('html, body').animate({scrollTop:0}, 'fast');
        return false;
});

$(".live_match_update a").each(function(){
var form_an = $(this).parent().parent().next(".match_update_form");
var close_up_but = form_an.children().children().children("a.close"); 
$(this).click(function(){
	form_an.slideDown(150);
	return false;
});
close_up_but.click(function(){
	form_an.slideUp(150);
	return false;
});
});

$(".dashboard_item").live({
  mouseenter: function() {
    $(this).children("ul.item_toolbar").fadeIn(250);
  },
  mouseleave: function() {
    $(this).children("ul.item_toolbar").fadeOut(150);
  }
});


   
