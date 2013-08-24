

 <script>

 function create_user()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('member/create_process'); ?>",
        data: $("#createform").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg); 

                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('create_a_new_account_button'); ?>" onclick="create_user()" class="stbutton"/>');
            }
            else
            { 
                $("#ajax").html(msg); 
            }
        }

    });

 }

 </script>

 




<!-- Register Form -->

<div class="ticketform">

<div id="ajax"></div>

	<form id="createform">

		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('name_lastname'); ?></label>

			<input type="text" name="name" value="" maxlength="50"  class="stinput"/>

		</div>

		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('email'); ?></label>

			<input type="text" name="email" value=""  maxlength="50" class="stinput inputhover"/>

		</div>

		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('password'); ?></label>

			<input type="password" name="pass1" value=""  maxlength="20" class="stinput"/>

		</div>

        

        <div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('retype_password'); ?></label>

			<input type="password" name="pass2" value="" maxlength="20" class="stinput"/>

		</div>	

		

		<div id="submitbutton" style="text-align: center;">

        <input type="button" name="button" id="button" value="<?php echo $this->lang->line('create_a_new_account_button'); ?>" onclick="create_user()" class="stbutton"/>

        </div>	

			

				

	</form>

</div>

<!-- End Ticket Form -->

