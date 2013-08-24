

 <script>

 function login_user()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('member/login_process'); ?>",
        data: $("#loginform").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg); 

                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('login'); ?>" onclick="login_user()" class="stbutton"/>');
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

<div id="ajax"><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?></div>

	<form id="loginform" onsubmit="return false">
		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('email'); ?></label>

			<input type="text" name="email" value=""  maxlength="50" class="stinput inputhover"/>

		</div>

		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('password'); ?></label>

			<input type="password" name="password" value=""  maxlength="20" class="stinput"/>

		</div>

		<div id="submitbutton" style="text-align: center;">

        <input type="submit" name="button" id="button" value="<?php echo $this->lang->line('login'); ?>" onclick="login_user()" class="stbutton"/>

        </div>	

			

				

	</form>

</div>

<!-- End Ticket Form -->







