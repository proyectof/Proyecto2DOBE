<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReferenciaEconomica */

$this->title = $model->id_referencia_economica;
$this->params['breadcrumbs'][] = ['label' => 'Referencia Economicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencia-economica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_referencia_economica], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_referencia_economica], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_referencia_economica',
            'trabaja',
            'grado_estudio',
            'ocupacion',
            'direccion_trabajo',
            'estado_civil',
            'edad',
            'id_referencia_familiar',
            'id_ficha',
        ],
    ]) ?>

</div>
