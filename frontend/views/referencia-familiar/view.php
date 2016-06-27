<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReferenciaFamiliar */

$this->title = $model->id_referencia_familiar;
$this->params['breadcrumbs'][] = ['label' => 'Referencia Familiar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencia-familiar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_referencia_familiar], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_referencia_familiar], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseas eliminar esta referencia familiar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_referencia_familiar',
            'id_ficha',
            'parentesco',
            'nombres',
            'apellidos',
            'cedula',
            'telefono_celular',
            'telefono_convencional'
        ],
    ]) ?>

</div>
