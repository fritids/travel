
<link type="text/css" href="<?php echo base_url(); ?>style/smoothness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.21.custom.min.js"></script>

 <script>
 $(function(){ $('#tabs').tabs(); });
    
 function change_email()
 {
	$.ajax({

        type: "POST",
        url: "<?php echo base_url('member/change_email'); ?>",
        data: $("#change_email").serialize(),
        beforeSend : function(msg){ $("#submitbutton1").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#ajax").html(msg); 
			$("#submitbutton1").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('change_email'); ?>" onclick="change_email()" class="stbutton"/>');
            
        }

    });

 }
 
 function change_password()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('member/change_password'); ?>",
        data: $("#change_password").serialize(),
        beforeSend : function(msg){ $("#submitbutton2").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#ajax").html(msg); 
			$("#submitbutton2").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('change_password'); ?>" onclick="change_password()" class="stbutton"/>');
            
        }

    });

 }
 
 function upload_settings()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('member/upload_settings'); ?>",
        data: $("#upload_settings").serialize(),
        beforeSend : function(msg){ $("#submitbutton3").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#ajax").html(msg); 
			$("#submitbutton3").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('Save'); ?>" onclick="upload_settings()" class="stbutton"/>');
            
        }

    });

 }
 
 function general_settings()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('member/general_settings'); ?>",
        data: $("#general_settings").serialize(),
        beforeSend : function(msg){ $("#submitbutton4").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#ajax").html(msg); 
			$("#submitbutton4").html('<input type="button" name="button" id="button" value="<?php echo $this->lang->line('save'); ?>" onclick="general_settings()" class="stbutton"/>');
            
        }

    });

 }

 </script>

 

<div class="center880" style="padding: 20px;">
<div class="stbox chat">

<h1 class="lih1"><?php echo $this->lang->line('admin_settings'); ?></h1>
<div class="container">


<div id="ajax"><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?></div>


