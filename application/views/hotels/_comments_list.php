<div id="new_comment">
	<h5>
    	<label for="comment_cont"><?php echo lang('share_your_thoughts');?></label> 
        <?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
        	<span>(<?php echo lang('you_are_logged_in_as');?> <?php echo $loggedin_username;?>)</span>
        <?php } ?>
    </h5>

	<form id="post_new_comments" method="post" action="<?php echo base_url();?><?php echo $this->config->item('create_new_comments_url');?>">
    	<p>
        	<textarea name="comment_content" id="comment_textbox" class="comment-content" style="width: 450px; height: 100px;"></textarea>
        </p>
		<p class="controls">
			<input type="hidden" name="commented_hotel_id" id="commented_hotel_id" value="<?php if(isset($hotel_profile_information)) echo $hotel_profile_information[0]->profile_id;?>">
			<input type="hidden" name="comment_parent" id="comment_parent" value="0">
			<?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
           		<input type="submit" name="post_new_comments" id="post_new_comments" value="Post Comment" class="button medium btn-red" />
            <?php }else{ ?>
            	<a class="open-popup button medium yellow" rel="leanModal" href="#user-login-popup">Post Comment</a>
            <?php }?>
        </p>
    </form>
</div>
<ul class="comments_list">
<?php if($comments!=NULL) { ?>
		<?php foreach($comments as $key=>$comment) { ?>					
                    <li id="comment_item_<?php echo $comment->comment_id;?>">
						<a href="#">
                        	<?php
								if(isset($comment) && $comment->avatar!=NULL)
								{
									$file_source = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR.$comment->user_id."/".$comment->avatar;
									echo image_thumb($file_source,48,48);
								}
							?>
                        </a>
						<div class="author_details">
							<h5>
                            	<a href="#"><?php echo $comment->display_name; ?></a><br/>
								<span class="item_time"><?php echo $comment->posted_on;?></span>
							</h5>
							<p class="author_bio"><?php echo $comment->comments;?></p>
						</div>
					</li>
	<?php } ?>
<?php } ?>
<li></li>
</ul>