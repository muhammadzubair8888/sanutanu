<div class="feed-comment-wrapper">
<div class="feed-comments-spot-reply-<?php echo $comment->ID ?>" id="feed-comments-spot-reply-<?php echo $comment->ID ?>">
<?php include("feed_comment_replies_single.php"); ?>
</div>
<div class="feed-comment-m clearfix">
  <div class="feed-comment-m-part1">
    <a href="#">
      <img style="width: 15px !important;height: 15px !important;" src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" class="user-icon">
    </a>
  </div>
  <div class="feed-comment-m-part2">
   <input style="border-radius: 16px;background-color: #dddddd42;" type="text" class="form-control feed-comment-input-reply feed-comment-input-reply<?php echo $comment->ID ?>" placeholder="<?php echo lang("ctn_513") ?> ..." data-id="<?php echo $comment->ID ?>">
  </div>
</div>
</div>