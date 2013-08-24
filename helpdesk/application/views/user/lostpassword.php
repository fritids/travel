

 <script>

 function lostpw()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('member/lostpassword_process'); ?>",
        data: $("#lostpassword").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            
			$("#ajax").html(msg); 

            $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('send'); ?>" onclick="lostpw()" class="stbutton"/>');
            
        }

    });

 }

 </script>

 



<!-- Register Form -->

<div class="ticketform">

<div id="ajax"></div>

	<form id="lostpassword">
		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('email'); ?></label>

			<input type="text" name="email" value=""  maxlength="50" class="stinput inputhover"/>

		</div>

		<div id="submitbutton" style="text-align: center;">

        <input type="button" name="button" id="button" value="<?php echo $this->lang->line('send'); ?>" onclick="lostpw()" class="stbutton"/>

        </div>	

			

				

	</form>

</div>

<!-- End Ticket Form -->







