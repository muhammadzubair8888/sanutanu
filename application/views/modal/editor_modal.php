<!-- <div id="editorpopup" class="modal fade in" role="dialog">
    <div class="modal-dialog">
        
        Modal content
        <div class="modal-content row">
            <div class="custom-modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Enquire Now</h4>
            </div>
            <div class="modal-body" id="sanutanu_editor_popup">
                <?php //include(APPPATH . "views/feed/storieseditor.php"); ?>
            </div>
            
        </div>
        
    </div>
</div> -->
<div class="editorpopup" style="display: none;">
    <div style="position: relative;">
        <span style="position: absolute; top: 3px; right: 10px; font-size: 18px; cursor: pointer; z-index: 9;" onclick="$('#status-overlay').click();">x</span>
        <?php include(APPPATH . "views/feed/storieseditor.php"); ?>
    </div>
</div>
<style type="text/css">
.editorpopup {
    width: 500px;
    position: absolute;
    top: 20%;
    left: 0;
    right: 0;
    margin: auto;
    z-index: 99999999999999999;
}
#editorpopup .modal-dialog:before {
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

#editorpopup .modal-dialog .close {
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

#editorpopup .modal-dialog:after {
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

/*#aboutpopup .form-group {
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
}*/
</style>
<script type="text/javascript">
	function editor_modal()
	{
		//$('#editorpopup').modal('show');
	}
</script>