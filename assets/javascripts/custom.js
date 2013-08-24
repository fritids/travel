/*-----------------------------------------------------------------------------------
/*
/* Custom JS
/*
-----------------------------------------------------------------------------------*/
	  
/* Start Document */
jQuery(document).ready(function() {

/*----------------------------------------------------*/
/*	Main Navigation
/*----------------------------------------------------*/

	/* Menu */
	(function() {

		var $mainNav    = $('#navigation').children('ul');

		$mainNav.on('mouseenter', 'li', function() {
			var $this    = $(this),
				$subMenu = $this.children('ul');
			if( $subMenu.length ) $this.addClass('hover');
			$subMenu.hide().stop(true, true).fadeIn(250);
		}).on('mouseleave', 'li', function() {
			$(this).removeClass('hover').children('ul').stop(true, true).fadeOut(50);
		});
		
	})();
	
	/* Responsive Menu */
	domready(function(){
		
		/*
		selectnav('nav', {
			label: 'Menu',
			nested: true,
			indent: '-'
		});
		*/
				
	});

if($('#date_picker_popup').val() != "") {
    	$('#date_picker_popup').prev("label").hide();
    }

	$('#fd-but-date_picker_popup').click(function(){
    	$('#date_picker_popup').prev("label").stop().fadeOut();
    	$('#date_picker_popup').focus();
    });
    $('#date_picker_popup').focus(function () {
    	if($(this).val() == "") {
    		$(this).prev("label").fadeTo(200, 0.45);;
    	}
    });
    
    $('#date_picker_popup').blur(function () {
    	if($(this).val() == "") {
    		$(this).prev("label").fadeTo(200, 1);
    	}
    });
    $('#date_picker_popup').keypress(function () {
    	$(this).prev("label").hide();
    });

/*----------------------------------------------------*/
/*	Back To Top Button
/*----------------------------------------------------*/
		var pxShow = 300;//height on which the button will show
		var fadeInTime = 400;//how slow/fast you want the button to show
		var fadeOutTime = 400;//how slow/fast you want the button to hide
		var scrollSpeed = 400;//how slow/fast you want the button to scroll to top. can be a value, 'slow', 'normal' or 'fast'

		jQuery(window).scroll(function(){
			if(jQuery(window).scrollTop() >= pxShow){
				jQuery("#backtotop").fadeIn(fadeInTime);
			}else{
				jQuery("#backtotop").fadeOut(fadeOutTime);
			}
		});
		 
		jQuery('#backtotop a').click(function(){
			jQuery('html, body').animate({scrollTop:0}, scrollSpeed); 
			return false; 
		}); 
		


/*----------------------------------------------------*/
/*	Accordion
/*----------------------------------------------------*/
	(function() {

		var $container = $('.acc-container'),
			$trigger   = $('.acc-trigger');

		$container.hide();
		$trigger.first().addClass().next().hide();

		var fullWidth = $container.outerWidth(true);
		$trigger.css('width', fullWidth);
		$container.css('width', fullWidth);
		
		$trigger.on('click', function(e) {
			if( $(this).next().is(':hidden') ) {
				$trigger.removeClass('active').next().slideUp(300);
				$(this).toggleClass('active').next().slideDown(300);
			}
			e.preventDefault();
		});

		// Resize
		$(window).on('resize', function() {
			fullWidth = $container.outerWidth(true)
			$trigger.css('width', $trigger.parent().width() );
			$container.css('width', $container.parent().width() );
		});

	})();

	
/*----------------------------------------------------*/
/*	Tabs
/*----------------------------------------------------*/

	(function() {

		var $tabsNav    = $('.tabs-nav'),
			$tabsNavLis = $tabsNav.children('li'),
			$tabContent = $('.tab-content');

		$tabsNav.each(function() {
			var $this = $(this);

			$this.next().children('.tab-content').stop(true,true).hide()
												 .first().show();

			$this.children('li').first().addClass('active').stop(true,true).show();
		});

		$tabsNavLis.on('click', function(e) {
			var $this = $(this);

			$this.siblings().removeClass('active').end()
				 .addClass('active');
			
			$this.parent().next().children('.tab-content').stop(true,true).hide()
														  .siblings( $this.find('a').attr('href') ).fadeIn();

			e.preventDefault();
		});

	})();

	


/*----------------------------------------------------*/
/*	Contact Form
/*----------------------------------------------------*/

(function() {
var animateSpeed=1000;

var emailReg = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;

		//if submit button is clicked
        function validateName(name)
        {
                    if (name.val()=='*') 
                        {
                            name.addClass('validation-error',animateSpeed);
                            return false;
                        }
                    else
                        {
                            name.removeClass('validation-error',animateSpeed);
                            return true;
                        }
         }
		 
         function validateEmail(email,regex)
         {
                    if (!regex.test(email.val()))
                        {
                            email.addClass('validation-error',animateSpeed);
                            return false;
                        }
                    else
                        {
                            email.removeClass('validation-error',animateSpeed);
                            return true;
                        }
         }
		 
         function validateMessage(message)
         {
                    if (message.val()=='')
                        {
                            message.addClass('validation-error',animateSpeed);
                            return false;
                        }
                     else
                         {
                             message.removeClass('validation-error',animateSpeed);
                             return true;
                         }
          }
                
		$('#send').click(function()
        {
		// result of action
                var result=true;
                
		//Get the data from all the fields
		var name = $('input[name=name]');
		var email = $('input[name=email]');
		var message = $('textarea[name=message]');
                
                
         // validate of name input
         if(!validateName(name)) result=false;
         if(!validateEmail(email,emailReg)) result=false;
         if(!validateMessage(message)) result=false;
		
         if(result==false) return false;
		//organize the data properly
		var data = 'name=' + name.val() + '&email=' + email.val() + '&message='  + encodeURIComponent(message.val());
		
		//disabled all the text fields
		$('.text').attr('disabled','true');
		
		//show the loading sign
		$('.loading').fadeIn('slow');
		
		//start the ajax
		$.ajax({
		
			//this is the php file that processes the data and send mail
			url: "contact.php",	
			
			//GET method is used
			type: "GET",

			//pass the data			
			data: data,		
			
			//Do not cache the page
			cache: false,
			
			//success
			success: function (html) {				
				//if process.php returned 1/true (send mail success)
				if (html==1) {	

					//show the loading sign
					$('.loading').fadeOut('slow');	
					
					//show the success message
					$('.success-message').slideDown('slow');
                                        
                    //deactivate submit
					$('#send').attr('disabled',true);
					
				//if process.php returned 0/false (send mail failed)
				} else 
               
			   {
                  $('.loading').fadeOut('slow')
                  alert('Sorry, unexpected error. Please try again.');				
               }
			   
			}		
		});
		
		//cancel the submit button default behaviours
		return false;
        });
        $('input[name=name]').blur(function(){
           validateName($(this)); 
        });
        $('input[name=email]').blur(function(){
           validateEmail($(this),emailReg); 
        });
        $('textarea[name=message]').blur(function(){
           validateMessage($(this)); 
        });
       
})();

		
/*----------------------------------------------------*/
/*	Isotope Portfolio Filter
/*----------------------------------------------------*/

	$(function() {
		var $container = $('#portfolio-wrapper');
				$select = $('#filters select');
				
		// initialize Isotope
		/*
		$container.isotope({
		  // options...
		  resizable: false, // disable normal resizing
		  // set columnWidth to a percentage of container width
		  masonry: { columnWidth: $container.width() / 12 }
		});
		
		// update columnWidth on window resize
		$(window).smartresize(function(){
		  $container.isotope({
			// update columnWidth to a percentage of container width
			masonry: { columnWidth: $container.width() / 12 }
		  });
		});
		
		
      $container.isotope({
        itemSelector : '.portfolio-item'
      });
	  */
	$select.change(function() {
			var filters = $(this).val();
	
			$container.isotope({
				filter: filters
			});
		});
      
      var $optionSets = $('#filters .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options )
        } else {
          // otherwise, apply new options
          $container.isotope( options );
        }
        
        return false;
      });
});