<div id="tabs">

			<ul>
                <li><a href="#tabs-1"><?php echo $this->lang->line('general_settings'); ?></a></li>
                
				<li><a href="#tabs-2"><?php echo $this->lang->line('change_email'); ?></a></li>

				<li><a href="#tabs-3"><?php echo $this->lang->line('change_password'); ?></a></li>

				<li><a href="#tabs-4"><?php echo $this->lang->line('upload_settings'); ?></a></li>

			</ul>
            
            <div id="tabs-1">
            
            <form id="general_settings">
            
        		<div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('site_name'); ?></label>
        
        			<input type="text" name="site_name" value="<?php echo config('site_name'); ?>"  class="stinput"/>
        
                    <?php echo $this->lang->line('site_name_desc'); ?>
                    
        		</div>
                
                <div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('site_email'); ?></label>
        
        			<input type="text" name="site_email" value="<?php echo config('site_email'); ?>"  class="stinput"/>
        
                    <?php echo $this->lang->line('site_email_desc'); ?>
        
        		</div>
                
                <div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('tickets_per_page'); ?></label>
        
        			<input type="text" name="tickets_per_page" value="<?php echo config('tickets_per_page'); ?>"  class="stinput"/>
        
        		</div>
        		
                
        
        		<div id="submitbutton4" style="text-align: center;">
        
                <input type="button" name="button" id="button" value="<?php echo $this->lang->line('save'); ?>" onclick="general_settings()" class="stbutton"/>
        
                </div>
                	
        	</form>
            
            </div>
            
			<div id="tabs-2">
            
            <form id="change_email">
		
        		<div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('email'); ?></label>
        
        			<input type="text" name="email" value="<?php echo $user->email; ?>"  maxlength="50" class="stinput"/>
        
        		</div>
        		<div id="submitbutton1" style="text-align: center;">
        
                <input type="button" name="button" id="button" value="<?php echo $this->lang->line('change_email'); ?>" onclick="change_email()" class="stbutton"/>
        
                </div>	
        	</form>
            
            
            
            </div>

			<div id="tabs-3">
            
            <form id="change_password">
        		<div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('current_password'); ?></label>
        
        			<input type="password" name="currentpass" value=""  maxlength="20" class="stinput"/>
        
        		</div>
        		
        		<div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('new_password'); ?></label>
        
        			<input type="password" name="pass1" value=""  maxlength="20" class="stinput"/>
        
        		</div>
        
                
        
                <div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('retype_new_password'); ?></label>
        
        			<input type="password" name="pass2" value="" maxlength="20" class="stinput"/>
        
        		</div>	
        
        		
        
        		<div id="submitbutton2" style="text-align: center;">
        
                <input type="button" name="button" id="button" value="<?php echo $this->lang->line('change_password'); ?>" onclick="change_password()" class="stbutton"/>
        
                </div>	
        	</form>
            </div>

			<div id="tabs-4">
            <form id="upload_settings">
        		<div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('allowed_files'); ?></label>
        
        			<input type="text" name="allowed_extensions" value="<?php echo config('allowed_extensions'); ?>"  class="stinput"/>
        
        		</div>
        		
        		<div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('max_upload_files'); ?></label>
        
        			<select name="max_upload_files" class="stinput">
                    <option value="1" <?php if( config('max_upload_files') == 1 ){ echo 'selected="selected"'; } ?>>1</option>
                    <option value="2" <?php if( config('max_upload_files') == 2 ){ echo 'selected="selected"'; } ?>>2</option>
                    <option value="3" <?php if( config('max_upload_files') == 3 ){ echo 'selected="selected"'; } ?>>3</option>
                    <option value="4" <?php if( config('max_upload_files') == 4 ){ echo 'selected="selected"'; } ?>>4</option>
                    <option value="5" <?php if( config('max_upload_files') == 5 ){ echo 'selected="selected"'; } ?>>5</option>
                    <option value="6" <?php if( config('max_upload_files') == 6 ){ echo 'selected="selected"'; } ?>>6</option>
                    <option value="7" <?php if( config('max_upload_files') == 7 ){ echo 'selected="selected"'; } ?>>7</option>
                    <option value="8" <?php if( config('max_upload_files') == 8 ){ echo 'selected="selected"'; } ?>>8</option>
                    <option value="9" <?php if( config('max_upload_files') == 9 ){ echo 'selected="selected"'; } ?>>9</option>
                    <option value="10" <?php if( config('max_upload_files') == 10 ){ echo 'selected="selected"'; } ?>>10</option>
                    </select>
        
        		</div>
        
                
        
                <div class="formline">
        
        			<label class="stlabel"><?php echo $this->lang->line('max_upload_file_size'); ?></label>
        
        			<select name="max_upload_file_size" class="stinput">
                    <option value="1000" <?php if( config('max_upload_file_size') == 1000 ){ echo 'selected="selected"'; } ?>>1 MB</option>
                    <option value="2000" <?php if( config('max_upload_file_size') == 2000 ){ echo 'selected="selected"'; } ?>>2 MB</option>
                    <option value="3000" <?php if( config('max_upload_file_size') == 3000 ){ echo 'selected="selected"'; } ?>>3 MB</option>
                    <option value="4000" <?php if( config('max_upload_file_size') == 4000 ){ echo 'selected="selected"'; } ?>>4 MB</option>
                    <option value="5000" <?php if( config('max_upload_file_size') == 5000 ){ echo 'selected="selected"'; } ?>>5 MB</option>
                    <option value="6000" <?php if( config('max_upload_file_size') == 6000 ){ echo 'selected="selected"'; } ?>>6 MB</option>
                    <option value="7000" <?php if( config('max_upload_file_size') == 7000 ){ echo 'selected="selected"'; } ?>>7 MB</option>
                    <option value="8000" <?php if( config('max_upload_file_size') == 8000 ){ echo 'selected="selected"'; } ?>>8 MB</option>
                    <option value="9000" <?php if( config('max_upload_file_size') == 9000 ){ echo 'selected="selected"'; } ?>>9 MB</option>
                    <option value="10000" <?php if( config('max_upload_file_size') == 10000){ echo 'selected="selected"'; } ?>>10 MB</option>
                    
                    </select>
        
        		</div>	
        
        		
        
        		<div id="submitbutton3" style="text-align: center;">
        
                <input type="button" name="button" id="button" value="<?php echo $this->lang->line('save'); ?>" onclick="upload_settings()" class="stbutton"/>
        
                </div>	
        	</form>
            </div>

		</div>

 
	
			
</div>
				

	

</div>
</div>









