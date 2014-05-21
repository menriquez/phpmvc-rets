<div class="jumbotron inner-shadow" style="background: #3B5B80;">
	<div class="container-fluid">
		<div class="wrap">
			<div class="row">
				<div class="col-md-6 animated fadeInLeftBig">
					<h1 class="text-white long-title-stretch"><?=$this->model->getTitle();?></h1>
					<p class="text-white"><?=$this->model->getShortDesc();?></p>
				</div>
				<? include('includes/small-buttons.php'); ?>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="wrap">
		<div class="row">
			<div class="col-sm-12 col-md-8">
				<div class="jumbotron border">
					<?= $this->model->getContent();?>
				</div>
			</div>
			<? include('includes/sidebar.php'); ?>
		</div>
	</div>
</div>