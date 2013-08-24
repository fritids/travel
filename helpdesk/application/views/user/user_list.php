

 <script>

 function delete_user( user_id )
 {
    //return confirm('Are you sure?');
    
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('member/delete' ); ?>/" + user_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#user_id_' + user_id).fadeOut('normal');
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
		<h1 class="lih1"><?php echo $this->lang->line('users'); ?></h1>
		
		
		<table width="100%" class="tablelist">
			<thead>
				<td width="20%"><?php echo $this->lang->line('name'); ?></td>
				<td width="20%"><?php echo $this->lang->line('email'); ?></td>
				<td width="15%"><?php echo $this->lang->line('department'); ?></td>
				<td width="18%"><?php echo $this->lang->line('register_time'); ?></td>
				<td width="24%"><?php echo $this->lang->line('options'); ?></td>
			</thead>
			<tbody>
			<?php if( ! empty($users) ){?>
			<?php foreach( $users as $user){ ?>
			 <tr id="user_id_<?php echo $user->id; ?>">
			 	<td><?php echo $user->name; ?></td>
			 	<td><?php echo $user->email; ?></td>
			 	<td><?php if($user->department_name){ echo $user->department_name; }else{ echo 'Customer'; } ?></td>
			 	<td><?php echo date('d F Y g:i a',$user->register_time); ?></td>
			 	<td><a href="<?php echo base_url('member/update/'.$user->id); ?>"><?php echo $this->lang->line('user_details'); ?></a>	<a href="javascript:void(0)" onclick="delete_user(<?php echo $user->id; ?>)"><?php echo $this->lang->line('delete'); ?></a></td>
			 </tr>
			<?php } ?>
			<?php } else { ?> <tr><td colspan="5"><h2><?php echo $this->lang->line('any_user'); ?></h2></td></tr> <?php } ?>
			</tbody>
		</table>
		
		<div class="bottombar"> </div>

	</div>
	


</form>
<!-- End Ticket -->






