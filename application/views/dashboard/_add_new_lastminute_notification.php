<div class="large-notice notification error closeable background">
	<h2><?php echo lang('information_offer_generic_title');?></h2>
	<p>
		<?php echo lang('information_offer_generic_description');?>
	</p>
	<br>
	<a href="<?php echo base_url();?><?php echo $this->config->item('create_new_offer_url');?>" class="button medium btn-red"><?php echo lang('post_offer');?></a>
</div>