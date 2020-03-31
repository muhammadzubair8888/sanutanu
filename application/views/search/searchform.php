<?php echo form_open(site_url(), array("class"=>"navbar-for")) ?>
	<div class="search">
		<button disabled="true" type="button" class="searchButton">
	        <i class="glyphicon glyphicon-search"></i>
	     </button>
	      <input type="text" class="searchTerm" placeholder="<?php echo lang("ctn_76") ?> ..." id="search-complete" >
	      
   </div>
              <!-- <div class="has-search" style="padding-bottom: 5px; position: relative !important;">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                <input type="text" class="form-control" placeholder="<?php echo lang("ctn_76") ?> ..." id="search-complete" style="width:100% !important;">
              </div> -->
              <?php echo form_close() ?>
<style type="text/css">
.search {
  width: 100%;
  position: relative;
  display: flex;
}

.searchTerm {
  width: 100%;
  border: 1px solid #CCC;
  border-left: none;
  padding: 5px;
  height: 36px;
  border-radius: 0 5px 5px 0;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #a41be3;
}

.searchButton {
  width: 40px;
  height: 36px;
  border: 1px solid #CCC;
  border-right: none;
  background: #FFF;
  text-align: center;
  color: #AAA;
  border-radius: 5px 0 0 5px;
  cursor: pointer;
  font-size: 20px;
}
</style>