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
<script src="<?php echo JSPATH; ?>flexslider.js"></script>




<a id="basicPopup3" rel="leanModal" name="social" href="#social"></a>

<div id="social">

	<div id="signup-ct">
		<div id="signup-header"><h3><?php echo lang('popup_title_homepage');?></h3></div>
	</div>
		<div id="social-message">L'unico portale in cui pubblicare le tue offerte.<br><h4>Provalo subito gratuitamente per due mesi.</h4><br>Crei i tuoi pacchetti, fatti trovare per la qualità delle tue <br>proposte di soggiorno. Puoi decidere poi se ne vale la pena.

<br><br><a href="<?php echo base_url();?><?php echo $this->config->item('hotel_owner_signup_url'); ?>" style="width:80px;height:17px;" class="button medium red"><?php echo lang('button_registrati_homepage');?> &raquo;</a> <a href="<?php echo base_url();?><?php echo $this->config->item('dashboard_url');?>" style="width:54px;height:17px; color:#FFF;" class="button medium red">Login &raquo;</a>
<a href="<?php echo base_url();?><?php echo $this->config->item('how_it_work_page_for_hotel_owner_url'); ?>" style="width:114px;height:17px; color:#666;" class="button medium">come funziona &raquo;</a>

<div class="clearfix-border"></div><a href="http://pinterest.com/travellyme/" style="float:left;margin-top:6px; height:24px; width:40px;" target="_blank"><img src="<?php echo IMAGEPATH; ?>pinterest.jpg"></a>
<a href="https://twitter.com/travelly_me" class="twitter-follow-button" data-show-count="true" data-lang="<?php echo lang('language_string');?>" data-show-screen-name="false">Segui @travelly_me</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> <div class="fb-like" style="margin-top:6px;"  data-href="http://www.facebook.com/pages/Travelly/405193586167312" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div></div>
</div>

<div id="slider">
	<!-- Slider -->
	<div class="container">
	
		<div id="search-container">
		
		
<div class="sixteen columns">

            <div class="info-box background-home" style="padding:12px;background: url(<?php echo IMAGEPATH; ?>transparent.png); border:1px solid #333;">
                <div class="info-content">
			<form id="search-home" method="post" action="<?php echo base_url();?><?php echo $this->config->item('search_page_url');?>" onsubmit="return validate_topsearch_form();">
				
               <div class="field" style="margin-right:8px; width:340px; float:left;">
					<input type="text" id="city_top" style="width:320px;" name="search_city" value="" placeholder="<?php echo lang('placeholder_city');?>" class="top-search" onfocus="$('#city_top').css('border','solid #bababa 1px');" />
				</div>
				
				<div class="field" style="margin-right:8px;width:210px; float:left;">
					<input type="text" class="text date_picker" name="search_form_date"  id="from" value="" placeholder="<?php echo lang('checkin');?>" onfocus="$('#from').css('border','solid #bababa 1px');" />
				</div>
				
				<div class="field" style="margin-right:10px;width:210px; float:left;">
					<input type="text" class="text date_picker" name="search_to_date"  id="to" value="" placeholder="<?php echo lang('checkout');?>" onfocus="$('#to').css('border','solid #bababa 1px');" />
				</div>
                <div class="field" style="margin-right:0px;width:125px; float:right;">
                <input type="hidden" name="search_latitude" id="search_latitude" value="">
                <input type="hidden" name="search_longitude" id="search_longitude" value="">
				<input type="submit" name="search" class="button medium yellow" style="width:125px;"  value="<?php echo lang('start_search');?>">
				</div>
                <div class="clearfix"></div>
			</form>
					</div>
					                           <div class="clearfix"></div>

		</div>
		
		</div>

		</div>
	</div>
		
	<!-- Flexslider Start-->
	<div class="flexslider" style="background: #fafafa;">
		<ul class="slides">
			<!-- Slide -->
			<li class="custom-slide" style="background: url(<?php echo IMAGEPATH; ?>portofino.jpg)"></li>
		</ul>
	</div>
	<!-- Flexslider End-->		
</div>
<div class="clearfix"></div>

<!--  Page Title -->
<div id="page-title-home" style="padding-top:6px; padding-bottom:0px;">
	<!-- 960 Container Start -->
	<div class="container">
		
				<div class="sixteen columns">						<h2><?php echo lang('lastmminute');?> <?php echo lang('hotel');?>, <?php echo lang('bb');?>, <?php echo lang('vacation_house');?> </h2>

		</div>
	</div>
	<!-- 960 Container End -->
</div>
<div class="clearfix-big"></div>
<!-- Page Title End -->




