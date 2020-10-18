<div id="postpopup" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content row">
			<div class="custom-modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<!-- <h4 class="modal-title">Enquire Now</h4> -->
			</div>
			<div class="modal-body" id="sanutanu_post_popup" style="padding: 0;">
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4"></div>
				</div>
			</div>
			
		</div>
		
	</div>
</div>

<style type="text/css">
	
#postpopup .modal-dialog {
    width: 88%;
    padding: 0px;
    position: relative;
}
/*#postpopup .modal-dialog:before {
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
}*/

#postpopup .custom-modal-header {
    text-align: center;
    color: #000;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-top: 0px solid;
}

#postpopup .modal-dialog .close {
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
	/*height: 700px;*/
}

#postpopup .modal-dialog:after {
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

#postpopup .form-group {
    margin-bottom: 15px !important;
}

#postpopup .form-inline .form-control {
    display: inline-block;
    width: 100%;
    vertical-align: middle;
}
#postpopup .feed-comments-spot {
	max-height: 100%;
	overflow-y: auto;
}
.feed-comment-area-popup { overflow-y: auto; }
.fit-image{
/*width: auto;*/
/*object-fit: cover;*/
/*height: auto;*/ /* only if you want fixed height */
}
.feed-content-popup
{
    display: table-cell;
    vertical-align: middle;
    background: #000;
}
</style>
<script type="text/javascript">
	function post_modal(id)
	{
		$.ajax({
		    url: global_base_url + 'feed/load_single_post_popup/'+id,
		    type: 'GET',
		    data: {
		    },
		    success: function(msg) {
		      $('#sanutanu_post_popup').html(msg);
		      load_comments_popup(id);
		      /*$('#home_posts').jscroll({
		        nextSelector : '.load_next'
		      });*/
              $('#postpopup').modal('show');
              //fit_modal_body($("#postpopup"));
              setTimeout(function(){ fit_modal_body($("#postpopup")); }, 200);
		     
		    }
		  })
		
	}
</script>
<script type="text/javascript">
    var fit_modal_body;

    fit_modal_body = function(modal) {
        //alert('ok');
        var ht = $(window).height();
      var body, bodypaddings, header, headerheight, height, modalheight, popupimg;
      header = $(".modal-header", modal);
      body = $("#sanutanu_post_popup", modal);
      popupimg = $(".fit-image", modal);
      modalheight = parseInt(modal.css("height"));
      headerheight = parseInt(header.css("height")) + parseInt(header.css("padding-top")) + parseInt(header.css("padding-bottom"));
      bodypaddings = parseInt(body.css("padding-top")) + parseInt(body.css("padding-bottom"));
      height = ht-80;//modalheight - headerheight - bodypaddings - 5;
      //alert(ht);
      iw = popupimg.width();
      ih = popupimg.height();
      
     // alert( iw + " x " + ih );
      if( Number(iw) > Number(ih) )
      {
        //popupimg.css("height", "auto");
        popupimg.css("width", "100%");
        //alert(1);
      }
      else
      {
        popupimg.css("height", "" + height + "px");
        //alert(2);
        //popupimg.css("width", "auto");
      }

      var mw = $('.feed-content-wraper').width();////////

      var fh1 = $('#postpopup .feed-header').height();
      var fh2 = $('#postpopup .feed-content-right').height();
      var fh3 = $('#postpopup .feed-content-stats').height();
      var fh4 = $('#postpopup .feed-footer').height();
      var fhf = $('.feed-content-popup').height() - fh1 - fh2 - fh3 - fh4;
     // alert(fhf);

      body.css("max-height", "" + height + "px");
      //$('#postpopup .feed-comment-area').css("height", height + "px");
      $('#postpopup .feed-comment-area').css("max-height", fhf + "px");
      $('.feed-content-popup').css("height", "" + height + "px");
      $('.feed-content-popup').css("width", "" + mw + "px");
      return body.css("height", "" + height + "px");

    };

    $(window).resize(function() {
      return fit_modal_body($("#postpopup"));
    });
</script>