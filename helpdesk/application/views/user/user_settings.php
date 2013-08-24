

 <script>

 function update()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('member/change_password'); ?>",
        data: $("#settings").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#ajax").html(msg); 
			$("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('update'); ?>" onclick="update()" class="stbutton"/>');
            
        }

    });

 }

 </script>

 





<!-- Register Form -->

<div class="ticketform">

<div id="ajax"><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?></div>

	<form id="settings">
		
		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('current_password'); ?></label>

			<input type="password" name="currentpass" value=""  maxlength="20" class="stinput"/>

		</div>
		
		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('new_password'); ?></label>

			<input type="password" name="pass1" value=""  maxlength="20" class="stinput"/>

		</div>

        

        <div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('retype_new_password'); ?></label>

			<input type="password" name="pass2" value="" maxlength="20" class="stinput"/>

		</div>	

		

		<div id="submitbutton" style="text-align: center;">

        <input type="button" name="button" id="button" value="<?php echo $this->lang->line('update'); ?>" onclick="update()" class="stbutton"/>

        </div>	

			

				

	</form>

</div>

<!-- End Ticket Form -->

