<link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />
<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>
<script>
 $(document).ready(
 function()
 {
	get_uploaded_area();
	$('#message').redactor({ fileUpload: '<?php echo base_url('tickets/upload/'.$ticket->id); ?>' });
 }
 );
 
 function get_uploaded_area()
 {
	$.post('<?php echo base_url('tickets/uploaded_files/'.$ticket->id); ?>', function(theResponse){ document.getElementById('upload_status').innerHTML =	theResponse; });
 }
 
 function delete_file(file_name)
 {
	$.post('<?php echo base_url('tickets/delete_file'); ?>/'+file_name, function(theResponse){  if(theResponse == 'deleted'){  get_uploaded_area(); } });
 }
 
 function create_ticket()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('tickets/create_process'); ?>",
        data: $("#createform").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg); 

                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('submit_a_new_ticket'); ?>" onclick="create_ticket()" class="stbutton"/>');
            }
            else
            { 
                $("#ajax").html(msg); 
            }
        }

    });

 }
 
 function toggle()
 {
	$('#fileupload').slideToggle('normal');
 }

 </script>

 




<!-- Register Form -->

<div class="ticketform">

<div id="ajax"></div>

	<form id="createform">

		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('title'); ?> </label>

			<input type="text" name="title" value="" maxlength="255"  class="stinput"/>

		</div>

		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('department'); ?></label>

			<select name="department" id="department" class="stinput">
			  <option selected="selected"><?php echo $this->lang->line('select_a_department'); ?></option>
			  <?php
              if( !empty($departments) )
              {
                foreach($departments as $department)
                {
                    echo '<option value="'.$department->id.'">'.$department->department_name.'</option>';
                }
              }
              ?>
            </select>

		</div>

		

		<div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('priority'); ?></label>

			<select name="priority" id="priority" class="stinput">
			  <option value="1"><?php echo $this->lang->line('low'); ?></option>
			  <option value="2"><?php echo $this->lang->line('medium'); ?></option>
			  <option value="3"><?php echo $this->lang->line('high'); ?></option>
			</select>

		</div>

        <div id="upload_status" style="margin-bottom:15px;">
			
			</div>

        <div class="formline">

			<label class="stlabel"><?php echo $this->lang->line('message'); ?></label>

			<textarea name="message" id="message" class="stinput" rows="6"></textarea>

		</div>	

		

		<div id="submitbutton">

        <input type="button" name="button" id="button" value="<?php echo $this->lang->line('submit_a_new_ticket'); ?>" onclick="create_ticket()" class="stbutton"/>

        </div>	

			

				

	</form>

</div>

<!-- End Ticket Form -->





