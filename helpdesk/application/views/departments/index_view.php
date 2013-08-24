<script>

 function delete_department( department_id )
 {
    //return confirm('Are you sure?');
    
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('departments/delete' ); ?>/" + department_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#department_id_' + department_id).fadeOut('normal');
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
		<h1 class="lih1"><?php echo $this->lang->line('departments'); ?></h1>
		
		<?php echo $this->session->flashdata('message'); ?>
		
		<table width="100%" class="tablelist">
			<thead>
				<td width="10%">ID</td>
				<td width="70%" align="left"><?php echo $this->lang->line('department_name'); ?></td>
				<td width="20%"><?php echo $this->lang->line('options'); ?></td>
			</thead>
			<tbody>
			<?php if( ! empty($departments) ){?>
			<?php foreach( $departments as $department){ ?>
			 <tr id="department_id_<?php echo $department->id; ?>">
			 	<td><?php echo $department->id; ?></td>
			 	<td align="left"><?php echo $department->department_name; ?></td>
			 	<td><a href="<?php echo base_url('departments/update/'.$department->id); ?>"><?php echo $this->lang->line('update'); ?></a>	<a href="javascript:void(0)" onclick="delete_department(<?php echo $department->id; ?>)"><?php echo $this->lang->line('delete'); ?></a></td>
			 </tr>
			<?php } ?>
			<?php } ?>
			</tbody>
		</table>
		
		<div class="bottombar"><a href="<?php echo base_url('departments/create'); ?>"><?php echo $this->lang->line('create_a_new_department'); ?></a> </div>

	</div>
	


</form>
<!-- End Ticket -->





