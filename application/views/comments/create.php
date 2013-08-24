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