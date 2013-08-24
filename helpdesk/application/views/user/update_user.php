

 <script>

 function update_user()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('member/update_process'); ?>",
        data: $("#updateform").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            
			$("#ajax").html(msg); 

            $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('update_user'); ?>" onclick="update_user()" class="stbutton"/>');
            
        }

    });

 }

 </script>

 









<!-- Register Form -->

<div class="ticketform">

<div id="ajax"></div>

	<form id="updateform">

		
		<input type="hidden" name="user_id" value="<?php echo $user->id; ?>" />
		
		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('name_lastname'); ?></label>

			<input type="text" name="name" maxlength="50" value="<?php echo $user->name; ?>"  class="stinput"/>

		</div>

		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('email'); ?></label>

			<input type="text" name="email" value="<?php echo $user->email; ?>"  maxlength="50" class="stinput inputhover"/>

		</div>
		
		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('user_dep'); ?></label>

			<select name="department" id="department" class="stinput">
			  <option value="0" <?php if( $user->department == 0 ){ echo 'selected="selected"'; } ?>>Customer</option>
			  <?php
              if( !empty($departments) )
              {
                foreach($departments as $department)
                {
					if( $department->id == $user->department )
					{
						echo '<option value="'.$department->id.'" selected="selected">'.$department->department_name.'</option>';
					}
					else
					{
						echo '<option value="'.$department->id.'">'.$department->department_name.'</option>';
					}
                    
                }
              }
              ?>
            </select>

		</div>
		
		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('banned'); ?> ? </label>

			<label><input type="checkbox" name="banned" <?php if( $user->status == 0 ){ echo 'checked="checked"';} ?> value="1" /> <?php echo $this->lang->line('yes'); ?></label>
			
		</div>

		

		

		

		<div id="submitbutton" style="text-align: center;">

        <input type="button" name="button" id="button" value="<?php echo $this->lang->line('update_user'); ?>" onclick="update_user()" class="stbutton"/>

        </div>	

			

				

	</form>

</div>

<!-- End Ticket Form -->







