<link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />
<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>
	
<script type="text/javascript">
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

 function reply_process()
 {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('tickets/reply_process'); ?>",
        data: $("#replyform").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			if(msg.substring(0,4) == '<div')
            {
                $('#message').setCode('');
				$('#ajax').before(msg);
                get_uploaded_area();
				$("#ajax").html('<div class="alert ok"><?php echo $this->lang->line('reply_succes'); ?></div>').hide().toggle('slow'); 
				
                $("#submitbutton").html('<input type="button" value="<?php echo $this->lang->line('close_ticket'); ?>" onclick="close_ticket(<?php echo $this->uri->segment(3); ?>);" class="stbutton button" style="float: left; width:150px;"/><input type="button" name="button" id="button" value="<?php echo $this->lang->line('send'); ?>" onclick="reply_process();" class="stbutton button"/>');
            }
            else
            {
                $("#ajax").html('<div class="alert error"><ul>' + msg + '</ul></div>'); 
                $("#submitbutton").html('<input type="button" value="<?php echo $this->lang->line('close_ticket'); ?>" onclick="close_ticket(<?php echo $this->uri->segment(3); ?>);" class="stbutton button" style="float: left; width:150px;"/><input type="button" name="button" id="button" value="<?php echo $this->lang->line('send'); ?>" onclick="reply_process();" class="stbutton button"/>');
            }
        }
			

    });
 }
 
 function close_ticket( ticket_id )
 {

    $.ajax({

        type: "GET",
        url: "<?php echo base_url(); ?>tickets/close/" + ticket_id,
        success: function(msg)
        {
			if( msg == 'closed' )
            {
                location.href = '<?php echo base_url('tickets/index'); ?>';
            }
            else
            {
                alert('<?php echo $this->lang->line('technical_problem'); ?>');
            }
        }

    });
 }

 </script>

<!-- Start Ticket -->
<div class="center880">


	<!-- Ticket info -->
	<div id="ticketinfo" class="stbox ticketinfo">
			<h1>#<?php echo $ticket->id; ?> <?php echo $this->lang->line('ticket_info'); ?></h1>
			<a href="#" class="ticketinfoclose" title="<?php echo $this->lang->line('hide'); ?>"><?php echo $this->lang->line('close'); ?></a>
				<ul>
					<li><?php echo $this->lang->line('customer'); ?> : <span><?php echo $ticket->name; ?></span></li>
					<li><?php echo $this->lang->line('department'); ?> : <span><?php echo $department; ?></span></li>
					<li><?php echo $this->lang->line('date'); ?> : <span><?php echo date('d F Y g:i a',$ticket->created_time); ?></span></li>
					<li><?php echo $this->lang->line('priority'); ?> : <span><?php 
                    
                    // Priority
                    switch( $ticket->priority )
                    {
                        case 1: echo $this->lang->line('low'); break;
                        case 2: echo $this->lang->line('medium'); break;
                        case 3: echo $this->lang->line('high'); break;
                    }
                    
                    ?></span></li>
					<li><?php echo $this->lang->line('email'); ?> : <span><?php echo $ticket->email; ?></span></li>
					<li><?php echo $this->lang->line('status'); ?> : <?php 
                    
                    switch( $ticket->ticket_status )
                    {
                        case 1: echo '<span class="open">'.$this->lang->line('open').'</span>'; break;
                        case 2: echo '<span class="wait1">'.$this->lang->line('pending').'</span>'; break;
                        case 3: echo '<span class="close">'.$this->lang->line('close').'</span>'; break;
                    }
                    
                    ?></li>
				</ul>
				<div class="clear"></div>
	</div>
	<!-- End Ticket info -->
	
	
	<!-- Start Chat -->
	<div class="stbox chat">
		<h1><?php echo $ticket->title; ?></h1>
		
		<?php
        if( !empty($messages) )
        {
            foreach($messages as $message)
            {
                
                $files = json_decode($message->files,true);
                
                if($message->department == 0){
                    
                    
            ?>
    		
    			<div class="chatline-customer">
    				<div class="profile">	
    					<img src="<?php echo base_url(); ?>images/customerimg.jpg" width="60" height="60" alt="customer" class="chatpicture"/>
    					<p class="chatname"><?php echo $this->lang->line('customer'); ?></p>
    				</div>
    				<div class="ballon"><?php echo $message->message;  ?>
                    
                    <?php if(count($files) > 0){ ?>
                    <div class="attachments">
                    <h4><?php echo $this->lang->line('attach'); ?> : </h4>
                    <ul>
                    <?php
                        for($c = 0; $c <= count($files); $c++)
                        {
                            echo '<li><a href="'.base_url('attachments/'.$files[$c]).'" target="_blank">'.$files[$c].'</a></li>';
                        }
                    ?>
                    </ul>
                    </div>
                    <?php } ?>
                    </div>
    				<img src="<?php echo base_url(); ?>images/customer-ballon-arrow.png" alt="arrow" class="customer-arrow"/>
    				<div class="clear"></div>
    				<div class="customer-date"><?php echo date('d F Y g:i a',$message->created_time); ?></div>
    			</div>
                
    		<?php 
            } else {
            ?>	
    			
    			<div class="chatline-support">
    				<div class="profile">	
    					<img src="<?php echo base_url(); ?>images/supportimg.jpg" width="60" height="60" alt="customer" class="chatpicture"/>
    					<p class="chatname"><?php echo $this->lang->line('support'); ?></p>
    				</div>
    				<div class="ballon"><?php echo $message->message;  ?>
                    
                    <?php if(count($files) > 0){ ?>
                    <div class="attachments">
                    <h4><?php echo $this->lang->line('attach'); ?> : </h4>
                    <ul>
                    <?php
                    
                        for($c = 0; $c <= count($files); $c++)
                        {
                            echo '<li><a href="'.base_url('attachments/'.$files[$c]).'" target="_blank">'.$files[$c].'</a></li>';
                        }
                    ?>
                    </ul>
                    </div>
                    <?php } ?>
                    </div>
    				<img src="<?php echo base_url(); ?>images/support-ballon-arrow.png" alt="arrow" class="support-arrow"/>
    				<div class="clear"></div>
    				<div class="support-date"><?php echo date('d F Y g:i a',$message->created_time); ?></div>
    			</div>
		<?php 
        
                }
            }
        } 
        
        ?>	
			
			
			<div id="ajax"></div>
			<!-- start reply -->
			<div class="reply" id="reply">
			
			<div id="upload_status" style="margin-bottom:15px;">
			
			</div>
			
                <form id="replyform">
				<textarea name="message" id="message" class="stinput" rows="6"></textarea>
                <input type="hidden" name="ticket_id" value="<?php echo $this->uri->segment(3); ?>" />
                <div id="submitbutton" style="text-align: right;margin-top:10px;">
                <input type="button" value="<?php echo $this->lang->line('close_ticket'); ?>" onclick="close_ticket(<?php echo $this->uri->segment(3); ?>);" class="stbutton button" style="float: left; width:150px;"/>
				<input type="button" name="button" id="button" value="<?php echo $this->lang->line('send'); ?>" onclick="reply_process();" class="stbutton button"/>
				</div>
                
                <div class="clear"></div>
                </form>
			</div>
			<!-- end reply -->
			
			
		
		
	</div>
	<!-- End Chat -->


</div>
<!-- End Ticket -->







