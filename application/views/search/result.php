<!-- <div style="border: 1px solid #f2f2f2; min-height: 400px;margin-top: 10px; border-radius: 3px;"> -->
	<?php foreach ($searchdata->result() as $row) {
		if($row->type=='user')
		{
			$user = $this->user_model->get_user_by_id($row->ID)->row();

			$friend_flag = 0;
              $request_flag = 0;
              $friend = $this->user_model->get_user_friend($this->user->info->ID, $row->ID);
              if($friend->num_rows() > 0) {
                // Friends
                $friend_flag = 1;
              } else {
                // Check for a request
                $request = $this->user_model->check_friend_request($this->user->info->ID, $row->ID);
                if($request->num_rows() > 0) {
                  // Request sent
                  $request_flag = 1;
                }
              }

	?>
			<!-- <div style="min-height: 100px; border-bottom: 1px solid #CCC;">
				<?php echo $row->type; ?> <?php echo $row->name; ?>
			</div> -->
			<div style="display: flex; align-items: center; border: 1px solid #EEE; padding: 5px 10px; margin-bottom: 5px; border-radius: 3px; background: #FFF;">
				<div style="width: 70px;">
                    <img src="<?php echo base_url($this->settings->info->upload_path_relative.'/'.$user->avatar); ?>" alt="Profile Picture" style='width: 60px; height: 60px; border-radius: 50%;'>
                </div>
                <div class="caption" class="pull-left" style="width: calc(100% - 160px);">
                  <div style="font-weight: bold;">
                  <a href="<?php echo site_url('profile/'.$user->username); ?>" ><?php echo $row->name; ?></a>
                  </div>
                  <small>@<?php echo $user->username; ?> <?php if($this->user_model->mutual_frields($row->ID)>0){ echo $this->user_model->mutual_frields($row->ID).' mutual friends'; } ?></small>  
                </div>
                <div style="width: 90px;">

                	<?php if($friend_flag) : ?>
		                <button type="button" class="btn btn-post btn-sm" id="friend_button_<?php echo $row->ID ?>"><span class="glyphicon glyphicon-ok"></span> <?php echo lang("ctn_493") ?></button>
		                <?php else : ?>
		                <?php if($request_flag) : ?>
			                <button type="button" class="btn btn-post btn-sm disabled" id="friend_button_<?php echo $row->ID ?>"><?php echo lang("ctn_601") ?></button>
			                <?php else : ?> 
			                  <?php if(!$user->allow_friends) : ?>
			                  <button type="button" class="btn btn-post btn-sm" onclick="add_friend(<?php echo $row->ID ?>)" id="friend_button_<?php echo $row->ID ?>"><?php echo lang("ctn_602") ?></button>
			                  <?php endif; ?>
                		<?php endif; ?>
                <?php endif; ?>

                    <!-- <a class="btn btn-post btn-sm icon  pull-right">Add Friend</a> -->
                </div>
            </div>
	<?php
		}
		else if($row->type=='page')
		{
			$page = $this->page_model->get_page($row->ID)->row();
			$member = $this->page_model->get_page_user($page->ID, $this->user->info->ID)->num_rows();
			?>
			<div style="display: flex; align-items: center; border: 1px solid #EEE; padding: 5px 10px; margin-bottom: 5px; border-radius: 3px; background: #FFF;">
				<div style="width: 70px;">
                    <img src="<?php echo base_url($this->settings->info->upload_path_relative.'/'.$page->profile_avatar); ?>" alt="Profile Picture" style='width: 60px; height: 60px; border-radius: 50%;'>
                </div>
                <div class="caption" class="pull-left" style="width: calc(100% - 160px);">
                  <div style="font-weight: bold;">
                  <a href="<?php echo site_url('pages/view/'.$page->slug); ?>" ><?php echo $row->name; ?></a>
                  </div>
                  <small>@<?php echo $page->slug; ?> <?php if($page->members>0){ echo $page->members.' mambers'; } ?></small>
                </div>
                <div style="width: 90px;">
                	<?php if($member == 0) : ?>
					    <?php if($page->pay_to_join > 0) : ?>
					    <button type="button" class="btn btn-post btn-sm" data-toggle="modal" data-target="#joinModal"><?php echo lang("ctn_554") ?></button>
					    <?php else : ?>
					    <a href="<?php echo site_url("pages/join_page/" . $page->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-post btn-sm"><?php echo lang("ctn_554") ?></a>
					    <?php endif; ?>
					  <?php else : ?>
					    <a href="<?php echo site_url("pages/leave_page/" . $page->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> <?php echo lang("ctn_34") ?></a> 
					  <?php endif; ?>
                </div>
            </div>
			<?php
		}
		else if($row->type=='feed')
		{
			$feed = $this->feed_model->get_post($row->ID,$this->user->info->ID)->row();
			$feed2 = '';
			if($feed->share_postid>0)
			{
				$feed2 = $this->feed_model->get_post($feed->share_postid,$this->user->info->ID)->row();
			}
			$feed_urls = $this->feed_model->get_feed_urls($feed->ID);
			$right = '0 hide';
			$left = '12';
			$rightcontent = '';
			if($feed->imageid>0)
			{
				$right = '4';
				$left = '8';
				$rightcontent = '<img src="'.base_url().$this->settings->info->upload_path_relative.'/'.$feed->image_file_name.'" width="100%">';
			}
			else if($feed->videoid>0)
			{
				$right = '4';
				$left = '8';
			}
			else if($feed->pollid>0)
			{
				//post_as
			}

			if($feed->share_postid>0)
			{
				if($feed2->imageid>0)
				{
					$right = '4';
					$left = '8';
					$rightcontent = '<img src="'.base_url().$this->settings->info->upload_path_relative.'/'.$feed2->image_file_name.'" width="100%">';
				}
				else if($feed2->videoid>0)
				{
					$right = '4';
					$left = '8';
				}
				else if($feed2->pollid>0)
				{
					//post_as
				}
			}

			if($feed->post_as=='page')
			{
				$page = $this->page_model->get_page($feed->pageid)->row();
				$avatar = $page->profile_avatar;
				$name = $page->name;
				$profilelink = site_url('pages/view/'.$page->slug);
			}
			else
			{
				$user = $this->user_model->get_user_by_id($feed->userid)->row();
				$avatar = $user->avatar;
				$name = $user->first_name.' '.$user->last_name;
				$profilelink = site_url('profile/'.$user->username);
			}
			$profileuser = '';
			if($feed->profile_userid>0)
			{
				$pu = $this->user_model->get_user_by_id($feed->profile_userid)->row();
				$profileuser = '<a href="'.site_url('profile/'.$pu->username).'" >'.$pu->first_name.' '.$pu->last_name.'</a> <span class="glyphicon glyphicon-circle-arrow-right"></span> ';
			}
			$shareduser = '';
			if($feed->share_postid>0)
			{
				$su = $this->user_model->get_user_by_id($feed2->userid)->row();
				$shareduser = ' <span style="font-weight: normal;">Shared</span> <a href="'.site_url('profile/'.$su->username).'" >'.$su->first_name.' '.$su->last_name.'\'s post</a> ';
				$leftcontent = $feed2->content;
			}
			else
			{
				$leftcontent = $row->name;
			}
			?>
			<div style="border: 1px solid #EEE; padding: 5px 10px; margin-bottom: 5px; border-radius: 3px; background: #FFF;">
				<div style="display: flex; align-items: center;">
					<div style="width: 50px;">
	                    <img src="<?php echo base_url($this->settings->info->upload_path_relative.'/'.$avatar); ?>" alt="Profile Picture" style='width: 40px; height: 40px; border-radius: 50%;'>
	                </div>
	                <div class="caption" class="pull-left" style="width: calc(100% - 50px);">
	                  <div style="font-weight: bold;">
	                  <div><?php echo $profileuser; ?><a href="<?php echo $profilelink; ?>" ><?php echo $name; ?></a><?php echo $shareduser; ?></div>
	                  <small style="font-weight: normal; color: #999;"><?php echo $this->common->get_time_string_simple($this->common->convert_simple_time($feed->timestamp)); ?></small>
	                  </div>
	                </div>
				</div>

				<?php
				if($feed_urls->num_rows()>0)
				{
					$u = $feed_urls->row();
					?>
					<div class="row">
						<div class="col-md-8" style="max-height: 100px; text-overflow: ellipsis; overflow: hidden; flex-wrap: wrap; padding: 15px;">
							<a href="<?php echo $u->url; ?>" target="_blank" style="color: #000; text-decoration: none;">
							<div style="font-weight: bold;"><?php echo $u->title; ?></div>
							<div><?php echo $u->description; ?></div>
							</a>
						</div>
						<div class="col-md-4 ?>">
							<a href="<?php echo $u->url; ?>" target="_blank" style="color: #000; text-decoration: none;">
								<img src="<?php echo $u->image; ?>" width="100%" />
							</a>
						</div>
					</div>
					<?php
				}
				else
				{
					?>
					<a href="<?php echo site_url('home/index/3?postid='.$feed->ID); ?>" style="color: #000; text-decoration: none;">
						<div class="row">
							<div class="col-md-<?php echo $left; ?>" style="max-height: 100px; text-overflow: ellipsis; overflow: hidden; flex-wrap: wrap; padding: 15px;"><?php echo $leftcontent; ?></div>
							<div class="col-md-<?php echo $right; ?>">
								<?php
								echo $rightcontent;

								if(!empty($feed->video_file_name)) : ?>
									 <video width="100%" controls>
									 	<?php if($feed->video_extension == ".mp4") : ?>
										  <source src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $feed->video_file_name ?>" type="video/mp4">
										<?php elseif($feed->video_extension == ".ogg" || $feed->video_extension == ".ogv") : ?>
									      <source src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $feed->video_file_name ?>" type="video/ogg">
										<?php elseif($feed->video_extension == ".webm") : ?>
									      <source src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $feed->video_file_name ?>" type="video/webm">
										<?php endif; ?>
										<?php echo lang("ctn_501") ?>
									 </video> 
								<?php 
								elseif(!empty($feed->youtube_id)) : 
								?>
									<p><iframe width="100%" height="100" src="https://www.youtube.com/embed/<?php echo $feed->youtube_id ?>" frameborder="0" allowfullscreen></iframe></p>
								<?php 
								endif;
								if($feed->share_postid>0):
									if(!empty($feed2->video_file_name)) : ?>
										 <video width="100%" controls>
										 	<?php if($feed2->video_extension == ".mp4") : ?>
											  <source src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $feed2->video_file_name ?>" type="video/mp4">
											<?php elseif($feed2->video_extension == ".ogg" || $feed2->video_extension == ".ogv") : ?>
										      <source src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $feed2->video_file_name ?>" type="video/ogg">
											<?php elseif($feed2->video_extension == ".webm") : ?>
										      <source src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $feed2->video_file_name ?>" type="video/webm">
											<?php endif; ?>
											<?php echo lang("ctn_501") ?>
										 </video> 
									<?php 
									elseif(!empty($feed2->youtube_id)) : 
									?>
										<p><iframe width="100%" height="100" src="https://www.youtube.com/embed/<?php echo $feed2->youtube_id ?>" frameborder="0" allowfullscreen></iframe></p>
									<?php 
									endif;
								endif;
								?>
							</div>
						</div>
					</a>
					<?php
				}
				?>
				
            </div>
			<?php
		}
	} 
	?>
<!-- </div> -->
<?php if(isset($a_url) && $searchdata->num_rows() > 0) : ?>
<a href="<?php echo $a_url ?>" class="load_next"><?php echo lang("ctn_512") ?></a>
<?php endif; ?>