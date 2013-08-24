<?php 
	if($comments_list!=NULL){
		foreach($comments_list as $comment_key=>$comment_item) { ?>
            <article id="comment_item_<?php echo $comment_item->comment_id; ?>" class="comments dashboard_item">
                <div class="item_body">
                <h5>
                     <span class="stars">
                     	<input name="star_<?php echo $comment_item->comment_id;?>" type="radio" class="star" disabled="disabled" <?php if($comment_item->hotel_rating==1) { ?> checked="checked" <?php }?> />
						<input name="star_<?php echo $comment_item->comment_id;?>" type="radio" class="star" disabled="disabled" <?php if($comment_item->hotel_rating==2) { ?> checked="checked" <?php }?> />
						<input name="star_<?php echo $comment_item->comment_id;?>" type="radio" class="star" disabled="disabled" <?php if($comment_item->hotel_rating==3) { ?> checked="checked" <?php }?> />
						<input name="star_<?php echo $comment_item->comment_id;?>" type="radio" class="star" disabled="disabled" <?php if($comment_item->hotel_rating==4) { ?> checked="checked" <?php }?> />
						<input name="star_<?php echo $comment_item->comment_id;?>" type="radio" class="star" disabled="disabled" <?php if($comment_item->hotel_rating==5) { ?> checked="checked" <?php }?> />
					</span>
                    </h5>	
                    <div class="clearfix"></div>
                                                                                        
                    <h4>
                        <a href="<?php echo base_url();?><?php echo hotel_url($comment_item);?>" title="<?php echo $comment_item->hotel_name;?>">
                         <?php echo $comment_item->hotel_name;?>
                        </a>
                    </h4>
                    <div class="clearfix"></div>
            
                    <p class="detail">
                        <?php echo $comment_item->comments;?>
                    </p>							
            
                </div>
                <div class="item_body_right">
                    <a id="delete_button" href="javascript:void(0);" class="button small red">delete</a>
						<div class="popover">
                            <a href="javascript:void(0);" class="close"></a>
                            <div class="inner">
                                <h3 class="title"><?php echo lang('delete_comment_message');?></h3>
                                    <div class="content">
                                        <ul>
                                            <li><a class="yes"  href="javascript:void(0);" onclick="delete_comment(<?php echo $comment_item->comment_id;?>);"><?php echo lang('yes_string');?></a></li>
                                            <li><a class="no" href="javascript:void(0);"><?php echo lang('no_string');?></a></li>
                                        </ul>								 
                                    </div>
                            </div>															 
						</div>
                        <div style="clear:both;"></div>
                </div>
            </article>
<?php 
	}
}else{
?>
	<div class="error_message_final"><?php echo lang('you_dont_have_recent_comments');?></div>
<?php } ?>