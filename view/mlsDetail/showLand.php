<div class="jumbotron inner-shadow lines">
	<div class="container-fluid">
		<div class="wrap">
			<div class="row">
				<div class="col-md-8 animated fadeInLeftBig" data-speed="2" data-type="background">
					<h1 id="address" class="text-center text-white long-title-stretch">
						<?= $this->model->getStreetAddress(); ?><br /><?= $this->model->getCityStZip();?>
					</h1>
				</div>
				<div class="col-md-4 col-sm-12 animated fadeInUpBig" style="animation-delay: 1s; -webkit-animation-delay: 1s;">
<!-- FIX ME -->
					<h1 id="price" class="text-center text-white stretch"><? if($row['sale_lease'] == "Lease") { ?>Lease <? } ?>Price: <?= $this->model->getListPrice;?></h1>

					<h1 id="mls-number" class="text-center stretch"><span class="text-white">MLS #</span> <a href="<?= $this->model->getMLS();?>.mls"><?= $this->model->getMLS();?></a></h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid shapes" data-speed="2" data-type="background">
	<div class="wrap">
		<div class="row">
			<div class="col-xs-12">
				<div class="row listing-info">
					<div class="col-sm-12 col-md-6">
						<div class="image-holder lg-img">
							<? //display first image here ?>
							<h4 class="text-center"><a href="javascript:void(0)" id="gallerypic"><img src="/images/demo.jpg" alt="" class="img-thumbnail img-responsive"></a></h4>
							<p><a href="javascript:void(0)" id="gallery" class="btn btn-large btn-black btn-block"><i class="fa fa-camera-retro"></i> View More Photos</a></p>
						</div>
					</div>

					<div class="col-sm-12 col-md-6">
						<div class="row">
							<? include('social/social.php'); ?>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<h4><a class="btn btn-primary btn-block" title="Print Page" href="javascript:window.print();"><i class="fa fa-print"></i> Print</a></h4>
							</div>
							<div class="col-xs-6">
								<h4><a class="btn btn-primary btn-block" title="Email Page" href="mailto:?subject=MLS  on www.JackJeffcoat.com&amp;body=I found this property that you might be interested in! %0A%0A %0A%0A Check it out at <?php echo urlencode(curPageURL()); ?>  %0A%0A %0A%0A<?= $this->model->getStreetAddress();?>, <?= $this->model->getCityStZip();?> %0A%0A %0A%0A<?= $this->model->getData('remarks');?>"><i class="fa fa-share"></i> Email to Friend</a></h4>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 hidden-sm hidden-xs">
								<p><button disabled="disabled" class="btn btn-primary btn-block"><i class="fa fa-bookmark"></i> To bookmark, press CTRL+D (<i class="fa fa-windows"></i> Windows) or CMD+D (<i class="fa fa-apple"></i> Mac)</button></p>
							</div>
						</div>

						<div class="row">
							<?php if( isset($row['virtual_tour']) ):?>
								<div class="col-xs-12">
									<p><a class="btn  btn-primary btn-block" href="<?=$this->model->getData('virtual_tour');?>" target="_blank" rel="nofollow"><i class="icon-play"></i> Virtual Tour</a></p>
								</div>
							<?php endif;?>
							<div class="col-xs-12">
								<p><a class="btn btn-blue btn-block" title="Contact for Showing" href="/contact.asp?mls=<?= $this->model->getData('listing_id');?>"><i class="fa fa-envelope"></i> Email Us For More Info</a></p>
							</div>
							<div class="col-xs-12">
								<p><a href="tel:1-321-536-1461" class="btn btn-blue btn-block"><i class="fa fa-phone"></i> Call Us For More Info: 321-536-1461</a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<p><strong>Property Type:</strong> <?php echo ucwords($this->model->getData('property_type'));?></p>
							</div>
							<?php if($this->model->getData('bedrooms')>0){?>
								<div class="col-sm-12 col-md-6">
									<p><strong>Beds:</strong> <?= $this->model->getData('bedrooms');?> </p>
								</div>
							<?php } ?>
							<?php if($this->model->getData('bathrooms')>0){?>
								<div class="col-sm-12 col-md-6">
									<p><strong> Full Baths:</strong> <?= $this->model->getData('bathrooms');?> </p>
								</div>
							<?php } ?>
							<?php if($this->model->getData('halfbaths')>0){?>
								<div class="col-sm-12 col-md-6">
									<p><strong>Half Baths:</strong> <?= $this->model->getData('halfbaths');?> </p>
								</div>
							<?php } ?>
							<div class="col-sm-12 col-md-6">
								<p><strong>List Date:</strong> <?= date('m-d-Y', strtotime($this->model->getData('listing_entry_timestamp')));?></p>
							</div>
							<?php if($this->model->getData('year_built')){?>
							<div class="col-sm-12 col-md-6">
								<p><strong>Year Built: </strong> <?= $this->model->getData('year_built');?></p>
							</div>
							<? } ?>
							<?php if($this->model->getData('homestead')){?>
							<div class="col-sm-12 col-md-6">
								<p><strong>Homestead: </strong> <?= $this->model->getData('homestead');?></p>
							</div>
							<? } ?>
							<?php if($this->model->getData('square_footage')!=""){ ?>
								<div class="col-sm-12 col-md-6">
									<p><strong><?= number_format($this->model->getData('square_footage'));?></strong> Sq. Ft.</p>
								</div>
							<?php } ?>
							<?php if($this->model->getData('sqft_total')>"0"){ ?>
								<div class="col-sm-12 col-md-6">
									<p><strong><?= number_format($this->model->getData('sqft_total'));?></strong> Total Sq. Ft.</p>
								</div>
							<?php } ?>
							<?php if($this->model->getData('zoning')!=""){ ?>
								<div class="col-sm-12 col-md-6">
									<p><strong>Zoning:</strong> <?= $this->model->getData('zoning');?></p>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<p><a href="https://www.google.com/maps/place/<?= $this->model->getStreetAddress(); ?> <?= $this->model->getCityStZip();?>" class="btn btn-primary btn-block" target="_blank"><i class="fa fa-map-marker"></i> View Map</a></p>
			</div>
			<div class="col-sm-12 col-md-4">
				<p><a href="/contact.asp?mls=<?= $this->model->getData('listing_id');?>" class="btn btn-blue btn-block"><i class="fa fa-info-circle"></i> Info / Showing</a></p>
			</div>
			<?
			// Get city and add a dash if there is a space for the link to view more homes
			$more_homes = $this->model->getCity();
			$more_homes = str_replace(" ","-", $more_homes);
			?>
			<div class="col-sm-12 col-md-4">
				<p><a href="/<?=$more_homes;?>.homes" class="btn btn-primary btn-block"><i class="fa fa-search"></i> View More <?= $this->model->getCity();?> Homes</a></p>
			</div>
		</div>
	</div>
</div>
<? $filename = "featured/".$this->model->getMLS()."/index.php";
	if (file_exists($filename))
		{
	    	include $filename;
	    }
	else
	    {}
?>
<div class="container-fluid shapes" data-speed="2" data-type="background">
	<div class="wrap">
		<div class="row">
			<div class="col-xs-12">
				<hr>
				<?php if($this->model->getData('finance')){?>
				<h4><strong>Financing Options</strong></h4>
				<p><?= $this->model->getData('finance');?></p>
				<hr>
				<? } ?>
				<?php if($this->model->getData('exterior_features')){?>
				<h4><strong>Exterior Features</strong></h4>
				<p><?= $this->model->getData('exterior_features');?></p>
				<hr>
				<? } ?>
				<?php if($this->model->getData('interior_features')){?>
				<h4><strong>Interior Features</strong></h4>
				<p><?= $this->model->getData('interior_features');?></p>
				<hr>
				<? } ?>
				<?php if($this->model->getData('equipment_appliances')){?>
				<h4><strong>Equipment / Appliances</strong></h4>
				<p><?= $this->model->getData('equipment_appliances');?></p>
				<hr>
				<? } ?>
				<?php if($this->model->getData('masterbed')){?>
				<h4><strong>Master Bedroom Features</strong></h4>
				<p><?= $this->model->getData('masterbed');?></p>
				<hr>
				<? } ?>

				<div class="row">
					<?php if($this->model->getData('elem_school')){?>
					<div class="col-md-4 col-sm-12">
						<h4><strong>Elementary School</strong></h4>
						<p><?= $this->model->getData('elem_school');?></p>
						<hr>
					</div>
					<? } ?>
					<?php if($this->model->getData('mid_school')){?>
					<div class="col-md-4 col-sm-12">
						<h4><strong>Middle School</strong></h4>
						<p><?= $this->model->getData('mid_school');?></p>
						<hr>
					</div>
					<? } ?>
					<?php if($this->model->getData('high_school')){?>
					<div class="col-md-4 col-sm-12">
						<h4><strong>High School</strong></h4>
						<p><?= $this->model->getData('high_school');?></p>
						<hr>
					</div>
					<? } ?>
				</div>

				<div class="row">
					<div class="col-sm-12 col-md-6">
						<?php if($this->model->getData('pool')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Pool</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('pool');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('pool_private')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Private Pool</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('pool_private');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('pool_comm')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Community Pool</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('pool_comm');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('pool_features')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Pool Description</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('pool_features');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('utilities')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Utilities</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('utilities');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('additional_rooms')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Additional Rooms</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('additional_rooms');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('waterfront')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Waterfront</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('waterfront');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('water_type')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Water Type</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><a href="<?=$this->model->getData('property_type')?>/waterview-<?=str_replace(" ", "-", strtolower($row['water_type']))?>.html"><?=ucwords($this->model->getData('water_type'));?></a></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('parking')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Parking</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('parking');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('split_yn')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Split Floorplan</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('split_yn');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('hoa')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>HOA</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('hoa');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('hoa_dues')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>HOA Dues</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4>
									$<?= $this->model->getData('hoa_dues');?>
									<? if($this->model->getData('hoa_dues_term')){ echo $this->model->getData('hoa_dues_term'); }?>
								</h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('construction')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Construction</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('construction');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('floor')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Floor</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('floor');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('exterior_finish')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Exterior Finish</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('exterior_finish');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('roof_type')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Roof Type</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('roof_type');?></h4>
							</div>
						</div>
						<? } ?>
					</div>

					<div class="col-sm-12 col-md-6">
						<?php if($this->model->getData('waterheat')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Water Heater Type</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('waterheat');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('fireplace')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Fireplace</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('fireplace');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('county')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>County</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('county');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('gated_community')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Gated Community</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('gated_community');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('furnishing')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Furnishings</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('furnishing');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('home_warranty')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Home Warranty</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('home_warranty');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('tax_year')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Tax Year</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('tax_year');?></h4>
							</div>
						</div>
						<? } ?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Tax Amount</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getTaxAmount();?></h4>
							</div>
						</div>
						<?php if($this->model->getData('over_55')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>55+ Community</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('over_55');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('subdivision')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Subdivision</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('subdivision');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('listing_status')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Listing Status</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('listing_status');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('property_status')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Property Status</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('property_status');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('home_style')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Home Style</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('home_style');?></h4>
							</div>
						</div>
						<? } ?>
						<?php if($this->model->getData('dwelling_view')){?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Home View</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><?= $this->model->getData('dwelling_view');?></h4>
							</div>
						</div>
						<? } ?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>Street</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><a href="<?= $this->model->getData('property_type');?>/street-<?=str_replace(" ", "-", strtolower($this->model->getData('street_name')))?>.html"><?=ucwords(strtolower($this->model->getData('street_name')));?></a> <?= $this->model->getData('street_suffix')?></h4>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<h4><strong>ZipCode</strong></h4>
							</div>
							<div class="col-sm-12 col-md-7">
								<h4><a href="<?= $this->model->getData('property_type');?>/postalcode-<?= $this->model->getData('postal_code');?>.html"><?= $this->model->getData('postal_code');?></a></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>