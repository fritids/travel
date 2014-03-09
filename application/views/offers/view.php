<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
<?php if(isset($hotel_profile_information) && $hotel_profile_information[0]->map_latitude!=0) { ?>
		var map_latitude=<?php echo $hotel_profile_information[0]->map_latitude; ?>;
<?php }else{ ?>
		var map_latitude=42.83333;
<?php } ?>

<?php if(isset($hotel_profile_information) && $hotel_profile_information[0]->map_longitude!=0) { ?>
		var map_longitude=<?php echo $hotel_profile_information[0]->map_longitude; ?>;
<?php }else{ ?>
		var map_longitude=12.83333;
<?php } ?>
<?php if(isset($hotel_profile_information) && $hotel_profile_information[0]->map_zoom_level!=0) { ?>
		var map_zoomlevel=<?php echo $hotel_profile_information[0]->map_zoom_level; ?>;
<?php }else{ ?>
		var map_zoomlevel=9;
<?php } ?>

var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  //document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  /*
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');
  */
 	$('#hotel_latitude_from_google').val(latLng.lat());
 	$('#hotel_logitude_from_google').val(latLng.lng()); 
}

function updateMarkerAddress(str) {
  //document.getElementById('address').innerHTML = str;
  
  $('#hotel_address_from_google').val(str);
}
var map, pinColor, pinImage, pinShadow, marker;
function initialize() {
  var latLng = new google.maps.LatLng(map_latitude, map_longitude);
  pinColor = "FE7569";
  pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));
  pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
        new google.maps.Size(40, 37),
        new google.maps.Point(0, 0),
        new google.maps.Point(12, 35));

  map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: map_zoomlevel,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false,
    scrollwheel: false,
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.TOP_RIGHT
    },
    zoomControl: true,
    streetViewControl: false,
    streetViewControlOptions: {
        position: google.maps.ControlPosition.BOTTOM_RIGHT
    }
  });
  marker = new google.maps.Marker({
    position: latLng,
    title: '<?php if(isset($hotel_profile_information)) echo addslashes($hotel_profile_information[0]->hotel_name); else echo "Hotel Address"?>',
    map: map,
    draggable: false,
    icon: pinImage,
    shadow: pinShadow
  });
  
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);
  
  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });
  
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });
  
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style>
  #mapCanvas {
    width: 640px;
    height: 250px;
  }
  #mapCanvas img{ height:auto !important; width:auto !important;}
</style>



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
    $('#toggle-description').click(
      function() {
        if(!galleries[0].settings.description_wrapper) {
          galleries[0].settings.description_wrapper = $('#descriptions');
        } else {
          galleries[0].settings.description_wrapper = false;
        }
        return false;
      }
    );
  });
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

<script>
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
        
         $( "#from-booking" ).datepicker({
            defaultDate: "+1w",
            altField: "#alternate-from",
            changeMonth: false,
            numberOfMonths: 1,
           dateFormat: 'dd-mm-yy',
            onSelect: function( selectedDate ) {
                $( "#to-booking" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#to-booking" ).datepicker({
            defaultDate: "+1w",
            altField: "#alternate-to",
            changeMonth: false,
            numberOfMonths: 1,
			dateFormat: 'dd-mm-yy',

            onSelect: function( selectedDate ) {
                $( "#from-booking" ).datepicker( "option", "maxDate", selectedDate );
            }
        });

    });
</script>
  <script src="<?php echo JSPATH;?>jquery.collapse.js"></script>


<?php //print_r($offer_details); ?>

<?php echo $this->template->block('SearchPanleTop','offers/_single_page_search_panel.php'); ?>


