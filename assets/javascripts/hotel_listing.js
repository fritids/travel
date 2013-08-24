// JavaScript Document
		$(document).ready(function(){
			
			
			$('#load_more_hotels').each(function() {				
				$(this).click(function() {
							if(parseInt(offset)<=parseInt(total_hotels)){
								//$('#loading_update_item_more').addClass('loading');
								var bodyContent = $.ajax({
															url: CI.base_url + "hotels/load_more_hotels",
															global: false,
															type: "POST",
															data: {	dataoffset : offset},
															dataType: "html",
															async:false,
															success: function(moredata){
																	//alert(offset);
																	//alert(moredata);
																	if(moredata!="")
																	{offset = parseInt(offset) + parseInt(load_more_limit);}
																	
																	//$('#loading_update_item_more').removeClass('loading');
																	 
																	$('#all_hotel_lists').append(moredata).slideDown('slow');
																	//alert("here");
																	if(parseInt(offset)>=parseInt(total_hotels)) 
																	$('#load_more_hotels').text("Spiacenti, non ci sono altre alloggio");
																	
															}
								}).responseText;
								
							} 
							return false;
				});
			});	
			
			
			
			$('.follow_this_hotel a').each(function() {
				$(this).click(function() {
					if(User.logged_id_username!=""){
						var hotelprofile_id = $(this).attr("id");
						//alert(offer_id);
						var response = $.ajax({
											url: CI.base_url+"hotels/follow_profile",
											global: false,
											type: "POST",
											data: {	hotelprofile_id : hotelprofile_id},
											dataType: "html",
											async:false,
											success: function(returndata){
												//alert("ashish"+returndata);
												returndata=$.trim(returndata);
												if(returndata=="1"){
													var each_span_text = "#follow_this_hotel_text_"+hotelprofile_id;
													//alert(span_id);
													$(each_span_text).each(function() {
														$(this).text(CI.unfollow_this_hotel_text);
													});
												}
												else if(returndata=="0"){
													var each_span_text = "#follow_this_hotel_text_"+hotelprofile_id;
													$(each_span_text).each(function() {
														$(this).text(CI.follow_this_hotel_text);
													});
												}
												else
													alert(returndata);
												}
											}
										).responseText;			
									 return false;
					}
				});
			});
			
			
			
			
			
			$('.item_like a').each(function() {
				$(this).click(function() {
					if(User.logged_id_username!=""){
						var profile_id = $(this).attr("id");
						//alert(offer_id);
						var response = $.ajax({
											url: CI.base_url+"hotels/like_profile",
											global: false,
											type: "POST",
											data: {	profile_id : profile_id},
											dataType: "html",
											async:false,
											success: function(returndata){
												//alert("ashish"+returndata);
												returndata=$.trim(returndata);
												if(returndata=="1"){
													var span_id = "#total_like_profile_"+profile_id;
													//alert(span_id);
													var no_like = parseInt($(span_id).text());
													no_like++;
													var each_span = ".item_likes " + span_id;
													$(each_span).each(function() {
															$(this).text(no_like);
													});
													var spantext_id="#likethisprofile_txt_"+profile_id;
													var each_span_text = ".item_like " + spantext_id;
													$(each_span_text).each(function() {
														$(this).text("Non mi piace");
													});
												}
												else if(returndata=="0"){
													var span_id = "#total_like_profile_"+profile_id;
													//alert(span_id);
													var no_like = parseInt($(span_id).text());
													no_like--;
													var each_span = ".item_likes " + span_id;
													$(each_span).each(function() {
														$(this).text(no_like);
													});
													var spantext_id="#likethisprofile_txt_"+profile_id;
													var each_span_text = ".item_like " + spantext_id;
													$(each_span_text).each(function() {
														$(this).text("Mi piace");
													});
												}
												else
													alert(returndata);
												}
											}
										).responseText;			
									 return false;
					}
				});
			});
			
			
			
			
			
			
			$('#comment_textbox').each(function(){
				$(this).focus(function(){
					$(this).animate({ height: '60px' }, 80); 
				});
			});
			
			 $('#post_new_comments').ajaxForm({ beforeSubmit: validate_comment_data, 
										 		async:false,
                                        		success: function(data) {
                                            	$('#ajax_loading_indication').removeClass('loading');
                                            	$('#comment_textbox').val("");
												returndata=$.trim(data);
												if(data=="" || data==null){
                                                	window.location=baseurl+'users/login';
												}
												else if(returndata=="0")
													alert("Sorry, you don't have permission to comment on this post.");
                                            	else{
                                                    $(data).hide().insertBefore('#comments_list li:first').slideDown('fast');
                                                    var no_comments = parseInt($("#total_comments_in_a_hotel").text());
                                                    no_comments++;
                                                    $("#total_comments_in_a_post").text(no_comments);   
                                               	}
                                        }
                                    });
});
		
function validate_comment_data(){
	if($('#comment_textbox').val()==""){
		alert("Se scrivi qualcosa è meglio!");
		return false;
	}
	else{
		$('#ajax_loading_indication').addClass('loading');
		return true;
	}
	return false;				
}
		
