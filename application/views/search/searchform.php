<?php echo form_open(site_url('search/index'), array("class"=>"navbar-for searchform","method"=>"get")) ?>
	<div class="search">
	      <input type="text" name="q" class="searchTerm autocomplete" placeholder="<?php echo lang("ctn_76") ?> ..." data-uri="search_suggession" data-template="search" value="<?php if(isset($get['q'])){ echo $get['q']; } else if(isset($_GET['q'])){ echo $_GET['q']; } ?>" autocomplete="off" >
        <button disabled="true" type="button" class="searchButton">
          <i class="glyphicon glyphicon-search"></i>
       </button>
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
  /*border-right: none;*/
  padding: 5px;
  height: 36px;
   border-radius: 3px 0 0 3px; 
  outline: none;
  color: #9DBFAF;
}



.searchButton {
  width: 40px;
  height: 36px;
  border: 1px solid #CCC;
  border-left: none;
  background: #FFF;
  text-align: center;
  color: #AAA;
  border-radius: 0 3px 3px 0;
  cursor: pointer;
  font-size: 20px;
}
</style>