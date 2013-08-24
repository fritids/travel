<div id="lang_switcher">	
	<ul class="site_languag_option">
		<?php 
				$languages = $this->config->item('supported_languages');
				if(!empty($languages))
					foreach($languages as $l_key => $l_value ) { 
		?>
	    				<li>
		   					<a href="javascript:void(0);" onclick="setlanguage('<?php echo $l_key; ?>');">
		   						<img class="flag" src="<?php echo IMAGEPATH; ?>flags/<?php echo $l_key; ?>.png" />
		   					</a>
						</li>
		<?php } ?>
	</ul>
</div>