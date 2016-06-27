<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Galeria */

$this->title = 'Subir fotos a la galeria';
$this->params['breadcrumbs'][] = ['label' => 'Galerias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galeria-create"> 

    <center>
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
    </center>

</div>
