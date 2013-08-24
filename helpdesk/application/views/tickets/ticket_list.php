

 <script>
 <?php if( userdata('department') > 0 ){ ?>
 function delete_ticket( ticket_id )
 {
    //return confirm('Are you sure?');
    
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('tickets/delete' ); ?>/" + ticket_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#ticket_id_' + ticket_id).fadeOut('normal');
            }
        }

    });
       
 }
 <?php } ?>
 function close_ticket( ticket_id )
 {
    //return confirm('Are you sure?');
    
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('tickets/close' ); ?>/" + ticket_id,
        success: function(msg)
        {
			if( msg == 'closed' )
            {
                var ticket = $('#ticket_id_' + ticket_id).html();
				ticket = ticket.replace('<span class="open"><?php echo $this->lang->line('open'); ?></span>', '<span class="close"><?php echo $this->lang->line('close'); ?></span>');
                ticket = ticket.replace('<span class="wait1"><?php echo $this->lang->line('pending'); ?></span>', '<span class="close"><?php echo $this->lang->line('close'); ?></span>');
                $('#ticket_id_' + ticket_id).fadeOut('normal');
				$('#ticket_id_' + ticket_id).remove();
				
				$('#head_tr').prepend( '<tr id="ticket_id_' + ticket_id + '">' + ticket + '</tr>' ); 
				$('#closebutton_' + ticket_id).remove();
				$('#any_ticket_row').remove();
				
            }
        }

    });
 }
 
 

 </script>

 








<!-- Start Ticket -->
<div class="center880">

<form id="tickets" method="post">
<!-- Start Table -->
	<div class="stbox chat">
		<h1 class="lih1"><?php echo $this->lang->line('open_tickets'); ?></h1>
		
		
		<table width="100%" class="tablelist">
			<thead>
				<td width="20%"><?php echo $this->lang->line('date'); ?></td>
				<td width="19%"><?php echo $this->lang->line('department'); ?></td>
				<td width="28%"><?php echo $this->lang->line('title'); ?></td>
				<td width="8%"><?php echo $this->lang->line('status'); ?></td>
				<td width="24%"></td>
			</thead>
			<tbody>
			<?php if( ! empty($open_tickets) ){?>
			<?php foreach( $open_tickets as $ticket){ ?>
			<?
            switch( $ticket->ticket_status )
            {
                case 1: $status_img = '<span class="open">'.$this->lang->line('open').'</span>'; break;
				case 2: $status_img = '<span class="wait1">'.$this->lang->line('pending').'</span>'; break;
                case 3: $status_img = '<span class="close">'.$this->lang->line('close').'</span>'; break;
            }
            ?>
			 <tr id="ticket_id_<?php echo $ticket->id; ?>">
			 	<td><?php echo date('d F Y g:i a',$ticket->created_time); ?></td>
			 	<td><?php echo $ticket->department_name; ?></td>
			 	<td><?php echo $ticket->title; ?></td>
			 	<td><?php echo $status_img; ?></td>
			 	<td><a href="<?php echo base_url('tickets/id/'.$ticket->id); ?>"><?php echo $this->lang->line('ticket_details'); ?></a>	<a href="javascript:void(0)" onclick="close_ticket(<?php echo $ticket->id; ?>)" id="closebutton_<?php echo $ticket->id; ?>"><?php echo $this->lang->line('close'); ?></a></td>
			 </tr>
			<?php } ?>
			<?php } else { ?> <tr><td colspan="5"><h2><?php echo $this->lang->line('any_ticket'); ?></h2></td></tr> <?php } ?>
			</tbody>
		</table>
		
		<div class="bottombar"> </div>

	</div>
	
	
	<div class="stbox chat">
		<h1 class="lih1"><?php echo $this->lang->line('other_tickets'); ?></h1>
		
		
		<table width="100%" class="tablelist">
			<thead>
				<td width="20%"><?php echo $this->lang->line('date'); ?></td>
				<td width="19%"><?php echo $this->lang->line('department'); ?></td>
				<td width="28%"><?php echo $this->lang->line('title'); ?></td>
				<td width="8%"><?php echo $this->lang->line('status'); ?></td>
				<td width="24%"></td>
			</thead>
			<tbody id="head_tr">
			<?php if( ! empty($other_tickets) ){?>
			<?php foreach( $other_tickets as $ticket){ ?>

			 <tr id="ticket_id_<?php echo $ticket->id; ?>">
			 	<td><?php echo date('d F Y g:i a',$ticket->created_time); ?></td>
			 	<td><?php echo $ticket->department_name; ?></td>
			 	<td><?php echo $ticket->title; ?></td>
			 	<td><span class="close"><?php echo $this->lang->line('close'); ?></span></td>
			 	<td><a href="<?php echo base_url('tickets/id/'.$ticket->id); ?>"><?php echo $this->lang->line('ticket_details'); ?></a> <?php if( userdata('department') > 0 ){ ?><a href="javascript:void(0)" onclick="delete_ticket(<?php echo $ticket->id; ?>)"><?php echo $this->lang->line('delete'); ?></a><?php } ?></td>
			 </tr>
			<?php } ?>
			<?php } else { ?> <tr id="any_ticket_row"><td colspan="5"><h2><?php echo $this->lang->line('any_ticket'); ?></h2></td></tr> <?php } ?>
			</tbody>
		</table>
		
		<div class="bottombar">
			<div class="actionbutton"></div>
			<div class="pagebutton"><?php echo $links; ?></div>
			<div class="clear"></div>
		</div>

	</div>
	<!-- End Table -->


</form>
<!-- End Ticket -->







