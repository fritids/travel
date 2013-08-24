<span id="lang_for_inputfield">	
	<ul class="site_languag_option">
		<?php 
				$languages = $this->config->item('supported_languages');
				if(!empty($languages))
					foreach($languages as $l_key => $l_value ) { 
					if($l_key!=$this->config->item('default_language')){
		?>
	    				<li><img class="flag" src="<?php echo IMAGEPATH; ?>flags/<?php echo $l_key; ?>.png" /></li>
					<?php } ?>
                <?php } ?>
	</ul>
</span>