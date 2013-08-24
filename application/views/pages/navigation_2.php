<div class="padding"><div id="navigation-pages">
	<ul id="nav">
		<li <?php if($select=="how_it_works"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('how_it_work_page_url'); ?>"><?php echo lang('how_it_works'); ?></a></li>
		<li <?php if($select=="how_it_works_tourist"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('how_it_work_page_for_tourist_url'); ?>"><?php echo lang('tourist'); ?></a></li>
		<li <?php if($select=="how_it_works_hotel"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('how_it_work_page_for_hotel_owner_url'); ?>"><?php echo lang('hotel_owner'); ?></a></li>
		<li <?php if($select=="how_it_works_office"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('how_it_work_page_for_tourist_office_url'); ?>"><?php echo lang('tourist_office'); ?></a></li>
		<li <?php if($select=="get_started"){ ?> class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('get_started_page_url'); ?>"><?php echo lang('get_started'); ?></a></li>
	</ul>
</div></div>