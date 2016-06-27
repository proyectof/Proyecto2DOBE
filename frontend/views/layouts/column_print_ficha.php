<?php $this->beginContent('@app/views/layouts/main.php'); ?>
	
	<div class="row">
		<div class="col-sm-2 hidden-print">
			<a href="#" class="btn btn-primary" onclick="window.print()"><span class="glyphicon glyphicon-print"></span> Imprimir Ficha</a>
		</div>
		<div class="col-sm-10">
				<?= $content; ?>
		</div>
	</div>
<?php $this->endContent(); ?>