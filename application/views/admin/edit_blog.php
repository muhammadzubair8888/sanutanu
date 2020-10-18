<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_772") ?></li>
</ol>


<?php echo form_open_multipart(site_url("admin/edit_blog_pro/" . $blog->ID), array("class" => "form-horizontal")) ?>
                <div class="panel panel-default">
                <div class="panel-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_773") ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="<?php echo $blog->title ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_774") ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" value="<?php echo $blog->description ?>">
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_775") ?></label>
                    <div class="col-sm-10">
                        <select name="private" class="form-control">
                          <option value="0"><?php echo lang("ctn_539") ?></option>
                          <option value="1" <?php if($blog->private == 1) echo "selected" ?>><?php echo lang("ctn_633") ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_1072") ?></label>
                    <div class="col-sm-10">
                        <select name="block_blog" class="form-control">
                          <option value="0"><?php echo lang("ctn_539") ?></option>
                          <option value="1" <?php if($blog->blog_status == 1) echo "selected" ?>><?php echo lang("ctn_1068") ?></option>
                          <option value="2" <?php if($blog->blog_status == 2) echo "selected" ?>><?php echo lang("ctn_1069") ?></option>
                          <option value="3" <?php if($blog->blog_status == 3) echo "selected" ?>><?php echo lang("ctn_1070") ?></option>
                          <option value="4" <?php if($blog->blog_status == 4) echo "selected" ?>><?php echo lang("ctn_1071") ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_1076") ?></label>
                    <div class="col-sm-10">
                        <select name="approve_blog" class="form-control">
                          <option value="0"><?php echo lang("ctn_1073") ?></option>
                          <option value="1" <?php if($blog->blog_approved == 1) echo "selected" ?>><?php echo lang("ctn_1075") ?></option>
                          
                        </select>
                    </div>
                </div>

                <input style="color:#FFF; background:#a41be3;" type="submit" class="btn form-control" value="<?php echo lang("ctn_13") ?>">

                </div>
                </div>
                <?php echo form_close() ?>


</div>
