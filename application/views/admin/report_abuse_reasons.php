<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra form-inline hide">

                <div class="form-group has-feedback no-margin">
<div class="input-group">
<input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
<div class="input-group-btn">
    <input type="hidden" id="search_type" value="0">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
          <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok" id="search-like"></span> <?php echo lang("ctn_337") ?></a></li>
          <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok no-display" id="search-exact"></span> <?php echo lang("ctn_338") ?></a></li>
          <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok no-display" id="reason-exact"></span> <?php echo lang("ctn_446") ?></a></li>
          <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok no-display" id="user-exact"></span> <?php echo lang("ctn_339") ?></a></li>
          <li><a href="#" onclick="change_search(4)"><span class="glyphicon glyphicon-ok no-display" id="page-exact"></span> <?php echo lang("ctn_447") ?></a></li>
          <li><a href="#" onclick="change_search(5)"><span class="glyphicon glyphicon-ok no-display" id="from-exact"></span> <?php echo lang("ctn_448") ?></a></li>
        </ul>
      </div><!-- /btn-group -->
</div>
</div>

</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_960") ?></li>
</ol>


<div class="table-responsive">
<table id="member-table" class="table table-striped table-hover table-bordered" style="max-width: 900px;" align="center">
<thead>
<tr class="table-header">
  <td style="width: 80px;"><?php echo lang("ctn_961") ?></td>
  <td><?php echo lang("ctn_962") ?></td>
  <td style="width: 90px;"><?php echo lang("ctn_52") ?></td>
</tr>
<tr class="table-header">
  <td style="width: 80px;"></td>
  <td><span class="reason_validation_title" style="color: red;"></span><input type="text" class="form-control" name="reason" id="reason" /></td>
  <td style="width: 120px; text-align: center;"><a onclick="add_report_abuse_reason();" class="btn btn-xs btn-success"><?php echo lang("ctn_963") ?></a></td>
</tr>
</thead>
<tbody class="result_reasons">
</tbody>
</table>
</div>

</div>

<script type="text/javascript">

function add_report_abuse_reason()
{
  var reason = $('#reason').val().trim();
  if(reason=="")
  {
    //alert("Please write something in reason");
    $('.reason_validation_title').text('Please write something in reason');
    $('#reason').val(reason);
    $('#reason').focus();
    setTimeout(function() { $('.reason_validation_title').text(''); }, 3000);
  }
  else
  {
    $.ajax({
      url: '<?php echo base_url(); ?>index.php/admin/report_abuse_reason_add',
      type: 'POST',
      data: {reason: reason,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
    })
    .done(function(data) {
      //console.log("success");
      if(data==1)
      {
        $('#reason').val('');
        load_report_abuse_reasons();
      }
    });
    
  }
}


function edit_report_abuse_reason(id)
{
  $('.reason-text-'+id).hide();
  $('#reason'+id).show();
  $('.btn-edit-'+id).hide();
  $('.btn-save-'+id).show();
}

function save_edit_report_abuse_reason(id)
{
  var reason = $('#reason'+id).val().trim();
  if(reason=="")
  {
    //alert("Please write something in reason");
    $('.reason_validation_title'+id).text('Please write something in reason');
    $('#reason'+id).val(reason);
    $('#reason'+id).focus();
    setTimeout(function() { $('.reason_validation_title'+id).text(''); }, 3000);
  }
  else
  {
    $.ajax({
      url: '<?php echo base_url(); ?>index.php/admin/report_abuse_reason_update/',
      type: 'POST',
      data: {id: id, reason: reason, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
    })
    .done(function(data) {
      //console.log("success");
      //alert(data);
      if(data==1)
      {
        //load_report_abuse_reasons();
        $('.reason-text-'+id).text(reason);
        $('#reason'+id).hide();
        $('.reason-text-'+id).show();
        $('.btn-save-'+id).hide();
        $('.btn-edit-'+id).show();
      }
    });
  }
  
}


function delete_report_abuse_reason(id)
{
  var conf = confirm('Are you sure you want to delete this?');
  if(conf==true)
  {
    $.ajax({
      url: '<?php echo base_url(); ?>index.php/admin/report_abuse_reason_delete',
      type: 'POST',
      data: {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
    })
    .done(function(data) {
      //console.log("success");
      if(data==1)
      {
        load_report_abuse_reasons();
      }
    });
    
  }
}


function load_report_abuse_reasons()
{
  $.ajax({
      url: '<?php echo base_url(); ?>index.php/admin/report_abuse_reason_load',
      type: 'POST',
      data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
    })
    .done(function(data) {
      //console.log("success");
      //alert(data);
      $('.result_reasons').html(data);
    });
}



jQuery(document).ready(function($) {
  load_report_abuse_reasons();
});
</script>