<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra">      <input type="button" class="btn btn-post btn-sm" value="Add Invite" data-toggle="modal" data-target="#addModal" />
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_1042") ?></li>
</ol>


<hr>

 <div class="panel panel-default">
                <div class="panel-body">
 <?php echo form_open(site_url("admin/edit_communities_pro/" . $community->ID), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_1042") ?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $community->name ?>">
                       
                    </div>
            </div>
            

                <input type="submit" class="btn btn-post form-control" value="<?php echo lang("ctn_810") ?>" />
        <?php echo form_close() ?>

                  </div>
                </div>

</div>