<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\GuiaAtencion */

$this->title = 'Editar Guía Atención';
$this->params['breadcrumbs'][] = ['label' => 'Guia Atencions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_guia_atencion, 'url' => ['view', 'id' => $model->id_guia_atencion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guia-atencion-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
