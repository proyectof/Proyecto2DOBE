<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FichaEncuesta */

$this->title = 'Update Ficha Encuesta: ' . ' ' . $model->id_ficha_encuesta;
$this->params['breadcrumbs'][] = ['label' => 'Ficha Encuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_ficha_encuesta, 'url' => ['view', 'id' => $model->id_ficha_encuesta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ficha-encuesta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
