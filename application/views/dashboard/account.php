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
}); 



// pre-submit callback 
function showRequest(formData, jqForm, options) { 
	return true; 
} 
 
// post-submit callback 
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
						
                            <ul class="tabs-nav">
                                <li class="active"><a href="#tab3"><?php echo lang('account_settings');?></a></li>
                                <?php if(isset($profile_details) && ($profile_details->user_type==1 || $profile_details->user_type==3)) { ?>
                                		<!-- <li><a href="#tab2">Payment information</a></li> //-->
                                        <li><a href="#tab4"><?php echo lang('invoicing');?></a></li>
                                <?php } ?>
                                
                            </ul>

							<!-- Tabs Content -->
							<div class="tabs-container">

								<?php if(isset($profile_details) && FALSE && ($profile_details->user_type==1 || $profile_details->user_type==3)) { ?>
								<div class="tab-content" id="tab2" style="display:none;"><div class="padding">
									<?php echo $this->template->block('PaymentProfileForm','profile/payment_profile_form.php');?>									
								</div><div class="clearfix-big"></div></div>
                                <?php } ?>
                                
                                <div class="tab-content" id="tab3"><div class="padding">
                                	<?php echo $this->template->block('AccountProfileForm','profile/account_profile_form.php');?>
                                </div> <div class="clearfix-big"></div></div>
                                

								<?php if(isset($profile_details) && ($profile_details->user_type==1 || $profile_details->user_type==3)) { ?>
                                <div class="tab-content" id="tab4"><div class="padding">
                                	<?php echo $this->template->block('InvoicingForm','profile/invoicing_form.php');?>
                                </div> <div class="clearfix-big"></div></div>
                                <?php } ?>
                                
                               							</div>
						</div>
						

						<div class="clearfix-big"></div>
				</div>
			</div>
		<!-- End Project Title-->
	</div>
	<!-- End 960 Container -->