<div class="col-xs-12 col-sm-4 col-md-3">
        <div class="listings listing-left">
          <div class="row">
            <div class="col-xs-12">
              <div class="listing-address overflow">
                <h3><a href="<?=$this->model->getMLSLink();?>"><? $stg=$this->model->getStreetAddress(); echo $stg ?></a></h3>
                <p><?= $this->model->getCityStZip(); ?></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="listing-image img-sm" style="background: url('/<?=$this->model->getThumbSmallFn();?>') no-repeat center center; margin-bottom: 10px;">
                  <a href="<?=$this->model->getMLSLink();?>">
                    <img src="/images/clear.png">
                  </a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="listing-price overflow">
                <h4 class="text-success"><b>Listing Price:</b> <?= $this->model->getPrice(); ?></h4>
                <hr style="margin: 5px 0;" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <h5><b>Type:</b> <small><?= ucwords($this->model->getPropertyTypeTag()); ?></small></h5>
            </div>
            <div class="col-xs-6">
              <h5><b>Bedrooms:</b> <?= $this->model->getBeds(); ?></h5>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <h5><b>Full Baths:</b> <?= $this->model->getBaths(); ?></h5>
            </div>
            <div class="col-xs-6">
              <h5><b>&frac12; Baths:</b> <?= $this->model->getHalfBaths(); ?></h5>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <h5><b>MLS #:</b> <a href="<?=$this->model->getMLSLink();?>"><?= $this->model->getMLS(); ?></a></h5>
            </div>
            <div class="col-xs-12 col-sm-6">
              <a href="<?=$this->model->getMLSLink();?>" class="btn btn-primary btn-sm btn-block" style="margin: 0;">Details <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <p class="property-info-sm">
                <? // (VERY IMPORTANT) limit to 76 characters and put "..." after ?>
                <?= $this->model->getShortDesc(144); ?>
              </p>
            </div>
          </div>
        </div>
      </div>


<? /* IF PAGE LOAD TIME IS STILL TOO SLOW, USE THIS FORMAT INSTEAD */ ?>
<? /*
<div class="listings-homes listing-left">
	<div class="listing-address overflow">
		<h3><?=$this->model->getStreetAddress();?></h3>
	</div>
	<div class="listing-image img-sm" style="background: url('/<?=$this->model->getThumbSmallFn();?>') no-repeat center center; margin-bottom: 10px;">
	<a href="">
	<img src="/images/clear.png">
	</a>
	</div>
	<h4 class="text-success" style="margin-top: 0;"><b>Listing Price:</b> <?= $this->model->getPrice(); ?></h4>
	<h4 class="text-info"><b>MLS #</b> <a href=""><?= $this->model->getMLS(); ?></a></h4>
	<h4><b>Property Type:</b> <?= ucwords($this->model->getPropertyType()); ?></h4>
	<h5 style="margin-top: 0;"><b>Bedrooms:</b> <?= $this->model->getBeds(); ?></h5>
	<h5><b>Bathrooms:</b> <?= $this->model->getBaths(); ?> <small class="define">full</small> <?= $this->model->getHalfBaths(); ?> <small class="define">half</small></h5>
	<h5><a href="" class="btn btn-primary btn-sm btn-block">More Info</a></h5>
	<p class="property-info-sm">
	<?= $this->model->getShortDesc(); ?>
	<a href="">Read More</a>
	</p>
</div>
*/ ?>