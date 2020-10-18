<style type="text/css">
	.jsad_nsja {
		display: block;
		color: #201f1f;
		box-shadow: 0 0 6px rgba(0, 0, 0, .2);
		padding: 15px 15px;
		border-radius: 5px;
		background-color: white;
		-webkit-border-radius: 5px;
	}

	.roundcircleborder {
		border: 1px solid #DDD;
		height: 112.984px;
		border-radius: 50%;
	}

	.form-top-left {
		margin-bottom: 30px;
	}

	label {
		font-weight: 600;
	}

	.amsify-suggestags-area .amsify-suggestags-input-area-default {
		cursor: pointer;
		border: 1px solid #cccccc;
		min-height: 20px;
		padding: 8px 5px;
	}

	.amsify-suggestags-area .amsify-suggestags-input-area {
		text-align: left;
		height: auto;
	}

	.amsify-suggestags-area .amsify-suggestags-input-area:hover {
		cursor: text;
	}

	.amsify-suggestags-area .amsify-suggestags-input-area .amsify-suggestags-input {
		max-width: 200px;
		padding: 0px 4px;
		border: 0;
	}

	.amsify-suggestags-area .amsify-suggestags-input-area .amsify-suggestags-input:focus {
		outline: 0;
	}

	.amsify-focus {
		border-color: #66afe9;
		outline: 0;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
	}

	.amsify-focus-light {
		border-color: #cacaca;
		outline: 0;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(189, 189, 189, 0.6);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(189, 189, 189, 0.6);
	}

	.amsify-suggestags-area .amsify-suggestags-label {
		cursor: pointer;
		min-height: 20px;
	}

	.amsify-toggle-suggestags {
		float: right;
		cursor: pointer;
	}

	.amsify-suggestags-area .amsify-suggestags-list {
		display: none;
		position: absolute;
		background: white;
		border: 1px solid #dedede;
		z-index: 1;
	}

	.amsify-suggestags-area .amsify-suggestags-list ul.amsify-list {
		list-style: none;
		padding: 3px 0px;
		max-height: 150px;
		overflow-y: auto;
	}

	.amsify-suggestags-area .amsify-suggestags-list ul.amsify-list li.amsify-list-item {
		text-align: left;
		cursor: pointer;
		padding: 0px 10px;
	}

	.amsify-suggestags-area .amsify-suggestags-list ul.amsify-list li.amsify-list-item:active {
		background: #717171;
		color: white;
		-moz-box-shadow: inset 0 0 10px #000000;
		-webkit-box-shadow: inset 0 0 10px #000000;
		box-shadow: inset 0 0 10px #000000;
	}

	.amsify-suggestags-area .amsify-suggestags-list ul.amsify-list li.amsify-list-group {
		text-align: left;
		padding: 0px 10px;
		font-weight: bold;
	}

	.amsify-suggestags-area .amsify-suggestags-list ul.amsify-list li.amsify-item-pad {
		padding-left: 30px;
	}

	.amsify-suggestags-area .amsify-suggestags-list ul.amsify-list li.amsify-item-noresult {
		display: none;
		color: #ff6060;
		font-weight: bold;
		text-align: center;
	}

	.amsify-suggestags-area .amsify-suggestags-list .amsify-select-input {
		display: none;
	}

	.amsify-suggestags-area .amsify-suggestags-list ul.amsify-list li.active {
		background: #d9d8d8;
	}

	.amsify-suggestags-area .amsify-suggestags-list ul.amsify-list li.amsify-item-pad.active {
		font-weight: normal;
	}

	.amsify-suggestags-input-area .amsify-select-tag {
		padding: 2px 7px;
		margin: 0px 4px 1px 0px;
		-webkit-border-radius: 2px;
		-moz-border-radius: 2px;
		border-radius: 2px;
		display: inline-block;
	}

	.amsify-suggestags-input-area .amsify-select-tag.col-bg {
		background: #d8d8d8;
		color: black;
	}

	/*.amsify-suggestags-input-area
.amsify-select-tag:hover {
	background: #737373;
    color: white;
}*/

	.amsify-suggestags-input-area .disabled.amsify-select-tag {
		background: #eaeaea;
		color: #b9b9b9;
		pointer-events: none;
	}

	.amsify-suggestags-input-area .flash.amsify-select-tag {
		background-color: #f57f7f;
		-webkit-transition: background-color 200ms linear;
		-ms-transition: background-color 200ms linear;
		transition: background-color 200ms linear;
	}

	.amsify-suggestags-input-area .amsify-remove-tag {
		cursor: pointer;
	}

	.amsify-no-suggestion {
		display: none;
		opacity: 0.7;
	}

	@media screen and (max-width: 1024px) {
		.form-content-form {
			width: 100vw !important;
			padding-right: 10vw;
		}

		.form-control {
			width: 100% !important;
		}

		.col-padding {
			padding-left: 15px !important;
			padding-right: 15px !important;
		}
	}
