<script type="text/javascript">
    $(function() {
        function log( message ) {
            $( "<div>" ).text( message ).prependTo( "#log" );
            $( "#log" ).scrollTop( 0 );
        }
 
         $( "#city_top" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: CI.base_url+"geodata/searchJSON",
                    dataType: "json",
                    lang: "it",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 4,
                        name_startsWith: request.term
                    },
                    success: function( data ) {
                        response( $.map( data.geonames, function( item ) {
                            var label_text = item.name;
							if(item.stateName!=null) label_text = label_text+','+item.stateName;
							if(item.countryName!=null) label_text = label_text+','+item.countryName;							
							return {
                                label: label_text,
                                value: label_text,
                                latitude: item.latitude,
								longitude: item.longitude
                            }
                        }));
                    }
                });
            },
            minLength: 2,
            select: function( event, ui ) {
            	$('#search_latitude').val(ui.item.latitude);
            	$('#search_longitude').val(ui.item.longitude);
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

	function validate_topsearch_form(){
		var return_val=true;
		if($('#city_top').val()==null || $('#city_top').val()==""){
			$('#city_top').css('border','solid red 1px');
			return_val = false;
		}
		if($('#from').val()==null || $('#from').val()==""){
			$('#from').css('border','solid red 1px');		
			return_val = false;
		}
		if($('#to').val()==null || $('#to').val()==""){
			$('#to').css('border','solid red 1px');			
			return_val = false;
		}
		
		return 	return_val;
	}
</script>

<!--  Page Title -->
<div id="search">

	<!-- 960 Container Start -->
	<div class="container">
		<div class="sixteen columns">
			<form class="search-top" name="search-top" method="post" action="<?php echo base_url();?><?php echo $this->config->item('search_page_url');?>" onsubmit="return validate_topsearch_form();">
				<div class="field" style="margin-right:10px; width:390px; float:left;">
					<input type="text" id="city_top" style="width:370px;" name="search_city"  placeholder="<?php echo lang('placeholder_city');?>" value="<?php if(isset($search_city)) echo $search_city;?>" class="top-search" onfocus="$('#city_top').css('border','solid #bababa 1px');"  />
				</div>
				
				<div class="field" style="margin-right:10px;width:190px; float:left;">
					<input type="text" class="text date_picker" name="search_form_date"  id="from" value="<?php if(isset($search_from_date)) echo $search_from_date;?>"  placeholder="<?php echo lang('checkin');?>" onfocus="$('#from').css('border','solid #bababa 1px');" />
				</div>
				
				<div class="field" style="margin-right:15px;width:190px; float:left;">
					<input type="text" class="text date_picker" name="search_to_date"  id="to" value="<?php if(isset($search_to_date)) echo $search_to_date;?>" placeholder="<?php echo lang('checkout');?>"  onfocus="$('#to').css('border','solid #bababa 1px');"  />
				</div>
				<input type="hidden" name="search_latitude" id="search_latitude" value="">
                <input type="hidden" name="search_longitude" id="search_longitude" value="">	
				<input type="submit" name="search" class="button medium yellow" style="float:right; margin-top:0px;"  value="<?php echo lang('start_search');?>">
			</form>
		</div>
	</div>
	<!-- 960 Container End -->
	
</div>
<!-- Page Title End -->
<!--
	<div class="container">

<div class="sixteen columns">
<div id="country-navigation">

		<ul id="nav"><li class="current"><a href="http://travelly.me/offers">Italia</a></li><li><a href="http://travelly.me/offers">Austria</a></li><li><a href="http://travelly.me/offers">Svizzera</a></li>
			<li><a href="http://travelly.me/offers">Germania</a></li>	<li><a href="http://travelly.me/offers">Francia</a></li> <li><a href="http://travelly.me/offers">Spagna</a></li><li><a href="http://travelly.me/offers">Austria</a></li><li><a href="http://travelly.me/offers">Svizzera</a></li>
			<li><a href="http://travelly.me/offers">Germania</a></li>	<li><a href="http://travelly.me/offers">Francia</a></li> <li><a href="http://travelly.me/offers">Spagna</a></li></ul>			
					</div></div></div>

<div class="clearfix"></div>-->


<div class="clearfix-big"></div>