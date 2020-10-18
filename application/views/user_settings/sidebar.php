<div class="white-area-content">
<ul class="settings-sidebar">
	<li><span class="glyphicon glyphicon-cog"></span> <a href="<?php echo site_url("user_settings") ?>"><?php echo lang("ctn_156") ?></a></li>
	<li><span class="glyphicon glyphicon-lock"></span> <a href="<?php echo site_url("user_settings/change_password") ?>"><?php echo lang("ctn_225") ?></a></li>
	<li><span class="glyphicon glyphicon-eye-open"></span> <a href="<?php echo site_url("user_settings/privacy") ?>"><?php echo lang("ctn_629") ?></a></li>
	<li><span class="glyphicon glyphicon-glass"></span> <a href="<?php echo site_url("user_settings/social_networks") ?>"><?php echo lang("ctn_422") ?></a></li>
	<li><span class="glyphicon glyphicon-user"></span> <a href="<?php echo site_url("user_settings/friend_requests") ?>"><?php echo lang("ctn_640") ?></a></li>
	<li><span class="glyphicon glyphicon-file"></span> <a href="<?php echo site_url("user_settings/page_invites") ?>"><?php echo lang("ctn_626") ?></a></li>
	<?php if($this->settings->info->enable_verified_requests) : ?>
		<li><span class="glyphicon glyphicon-ok"></span> <a href="<?php echo site_url("user_settings/verified") ?>"><?php echo lang("ctn_743") ?></a></li>
	<?php endif; ?>
	<li><span class="fa fa-bug"></span> <a href="<?php echo site_url("user_settings/report_bug") ?>"><?php echo lang("ctn_969") ?></a></li>
	<li><span class="fa fa-language"></span> <a href="<?php echo site_url("home/change_language") ?>"><?php echo lang("ctn_146") ?></a></li>
	<li><span class="fa fa-address-book"></span><a href="<?php echo site_url("user_settings/contact_us") ?>"><?php echo lang("ctn_1028") ?></a></li>
	<li><span class="fa fa-newspaper-o"></span> <a href="<?php echo site_url("user_settings/advert") ?>"><?php echo lang("ctn_708") ?></a></li>

</ul>
</div>