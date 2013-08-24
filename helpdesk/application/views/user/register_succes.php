

<!-- Start Report Box -->
<div class="reportbox">
	<h1><?php echo $this->lang->line('register_succes_msg1'); ?></h1>
	<p class="text"><?php echo vlang('register_succes_msg2',array($name)); ?> </p>
	<br>
	<input type="button" class="stbutton" onclick="location.href='<?php echo base_url('tickets/create'); ?>'" value="<?php echo $this->lang->line('create_a_new_ticket'); ?>" />
</div>
<!-- End Report Box -->
