// JavaScript Document		
$(document).ready(function(){
	
	$('#load_more_offer').each(function() {				
		$(this).click(function() {
										if(parseInt(offset)<=parseInt(total_offer)){
											//$('#loading_update_item_more').addClass('loading');
											var bodyContent = $.ajax({
																		url: CI.base_url + "lastminute/load_more_offer",
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
																				 
																				$('#offer_search_result').append(moredata).slideDown('slow');
																				//alert("here");
																				if(parseInt(offset)>=parseInt(total_offer)) 
																				$('#load_more_offer').text("Spiacenti, non ci sono altre offerte");
																				
																		}
											}).responseText;
											
										} 
										return false;
		});
	});	
	
	
	
	$('.item_like a').each(function() {				
		$(this).click(function() {					
			if(User.logged_id_username!=""){						
				var offer_id = $(this).attr("id");						
				//alert(offer_id);						
				var response = $.ajax({											
					url: CI.base_url+"offers/like_offer",											
					global: false,											
					type: "POST",											
					data: {	offer_id : offer_id},											
					dataType: "html",											
					async:false,											
					success: function(returndata){												
						//alert("ashish"+returndata);												
						returndata=$.trim(returndata);												
						if(returndata=="1"){													
							var span_id = "#total_like_offer_"+offer_id;													
							//alert(span_id);													
							var no_like = parseInt($(span_id).text());													
							no_like++;													
							var each_span = ".item_likes " + span_id;													
							$(each_span).each(function() {	$(this).text(no_like);});													
							var spantext_id="#likethisoffer_txt_"+offer_id;													
							var each_span_text = ".item_like " + spantext_id;													
							$(each_span_text).each(function() {	$(this).text("Non mi piace");});												
							}												
						else if(returndata=="0"){													
							var span_id = "#total_like_offer_"+offer_id;													
							//alert(span_id);													
							var no_like = parseInt($(span_id).text());													
							no_like--;													
							var each_span = ".item_likes " + span_id;													
							$(each_span).each(function() {	$(this).text(no_like); });													
							var spantext_id="#likethisoffer_txt_"+offer_id;													
							var each_span_text = ".item_like " + spantext_id;													
							$(each_span_text).each(function() {	$(this).text("Mi piace");});												
							}												
						else													
							alert(returndata);												
					}											
				}).responseText;												 
				return false;					
			}				
		});			
	});
});






/*

$('#load_more_item_dashboard').click(function(){
	$('#loading_update_item_more').addClass('loading');
	var bodyContent = $.ajax({
								url: baseurl+"dashboard/load_more_update/",
								global: false,
								type: "POST",
								data: {	dataoffset : offset, is_favourite: show_favourite_list_only},
								dataType: "html",
								async:false,
								success: function(moredata){
										//alert(offset);
										//alert(moredata);
									
									
										if(moredata!="")
										{offset = parseInt(offset)+parseInt(load_more_limit);}
										
										$('#loading_update_item_more').removeClass('loading');
										 
										$('#dashboard_item_list').append(moredata).slideDown('slow');
										if(show_favourite_list_only=="1")
										{
											//alert("there"); //for favourite match update
									 		if(moredata=="" || parseInt(offset)>=parseInt(total_favourite)) 
											$('.more_ajax').html("<div class='no_more_post_to_show'>Spiacenti, non ci sono altri aggiornamenti</div>");
										}
										else if(show_favourite_list_only=="2")
										{
											//alert("there"); for post's activity
									 		if(moredata=="" || parseInt(offset)>=parseInt(total_activity_on_posts)) 
											$('.more_ajax').html("<div class='no_more_post_to_show'>Spiacenti, non ci sono altri aggiornamenti</div>");
										}
										else if(show_favourite_list_only=="3")
										{
											//alert("there"); //for event activity
									 		if(moredata=="" || parseInt(offset)>=parseInt(total_activity_on_events)) 
											$('.more_ajax').html("<div class='no_more_post_to_show'>Spiacenti, non ci sono altri aggiornamenti</div>");
										}
										else
									 	{
											//alert("here");
											if(moredata=="" || parseInt(offset)>=parseInt(total_update)) 
											$('.more_ajax').html("<div class='no_more_post_to_show'>Spiacenti, non ci sono altri aggiornamenti</div>");
										}
										
									  }
								   }
							 ).responseText;
	
	return false;
});

*/