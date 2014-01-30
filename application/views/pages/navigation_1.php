<div id="navigation-pages">
	<ul id="nav">
		<li <?php if($select=="about"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('about_page_url'); ?>"><?php echo lang('about'); ?></a></li>
		<li <?php if($select=="jobs"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('jobs_page_url'); ?>"><?php echo lang('jobs'); ?></a></li>
		<li <?php if($select=="support"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('support_page_url'); ?>"><?php echo lang('support'); ?></a></li>
		<li <?php if($select=="contact"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('contact_page_url'); ?>"><?php echo lang('contact'); ?></a></li>
		<li <?php if($select=="conditions"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('conditions_page_url'); ?>"><?php echo lang('conditions'); ?></a></li>
		<li <?php if($select=="privacy"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('privacy_page_url'); ?>"><?php echo lang('privacy'); ?></a></li>
			<li <?php if($select=="how_it_works"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('how_it_work_page_url'); ?>">Trip-bangladesh</a></li>
</ul>
</div>