<script>

 function create_department()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('departments/create_process'); ?>",
        data: $("#createform").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            
			$("#ajax").html(msg); 

            $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('create_a_new_department'); ?>" onclick="create_department()" class="stbutton"/>');
            
        }

    });

 }

 </script>


<!-- Register Form -->

<div class="ticketform">

<div id="ajax"></div>

	<form id="createform">

		
		
		
		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('department_name'); ?></label>

			<input type="text" name="name" maxlength="50" value=""  class="stinput"/>

		</div>

		

		<div id="submitbutton" style="text-align: center;">

        <input type="button" name="button" id="button" value="<?php echo $this->lang->line('create_a_new_department'); ?>" onclick="create_department()" class="stbutton"/>

        </div>	

			

				

	</form>

</div>

<!-- End Ticket Form -->




