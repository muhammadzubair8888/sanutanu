<style type="text/css">
	.jsad_nsja{
		display: block;
	    color: #201f1f;
	    box-shadow: 0 0 6px rgba(0,0,0,.2);
	    padding: 15px 15px;
	    border-radius: 5px;
	    background-color: white;
	    -webkit-border-radius: 5px;
	}
	.roundcircleborder{
		border: 1px solid #DDD;
		height: 112.984px;
		border-radius: 50%;
	}
	.form-top-left{
		margin-bottom: 30px;
	}
	label{
		font-weight: 600;
	}
</style>
<div class="row half-separator">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="jsad_nsja">
			<div style="text-align: center;" class="row">
					<img style="width: 100%; height: 100%;" src="<?php echo base_url('uploads/') ?>createprofile2.jpg">
			</div>
			<?php echo form_open_multipart(site_url("marriage/step2"), array("class" => "form-horizontal")) ?>
				<input type="hidden" name="profileid" value="<?php echo $profileid; ?>">
		        	<div class="form-top">
		        		<div class="form-top-left">
		        			<h3>Step 2</h3>
		        			<p style="color: red;">Correspondence Contact Details</p>
		        		</div>
		            </div>
		            <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            <div><b>Mantion Name & Time of contact</b></div>
		            </div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Relationship with Member:</label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<select id="profileby" class="form-control" name="relationshipwithmember">
			            			<option value="Self">Self</option>
		                            <option value="Parent">Parent</option>
		                            <option value="Guardian">Guardian</option>
		                            <option value="Friend">Friend</option>
		                            <option value="Sibling">Sibling</option>
		                            <option value="Son">Son</option>
		                            <option value="Daughter">Daughter</option>
		                            <option value="Relative">Relative</option>		            		
		                        </select>
		            		</div>		            		
		            	</div>		            	
		            	<div id="othername" class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Name of the Contact Person: </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<input type="text" class="form-control" required=""  name="contactpersonname">
		            		</div>		            		
		            	</div>		            			            		
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Other Contact Number : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<input  type="text" name="othercontactnumber"  class="form-control"  >
		            		</div>		            		
		            	</div>			            	
		               	<div style="text-align: right;">
		            		<button type="submit" class="btn btn-success">Submit</button>
		            	</div>	
    		<?php echo form_close() ?>
		</div>
	</div>
	<div class="col-md-2"></div>			
</div>