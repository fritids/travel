<script src="<?php echo JSPATH;?>jcrop/jquery.min.js"></script>
<script src="<?php echo JSPATH;?>jcrop/jquery.Jcrop.js"></script>
<script src="<?php echo JSPATH;?>jcrop/jquery.color.js"></script>
<script type="text/javascript">
  jQuery(function($){

    var jcrop_api;

		<?php 
		if($profile_attachments!=NULL)
          foreach($profile_attachments as $key=>$item){
		?>
		
		var img_id = "#target_<?php echo $item->profileattachment_id;?>";

	    $(img_id).Jcrop({
	      	bgFade:     true,
	      	bgOpacity: .2,
      		onSelect: updateCoords,
	      	setSelect: [ 0, 0, 660, 400 ]
	    },function(){
	      jcrop_api = this;
	    });
	    	    	    
	    <?php } ?>
    
    

    $('#fadetog').change(function(){
      jcrop_api.setOptions({
        bgFade: this.checked
      });
    }).attr('checked','checked');

    $('#shadetog').change(function(){
      if (this.checked) $('#shadetxt').slideDown();
        else $('#shadetxt').slideUp();
      jcrop_api.setOptions({
        shade: this.checked
      });
    }).attr('checked',false);

    // Define page sections
    var sections = {
      bgc_buttons: 'Change bgColor',
      bgo_buttons: 'Change bgOpacity',
      anim_buttons: 'Animate Selection'
    };
    // Define animation buttons
    var ac = {
      anim1: [217,122,382,284],
      anim2: [20,20,580,380],
      anim3: [24,24,176,376],
      anim4: [347,165,550,355],
      anim5: [136,55,472,183]
    };
    // Define bgOpacity buttons
    var bgo = {
      Low: .2,
      Mid: .5,
      High: .8,
      Full: 1
    };
    // Define bgColor buttons
    var bgc = {
      R: '#900',
      B: '#4BB6F0',
      Y: '#F0B207',
      G: '#46B81C',
      W: 'white',
      K: 'black'
    };
    // Create fieldset targets for buttons
    for(i in sections)
      insertSection(i,sections[i]);

    function create_btn(c) {
      var $o = $('<button />').addClass('btn btn-small');
      if (c) $o.append(c);
      return $o;
    }

    var a_count = 1;
    // Create animation buttons
    for(i in ac) {
      $('#anim_buttons .btn-group')
        .append(
          create_btn(a_count++).click(animHandler(ac[i])),
          ' '
        );
    }

    $('#anim_buttons .btn-group').append(
      create_btn('Bye!').click(function(e){
        $(e.target).addClass('active');
        jcrop_api.animateTo(
          [300,200,300,200],
          function(){
            this.release();
            $(e.target).closest('.btn-group').find('.active').removeClass('active');
          }
        );
        return false;
      })
    );

    // Create bgOpacity buttons
    for(i in bgo) {
      $('#bgo_buttons .btn-group').append(
        create_btn(i).click(setoptHandler('bgOpacity',bgo[i])),
        ' '
      );
    }
    // Create bgColor buttons
    for(i in bgc) {
      $('#bgc_buttons .btn-group').append(
        create_btn(i).css({
          background: bgc[i],
          color: ((i == 'K') || (i == 'R'))?'white':'black'
        }).click(setoptHandler('bgColor',bgc[i])), ' '
      );
    }
    // Function to insert named sections into interface
    function insertSection(k,v) {
      $('#interface').prepend(
        $('<fieldset></fieldset>').attr('id',k).append(
          $('<legend></legend>').append(v),
          '<div class="btn-toolbar"><div class="btn-group"></div></div>'
        )
      );
    };
    // Handler for option-setting buttons
    function setoptHandler(k,v) {
      return function(e) {
        $(e.target).closest('.btn-group').find('.active').removeClass('active');
        $(e.target).addClass('active');
        var opt = { };
        opt[k] = v;
        jcrop_api.setOptions(opt);
        return false;
      };
    };
    // Handler for animation buttons
    function animHandler(v) {
      return function(e) {
        $(e.target).addClass('active');
        jcrop_api.animateTo(v,function(){
          $(e.target).closest('.btn-group').find('.active').removeClass('active');
        });
        return false;
      };
    };
    
    
    function updateCoords(c){
	  $('#x').val(c.x);
	  $('#y').val(c.y);
	  $('#w').val(c.w);
	  $('#h').val(c.h);
	};
	
	  function checkCoords()
	  {
	    if (parseInt($('#w').val())) return true;
	    alert('Please select a crop region then press submit.');
	    return false;
	  };

    $('#bgo_buttons .btn:first,#bgc_buttons .btn:last').addClass('active');
    $('#interface').show();

  });


</script>
<link rel="stylesheet" href="<?php echo CSSPATH;?>jcrop/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" href="<?php echo CSSPATH;?>jcrop/jquery.Jcrop.extras.css" type="text/css" />


<div class="container">
	<div class="row">
		<div class="span12">
			<div class="jc-demo-box">

  				<div class="row-fluid">
   					<div class="span9">   						
   										<?php
	                                        //print_r($existence_offer_attachments);
	                                        if($profile_attachments!=NULL)
	                                        foreach($profile_attachments as $key=>$item){
	                                            $file_source = base_url().PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR.$item->profile_id."/".$item->image_name;
												echo "Edit and Save Image:<br>";
	                                            echo '<img src="'.$file_source.'" id="target_'.$item->profileattachment_id.'"';
												echo ' alt="Jcrop Image" />';
												echo "<br>";
										?>
										
										<form action="<?php echo base_url(); ?>profile/save_croped_images" method="post" onsubmit="return checkCoords();">
											<input type="hidden" id="image_id" name="image_id" value="<?php echo $item->attachment_id; ?>" />
											<input type="hidden" id="x" name="x" />
											<input type="hidden" id="y" name="y" />
											<input type="hidden" id="w" name="w" />
											<input type="hidden" id="h" name="h" />
											<input type="submit" value="Crop & save Image" class="button small yellow" />
										</form>
												
										<?php		
	                                        }
                                        ?>
    				</div>
  				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
