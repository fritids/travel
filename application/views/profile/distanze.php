<script src="<?php echo JSPATH;?>jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function() { 
    
	var options = { 
        target:        '#hotel_paymentprofile_error_message',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback
    }; 
    // bind form using 'ajaxForm' 
    $('#payment_profile_form').ajaxForm(options); 
	
	var options2 = { 
        target:        '#account_profile_error_message',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback
    }; 
 
    // bind form using 'ajaxForm' 
    $('#account_profile_form').ajaxForm(options2);
    
    var options3 = { 
        target:        '#invoice_profile_error_message',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback
    }; 
 
    // bind form using 'ajaxForm' 
    $('#account_invoicing_form').ajaxForm(options2);
	
	var options4 = { 
        target:        '#save_struttura_message',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse_struttura  // post-submit callback
    }; 
 
    // bind form using 'ajaxForm' 
    $('#profile_edit_form').ajaxForm(options4);
	
	var options5 = { 
        target:        '#save_descrizione_message',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse_descrizione  // post-submit callback
    }; 
 
    // bind form using 'ajaxForm' 
    $('#profile_edit_form2').ajaxForm(options5);
	
	var options6 = { 
        target:        '#save_servizi_message',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse_servizi  // post-submit callback
    }; 
 
    // bind form using 'ajaxForm' 
    $('#profile_edit_form3').ajaxForm(options6);
	
	var options7 = { 
        target:        '#save_altro_message',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse_altro  // post-submit callback
    }; 
 
    // bind form using 'ajaxForm' 
    $('#profile_edit_form4').ajaxForm(options7);
	
	
}); 



// pre-submit callback 
function showRequest(formData, jqForm, options) { 
	return true; 
} 
 
// post-submit callback 

function showResponse_altro(responseText, statusText, xhr, $form){ 
		$("#save_altro_message").css("display","block");
		$("#save_altro_message").text(responseText);
		jQuery('html, body').animate({scrollTop:0}, 400);
		$("#save_altro_message").fadeOut(7000); 
	}
function showResponse_servizi(responseText, statusText, xhr, $form){ 
		$("#save_servizi_message").css("display","block");
		$("#save_servizi_message").text(responseText);
		jQuery('html, body').animate({scrollTop:0}, 400);
		$("#save_servizi_message").fadeOut(7000); 
	}
	
function showResponse_descrizione(responseText, statusText, xhr, $form){ 
		$("#save_descrizione_message").css("display","block");
		$("#save_descrizione_message").text(responseText);
		jQuery('html, body').animate({scrollTop:0}, 400);
		$("#save_descrizione_message").fadeOut(7000); 
	}
	
function showResponse_struttura(responseText, statusText, xhr, $form){ 
		$("#save_struttura_message").css("display","block");
		$("#save_struttura_message").text(responseText);
		jQuery('html, body').animate({scrollTop:0}, 400);
		$("#save_struttura_message").fadeOut(7000); 
	} 
function showResponse(responseText, statusText, xhr, $form){ 
	$("#profile_edit_message").css("display","block");
    $("#profile_edit_message").text(responseText);
    jQuery('html, body').animate({scrollTop:0}, 400);
	$("#profile_edit_message").fadeOut(7000); 
} 
</script>
<script type="text/javascript">
    $(function() {
        $( "#from" ).datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 1,
           dateFormat: 'dd-mm-yy',
            onSelect: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#to" ).datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 1,
			dateFormat: 'dd-mm-yy',

            onSelect: function( selectedDate ) {
                $( "#from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        function log( message ) {
            $( "<div>" ).text( message ).prependTo( "#log" );
            $( "#log" ).scrollTop( 0 );
        }
 
        $( "#city" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "http://ws.geonames.org/searchJSON",
                    dataType: "jsonp",
                    lang: "it",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term
                    },
                    success: function( data ) {
                        response( $.map( data.geonames, function( item ) {
                            return {
                                label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                                value: item.name
                            }
                        }));
                    }
                });
            },
            minLength: 2,
            select: function( event, ui ) {
                log( ui.item ?
                    "Selected: " + ui.item.label :
                    "Nothing selected, input was " + this.value);
            },
            open: function() {
                $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
            },
            close: function() {
                $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
            }
        });
    });
