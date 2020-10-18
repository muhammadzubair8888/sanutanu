<?php include(APPPATH . "views/modal/buy_plan_modal.php"); ?>
<div class="row">

<div class="col-md-3">
<?php include(APPPATH . "views/user_settings/sidebar.php"); ?>
</div> 

 <div class="col-md-9">


<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo lang("ctn_708") ?></div>
    <div class="db-header-extra">
        <?php if (!empty($alluserplans)) { ?>
            
      
    	<button type="button" data-toggle="modal" data-target="#buyplanmodal" class="btn btn-primary"><?php echo lang("ctn_284") ?></button>
         <?php  } ?>
</div>
</div>
<?php
if (empty($alluserplans)) { ?>
    <div class="row">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-6">
            <button style="height: 50px; font-size: 22px;" type="button" data-toggle="modal" data-target="#buyplanmodal" class="form-control btn btn-primary"><?php echo lang("ctn_284") ?></button>
        </div>
        <div class="col-md-3">
            
        </div>
    </div>        
  <?php   }else{ ?>
<table class="table table-bordered table-hover table-striped">
<tr class="table-header"><td><?php echo lang("ctn_260") ?></td><td><?php echo lang("ctn_997") ?></td><td><?php echo lang("ctn_1013") ?></td><td><?php echo lang("ctn_1015") ?></td></tr>
<?php foreach($alluserplans as $r) : ?>
<tr>
	<td><?php echo $r->plan_name; ?></td>
	<td><?php echo $r->no_of_ads ?></td>
	<td><?php echo $r->remaining_adds ?></td>
	<td><?php echo $r->buy_date; ?></td>
</tr>
<?php endforeach; ?>

</table>
<div class="row">
    <div class="col-md-6">
        <div class="spend-block">
            <p><img src="<?php echo base_url() ?>images/pin.png"></p>
            <p><strong><?php echo lang("ctn_1004") ?></strong></p>
            <p><?php echo lang("ctn_1005") ?></p>
            <p><a href="<?php echo site_url("user_settings/alladverts") ?>"><?php echo lang("ctn_735") ?></a></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="spend-block">
            <p><img src="<?php echo base_url() ?>images/pin.png"></p>
            <p><strong><?php echo lang("ctn_707") ?></strong></p>
            <p><?php echo lang("ctn_1006") ?></p>
            <p><a href="<?php echo site_url("user_settings/addadvert") ?>"><?php echo lang("ctn_707") ?></a></p>
        </div>
    </div>  
</div>
<?php } ?>

</div>

</div>
</div>