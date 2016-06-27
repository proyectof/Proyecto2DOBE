<?php $this->beginContent('@app/views/layouts/main.php'); ?>
	
	<div class="row">
		<div class="col-md-3 hidden-print">
			<img src="img/logo.jpg" width="160" alt="" class="img-circle">
		</div>
		<div class="col-md-9">
				<?= $content; ?>
		</div>
	</div>
<?php $this->endContent(); ?>