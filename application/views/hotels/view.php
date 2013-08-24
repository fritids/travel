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
		var map_zoomlevel=15;
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
<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>

<?php //print_r($offer_details); ?>

<?php echo $this->template->block('SearchPanleTop','offers/_single_page_search_panel.php'); ?>



<!-- 960 Container -->
<div class="container">


<div class="clearfix"></div>
	<!-- Project Title -->
			<div class="twelve-small columns background">	
                        
                        <div class="padding" style="padding-bottom:0px;">
                       
                <div class="clearfix"></div>
		<h1><strong><?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) echo $hotel_profile_information[0]->hotel_name;?></strong></h1>
                       <em><?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information) && ($hotel_profile_information[0]->hotel_description!=NULL || $hotel_profile_information[0]->hotel_description!=0)) echo short_description($hotel_profile_information[0]->hotel_description,50);?></em> 
                       <div class="clearfix-small"></div>
                        </div>
		<!-- Tabs Navigation -->
		<ul class="tabs-nav"><?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
                    <div class="item_like button small white" style="float:right; margin-right:20px;"> <!-- Dont rename this class name//-->
                        <span class="item_likes">
                            <span id="total_like_profile_<?php echo $hotel_profile_information[0]->user_id;?>"><?php echo $hotel_profile_information[0]->total_profile_like;?></span>
                        </span> 
                        <span id="like_this_post" >
                            <a id="<?php echo $hotel_profile_information[0]->user_id;?>" href="javascript:void(0);">
                                <span id="likethisprofile_txt_<?php echo $hotel_profile_information[0]->user_id;?>">
                                	<?php if(is_liked_this_profile($hotel_profile_information[0]->user_id,$profile_details->user_id)) { ?>
                                        		<?php echo lang('i_dont_like');?>
                                    <?php }else{?>	
                                            	<?php echo lang('i_like');?>
                                    <?php } ?>
                                </span>
                            </a>
                        </span>
                    </div>
            <?php }else{ ?>
            		 <div class="item_like2 button small white" style="float:right; margin-right:20px;">
                        <span class="item_likes">
                            <span id="total_like_profile_<?php echo $hotel_profile_information[0]->user_id;?>"><?php echo $hotel_profile_information[0]->total_profile_like;?></span>
                        </span> 
                        <span id="like_this_post">
                            <a class="open-popup" rel="leanModal" href="#user-login-popup">
                                <span id="likethisprofile_txt_<?php echo $hotel_profile_information[0]->user_id;?>">Mi piace</span>
                            </a>
                        </span>
                    </div>
            <?php } ?>

			<li class="active"><a href="#info"><?php echo lang('informations');?></a></li>
			<li><a href="#offers"><?php echo lang('offers_packs');?></a></li>
					<li><a href="#comments"><?php echo lang('comments');?> (<?php if(isset($hotel_profile_information)) echo $hotel_profile_information[0]->total_comments;?>)</a></li>
					
					
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
          				<?php if($hotel_profile_attachments!=NULL){ ?>
          				<ul class="ad-thumb-list">
          					<?php foreach($hotel_profile_attachments as $key=>$item ){ ?>
          							<?php 
					                $file_source = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$item->user_id."/".$item->image_name;
									echo "<li>";
									echo "<a href='".image_resize($file_source,750,550)."'>";
									echo @image_thumb($file_source,60,60);
									echo "</a>";
									echo "</li>";
									?>
             				<?php } ?>
             				
             				
          				</ul>
          				<?php } ?>
        			</div>
      			</div>
    		</div>
    	</div>
		<div class="clearfix-big"></div>

                        
                        
                   <h3>Descrizione <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) echo $hotel_profile_information[0]->hotel_name;?></h3>     
				<p>
                	<?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) echo $hotel_profile_information[0]->hotel_description;?>
                </p>
                
                                   <h3>Informazioni importanti</h3>     

                 <p class="tooltips">
            	<?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) echo $hotel_profile_information[0]->important_information;?>
            </p>
            
            		<div class="clearfix-big"></div>

            <?php if($services!=NULL){ ?>
				<ul class="check_list">
				<?php
						$columns=2; //print_r($hotel_profile_services);
						$sub_array = array_chunk($services, ceil(count($services) / $columns));
						foreach ($sub_array[0] as $key => $value) {
							if(is_array($hotel_profile_services) && in_array($value->facility_id, $hotel_profile_services))
								echo "<li class='withfloat service_yes'>".$value->facility_name."</li>";
							else
								echo "<li class='withfloat service_no'>".$value->facility_name."</li>";
						}	
					
				?>
				</ul>
				<ul class="check_list">
					<?php
						foreach ($sub_array[1] as $key => $value) {
							if(is_array($hotel_profile_services) && in_array($value->facility_id, $hotel_profile_services))
								echo "<li class='withfloat service_yes'>".$value->facility_name."</li>";
							else
								echo "<li class='withfloat service_no'>".$value->facility_name."</li>";
						}
					?>
				</ul>
				<?php } ?>
				
						<div class="clearfix-big"></div>
						<?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information) && $hotel_profile_information[0]->nearest_airport_1!="") { ?>
                        	<div><?php echo lang('nearest_airport');?>: <?php  echo $hotel_profile_information[0]->nearest_airport_1;?></div>
                        <?php } ?>
                        
                        <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information) && $hotel_profile_information[0]->nearest_airport_2!="") { ?>    
                        	<div><?php echo lang('nearest_airport');?> #2: <?php echo $hotel_profile_information[0]->nearest_airport_2;?></div>
                        <?php } ?>
                        
                        <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information) && $hotel_profile_information[0]->nearest_airport_3!="") { ?>	
                        	<div><?php echo lang('nearest_airport');?> #3: <?php echo $hotel_profile_information[0]->nearest_airport_3;?></div>
                        <?php } ?>
                        
                        <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information) && $hotel_profile_information[0]->nearest_train_station!="") { ?>	
                        	<div><?php echo lang('nearest_train_station');?>: <?php echo $hotel_profile_information[0]->nearest_train_station;?></div>
                        <?php } ?>	
                        
                        <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information) && $hotel_profile_information[0]->nearest_bus_station!="") { ?>	
                        	<div><?php echo lang('nearest_bus_station');?>: <?php echo $hotel_profile_information[0]->nearest_bus_station;?></div>
                        <?php } ?>
                        
                        <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information) && $hotel_profile_information[0]->nearest_beach!="") { ?>	
                        	<div><?php echo lang('nearest_beach');?>: <?php echo $hotel_profile_information[0]->nearest_beach;?></div>
                        <?php } ?>
                        
                        <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information) && $hotel_profile_information[0]->nearest_restaurant!="") { ?>	
                        	<div><?php echo lang('nearest_restaurant');?>: <?php echo $hotel_profile_information[0]->nearest_restaurant;?></div>
                        <?php } ?>	
                        
                        <div class="clearfix-big"></div>
            		 	<div id="mapCanvas" style="width:640px; height:250px ;float:left;"></div>

