<div class="row">
   <div class="col-md-12">
      <div class="row half-separator">
         <div style="position: sticky;top: 55px;" class="col-md-2">
            <div>
               <div style="font-size: 25px;">
                  <a style="color: #1ca1fa !important; " href="<?php echo site_url('groups/view/').$group->ID ?>"><?php echo $group->name ?></a>
               </div>
               <div style="display: flex;color: #90949c;font-size: 13px;font-weight: 600;line-height: 18px;">
                  <span class="glyphicon glyphicon-lock"></span>
                  <p>Private Group</p>
               </div>
               <div style="height: auto!important;" class="sidebar-block custom-scrollbar-css" id="homepage-links">
                  <ul>
                     <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/about/" . $group->ID) ?>">About</a></li>
                     <li class="active"><a href="<?php echo site_url("groups/view/" . $group->ID) ?>">Discussion</a></li>
                     <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/events/" . $group->ID) ?>">Events</a></li>
                     <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/albums/" . $group->ID) ?>">Albums</a></li>
                     <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/files/" . $group->ID) ?>">Files</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-10">
            <?php include(APPPATH . "/views/groups/coverimage.php"); ?>
            <div  class="row">
                  <div class="col-md-12">
                    <div style="border: 1px solid #DDD;" class="col-md-3">
                      <ul style="list-style: none; padding-left: 0px; ">
                         <li style="padding: 5px;"><a  href="<?php echo site_url('groups/settings/').$group->ID ?>">Genral Settings</a></li>
                         <li style="padding: 5px;"><a href="">Moderate Settings</a></li>
                         <li style="padding: 5px;"><a href="<?php echo site_url('groups/rules/').$group->ID ?>">Group Rules</a></li>
                        <li style="padding: 5px;"><a style="color: black;font-weight: bold;font-size: 13px;" href="<?php echo site_url('groups/questions/').$group->ID ?>">Membership Questions</a></li>
                      </ul>
                   </div>
                   <div style="padding-right: 0px;" class="col-md-9">
                  <div class="editor-wrapper">
                    <div  style="font-size: 18px;" class="editor-header">
                       Membership Questions
                    </div>
                      <div style="padding: 20px;">
                          <p style="text-align: center;">Ask pending members up to three questions when they request to join your group. Only admins and moderators will see the answers.</p>
                          <div style="text-align: center;">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addquestion">Add Question</button>
                          </div>
                      </div>
                  </div>
                   </div>
                </div>
              </div>
         </div>
      </div>
   </div>
</div>



<!-- model for Edit -->
<div class="modal fade" id="addquestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("groups/updategrouprule/" .$group->ID)) ?>
      <div class="form-group">
      <label class="col-form-label">Question</label>
      <div class="row">
        <div class="col-md-8">
                <input required="" type="text" class="form-control" name="questionname" placeholder="Enter Question.....">
        </div>
        <div class="col-md-4">
            <select required="" class="form-control" id="type">
                <option value="">Select Type</option>
                <option value="1">Multiple Choices</option>
                <option value="2">Checkboxes</option>
                <option value="3">Written Answers</option>
            </select>
        </div>
      </div>
      </div>
      <div style="display: none;" id="multiple" class="form-group">
          <label>Add Option</label>
          <input type="text" placeholder="Enter Multiple Choice Option 1" name="option1" class="form-control">
          <br>
          <input type="text" placeholder="Enter Multiple Choice Option 2" name="option2" class="form-control">
          <br>
          <input type="text" placeholder="Enter Multiple Choice Option 3" name="option3" class="form-control">
          <br>
          <input type="text" placeholder="Enter Multiple Choice Option 4" name="option4" class="form-control">
          <br>
          <input type="text" placeholder="Enter Multiple Choice Option 5" name="option5" class="form-control">
          <br>
      </div> 
      <div style="display: none;" id="checkbox" class="form-group">
          <label>Add Option</label>
          <input type="text" placeholder="Enter Checkbox Option 1" name="option6" class="form-control">
          <br>
          <input type="text" placeholder="Enter Checkbox Option 2" name="option7" class="form-control">
          <br>
          <input type="text" placeholder="Enter Checkbox Option 3" name="option8" class="form-control">
          <br>
          <input type="text" placeholder="Enter Checkbox Option 4" name="option9" class="form-control">
          <br>
          <input type="text" placeholder="Enter Checkbox Option 5" name="option10" class="form-control">
          <br>
      </div>          
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary">Save changes</button>
       <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- end of edit model -->





<script type="text/javascript">

$( "select[id='type']" ).change(function (){
    var type = $(this).val();
    if (type == 1) {
      $('#checkbox').hide();
      $('#multiple').show();
    }
    if (type == 2) {
      $('#multiple').hide();
      $('#checkbox').show();
    }

    if (type == 3) {
      $('#multiple').hide();
      $('#checkbox').hide();
    }
    if (type == "") {
      $('#multiple').hide();
      $('#checkbox').hide();
    }
});

  



  $(document).ready(function(){
  $("#savegenralsettings").click(function(){
    var name = $( "#namegorupsettings" ).val();  
    var description = $( "#descriptiongorupsettings" ).val(); 
    var groupid = $( "#groupidgorupsettings" ).val();
    $("#groupnamechangebyid").html(name);
    $.ajax({ 
      url: '<?php echo site_url('groups/updategroupsettings/'); ?>',
      type: 'POST',
      data: { name : name  , description: description, groupid: groupid},
      success: function(resp){
          swal(resp);
      }
    });
  });
});
</script>