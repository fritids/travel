<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>
	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <title>Map</title>
            <?php 
            echo $this->template->block('name', 'layouts/_stylesheets'); 	
            echo $this->template->block('name', 'layouts/_javascripts'); 
            ?>
	    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	<?php if(isset($hotel_list) && $hotel_list!=NULL) { ?>
			var map_zoomlevel=7;
	<?php } else{ ?>
			var map_latitude=42.83333;
			var map_longitude=12.83333;
			var map_zoomlevel=5;
	<?php } ?>
	
	var markers = [
		
                        <?php 
                        if($hotel_list!=NULL)
                        foreach($hotel_list as $h_key=>$h_value) { 
                            $v = "['<a target=\'_blank\' href=\'".base_url().addslashes(hotel_url($h_value))."\'><strong style=\'font-size:16px;\'>". addslashes($h_value->hotel_name)."</strong></a><br>".addslashes($h_value->hotel_address).", ".$h_value->hotel_zip."<br>".$h_value->city_name."<br>".$h_value->country_name."',".$h_value->map_latitude.",".$h_value->map_longitude."],";
                            echo $v;
                        } ?>
                
	];
	
	function initializeMaps() {
		<?php if(isset($hotel_list) && $hotel_list!=NULL) { ?>
				var myOptions = {
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: false,
				zoom: map_zoomlevel
				};
		<?php } else{ ?>
			var latLng = new google.maps.LatLng(map_latitude, map_longitude);
			var myOptions = {
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: false,
				zoom: map_zoomlevel,
				center: latLng
				};
		<?php } ?>	
                var map2 = new google.maps.Map(document.getElementById("map_canvas2"),myOptions);
		var infowindow = new google.maps.InfoWindow(); 
		var marker2, i;
		var bounds = new google.maps.LatLngBounds();
	
		for (i = 0; i < markers.length; i++) { 
			var pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
			bounds.extend(pos);
                        marker2 = new google.maps.Marker({
				position: pos,
				map: map2
			});
                        google.maps.event.addListener(marker2, 'click', (function(marker2, i) {
				return function() {
					infowindow.setContent(markers[i][0]);
					infowindow.open(map2, marker2);
				}
			})(marker2, i));
		}
		<?php if(isset($hotel_list) && $hotel_list!=NULL) { ?>
                map2.fitBounds(bounds);
		<?php } ?>
	}
	
	$(document).ready(function() {
  		initializeMaps();
	});
</script> 
	</head>
	<body>
	    <div id="map_canvas2" style="width:100%; height:300px"></div>
	    	
	   
	<!-- START DEBUG DEBUG -->
	<!-- <p>Page rendered in {elapsed_time} seconds using {memory_usage}.</p> -->
	<!-- END DEBUG DEBUG -->	
	</body>
</html>