<!-- 960 Container Start -->
<div class="container">

                    
                    
	<div class="clearfix"></div>
		<?php 
			if($latest_offers!=NULL){
				foreach($latest_offers as $offer_key=>$offer_item) { ?>
                    <!-- 1/4 Column -->
                    <div class="four columns background">
                        <div class="item-img">
                
                        <ul class="item_toolbar">da<br>
									<h3 style="color:#FFF;"><?php echo $offer_item->offer_price_adult;?>€</h3>
									
																													</ul>
					<a href="<?php echo base_url();?><?php echo offers_url($offer_item);?>">
						
						<?php 
		                	$filename = offer_random_attachment($offer_item->user_id);
		                    if($filename!=NULL)
								$file = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$offer_item->user_id."/".$filename;
							else
								$file = "assets/images/default_attachment.png";
									echo image_thumb($file,160,220);
						?>
						
		          <div class="overlay zoom"></div  </a>
                </div>
                                    <div class="portfolio-item-meta">
                        	<div class="hotel">
                             <a class="offer_name" href="<?php echo base_url();?><?php echo offers_url($offer_item);?>" title="<?php echo $offer_item->offer_title;?>">
Vacanze a <?php echo $offer_item->city_name;?>
                             </a>
                            </div>
                            <div class="date"><?php echo $offer_item->offer_duration;?></div>
                            <div class="description">
<?php echo date('d M',strtotime($offer_item->offer_start_date)); ?> al <?php echo date('d M Y',strtotime($offer_item->offer_finish_date)); ?>
                            </div>
                        </div>
                        
                    </div>
         <?php 
				}
			} 
		?>
			
        <div class="clearfix"></div>

		<div class="clearfix-bigger"></div>

                    <div class="four columns background">
                        <div class="item-img">
                
                              <ul class="item_toolbar">Offerte di vacanza<br>
									<strong>Piemonte</strong>
									
																													</ul>
					<a href="http://www.travelly.me/offers/italy/piemonte">
						
						<img src="http://travelly.me/assets/images/home/piemonte.jpg" />						
		         <div class="overlay zoom"></div>   </a>
                </div>
                                     <div class="portfolio-item-meta">
<strong>a partire da 79€ a persona</strong>

				                                          <div style="clear:both;"></div>
                                       
                                                   </div>
                        
                    </div>
                    
                    
                      <div class="four columns background">
                        <div class="item-img">
                
                              <ul class="item_toolbar">Offerte di vacanza<br>
									<strong>Puglia</strong>
									
																													</ul>
					<a href="http://www.travelly.me/offers/italy/puglia">
						
						<img src="http://travelly.me/assets/images/home/puglia.jpg" />						
		         <div class="overlay zoom"></div>   </a>
                </div>
                                    <div class="portfolio-item-meta">
<strong>a partire da 49€ a persona</strong>

				                                          <div style="clear:both;"></div>
                                       
                                                   </div>
                        
                    </div>
                    
                       <div class="four columns background">
                        <div class="item-img">
                
                              <ul class="item_toolbar">Offerte di vacanza<br>
									<strong>Toscana</strong>
									
																													</ul>
					<a href="http://www.travelly.me/offers/italy/toscana">
						
						<img src="http://travelly.me/assets/images/home/toscana.jpg" />						
		         <div class="overlay zoom"></div>   </a>
                </div>
                                      <div class="portfolio-item-meta">
<strong>a partire da 89€ a persona</strong>

				                                          <div style="clear:both;"></div>
                                       
                                                   </div>
                        
                    </div>
                    
                                        
                       <div class="four columns background">
                        <div class="item-img">
                
                              <ul class="item_toolbar">Offerte di vacanza<br>
									<strong>Abruzzo</strong>
									
																													</ul>
					<a href="http://www.travelly.me/offers/italy/abruzzo">
						
						<img src="http://travelly.me/assets/images/home/abruzzo.jpg" />						
		         <div class="overlay zoom"></div>   </a>
                </div>
                                     <div class="portfolio-item-meta">
<strong>a partire da 49€ a persona</strong>
				                                          <div style="clear:both;"></div>
                                       
                                                   </div>
                        
                    </div>
   
                 
		
		<div class="clearfix-small"></div>

		<!--Info Box Start -->
        <div class="sixteen columns">
            <div class="info-box">
                <div class="info-content">
                    <h4><?php echo lang('register_with_us_promotion_text_head');?></h4>
                    <p><?php echo lang('register_with_us_promotion_text');?></p>
                </div>
                	<?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
                    <a class="button medium red" style="float: right;" href="<?php echo base_url();?><?php echo $this->config->item('how_it_work_page_for_hotel_owner_url'); ?>">Pubblica le tue offerte</a>
                    <?php }else{ ?>
                    <a class="button medium red" style="float: right;" href="<?php echo base_url();?><?php echo $this->config->item('how_it_work_page_for_hotel_owner_url'); ?>">Pubblica le tue offerte</a>
                    <?php } ?>
                    
                           <div class="clearfix"></div>
            </div>
        </div>
		<!-- Recent Work End -->
		<!-- Our Clients -->
</div>
<!-- 960 Container End -->