/* End Document */
});


//Delete icon and popup single match
$('.delete_ico_js').each(function(){
	$(this).hover(
		function(){
			$(this).find('.delete a.del').stop().show();
		},
		function(){
			$(this).find('.delete a.del').stop().hide();
		}
	);
});

$('#delete_button').live("click", function(e){
		e.preventDefault();
		$('.popover').fadeOut();
		$(this).next().fadeIn();		
});
$('a.no, .popover a.close').live("click", function() {
		$('.popover').hide();
		return false;
});

function delete_comment(comment_id){
		if(comment_id.length != 0){
			//name.addClass("error");
			$.post(CI.base_url+"comments/delete_comment", {
     											comment_id: comment_id
   											 }, function(response){
													response=$.trim(response);
     											if(response=="1"){
														var div_id="#comment_item_"+comment_id;
														$(div_id).hide();
													}
													else{
														alert(response);	
													}
													
										}
									);
			
			
			
		}
	}
function unlike_offer(offer_id){
		if(offer_id.length != 0){
			//name.addClass("error");
			$.post(CI.base_url+"offers/like_offer", {
     											offer_id: offer_id
   											 }, function(response){
													response=$.trim(response);
     											if(response=="0"){
														var div_id="#offers_i_like_"+offer_id;
														$(div_id).hide();
													}
										}
									);
			
			
			
		}
	}
	
function cancel_offer(offer_id){
		if(offer_id.length != 0){
			//name.addClass("error");
			$.post(CI.base_url+"offers/cancel", {
     											offer_id: offer_id
   											 }, function(response){
													response=$.trim(response);
     											if(response=="1"){
														var div_id="#my_active_offer_"+offer_id;
														$(div_id).hide();
													}
													else{
														alert(response);
													}
										}
									);
			
			
			
		}
	}
	
function delete_offer(offer_id){
		if(offer_id.length != 0){
			//name.addClass("error");
			$.post(CI.base_url+"offers/delete", {
     											offer_id: offer_id
   											 }, function(response){
													response=$.trim(response);
     											if(response=="1"){
														var div_id="#my_old_offer_"+offer_id;
														$(div_id).hide();
													}
													else{
														alert(response);
													}
										}
									);
			
			
			
		}
	}