</style>
<div class="row half-separator">
	<div class="col-md-2"></div>
	<div class="col-md-8 form-content-form">
		<div class="jsad_nsja">
			<div style="text-align: center;" class="row">
				<img style="width: 100%; height: 100%;" src="<?php echo base_url('uploads/') ?>createprofile4.jpg">
			</div>
			<?php echo form_open_multipart(site_url("marriage/step4"), array("class" => "form-horizontal")) ?>
			<input type="hidden" name="profileid" value="<?php echo $profileid; ?>">
			<div class="form-top">
				<div class="form-top-left">
					<h3>Step 4</h3>
					<p style="color: red;">Add your Hobbies, Interests, and more...</p>
				</div>
			</div>
			<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
				<div><b>Hobbies</b></div>
			</div>
			<div class="row form-group">
				<div class="col-md-12 col-padding">
					<!-- <div class="row">
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Acting" name="hobbies[]"> Acting
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Animal breeding" name="hobbies[]"> Animal breeding
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Art / Handicraft" name="hobbies[]"> Art / Handicraft
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Collecting Coins" name="hobbies[]"> Collecting Coins
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Collecting Stamps" name="hobbies[]"> Collecting Stamps
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Cooking" name="hobbies[]"> Cooking
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Dancing" name="hobbies[]"> Dancing
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Film-making" name="hobbies[]"> Film-making
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Fishing" name="hobbies[]"> Fishing
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Gardening / Landscaping" name="hobbies[]"> Gardening 
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Graphology" name="hobbies[]"> Graphology
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Ham radio" name="hobbies[]"> Ham radio
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Interior decoration" name="hobbies[]"> Interior decoration
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Long Drives" name="hobbies[]"> Long Drives
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Model building" name="hobbies[]"> Model building
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Painting" name="hobbies[]"> Painting
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Photography" name="hobbies[]"> Photography
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Graphology" name="hobbies[]"> Graphology
		            				</div>
		            			</div>
		            		</div>	            		
		            	</div> -->
					<!-- <input type="test" name="hobbies"> -->
					<div class="row form-group">
						<div class="col-md-12 col-padding ">
							<input type="text" class="form-control" name="hobbies">
						</div>
					</div>
					<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
						<div><b>Intrests</b></div>
					</div>
					<div class="row form-group">
						<div class="col-md-12 col-padding ">
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" value="Alternative healing" name="intrests[]"> Alternative healing
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Blogging" name="intrests[]"> Blogging
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Health & Fitness" name="intrests[]"> Health & Fitness
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Learning" name="intrests[]"> Learning
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Listening to music" name="intrests[]"> Listening to music
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Motor Sport / Racing " name="intrests[]"> Motor Sport / Racing
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Movies" name="intrests[]"> Movies
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Net surfing" name="intrests[]"> Net surfing
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Politics" name="intrests[]"> Politics
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Reading / Book clubs" name="intrests[]"> Reading / Book clubs
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Sports - Indoor" name="intrests[]"> Sports - Indoor
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Sports - Outdoor" name="intrests[]"> Sports - Outdoor
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Theatre" name="intrests[]"> Theatre
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Travel / Sightseeing" name="intrests[]"> Travel / Sightseeing
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Trekking / Adventure sports" name="intrests[]"> Adventure sports
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Computer games" name="intrests[]"> Computer games
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Volunteering" name="intrests[]"> Volunteering
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Watching television" name="intrests[]"> Watching television
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Writing" name="intrests[]"> Writing
								</div>
								<div class="col-md-4">
									<input type="checkbox" value="Yoga / Meditation" name="intrests[]"> Yoga / Meditation
								</div>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12 col-padding ">
							<input placeholder="Add More Intrests" type="text" class="form-control" name="intrests[]">
						</div>
					</div>
					<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
						<div><b>Preferred dress style </b></div>
					</div>
					<div class="row form-group">
						<div class="col-md-12 col-padding ">
							<div class="row">
								<div class="col-md-6">
									<input type="radio" value="Business casual - semi-formal" name="prefferddress" required=""> Business casual - semi-formal
								</div>
								<div class="col-md-6">
									<input type="radio" value="Casual - usually in jeans and T-shirts" name="prefferddress"> Casual - usually in jeans and T-shirts
								</div>
								<div class="col-md-6">
									<input type="radio" value="Classic Indian - Indian formal wear" name="prefferddress"> Classic Indian - Indian formal wear
								</div>
								<div class="col-md-6">
									<input type="radio" value="Classic Western - western formal wear" name="prefferddress"> Classic Western - western formal wear
								</div>
								<div class="col-md-6">
									<input type="radio" value="Designer - only leading brands will do" name="prefferddress"> Designer - only leading brands will do
								</div>
								<div class="col-md-6">
									<input type="radio" value="Trendy - in line with the latest fashion" name="prefferddress"> Trendy - in line with the latest fashion
								</div>
							</div>
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
		<script src="<?php echo base_url(); ?>scripts/libraries/tags.js"></script>
		<script>
			$('input[name="hobbies"]').amsifySuggestags();
		</script>