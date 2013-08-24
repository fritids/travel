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
                    url: CI.base_url+"geodata/searchJSON",
                    dataType: "json",
                    lang: "it",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 100,
                        name_startsWith: request.term
                    },
                    success: function( data ) {
                        response( $.map( data.geonames, function( item ) {
                            var label_text = item.name;
							if(item.stateName!=null) label_text = label_text+','+item.stateName;
							if(item.countryName!=null) label_text = label_text+','+item.countryName;							
							return {
                                label: label_text,
                                value: label_text
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

<script type="text/javascript" src="<?php echo JSPATH;?>jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>tmpl.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>draggable-0.1.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>jquery.slider.js"></script>

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
    });
</script>

<!-- bin/jquery.slider.min.css -->
	<link rel="stylesheet" href="<?php echo CSSPATH;?>jslider.css" type="text/css">
	<link rel="stylesheet" href="<?php echo CSSPATH;?>jslider.blue.css" type="text/css">
<!-- end -->
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
                            $v = "['<a href=\'".hotel_url($h_value)."\'><b style=\'font-size:16px;\'>". $h_value->hotel_name."</b></a><br>".$h_value->hotel_address.", ".$h_value->hotel_zip."<br>".$h_value->city_name."<br>".$h_value->country_name."',".$h_value->map_latitude.",".$h_value->map_longitude."],";
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
		
		var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
		var infowindow = new google.maps.InfoWindow(); 
		var marker, i;
		var bounds = new google.maps.LatLngBounds();
	
		for (i = 0; i < markers.length; i++) { 
			var pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
			bounds.extend(pos);
			marker = new google.maps.Marker({
				position: pos,
				map: map
			});
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infowindow.setContent(markers[i][0]);
					infowindow.open(map, marker);
				}
			})(marker, i));
		}
		<?php if(isset($hotel_list) && $hotel_list!=NULL) { ?>
		map.fitBounds(bounds);
		<?php } ?>
	}
	
	$(document).ready(function() {
  		initializeMaps();
	});
</script>     

<?php //echo $this->template->block('SearchPanleTop','offers/_single_page_search_panel.php'); ?>
<div class="clearfix-big"></div>
<div class="clearfix-big"></div>

<!-- 960 Container -->
<div class="container">
	
    

	<!-- Project Title -->
	<div class="sixteen columns">
			<div class="four columns alpha background">

				<div class="clearfix"></div>
        		<?php echo $this->template->block('SearchPanleLeft','hotels/_left_search_panel.php'); ?>
          
						</div>

			<div class="twelve columns omega">	
			<div class="dashboard_item background">
		<h2 class="headline-title">
           <?php echo lang('hotel_results');?>
        </h2>
    		<a href="javascript:void(0);" onclick="$('#photoview').hide();$('#listview').show();" class="button small yellow" style="float:right;">Lista</a>
        	<a  href="javascript:void(0);" onclick="$('#listview').hide();$('#photoview').show();" class="button small yellow" style="float:right;">Foto</a>
        
       <div class="clearfix"></div>
	</div>
				<div class="clearfix-big"></div>
					<div id="request_info_form_loading" class="search_loading"><h3>Search loading</h3><img src="<?php echo IMAGEPATH; ?>/search_loader.gif"></div>
                	<div class="clearfix"></div>
				<!-- Tabs Content -->
					<div id="all_hotel_lists">
						<div id="list_of_hotels">
							<div id="photoview">
								<?php echo $this->template->block('SearchPanleLeft','hotels/_hotel_list.php'); ?>
                            </div>
                            <div id="listview" style="display:none;">
                            	<?php echo $this->template->block('SearchPanleLeft','hotels/_hotel_list_listview.php'); ?>
                            </div>
						</div>
                                                        <?php if($hotel_list!=NULL){ ?>
                                                        <div style="text-align: center;">
                                                                <!-- <a class="button small white" href="javascript:void(0);" id="load_more_hotels">Load More</a>-->
                                                                <script type="text/javascript">					
                                                                                var first_limit = <?php echo $first_limit; ?>;
                                                                                var offset = <?php echo $first_limit; ?>;
                                                                                var load_more_limit = <?php echo $second_limit; ?>;
                                                                                var total_hotels = <?php echo $total_hotels; ?>;
                                                                </script>	
                                                        </div>
                                                        <?php } ?>
					</div>
										

			</div>
			<div class="clearfix-big"></div>
		</div>
	
	<!-- End Portfolio Content -->
</div>
<!-- End 960 Container -->


<div id="map-popup">
<a class="modal_close" href="javascript:void(0);"></a>       
<div id="popup_main_content">
    <iframe style="border:0px; width:750px; height:400px;" src="<?php echo base_url();?>hotels/load_hotel_search_map"></iframe>
</div>    
</div>