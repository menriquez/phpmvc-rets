<div class="jumbotron inner-shadow lines" data-speed="2" data-type="background">
	<div class="container-fluid">
		<div class="wrap">
			<div class="row">
				<div class="col-md-8 col-sm-12 animated fadeInLeftBig">
					<h1 class="text-white text-center"><?= $this->page->getPageTitle() ?></h1>
					<h3 class="text-white text-center">Brevard County, FL</h3>
					<h3 class="text-white text-center">Central Florida Coastal Cities</h3>
					<h4 class="text-white text-center blink"><i class="fa fa-arrow-down"></i>Scroll Down to See Listings</h4>
				</div>
				<div class="col-md-4 col-sm-12">
					<? if($this->page->getImageFn()!="") { ?>
					<h3 class="text-center"><img src="<?= $this->page->getImageFn() ?>" class="img-thumbnail img-responsive animated flipInX" alt="<?= $this->page->getPageDesc() ?>" style="max-height: 200px;"></h3>
					<? } else { ?>
					<h3 class="text-center"><img src="/images/brevard-real-estate-phone.png" class="img-responsive animated flipInX" alt="<?= $this->page->getPageDesc() ?>" style="max-height: 200px;"></h3>
					<? } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid shapes" data-speed="2" data-type="background">
	<div class="wrap">
		<div class="row">
			<div class="col-sm-12 col-md-12">

				<div id="readmore-block" class="jumbotron border less">
					<p><?= $this->page->getPageText() ?></p>
					<p><button class="btn btn-danger right" id="close-readmore"><i class="fa fa-times"></i> Close</button></p>
					<div class="clear"></div>
				</div>

				<p><button class="btn btn-success right" id="readmore">Read More</button></p>
				<div class="clear"></div>

				<script>
					$("#readmore").click(function() {
						$("#readmore-block").toggleClass("more");
					});
					$("#close-readmore").click(function() {
						$("#readmore-block").toggleClass("more");
						$('html, body').animate({ scrollTop: 400 }, 400);
					});
				</script>

				<hr />

				<h4 class="text-center text-info">Below are the current listings available in <?= $this->page->getPageTitle() ?> <span class="blink instruct">&nbsp;&nbsp;&nbsp;Scroll Down <i class="fa fa-arrow-down"></i></span></h4>
				<hr />

				<div class="show-listings">

					<?
						$action=basename(__FILE__, '.php');         				// load action from filename for consistancy
						$controller = new Controller($action.'-loop');      // register controller with action
						$controller->invoke();                      				// invokde controller to get view
					?>

				</div>
			</div>
		</div>
	</div>
</div>
