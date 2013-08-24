<div class="clearfix-big"></div>
	<!-- 960 Container -->
	<div class="container">
		<!-- Project Title -->
		<div class="sixteen columns background">
			<div class="padding">
				<div class="ten columns alpha">
					<h2 class="login"><?php echo lang('payment_bank_title'); ?></h2>
					<p><?php echo lang('payment_bank_description'); ?></p>
					<br>
					
					Ti chiediamo di riportare questa dicitura nella causale del versamento:<br>
 				    CANONE TRAVELLY - NR. INDICATO NELLA E-MAIL (es.<strong><?php echo $invoice_number; ?>)</strong> <br>
 <br>
Infine, per concludere la procedura e attivare il tuo account, invia gentilmente<br>una e-mail a 
<a href="mailto:payments@travelly.me?subject=Numero di Fattura <?php echo $invoice_number; ?>">payments@travelly.me</a>, indicando nell'oggetto il nr. CRO
</p>
					<a href="mailto:payments@travelly.me?subject=Numero di Fattura <?php echo $invoice_number; ?>" class="button medium yellow" style="float:left;">Invia conferma pagamento</a>	
					<a href="<?php echo base_url();?><?php echo $this->config->item('user_profile_edit_url');?>" class="button medium white" style="float:left;">Torna al tuo profilo</a>
					<div class="clearfix-big"></div>
					<p>Se hai dei dubbi o incontri delle difficoltà non esitare a contattarci.<br>
 
Grazie per la tua preziosa collaborazione e buon proseguimento con Travelly !</p>					
				</div>
				<div class="five columns alpha">		
					<img src="<?php echo IMAGEPATH; ?>Credit_Card.png" style="float:right">										
				</div>
				<div class="clearfix-big"></div>
			</div>
		</div>
	</div>
	<!-- End Project Title-->
</div>
<!-- End 960 Container -->