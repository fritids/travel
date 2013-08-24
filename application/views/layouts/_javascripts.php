<link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

<script type="text/javascript">
<!--
    
    var CI = {
      			'base_url': '<?php echo base_url(); ?>',
                        'unfollow_this_hotel_text': '<?php echo lang('unfollow_this_hotel_text'); ?>',
                        'follow_this_hotel_text': '<?php echo lang('follow_this_hotel_text'); ?>'
    		};
-->
</script>
<?php if(isset($is_loggedin) && $is_loggedin=="true" && isset($profile_details)){ ?>
<script type="text/javascript">
<!--
    var User = {
      			'logged_id_username': '<?php echo $profile_details->username; ?>'
    		};
-->
</script>
<?php } ?>
<!-- Java Script
 ================================================== -->
<script type="text/javascript" src="<?php echo JSPATH;?>extra/jquery.js"></script>
<script src="<?php echo JSPATH;?>modernizr.js"></script>

 <script type="text/javascript">
    $(document).ready(function(){

    if(!Modernizr.input.placeholder){

      $('[placeholder]').focus(function() {
        var input = $(this);
        if (input.val() == input.attr('placeholder')) {
        input.val('');
        input.removeClass('placeholder');
        }
      }).blur(function() {
        var input = $(this);
        if (input.val() == '' || input.val() == input.attr('placeholder')) {
        input.addClass('placeholder');
        input.val(input.attr('placeholder'));
        }
      }).blur();
      $('[placeholder]').parents('form').submit(function() {
        $(this).find('[placeholder]').each(function() {
        var input = $(this);
        if (input.val() == input.attr('placeholder')) {
          input.val('');
        }
        })
      });

    }

    });
    </script>
<script src="<?php echo JSPATH;?>jquery/1.7.1/jquery.min.js"></script>

<?php if(!isset($dont_load_extra_js)) { ?>
	<script src="<?php echo JSPATH;?>jquery.isotope.min.js"></script>
	<script src="<?php echo JSPATH;?>custom.js"></script>
	<script src="<?php echo JSPATH;?>ender.min.js"></script>
	<script src="<?php echo JSPATH;?>effects.js"></script>
<?php } ?>	

<?php if(!isset($dont_load_extra_js)) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH;?>lib/jquery.ad-gallery.css">
<script type="text/javascript" src="<?php echo JSPATH;?>jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>jquery/1.8.2/jquery-1.8.2.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH;?>scripts.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.view-type li:first-child').removeClass('active');
		$('.view-type li:nth-child(2n)').addClass('active');
	});
	</script>
<script type="text/javascript" src="<?php echo JSPATH;?>jquery/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo ASSETSPATH;?>lib/jquery.ad-gallery.js"></script>
<?php } ?>

<?php if(!isset($dont_load_extra_js)) { ?>
	<?php if(!isset($show_flexslider)) { ?>
		<script src="<?php echo JSPATH;?>flexslider.js"></script>
	<?php } ?>

	<script src="<?php echo JSPATH;?>plugins.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH;?>jquery.leanModal.min.js"></script>
	<?php if(!isset($show_flexslider)) { ?>
		<script type="text/javascript">
			$(function() {
    			$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
    	    	$("#basicPopup3").click();
	
			});
		</script>
	<?php } ?>

	<script type="text/javascript" src="<?php echo JSPATH;?>jshashtable-2.1_src.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH;?>jquery.numberformatter-1.2.3.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH;?>tmpl.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH;?>jquery.dependClass-0.1.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH;?>draggable-0.1.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH;?>jquery.slider.js"></script>
<?php } ?>

<script type="text/javascript" src="<?php echo JSPATH;?>jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo JSPATH;?>langpicker.js"></script>
<?php if(!isset($dont_load_extra_js)) { ?>
<script type="text/javascript" src="<?php echo JSPATH;?>historyjs/scripts/bundled/html4+html5/jquery.history.js"></script>
<?php } ?>
     
<?php
	// per page scripts (string or array)
	if(isset($page_js) AND $page_js != ''){
		if(is_array($page_js)) foreach ($page_js as $js) echo '<script type="text/javascript" src="'.JSPATH.$js.'.js"></script>';
		else echo '<script type="text/javascript" src="'.JSPATH.$page_js.'.js"></script>';
	}
?>