<style type="text/css">
	@media only screen and (min-width: 960px) {#portfolio-wrapper img {min-height: 147px;}} 
	@media only screen and (min-width: 768px) and (max-width: 959px) {#portfolio-wrapper img {min-height: 115px;}}
</style>

<!-- End Header -->						
<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>
<?php echo $this->template->block('PageTopPanel','layouts/_page_top_panel.php');?>
<div class="clearfix-big"></div>


<!-- 960 Container -->
<div class="container">
	<div class="four columns">
		<?php echo $this->template->block('NormalUserSummary','dashboard/_normal_user_summary.php');?>
			
		<div class="large-notice notification error closeable background">
			<h2>Pubblica Offerta</h2>
			<p>
				Clicca su pubblica offerta e compila il form d'inserimento dell'offerta seguendo le indicazioni.
			</p>
			<br>
			<a href="<?php echo base_url();?><?php echo $this->config->item('create_new_offer_url');?>" class="button medium red">Pubblica Offerta</a>
		</div>			

		<div class="clearfix-small"></div>

		<div class="background">
			<div id="default-example-info" data-collapse>
				<h5 class="open">Offerte attive</h5>
				<div>
					Questo pannello ti mostra le offerte che hai attualmente online su travelly. Alla data di scadenza travelly sposta l'offerta automaticamente nelle offerte scadute.										                       
				</div> 
				<h5>Offerte scadute</h5>
				<div>
					Questo pannello archivia le offerte scadute. Se desideri puoi ripubblicarle.
				</div> 
			</div>
												                       
		</div>
	</div>
			
	<div class="twelve columns">		
		<div class="background">
			<ul class="tabs-nav">
				<li class="active"><a href="#tab1">New Messages</a></li>
				<li><a href="#tab2">Old Messages</a></li>
			</ul>

			<!-- Tabs Content -->
			<div class="tabs-container">
				<div class="tab-content" id="tab1">
					<?php echo $this->template->block('NewMessages','messages/_new_messages.php');?>
				</div>
						
				<div class="tab-content" id="tab2">
					<?php echo $this->template->block('OldMessages','messages/_old_messages.php');?>							
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix-big"></div>
</div>