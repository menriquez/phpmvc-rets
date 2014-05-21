<div class="jumbotron inner-shadow lines" data-speed="2" data-type="background">
	<div class="container-fluid">
		<div class="wrap">
			<div class="row">
				<div class="col-md-8 col-sm-12 animated fadeInLeftBig">
					<h1 class="text-white text-center"><?= $this->model->getDisplayTitle() ?></h1>
					<h3 class="text-white text-center">Brevard County, FL</h3>
				</div>
				<div class="col-md-4 col-sm-12">
					<p class="text-center"><img src="/images/brevard-real-estate-phone.png" class="img-responsive animated flipInX" alt="" style="max-height: 200px;"></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid shapes" data-speed="2" data-type="background">
	<div class="wrap">
		<div class="row">
			<div class="col-sm-12 col-md-12">

				<hr />

				<!--
				<h4 class="text-center text-info">Below are the current listings available in <?= $this->model->getCityStZip() ?>--> <span class="blink instruct">&nbsp;&nbsp;&nbsp;Scroll Down <i class="fa fa-arrow-down"></i></span></h4>
				<hr />

				<div class="show-listings">

          <?
         		$action=basename(__FILE__, '.php');         				// load action from filename for consistancy
        		$controller = new Controller($action.'-loop');      // register controller with action
         		$controller->invoke();                      				// invokde controller to get view
          ?>
				<div class="clear"></div>
				</div>
			</div>
			<? //include('includes/sidebar.php'); ?>
		</div>
	</div>
</div>
