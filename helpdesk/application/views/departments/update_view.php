<script>

 function update_department()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('departments/update_process'); ?>",
        data: $("#updateform").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            
			$("#ajax").html(msg); 

            $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('update_department'); ?>" onclick="update_department()" class="stbutton"/>');
            
        }

    });

 }

 </script>




<!-- Register Form -->

<div class="ticketform">

<div id="ajax"></div>

	<form id="updateform">

		
		<input type="hidden" name="department_id" value="<?php echo $department->id; ?>" />
		
		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('department_name'); ?></label>

			<input type="text" name="name" maxlength="50" value="<?php echo $department->department_name; ?>"  class="stinput"/>

		</div>

		

		<div id="submitbutton" style="text-align: center;">

        <input type="button" name="button" id="button" value="<?php echo $this->lang->line('update_department'); ?>" onclick="update_department()" class="stbutton"/>

        </div>	

			

				

	</form>

</div>

<!-- End Ticket Form -->







