<div id="aboutpopup" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content row">
			<div class="custom-modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<!-- <h4 class="modal-title">Enquire Now</h4> -->
			</div>
			<div class="modal-body" id="sanutanu_about_popup">
				<div class="row">
					<div class="col-md-12 sanutanu_about_form" >
                                     
                    </div>
				</div>
			</div>
			
		</div>
		
	</div>
</div>

<style type="text/css">
	
#aboutpopup .modal-dialog {
    width: 70%;
    max-height: 100%;
    padding: 0px ;
    position: relative;
}
#aboutpopup .modal-dialog:before {
    content: '';
    height: 0px;
    width: 0px;
    border-left: 50px solid #a41be3;
    border-right: 50px solid transparent;
    border-bottom: 50px solid transparent;
    position: absolute;
    top: 1px;
    left: -14px;
    z-index: 99;
}

.custom-modal-header {
    text-align: center;
    color: #a41be3;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-top: 4px solid;
}

#aboutpopup .modal-dialog .close {
    z-index: 99999999;
    color: white;
    text-shadow: 0px 0px 0px;
    font-weight: normal;
    top: 4px;
    right: 6px;
    position: absolute;
    opacity: 1;
}

.custom-modal-header .modal-title {
    /* font-weight: bold; */
    font-size: 18px;
}

.custom-modal-body {
	height: 700px;
}

#aboutpopup .modal-dialog:after {
    content: '';
    height: 0px;
    width: 0px;
    /* border-right: 50px solid rgba(255, 0, 0, 0.98); */
    border-right: 50px solid #a41be3;
    border-bottom: 50px solid transparent;
    position: absolute;
    top: 1px;
    right: -14px;
    z-index: 999999;
}

#aboutpopup .form-group {
    margin-bottom: 15px !important;
}

#aboutpopup .form-inline .form-control {
    display: inline-block;
    width: 100%;
    vertical-align: middle;
}
#aboutpopup .feed-comments-spot {
	max-height: 190px;
	overflow-y: auto;
}
</style>

<script type="text/javascript">
    function initahead() {
        $('.typeahead').typeahead(null,{
              name: 'autocomplete',
              display: 'search_title',
              //input: this,

              source: function (query, result, cba) {
                //var element = $(this.$el[0].parentElement.parentElement).children("input").first();
                //console.log();
                //var uri = $(':focus').attr('data-url');
                    var uri = '<?php echo site_url('/'); ?>' + $(':focus').attr('data-url');
                    $.ajax({
                        url: uri,
                        data: {'query': query,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
                        dataType: "json",
                        type: "POST",
                        success: function (data) {
                            cba(data);
                        }
                    });
                },
                limit:10,
                templates: {
                    suggestion: function(item){
                        var t = $(':focus').attr('data-template');
                        if(t=='places')
                        {
                            return `<div class="row" style="margin: 0;">
                                      <div class="col-md-12" style="padding:3px; font-weight: bold;">`+item.search_title+`</div>
                                    </div>`;
                        }
                        else if(t=='cities')
                        {
                            return `<div class="row" style="margin: 0;">
                                      <div class="col-md-12" style="padding:3px; font-weight: bold;">`+item.city+`, `+item.state+`, `+item.country+`</div>
                                    </div>`;
                        }
                        else if(t=='states')
                        {
                            return `<div class="row" style="margin: 0;">
                                      <div class="col-md-12" style="padding:3px; font-weight: bold;">`+item.state+`, `+item.country+`</div>
                                    </div>`;
                        }
                        else if(t=='countries')
                        {
                            return `<div class="row" style="margin: 0;">
                                      <div class="col-md-12" style="padding:3px; font-weight: bold;">`+item.country+`</div>
                                    </div>`;
                        }
                        else if(t=='user')
                        {
                            return `<div class="row" style="margin: 0;">
                                      <div class="col-md-12" style="padding:3px; font-weight: bold;">`+item.city+`, `+item.state+`, `+item.country+`</div>
                                    </div>`;
                        }
                        else
                        {
                            return `<div class="row" style="margin: 0;">
                                      <div class="col-md-12" style="padding:3px; font-weight: bold;">`+item.search_title+`</div>
                                    </div>`;
                        }
                        
                        //Handlebars.compile(htm);
                    } 
                  }
        });
    };
</script>

<script type="text/javascript">
	function about_modal()
	{
		$.ajax({
		    url: global_base_url + 'user_settings/about_form/',
		    type: 'GET',
		    data: {
		    },
		    success: function(msg) {
		      $('.sanutanu_about_form').html(msg);
              initahead();
		      //load_comments_popup(id);
		      /*$('#home_posts').jscroll({
		        nextSelector : '.load_next'
		      });*/
		     
		    }
		  })
		$('#aboutpopup').modal('show');
	}
</script>



<style>
.autocomp
{
    padding-top:0px; 
    padding-bottom:0px; 
    border:none !important; 
    padding-right:0px; 
    background:none; 
    padding-left:5px; 
    min-width:80px;
}

.ui-autocomplete-highlight {
    font-weight: bold;
}

.ui-state-active a,
.ui-state-active a:link,
.ui-state-active a:visited {
    color: #5b518b !important; /* any color you like */
    background:#900 !important;
    border-radius: 0;
}

.ui-widget-content .ui-state-active {
    color: #5b518b !important; /* any color you like */
    background:#900 !important;
    border-radius: 0;
}

.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus
{
    
    color:#FFF !important;
    border-radius: 0;
}
.ui-autocomplete {
  z-index: 215000000 !important;
  border-radius: 0;
  padding: 0;
}
</style>