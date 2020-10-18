<?php if(isset($promoted_posts)) : ?>
<?php foreach($promoted_posts->result() as $r) : ?>
	<?php
	$this->feed_model->decrease_post_pageviews($r->promoted_id);
	?>
<?php include("story_single.php"); ?>
<?php endforeach; ?>
<?php endif; ?>
<?php foreach($posts->result() as $r) : ?>
	<?php if($r->postfor==1): ?>
		<?php include("story_single.php"); ?>
	<?php elseif($r->postfor==2): ?>
		<?php if($r->member_only && isset($member) && !isset($member->ID)) : ?>
			<?php include("feed_hidden.php"); ?>
		<?php else : ?>
			<?php include("story_single.php"); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php if($r->userid==$this->user->info->ID): ?>
			<?php include("story_single.php"); ?>
		<?php endif; ?>

	<?php endif; ?>
<?php endforeach; ?>
<?php if(isset($a_url) && $posts->num_rows() > 0) : ?>
<a href="<?php echo $a_url ?>" class="load_next"><?php echo lang("ctn_512") ?></a>
<?php endif; ?>