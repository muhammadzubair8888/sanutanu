<?php echo form_open(site_url("feed/promote_post_pro/" . $post->ID), array("id" => "social-form-edit")) ?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_719") ?></h4>
</div>
<div class="modal-body ui-front form-horizontal" id="promotePost">
	<div class="form-group">
        <label for="email-in" class="col-md-4 label-heading"><?php echo lang("ctn_719") ?></label>
        <div class="col-md-8">
            <p><?php echo lang("ctn_724") ?></p>
            <p><?php echo lang("ctn_725") ?> <strong><?php echo lang("ctn_726") ?></strong> <?php echo lang("ctn_727") ?></p>
        </div>
    </div>
	<div class="form-group">
        <label for="email-in" class="col-md-4 label-heading"><?php echo lang("ctn_1027") ?></label>
        <div class="col-md-8">
            <select class="form-control" name="duration">
                <option value="1"><?php echo lang("ctn_990") ?></option>
                <option value="2"><?php echo lang("ctn_991") ?></option>
                <option value="3"><?php echo lang("ctn_992") ?></option>
                <option value="4"><?php echo lang("ctn_993") ?></option>
            </select>
            <input type="text" class="form-control" name="pageviews" id="pageviews" value="1000">
            <span class="help-block"><?php echo lang("ctn_728") ?>
            <br />
            <br />
            <?php echo lang("ctn_729") ?>: 
            <strong>
                <?php echo $this->settings->info->credit_price_pageviews ?> 
                <?php echo lang("ctn_350") ?>
                </strong>
                <br />
                <br />
                <?php echo lang("ctn_730") ?>: 
                <strong>
                    <span id="pageviews_cost"><?php echo $this->settings->info->credit_price_pageviews ?>
                        
                    </span>
                     <?php echo lang("ctn_350") ?>
                 </strong> 
            </span>
        </div>
    </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
<input type="submit" class="btn btn-post" value="<?php echo lang("ctn_719") ?>">
</div>

<?php echo form_close() ?>

<script type="text/javascript">
$(document).ready(function() {
$('#pageviews').on("change", function() {
	var cost = <?php echo $this->settings->info->credit_price_pageviews ?>;
	var val = $('#pageviews').val();
	var total = parseFloat(val/1000);
	var total_cost = parseFloat(total * cost);

	$('#pageviews_cost').text(total_cost);
});
});
</script>