<?php echo form_open(site_url("feed/promote_post_pro/" . $post->ID), array("id" => "social-form-edit")) ?>
<div style="background-color: #e5e5e5 !important; color: black !important;" class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Boast Post </h4>
</div>
<div style="background-color: #f5f7f8 !important;" class="modal-body ui-front form-horizontal" id="promotePost">
	<div class="row">
        <div class="col-md-5">
            
        </div>
        <div class="col-md-7">
            <label>Perview: </label>
            <select class="form-control">
                <option>Desktop News Feed</option>
                <option>Mobile News Feed</option>
            </select>
            <div style="border:1px solid #DDD;background-color: white; margin-top: 10px;">
            <div class="feed-header clearfix">
            <div class="feed-header-user">
               <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->page_model->get_page($post->pageid)->row()->profile_avatar ?>" class="user-icon-big">
            </div>
            <div class="feed-header-info">
               <a href="http://192.168.10.102/sanutanu/index.php/pages/view/salman-khan123"><?php echo $this->page_model->get_page($post->pageid)->row()->name ?></a>       
               <div class="feed-timestamp" style="display: flex;">Sponserd <span style="margin-left: 4px;margin-top: 2px;" class="fa fa-globe"></span>
               </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
<button style="border-radius: 0px;" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<input style="border-radius: 0px;" type="submit" class="btn btn-post" value="Boast">
</div>

<?php echo form_close() ?>