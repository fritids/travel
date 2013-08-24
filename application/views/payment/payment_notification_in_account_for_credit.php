				<div class="large-notice notification error">
                    <h2>Make a Payment</h2>
                    <p>
                        <?php if(isset($payment_notification_message)) echo $payment_notification_message; else echo lang('default_payment_notification_message'); ?>
                    </p>
                    <br>
                    <a href="<?php echo base_url(); ?><?php echo $this->config->item('subscribe_credit_url');?>" class="button medium red">Make a Payment</a>
				</div>