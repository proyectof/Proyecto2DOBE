<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\AspectoAcademico */

$this->title = 'Nuevo Aspecto Académico';
$this->params['breadcrumbs'][] = ['label' => 'Aspecto Academicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aspecto-academico-create">
		<h1><?= Html::encode($this->title) ?></h1>
		<hr>
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	    
</div>
