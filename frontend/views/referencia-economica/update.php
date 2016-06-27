<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReferenciaEconomica */

$this->title = 'Editar Referencia Economica';
$this->params['breadcrumbs'][] = ['label' => 'Referencia Economicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_referencia_economica, 'url' => ['view', 'id' => $model->id_referencia_economica]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="referencia-economica-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
