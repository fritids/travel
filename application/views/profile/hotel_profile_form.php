<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
<?php if(isset($profile_details) && $profile_details->map_latitude!=0) { ?>
		var map_latitude=<?php echo $profile_details->map_latitude; ?>;
<?php }else{ ?>
		var map_latitude=42.83333;
<?php } ?>

<?php if(isset($profile_details) && $profile_details->map_longitude!=0) { ?>
		var map_longitude=<?php echo $profile_details->map_longitude; ?>;
<?php }else{ ?>
		var map_longitude=12.83333;
<?php } ?>

<?php if(isset($profile_details) && $profile_details->map_zoom_level!=0) { ?>
		var map_zoomlevel=<?php echo $profile_details->map_zoom_level; ?>;
<?php }else{ ?>
		var map_zoomlevel=7;
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
  	$('#hotel_zoomlevel_from_google').val(map.getZoom());
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
    mapTypeControl: true,
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.TOP_RIGHT
    },
    zoomControl: true,
    streetViewControl: true,
    streetViewControlOptions: {
        position: google.maps.ControlPosition.BOTTOM_RIGHT
    }
  });
  marker = new google.maps.Marker({
    position: latLng,
    title: '<?php if(isset($hotel_name)) echo addslashes($hotel_name); else if($profile_details->hotel_name!="") echo addslashes($profile_details->hotel_name); else echo "Hotel Address"?>',
    map: map,
    draggable: true,
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

function codeAddress(street_address){
	//var street_address = $('#hotel_address').val();
	var country_selected = $("#hotel_country option:selected").text();
	var state_selected = $("#hotel_state option:selected").text();
	var city_selected = $("#hotel_city option:selected").text();
	street_address = street_address+", "+city_selected+", "+state_selected+", "+country_selected;
	geocoder.geocode({'address': street_address}, 
						function(results,status){
							if (status == google.maps.GeocoderStatus.OK) {
								map.setCenter(results[0].geometry.location);
								marker.setMap(null);
								marker = new google.maps.Marker({
								 map: map,
								 position: results[0].geometry.location,
								 draggable: true,
							     icon: pinImage,
							     shadow: pinShadow
								});
								map.setZoom(17);
								geocodePosition(marker.getPosition());
								updateMarkerPosition(marker.getPosition());
							}
						});
}


function change_map_country(){
	var country_selected = $("#hotel_country option:selected").text();
	geocoder.geocode({'address': country_selected}, 
						function(results,status){
							if (status == google.maps.GeocoderStatus.OK) {
								map.setCenter(results[0].geometry.location);
								marker.setMap(null);
								marker = new google.maps.Marker({
								 map: map,
								 position: results[0].geometry.location,
								 draggable: true,
							     icon: pinImage,
							     shadow: pinShadow
								});
								map.setZoom(7);
								geocodePosition(marker.getPosition());
								updateMarkerPosition(marker.getPosition());
							}
						});
}

function change_map_state(){
	var state_selected = $("#hotel_state option:selected").text();
	geocoder.geocode({'address': state_selected}, 
						function(results,status){
							if (status == google.maps.GeocoderStatus.OK) {
								map.setCenter(results[0].geometry.location);
								marker.setMap(null);
								marker = new google.maps.Marker({
								 map: map,
								 position: results[0].geometry.location,
								 draggable: true,
							     icon: pinImage,
							     shadow: pinShadow
								});
								map.setZoom(10);
								geocodePosition(marker.getPosition());
								updateMarkerPosition(marker.getPosition());
							}
						});
}

function change_map_city(){
	var city_selected = $("#hotel_city option:selected").text();
	geocoder.geocode({'address': city_selected}, 
						function(results,status){
							if (status == google.maps.GeocoderStatus.OK) {
								map.setCenter(results[0].geometry.location);
								marker.setMap(null);
								marker = new google.maps.Marker({
								 map: map,
								 position: results[0].geometry.location,
								 draggable: true,
							     icon: pinImage,
							     shadow: pinShadow
								});
								map.setZoom(12);
								geocodePosition(marker.getPosition());
								updateMarkerPosition(marker.getPosition());
							}
						});
}

function change_map_comune(){
	var comune_selected = $("#hotel_comune option:selected").text();
	geocoder.geocode({'address': comune_selected}, 
						function(results,status){
							if (status == google.maps.GeocoderStatus.OK) {
								map.setCenter(results[0].geometry.location);
								marker.setMap(null);
								marker = new google.maps.Marker({
								 map: map,
								 position: results[0].geometry.location,
								 draggable: true,
							     icon: pinImage,
							     shadow: pinShadow
								});
								map.setZoom(17);
								geocodePosition(marker.getPosition());
								updateMarkerPosition(marker.getPosition());
							}
						});
}
</script>
<style>
  #mapCanvas {
    width: 640px;
    height: 200px;
  }
  #mapCanvas img{ height:auto !important; width:auto !important;}
</style>


<div class="tab-content" id="tab1">	
	<div class="padding">		
		<form id="profile_edit_form" style="width:640px;" name="profile-edit-form" method="post" action="<?php echo base_url();?><?php echo $this->config->item('save_struttura_url');?>">
        	<?php echo $this->template->block('struttura','profile/hotel_profile_form_parts/struttura.php');?>
        </form>
		<?php echo $this->template->block('PrivacyPolicy','users/privacy_policy.php'); ?>  
	</div>
<div class="clearfix-big"></div>
</div>