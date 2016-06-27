<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ReferenciaEconomica */

$this->title = 'Nueva Referencia Economica';
$this->params['breadcrumbs'][] = ['label' => 'Referencia Economicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencia-economica-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
