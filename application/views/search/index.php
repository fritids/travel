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

<script type="text/javascript" src="<?php echo JSPATH;?>jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>tmpl.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>draggable-0.1.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>jquery.slider.js"></script>

<!-- bin/jquery.slider.min.css -->
	<link rel="stylesheet" href="<?php echo CSSPATH;?>jslider.css" type="text/css">
	<link rel="stylesheet" href="<?php echo CSSPATH;?>jslider.blue.css" type="text/css">
<!-- end -->

    <style type="text/css">
            #viewmap {
                position:relative;
                width:100%;
                float:left;
            }
            #hidemap {
                position:relative;
                width:100%;
                float:left;
            }
            #map_canvas2 {
                position:relative;
                float:left;
                width:100%;
                height:300px;
            }
          .good-bye {
            position: absolute !important;
            left: -10000px !important;
          }
        </style> 

<?php echo $this->template->block('SearchPanleTop','offers/_single_page_search_panel.php'); ?>
 <script type="text/javascript">
            function toggleDiv1(viewmap){
              if(hasClass(document.getElementById(viewmap), 'good-bye'))
                removeClass(document.getElementById(viewmap), 'good-bye');
              else
                addClass(document.getElementById(viewmap), 'good-bye');
              return;
            }
            function toggleDiv2(hidemap){
              if(hasClass(document.getElementById(hidemap), 'good-bye'))
                removeClass(document.getElementById(hidemap), 'good-bye');
              else
                addClass(document.getElementById(hidemap), 'good-bye');
              return;
            }

            // http://snipplr.com/view/3561/addclass-removeclass-hasclass/
            function hasClass(ele,cls) {
              return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
            }

            function addClass(ele,cls) {
              if (!this.hasClass(ele,cls)) ele.className += " "+cls;
            }

            function removeClass(ele,cls) {
              if (hasClass(ele,cls)) {
                var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
                ele.className=ele.className.replace(reg,' ');
              }
            }
        </script>
        
        
<!-- 960 Container -->
<div class="container">


<div class="four columns">
				<div class="clearfix"></div>
        		<?php echo $this->template->block('SearchPanleLeft','offers/_left_search_panel.php'); ?>
            </div>
			
                	<div id="request_info_form_loading" class="search_loading"><h3>Search loading</h3><img src="<?php echo IMAGEPATH; ?>/search_loader.gif"></div>		

			<div class="twelve columns">
						<!--three-fourth content-->
					<section class="three-fourth">
						<div class="sort-by">
							<h3><?php echo lang('search_result_page_heading');?> <?php if(isset($search_city)) echo $search_city;?></h3>
							<ul class="sort">
								<li><select id="sort_by" name="sort_by">
                <option value="price"><?php echo lang('order_by_price');?></option>
                <option value="date"><?php echo lang('order_by_date');?></option>
            </select></li>

							</ul>
							
							<ul class="view-type">
								<li class="grid-view"><a href="javascript:void(0);" title="grid view">grid view</a></li>
								<li class="list-view"><a href="javascript:void(0);" title="list view">list view</a></li>
								<li class="location-view"><a href="#" onmousedown="toggleDiv1('viewmap'); toggleDiv2('hidemap');">location view</a></li>

							</ul>
						</div>
						
						<div class="locations clearfix-grid">
						
  
<script type="text/javascript">
	<?php if(isset($latest_offers) && $latest_offers!=NULL) { ?>
			var map_zoomlevel=7;
	<?php } else{ ?>
			var map_latitude=42.83333;
			var map_longitude=12.83333;
			var map_zoomlevel=5;
	<?php } ?>
	
	var markers = [
		
                        <?php 
                        if($latest_offers!=NULL)
                        foreach($latest_offers as $h_key=>$h_value) { 
                            $v = "['<a target=\'_blank\' href=\'".base_url().addslashes(hotel_url($h_value))."\'><b style=\'font-size:14px;font-weight:bold\'>".addslashes($h_value->hotel_name)."</b></a><br>".addslashes($h_value->hotel_address).", ".$h_value->hotel_zip."<br>".$h_value->city_name.",".$h_value->country_name."',".$h_value->map_latitude.",".$h_value->map_longitude."],";
                            echo $v;
                        } ?>
                
	];
	
	function initializeMaps() {
		<?php if(isset($latest_offers) && $latest_offers!=NULL) { ?>
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
		var marker1,marker2, i;
		var bounds = new google.maps.LatLngBounds();
	
		for (i = 0; i < markers.length-1; i++) { 
			//alert(markers[i]);
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
		<?php if(isset($latest_offers) && $latest_offers!=NULL) { ?>
                map2.fitBounds(bounds);
		<?php } ?>
	}
	
	$(document).ready(function() {
  		initializeMaps();
	});
</script> 
	<div id="viewmap" class="good-bye">
            <div id="map_canvas2"></div>
            							<div class="clearfix-big"></div> 						
            <a href="#" style="display:none;" onmousedown="toggleDiv1('viewmap'); toggleDiv2('hidemap');">View map</a>

        </div>
     
	    	

							<div id="offer_search_result">
								<?php echo $this->template->block('OfferteLastminute','lastminute/_offerte_lastminute.php'); ?>
								<?php echo $pagination_link; ?>
							</div>					
						</div>
				
				</section>
			</div>
			<div class="clearfix-big"></div>
			
	
</div>
<!-- End 960 Container -->
	
					
				