</div>
			</div>
            
			<div class="tab-content" id="offers">
				<div id="welcome_item_list">
                	<?php echo $this->template->block('ActiveOffers','dashboard/_active_offerlist.php');?>
				</div>
			</div>
				
		
			
						<div class="tab-content" id="comments">
<div class="padding">
			<h5 class="headline"><?php echo lang('comments');?> (<span id="total_comments_in_a_hotel"><?php if(isset($hotel_profile_information)) echo $hotel_profile_information[0]->total_comments;?></span>)</h5>
		 	<div class="clearfix"></div>
            <div id="comments_list" style="width:660px;float:left;">
            	<?php echo $this->template->block('CommentsList','hotels/_comments_list.php');?>
            </div>
                        </div>
</div>
            
            <div class="clearfix"></div>
            

            
            <div class="clearfix-big"></div>
            
            
		</div>	    					
	</div>		




		
<div class="four-large columns">

	<div class="background padding" style="padding-bottom:5px;">
  
  <ul class="the-icons-hotel">
<li> <div class="stars">
                	<input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($hotel_profile_information[0]->hotel_rating==1) { ?> checked="checked" <?php }?> />
                    <input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($hotel_profile_information[0]->hotel_rating==2) { ?> checked="checked" <?php }?> />
                    <input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($hotel_profile_information[0]->hotel_rating==3) { ?> checked="checked" <?php }?> />
                    <input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($hotel_profile_information[0]->hotel_rating==4) { ?> checked="checked" <?php }?> />
                    <input name="hotel_profile_page_star" type="radio" class="star" disabled="disabled" <?php if($hotel_profile_information[0]->hotel_rating==5) { ?> checked="checked" <?php }?> />
                </div>
                <div class="clearfix"></div>
</li>
        <li><?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) echo $hotel_profile_information[0]->hotel_address;?></li>
   
                   <li><?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) echo $hotel_profile_information[0]->hotel_zip;?> <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) { echo $hotel_profile_information[0]->hotel_town.", ".$hotel_profile_information[0]->city_name;} ?></li>

   <li><em>Tel.</em> <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) echo $hotel_profile_information[0]->hotel_phone;?></li>

   <li><em>Fax.</em> <?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) echo $hotel_profile_information[0]->hotel_fax;?></li>
    <li>
<a href="<?php if($hotel_profile_information!=NULL && array_key_exists(0,$hotel_profile_information)) echo str_replace("www.www.","www.",$hotel_profile_information[0]->hotel_website);?>" target="_blank">Visit website</a></li>

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
<h3 class="headline">Booking request</h3>
        <div class="clearfix-big"></div>

							<?php echo $this->template->block('RequestInformationForm','hotels/_request_information_form.php');?>
     </div>  
     
     <div class="clearfix-big"></div>

<div class="background padding">

 <?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
        				<div class="follow_this_hotel button medium yellow"> <!-- Dont rename this class name//-->
                        	<a id="<?php echo $hotel_profile_information[0]->user_id;?>" href="javascript:void(0);">
                        		<span id="follow_this_hotel_text_<?php echo $hotel_profile_information[0]->user_id;?>">
                                		<?php if(is_followed_this_profile($hotel_profile_information[0]->user_id,$profile_details->user_id)) { ?>
                                        		<?php echo lang('unfollow_this_hotel_text');?>
										<?php }else{?>	
                                                <?php echo lang('follow_this_hotel_text');?>
                                        <?php } ?>
                                </span>
                           </a>
                        </div>
            <?php }else{ ?>
                        <a class="open-popup button medium yellow" rel="leanModal" href="#user-login-popup">
                            <?php echo lang('follow_this_hotel_text');?>
                        </a>
            <?php } ?>
</div>


     <div class="clearfix-big"></div>
			
         </div>
			

</div>
