<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Sancion */

$this->title = $model->id_citacion;
$this->params['breadcrumbs'][] = ['label' => 'Sancions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sancion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_citacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_citacion], [
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
            'id_citacion',
            'id_ficha',
            'fecha',
            'causa',
            'descripcion:ntext',
            'obsevacion:ntext',
            'fecha_desde',
            'fecha_hasta',
        ],
    ]) ?>

</div>
