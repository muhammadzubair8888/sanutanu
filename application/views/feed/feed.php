<?php if(isset($promoted_posts)) : ?>
<?php foreach($promoted_posts->result() as $r) : ?>
	<?php
	$this->feed_model->decrease_post_pageviews($r->promoted_id);
	?>
<?php include("feed_single.php"); ?>
<?php endforeach; ?>
<?php endif; ?>
<?php foreach($posts->result() as $r) : ?>
	<?php //print_r($this->db->last_query()); ?>
	<?php if( $this->feed_model->is_post_reported($r->ID) == 0 ): ?>
		<?php if($r->postfor==1): ?>
			<?php include("feed_single.php"); ?>
		<?php elseif($r->postfor==2): ?>
			<?php if($r->status_post == 0 && $r->roleid == 0): ?>
				<?php else:?>
			<?php if($r->member_only && isset($member) && !isset($member->ID)) : ?>
				<?php include("feed_hidden.php"); ?>
			<?php else : ?>
				<?php include("feed_single.php"); ?>
			<?php endif; ?>
			<?php endif; ?>

		<?php else : ?>
			<?php if($r->userid==$this->user->info->ID): ?>
				<?php include("feed_single.php"); ?>
			<?php endif; ?>

		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; ?>
<?php if(isset($a_url) && $posts->num_rows() > 0) : ?>
<a href="<?php echo $a_url ?>" class="load_next"><?php echo lang("ctn_512") ?></a>
<?php endif; ?>