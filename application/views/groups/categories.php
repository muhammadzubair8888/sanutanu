<div style="margin-top: 20px;" class="row">

<?php include(APPPATH . "/views/groups/sidebarofgroups.php"); ?>
 
<div  class="col-md-9">

    <div style="background-color: #F2F2F2; padding: 10px; margin-bottom: 20px; border: 1px solid rgb(218, 221, 225);">
    <div class="row">
      <div class="col-md-6"> 
              <p style="color: black; font-size: 16px; font-weight: bold;">ALL Categories</p>
      </div>
    </div> 
    <p>Find a group by browsing top categories.</p>
    <div class="row">
      <?php  
            foreach($groupcat as $key):
      ?>
      <div style="margin-top: 15px;" class="col-md-3">
        <a style="text-decoration: none;" href="<?php echo site_url('groups/category_id/').$key->id ?>">
        <div class="card">
          <div class="card_image"> <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $key->image ?>" /> </div>
          <div class="card_title title-white">
            <p ><?php echo $key->name; ?></p>
          </div>
        </div>
        </a>
      </div>
      <?php
            endforeach;
          ?> 
    </div>
  </div>

</div>
</div>
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="padding-top: 5px; padding-bottom: 5px; background-color: #f5f6f7 !important;" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: #1d2129;font-size: 14px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap; font-weight: bold;" class="modal-title" id="myModalLabel"><?php echo lang("ctn_1030") ?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("groups/add_group_pro"), array("class" => "form-horizontal")) ?>
      <br>
                    <label><?php echo lang("ctn_1031") ?></label>
                    <input style="border-radius: 0px;" type="text" class="form-control" id="email-in" name="name">
            <br>
            <label><?php echo lang("ctn_1032") ?></label>
            <textarea rows="6" style="border-radius: 0px;" id="description" class="form-control" name="description" placeholder="Write something.." ></textarea>
            <br>
            <label><?php echo lang("ctn_1033") ?></label>
            <select required="" name="groupcatid" class="form-control" style="border-radius: 0px;">
                      <?php  
            foreach($groupcat as $key):
          ?>
            <option value="<?php echo $key->id; ?>"><?php echo $key->name; ?></option>
                  <?php
            endforeach;
          ?> 
            </select>
            </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-post" value="<?php echo lang("ctn_559") ?>" />
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
</div>