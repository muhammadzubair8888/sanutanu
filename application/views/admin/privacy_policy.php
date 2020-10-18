<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_981") ?></li>
</ol>

     <?php echo form_open_multipart(site_url("admin/privacy/save"), array("class" => "form-horizontal")) ?>
            <div class="panel panel-default">
            <div class="panel-body">

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_506") ?></label>
                <div class="col-sm-10">
                    <textarea name="description" id="post"><?php echo $page_data['description']; ?></textarea>
                </div>
            </div>

            <input type="submit" class="btn btn-post form-control" value="<?php echo lang("ctn_13") ?>">

            </div>
            </div>
            <?php echo form_close() ?>


</div>


        <script type="text/javascript">
CKEDITOR.replace('post', { height: '300'});

</script>