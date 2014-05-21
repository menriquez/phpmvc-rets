<?
$mlsLink="/".$this->model->getMLS().".mls";
?>

     <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="listings listing-left">
          <div class="row">
            <div class="col-xs-12">
              <div class="listing-address overflow">
                <h3><a href="<?=$this->model->getMLSLink();?>"><?=$this->model->getStreetAddress(); ?></a></h3>
                <p><?= $this->model->getCityStZip(); ?></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="listing-image" style="background: url('/<?=$this->model->getThumbFn();?>') no-repeat center center; background-size: 100%;">
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
                <hr style="margin: 5px 0;">
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