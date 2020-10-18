<?php echo form_open(site_url("feed/promote_post_pro/" . $post->ID), array("id" => "social-form-edit")) ?>
<div style="background-color: #e5e5e5 !important; color: black !important;" class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Boast Post </h4>
</div>
<div style="background-color: #f5f7f8 !important;" class="modal-body ui-front form-horizontal" id="promotePost">
	<div class="row">
        <div class="col-md-5">
            <div style="border: 1px solid #DDD;padding: 5px; background-color: #e5e5e5; ">
                <div style="font-size: 18px; font-weight: 900">AUDIENCE</div>
            </div>
            <div style="padding: 5px;">
                <div style="padding: 5px;">
                    <input type="radio" name="audienceselect"><span style="padding-left: 10px;">People Who Like Your Page</span>
                </div>
                <div style="padding: 5px;">
                    <input type="radio" name="audienceselect"><span style="padding-left: 10px;">People Who Like Your Page and there Friends</span>
                </div>
                <div style="padding: 5px;">
                    <input  type="radio" name="audienceselect" checked><span style="padding-left: 10px;">People You Chose Through Targeting</span>
                </div>
                <br>
                <div class="row">
                    <div style="margin-top: 5px;" class="col-md-3 col-xs-2 col-sm-2">
                        <b>Location</b>
                    </div>
                    <div class="col-md-9 col-xs-10 col-sm-10">
                        <select style="font-size: 18px;font-weight: bold; height: 40px;" class="form-control" id="countries">
                            <option value="">Select Country</option>
                            <?php foreach ($this->db->get('countries')->result() as $c) { ?>
                                <option value="<?php echo $c->id ?>"><?php echo $c->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div style="margin-top: 5px;display: none" class="col-md-3 col-xs-2 col-sm-2" id="devcity">
                        <b>city</b>
                    </div>
                    <div class="col-md-9 col-xs-10 col-sm-10" style="display: none;margin-top: 5px" id="city_div">
                        <select style="font-size: 18px;font-weight: bold; height: 40px;" class="form-control" id="cities" name="cities">
                            <option value="">Select City</option>
                           
                        </select>
                    </div>
                    <div style="margin-top: 5px;" class="col-md-3 col-xs-2 col-sm-2">
                        <b>Targetting Gender</b>
                    </div>
                    <div class="col-md-9 col-xs-10 col-sm-10" style="margin-top: 5px">
                        <select style="font-size: 18px;font-weight: bold; height: 40px;" class="form-control" id="t_gender" name="t_gender">
                            <option value="">Select Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                           
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="total_paulation" id="total_paulation">
            <div style="border: 1px solid #DDD;padding: 5px; background-color: #e5e5e5; ">
                <div style="font-size: 18px; font-weight: 900">Budjet and Duration</div>
            </div>
            <div style="margin-top: 10px;">
                <label>Total Budjet</label><span data-toggle="popover" data-trigger="hover" data-content="If Options is Disabled then Add More Funds in Your Account" style="cursor: pointer; padding-left: 10px;"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                <div><small>Funds in Your Account is <b><?php echo $this->user->info->points; ?></b></small></div>
                <select name="budget" id="budjet" style="font-size: 18px;font-weight: bold; height: 40px;" class="form-control">
                    <option>select Funds</option>
                
                </select>
                <input type="hidden" name="user_funds" id="user_funds" value="<?php echo $this->user->info->points; ?>">
                <input type="hidden" name="rates" id="rate_per">
            </div>
            <div style="padding: 5px;">
               <div><b>Estemated People Reached</b></div>
               <div ><b style="color: #337ab7;"><span id="peoplechanges"></span></b></div>
                 <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" id="progressbar" style="width:0%">
                 
                  </div>
                </div>
                <style type="text/css">
          .activebutton{
            background-color: green !important;
          }
        </style>
               <p style="text-align: justify;">Refine your audience or add budget to reach more people that matter to you</p>
               <div style="margin-bottom: 10px;"><b>Duration</b></div>
               <div class="btn-group">
                <button type="button" disabled id="sevendays" style="color: white;" class="btn activebutton">7 Days</button>
                <button type="button" disabled id="fourteendays" class="btn btn-primary ">14 Days</button>
                <button type="button" disabled id="twintyonedays" class="btn btn-primary ">21 Days</button>
                <button type="button" disabled id="thirtydays" class="btn btn-primary ">30 Days</button>
              </div>
            </div>
        </div>
        
        <script type="text/javascript">
          $(document).ready(function(){
            $(':input[type="submit"]').prop('disabled', true);
             $('[data-toggle="popover"]').popover();  

              $("#budjet").change(function(){
                var budgetrange = $('#budjet').val();
                var total_paulation = $('#total_paulation').val();
             // alert(total_paulation);
             $(':input[type="submit"]').prop('disabled', false);
                if (budgetrange == '25') {
                  var papu = (25/100)*Number(total_paulation);
                  var ratis = (papu/1000)*100;
                  $('#rate_per').val(ratis);
                  $('#peoplechanges').html('50 - '+papu+' Peoples');
                  $('#progressbar').css('width' , '25%');
                  $('#sevendays').removeClass("btn-primary");
                  $('#fourteendays').addClass("btn-primary");
                  $('#twintyonedays').addClass("btn-primary");
                  $('#thirtydays').addClass("btn-primary");
                  $('#sevendays').css("background-color", "green");
                }
                if (budgetrange == '50') {
                  var papu = (50/100)*Number(total_paulation);
                   var ratis = (papu/1000)*100;
                  $('#rate_per').val(ratis);
                  $('#peoplechanges').html(''+papu+' Peoples');
                  $('#progressbar').css('width' , '50%');
                  $('#fourteendays').removeClass("btn-primary");

                  $('#sevendays').addClass("btn-primary");
                  $('#twintyonedays').addClass("btn-primary");
                  $('#thirtydays').addClass("btn-primary");


                  $('#fourteendays').css("background-color", "green");
                  $('#fourteendays').css("color", "white");
                }
                if (budgetrange == '75') {
                  var papu = (75/100)*Number(total_paulation);
                   var ratis = (papu/1000)*100;
                  $('#rate_per').val(ratis);
                  $('#peoplechanges').html(''+papu+' Peoples');
                  $('#progressbar').css('width' , '75%');
                  $('#twintyonedays').removeClass("btn-primary");
                  $('#sevendays').addClass("btn-primary");
                  $('#fourteendays').addClass("btn-primary");
                  $('#thirtydays').addClass("btn-primary");


                  $('#twintyonedays').css("background-color", "green");
                  $('#twintyonedays').css("color", "white");
                }
                if (budgetrange == '100') {
                  var papu = (100/100)*Number(total_paulation);
                   var ratis = (papu/1000)*100;
                  $('#rate_per').val(ratis);
                  $('#peoplechanges').html(''+papu+' Peoples');
                  $('#progressbar').css('width' , '100%');
                  $('#thirtydays').removeClass("btn-primary");

                  $('#sevendays').addClass("btn-primary");
                  $('#fourteendays').addClass("btn-primary");
                  $('#twintyonedays').addClass("btn-primary");                  

                  $('#thirtydays').css("background-color", "green");
                  $('#thirtydays').css("color", "white");
                }
              });
          });
        </script>
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
               <a href="<?php echo base_url('pages/view/'. $this->page_model->get_page($post->pageid)->row()->slug); ?>"><?php echo $this->page_model->get_page($post->pageid)->row()->name ?></a>       
               <div class="feed-timestamp" style="display: flex;">Sponserd <span style="margin-left: 4px;margin-top: 2px;" class="fa fa-globe"></span>
               </div>
            </div>


            <div class="feed-content">
    <?php if(isset($post->videoid)): ?>
      <p><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $this->db->where('ID' , $post->videoid)->get('user_videos')->row()->youtube_id; ?>" frameborder="0" allowfullscreen></iframe></p>
    <?php elseif($post->template == "event") : ?>
    <div class="editor-event">
        <span class="glyphicon glyphicon-calendar big-event-icon"></span>
        <p><strong><a href="<?php echo site_url("pages/view_event/" . $post->eventid) ?>"><?php echo $post->event_title ?></a></strong></p>
        <p><?php echo $post->event_description ?></p>
         <p><span class="glyphicon glyphicon-time"></span> <?php echo $post->event_start ?> ~ <?php echo $post->event_end ?> </p>
      </div>
    <?php elseif($post->site_flag): ?>
           <a href="<?php echo $post->content; ?>"><div class="feed-content-text"><?php echo $post->content; ?></div></a>
               <?php $sites = $this->feed_model->get_feed_urls($post->ID); ?>
    <?php foreach($sites->result() as $site) : ?>
        <div class="link-post-data" style="text-decoration: none; margin: 0; overflow: hidden;" >
            <a href="<?php echo $site->url; ?>" target="_blank" style="text-decoration: none; color: #000;">
                <?php
            if(!empty($site->title))
               {
                   if($this->feed_model->isRtl($site->title))
                   {
                    $dir = 'rtl';
                   }
                   else
                   {
                    $dir = 'ltr';
                   }
                   ?>
                    <div class="link-post-title" dir="<?php echo $dir; ?>" ><?php echo $site->title; ?></div>
                 <?php
               }
               if(!empty($site->description))
               {
                if($this->feed_model->isRtl($site->description))
                   {
                    $dir = 'rtl';
                   }
                   else
                   {
                    $dir = 'ltr';
                   }
               ?>
                   <div class="link-post-desc" dir="<?php echo $dir; ?>" style=""><?php echo $site->description; ?></div>
                <?php
                }
            ?>
               
               <?php
                  if(!empty($site->image)) {
                    ?>
                     <div class="link-post-image" style="position: relative;"><img  style="max-height:100%; max-width:100%; width: 100%;" src="<?php echo $site->image; ?>" /></div>
                     <?php
               }
            ?>
            </a>
        </div>
    <?php endforeach; ?>

    <?php else : ?>

<div class="feed-content-text"><?php echo $post->content; ?></div>
 <a style="cursor: pointer;" ><img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->feed_model->getpostimage($post->imageid)->row()->file_name ?>" width="100%"></a>
<?php endif; ?>
            </div>

            <div style="padding: 5px;" class="feed-footer">
<a class="like-button-336 editor-button faded-icon "><svg class="svg-inline--fa fa-thumbs-up fa-w-16" aria-hidden="true" focusable="false" data-prefix="far" data-icon="thumbs-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M466.27 286.69C475.04 271.84 480 256 480 236.85c0-44.015-37.218-85.58-85.82-85.58H357.7c4.92-12.81 8.85-28.13 8.85-46.54C366.55 31.936 328.86 0 271.28 0c-61.607 0-58.093 94.933-71.76 108.6-22.747 22.747-49.615 66.447-68.76 83.4H32c-17.673 0-32 14.327-32 32v240c0 17.673 14.327 32 32 32h64c14.893 0 27.408-10.174 30.978-23.95 44.509 1.001 75.06 39.94 177.802 39.94 7.22 0 15.22.01 22.22.01 77.117 0 111.986-39.423 112.94-95.33 13.319-18.425 20.299-43.122 17.34-66.99 9.854-18.452 13.664-40.343 8.99-62.99zm-61.75 53.83c12.56 21.13 1.26 49.41-13.94 57.57 7.7 48.78-17.608 65.9-53.12 65.9h-37.82c-71.639 0-118.029-37.82-171.64-37.82V240h10.92c28.36 0 67.98-70.89 94.54-97.46 28.36-28.36 18.91-75.63 37.82-94.54 47.27 0 47.27 32.98 47.27 56.73 0 39.17-28.36 56.72-28.36 94.54h103.99c21.11 0 37.73 18.91 37.82 37.82.09 18.9-12.82 37.81-22.27 37.81 13.489 14.555 16.371 45.236-5.21 65.62zM88 432c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z"></path></svg><!-- <span class="far fa-thumbs-up"></span> --> <span id="like-button-like-336" class="like-button-like-336">Like</span></a> 
 
<a class="editor-button faded-icon"><svg class="svg-inline--fa fa-comment-alt fa-w-16" aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288z"></path></svg><!-- <span class="far fa-comment-alt"></span> --> Comment</a>
<a class="editor-button faded-icon dropdown-toggle" data-toggle="dropdown"><svg class="svg-inline--fa fa-share fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="share" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M503.691 189.836L327.687 37.851C312.281 24.546 288 35.347 288 56.015v80.053C127.371 137.907 0 170.1 0 322.326c0 61.441 39.581 122.309 83.333 154.132 13.653 9.931 33.111-2.533 28.077-18.631C66.066 312.814 132.917 274.316 288 272.085V360c0 20.7 24.3 31.453 39.687 18.164l176.004-152c11.071-9.562 11.086-26.753 0-36.328z"></path></svg><!-- <span class="fa fa-share"></span> --> Share</a>
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
<script>
  $('#countries').on('change',function(){
    $id = $('#countries').val();
    // alert($id);
    $.ajax({
      url: global_base_url + 'Home/get_city_id',
      data: {id: $id},
    })
    .done(function(res) {
      // console.log(res);
      $('#cities').append(res);
      $('#devcity').show();
      $('#city_div').show();
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  });

  $('#cities').on('change',function(){
    $city_id = $('#cities').val();
    $country_id = $('#countries').val();
    $.ajax({
      url: global_base_url + 'Home/get_rates',
      data: {c_id: $city_id,count:$country_id},
    })
    .done(function(res) {
      $test = JSON.parse(res)
      $rate = $test[0][0].rate_per;
      $papulation = $test[1][0].papulation;
     var fourthpart = (25/100)*Number($papulation);
     var fundforfourth = (fourthpart/1000)*$rate; 
      var scndhpart = (50/100)*Number($papulation);
      var fundforscnd = (scndhpart/1000)*$rate;
      var thirdhpart = (75/100)*Number($papulation);
      var fundforthird = (thirdhpart/1000)*$rate;
      var fullpart = (100/100)*Number($papulation);
      var fundforfull = (fullpart/1000)*$rate;
      var user_funds  = $('#user_funds').val();

      $('#total_paulation').val($papulation);
      $('#rate_per').val($rate);
        if(fundforfourth > user_funds)
        {
         var html = '<option value="25" >'+fundforfourth+'Funds for'+fundforfourth+'</option><option value="50" disabled>'+fundforscnd+'Funds for'+scndhpart+'</option><option value="75" disabled>'+fundforthird+'Funds for'+thirdhpart+'</option><option value="100" disabled>'+fundforfull+'Funds for'+fullpart+'</option>';
        }
       else if(fundforfourth < user_funds && fundforscnd > user_funds )
        {
         var html = '<option value="25" >'+fundforfourth+'Funds for'+fundforfourth+'</option><option value="50" disabled>'+fundforscnd+'Funds for'+scndhpart+'</option><option value="75" disabled>'+fundforthird+'Funds for'+thirdhpart+'</option><option value="100" disabled>'+fundforfull+'Funds for'+fullpart+'</option>';
        }  else if(fundforscnd < user_funds && fundforthird > user_funds )
        {
         var html = '<option value="25" >'+fundforfourth+'Funds for'+fundforfourth+'</option><option value="50" >'+fundforscnd+'Funds for'+scndhpart+'</option><option value="75" disabled>'+fundforthird+'Funds for'+thirdhpart+'</option><option value="100" disabled>'+fundforfull+'Funds for'+fullpart+'</option>';
        } else if(fundforthird < user_funds && fundforfull > user_funds )
        {
         var html = '<option value="25" >'+fundforfourth+'Funds for'+fundforfourth+'</option><option value="50" >'+fundforscnd+'Funds for'+scndhpart+'</option><option value="75" >'+fundforthird+'Funds for'+thirdhpart+'</option><option value="100" disabled>'+fundforfull+'Funds for'+fullpart+'</option>';
        }else
        {
         var html = '<option value="25" >'+fundforfourth+'Funds for'+fundforfourth+'</option><option value="50" >'+fundforscnd+'Funds for'+scndhpart+'</option><option value="75" >'+fundforthird+'Funds for'+thirdhpart+'</option><option value="100" >'+fundforfull+'Funds for'+fullpart+'</option>'; 
        }
      $('#budjet').append(html);
    })
    
    


  });
</script>