<!-- 960 Container -->
<div class="container">

	
			<!-- Project Title -->
			<div class="twelve-small columns background">
			<div class="padding">
			<h1><strong>			<?php echo $offer_details->offer_title;?></strong>

		</h1>
		 <em>
            <?php echo short_description($offer_details->offer_package_description, 40); ?>
            </em><br>
            <em><strong><a href="<?php echo base_url();?><?php echo hotel_url($offer_details);?>"><?php echo $offer_details->hotel_name;?></a> - <?php if($offer_details!=NULL) echo $offer_details->hotel_zip;?> <?php if($offer_details!=NULL) { echo $offer_details->hotel_town.", ".$offer_details->city_name;} ?></strong></em>
		  
		</div>
		<!-- Tabs Navigation -->
			<ul class="tabs-nav">
				<li class="active"><a href="#info"><?php echo lang('Descrizione');?> <?php echo lang('offer');?></a></li>
				<li><a href="#hotel"> <?php echo lang('hotels');?></a></li>
				<li><a href="#packages"><?php echo lang('offers_packs');?></a></li>
				
					<?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
                	<div class="item_like button small white" style="float:right;margin-right:20px;">
							<span class="item_likes">
								<span id="total_like_offer_<?php echo $offer_details->offer_id;?>"><?php echo $offer_details->total_like;?></span>
							</span> 
							<span id="like_this_post">
                                <a id="<?php echo $offer_details->offer_id;?>" href="javascript:void(0);">
									<span id="likethisoffer_txt_<?php echo $offer_details->offer_id;?>">
                                    	<?php if(is_liked_this_offer($offer_details->offer_id,$profile_details->user_id)) { ?>
                                        		Non mi piace
                                        <?php }else{?>	
                                            	Mi piace
                                        <?php } ?>
                                    </span>
								</a>
                            </span>
					</div>
                    <?php }else{?>
                    <div class="item_like2 button small white" style="float:right;margin-right:20px;">
                    		<span class="item_likes">
								<span id="total_like_offer_<?php echo $offer_details->offer_id;?>"><?php echo $offer_details->total_like;?></span>
							</span> 
							<span id="like_this_post">
                                <a rel="leanModal" href="#user-login-popup">
									<span id="likethisoffer_txt_<?php echo $offer_details->offer_id;?>">Mi piace</span>
								</a>
                            </span>
                   </div>
                    <?php } ?>

			</ul>

			<!-- Tabs Content -->
			<div class="tabs-container">
				<div class="tab-content" id="info">

		<div class="padding">
			<div class="project">
			
				<div id="gallery" class="ad-gallery">
      				<div class="ad-image-wrapper"></div>
   					<div class="ad-nav">
        				<div class="ad-thumbs">
          					<ul class="ad-thumb-list">
                            	<?php if($hotel_profile_attachments!=NULL){ ?>
          				<ul class="ad-thumb-list">
          					<?php foreach($hotel_profile_attachments as $key=>$item ){ ?>
          							<?php 
					                $file_source = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$item->user_id."/".$item->image_name;
									echo "<li>";
									echo "<a href='".image_resize($file_source,750,550)."'>";
									echo image_thumb($file_source,60,60);
									echo "</a>";
									echo "</li>";
									?>
             				<?php } ?>
             				</ul>
          				<?php } ?>
                            </ul>
        				</div>
      				</div>
    			</div>
    		</div>
			<div class="clearfix-big"></div>
			
								<p>
                    	<?php echo $offer_details->offer_package_description;?>
                    </p>
                    
								
						
								<div class="clearfix-big"></div>

				
            		 	<div id="mapCanvas" style="width:640px; height:250px ;float:left;"></div>

								<div class="clearfix-small"></div>

				</div>
				</div>
				<div class="tab-content" id="hotel">
				<div class="padding">
				
				<div class="stars">
                	<input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($offer_details->hotel_rating==1) { ?> checked="checked" <?php }?> />
                    <input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($offer_details->hotel_rating==2) { ?> checked="checked" <?php }?> />
                    <input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($offer_details->hotel_rating==3) { ?> checked="checked" <?php }?> />
                    <input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($offer_details->hotel_rating==4) { ?> checked="checked" <?php }?> />
                    <input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($offer_details->hotel_rating==5) { ?> checked="checked" <?php }?> />
                </div>
                <div class="clearfix"></div>
		<h3>
			<a href="<?php echo base_url();?><?php echo hotel_url($offer_details);?>"><?php echo $offer_details->hotel_name;?></a>
		</h3><div class="clearfix-small"></div>
		
				
				<em><?php if($offer_details!=NULL) echo $offer_details->hotel_address;?>, 
        <?php if($offer_details!=NULL) echo $offer_details->hotel_zip;?> <?php if($offer_details!=NULL) { echo $offer_details->hotel_town.", ".$offer_details->city_name;} ?></em><br>
        Tel: <?php if($offer_details!=NULL) echo $offer_details->hotel_phone;?>, Fax: <?php if($offer_details!=NULL) echo $offer_details->hotel_fax;?>, <a href="<?php if($offer_details!=NULL) echo $offer_details->hotel_website;?>" target="_blank">Visit website</a>
        
										
					<div class="clearfix-big"></div>
					<p>
						<?php if(isset($hotel_profile_information) && array_key_exists(0, $hotel_profile_information)) echo $hotel_profile_information[0]->hotel_description; ?>
					</p>
										<div class="clearfix-small"></div>

					
					<?php //print_r($hotel_services_view);?>
                    <?php if($services!=NULL){ ?>
						<ul class="check_list">
						<?php
								$columns=2;//$existence_offer_services_view
								$sub_array = array_chunk($services, ceil(count($services) / $columns));
								foreach ($sub_array[0] as $key => $value) {
									if(!empty($hotel_services_view) && in_array($value->facility_id, $hotel_services_view))
										echo "<li class='withfloat service_yes'>".$value->facility_name."</li>";
									else
										echo "<li class='withfloat service_no'>".$value->facility_name."</li>";
								}	
							
						?>
						</ul>
						<ul class="check_list">
							<?php
								foreach ($sub_array[1] as $key => $value) {
									if(!empty($hotel_services_view) && in_array($value->facility_id, $hotel_services_view))
										echo "<li class='withfloat service_yes'>".$value->facility_name."</li>";
									else
										echo "<li class='withfloat service_no'>".$value->facility_name."</li>";
								}
							?>
						</ul>
						<?php } ?>	
						
																<div class="clearfix-small"></div>

				</div>
				</div>
				<div class="tab-content" id="packages">
					<div id="welcome_item_list">
						<?php echo $this->template->block('ActiveOffers','dashboard/_active_offerlist.php');?>
					</div>
				</div>
				
			
				
		

		</div>
	</div>
	<div class="four-large columns">
	
	<div class="background padding" style="padding-bottom:5px;">
  
   <ul class="the-icons">
        <li><div class="price"></div><strong style="font-size: 28px;"><?php echo $offer_details->offer_price_adult;?> TK.</strong>/ <?php echo lang('adults');?> </li>
       	<li><div class="children"></div><em><?php echo lang('children');?> </em><br> <?php echo $offer_details->offer_price_children;?> TK.</li>
       	<li><div class="calendar"></div><em><?php echo lang('duration_time');?> </em><br><?php echo $offer_details->offer_duration;?></li>
        <li><div class="restaurant"></div><em><?php echo lang('offer_includes');?> </em><br><?php echo $offer_details->offerinclude_option;?></li>

        <li><div class="calendar"></div><em><?php echo lang('offer_validation');?></em><br><?php echo date("d/m/Y",strtotime($offer_details->offer_start_date));?> - <?php echo date("d/m/Y",strtotime($offer_details->offer_finish_date));?></li>
   <li style="border:none;">
   
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_counter addthis_pill_style" style="display:none; visibility:hidden;height:0px;"></a>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-514410b9151370e8"></script>
<!-- AddThis Button END -->

 </li>

      </ul>
        
        
  
  
</div>
<div class="clearfix-big"></div>
			




		<div class="padding background blue_form">
<h3 class="headline"><?php echo lang('booking_request');?></h3>
        <div class="clearfix-big"></div>

			<?php echo $this->template->block('BookingForm','offers/_booking_form.php'); ?>	      </div>
			
			<div class="clearfix-big"></div>
			

<?php echo $this->template->block('RelatedOffer','offers/_related_offer.php'); ?>
</div>
<!-- End 960 Container -->
			<div class="clearfix-big"></div>