</script>

<script type="text/javascript">
  $(function() {
   
    var galleries = $('.ad-gallery').adGallery();
 
    
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );

  });
</script>


<script type="text/javascript">
    $(function() {
        $( document ).tooltip();
    });
</script>
<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>

<?php echo $this->template->block('PageTopPanel','layouts/_page_top_panel.php');?>

				<div class="clearfix-big"></div>

	<!-- 960 Container -->
<div class="container">

<div class="four columns">
    <?php echo $this->template->block('NormalUserSummary','dashboard/_normal_user_summary.php');?>

    	<?php echo $this->template->block('AddNewLastMinuteNotification','dashboard/_add_new_lastminute_notification.php'); ?>	
  <div class="clearfix-small"></div>
  
  <div id="default-example-info" class="background" data-collapse>
										                        <h5 class="open"><?php echo lang('information_profile_title_1');?></h5>
										                       <div>
										                       			<?php echo lang('information_profile_description_1');?>

										                       </div> 
										                       
										                       <h5><?php echo lang('information_profile_title_2');?></h5>
										                       <div>
										                       			<?php echo lang('information_profile_description_2');?>

										                       </div> 
										                       
										                        <h5><?php echo lang('information_profile_title_3');?></h5>
										                       <div>
										                       			<?php echo lang('information_profile_description_3');?>

										                       </div> 
										                       
										                       </div>
  
</div>
																							

			
							<?php if((isset($profile_details) && ($profile_details->is_complete==0 || $profile_details->invoice_profile_complete==0)) || isset($show_profile_notification)) { ?>
								<?php echo $this->template->block('UserProfileIncompleteNotification','dashboard/_complete_profile_notification.php');?>
                            <?php } ?>  
                            
                                                        
									<div class="twelve columns background">												
	
							
							
                            
                            <div style="margin-bottom:0px;">
								<div id="profile_edit_message" class="success_message" style="<?php if(isset($display_message) && $message!='') echo "display:block;"; ?>">
									<?php if(isset($display_message) && $message!='') echo $message; ?>
								</div>
							</div>
						
                            <ul class="tabs-nav-custom">
                            <?php if(isset($profile_details) && ($profile_details->user_type==1 || $profile_details->user_type==3)) { ?>
                                <li><a href="<?php echo base_url();?><?php echo $this->config->item('user_profile_profilo_edit_url');?>"><?php echo lang('struttura_profilo');?></a></li>
                                <li><a href="<?php echo base_url();?><?php echo $this->config->item('user_profile_descrizione_edit_url');?>"><?php echo lang('struttura_descrizione');?></a></li>
                                <li><a href="<?php echo base_url();?><?php echo $this->config->item('user_profile_servizi_edit_url');?>"><?php echo lang('struttura_servizi');?></a></li>
                                <li class="active"><a href="<?php echo base_url();?><?php echo $this->config->item('user_profile_distanze_edit_url');?>"><?php echo lang('struttura_distanze');?></a></li>
                                <li><a href="<?php echo base_url();?><?php echo $this->config->item('user_profile_immagini_edit_url');?>"><?php echo lang('struttura_Immagini');?></a></li>
                            <?php } else { ?>   
                             	<li class="active"><a href="#tab1"><?php echo lang('edit_profile');?></a></li>
                            <?php } ?>
                            </ul>

							<!-- Tabs Content -->
							<div class="tabs-container">
									 	<div class="tab-content" id="tab4">	
											<div class="padding">
											<form id="profile_edit_form4" style="width:660px;" name="profile-edit-form" method="post" action="<?php echo base_url();?><?php echo $this->config->item('save_altro_url');?>">    
												<?php echo $this->template->block('Altro','profile/hotel_profile_form_parts/Altro.php');?>
											</form>                
											</div>
										<div class="clearfix-big"></div>
										</div>
							</div>
						</div>
						

						<div class="clearfix-big"></div>
				</div>
			</div>
		<!-- End Project Title-->
	</div>
	<!-- End 960 Container -->