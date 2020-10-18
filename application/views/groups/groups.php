<!-- <div class="white-area-content">
<div class="row">
 <div class="col-md-12">

  <?php 
 if($this->home_model->get_ad_group()->num_rows()>0)
 {
  $ad = $this->home_model->get_ad_group()->row();
  $image = $ad->image;
 }
 else
 {
  $image = 'ad.jpg';
 }
 
 ?>
<img src="<?php echo base_url() ?>uploads/<?php echo $image; ?>" style="width: 100%; height: 100%; border-radius: 1rem;" />
</div></div></div>
 -->
 
<br>
 <div class="row">

<div class="col-sm-8">
<div class="white-area-content" style="margin-left: 326px; margin-right: -325px;  margin-top: 8px;">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="fa fa-users sidebaricon"></span> <?php echo lang("ctn_987") ?></div>
    <div class="db-header-extra"><input type="button" class="btn btn-post btn-sm" value="<?php echo lang("ctn_14") ?>" data-toggle="modal" data-target="#memberModal" />
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("home") ?>"><?php echo lang("ctn_15") ?></a></li>
  <!-- <li class="active"><?php echo lang("ctn_15") ?></li> -->
</ol>

<p><?php echo lang("ctn_51") ?></p>

<hr>

<table class="table table-bordered">
<tr class="table-header">
  
  <td><?php echo lang("ctn_18") ?></td>
  <td><?php echo lang("ctn_19") ?></td>
  <td><?php echo lang("ctn_52") ?></td></tr>
<?php foreach($groups->result() as $r) : ?>

<tr>
 <td><a href="<?php echo site_url("groups/view/" .$r->ID) ?>"><?php echo $r->name ?></a></td>
<!--   <td><?php echo $r->name ?></td> -->
  <td><?php if($r->default) { echo lang("ctn_53");}else{ echo lang("ctn_54"); } ?></td>
  <td><a href="<?php echo site_url("groups/edit_group/" . $r->ID) ?>" class="btn btn-warning btn-xs" title="<?php echo lang("ctn_55") ?>"><span class="glyphicon glyphicon-cog"></span></a>

   <a href="<?php echo site_url("groups/delete_group/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo lang("ctn_56") ?>')" title="<?php echo lang("ctn_57") ?>">
    <span class="glyphicon glyphicon-trash"></span></a> <a href="<?php echo site_url("home/view_group/" . $r->ID) ?>" class="btn btn-post btn-xs"><?php echo lang("ctn_58") ?></a></td>
  </tr>
<?php endforeach; ?>
</table>

<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang("ctn_14") ?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("groups/add_group_pro"), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_18") ?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="email-in" name="name">
                    </div>
            </div>

            <div class="form-group">
                <label for="username-in" class="col-md-3 label-heading"><?php echo lang("ctn_19") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="default_group" value="1">
                            <span class="help-block"><?php echo lang("ctn_59") ?></span>
                        </div>
            </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-post" value="<?php echo lang("ctn_61") ?>" />
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
</div>

</div> <!-- col4 ending div -->

</div> <!-- row -->


