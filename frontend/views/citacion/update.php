<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Citacion */

$this->title = 'Editar Citación';
$this->params['breadcrumbs'][] = ['label' => 'Citacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_citacion, 'url' => ['view', 'id' => $model->id_citacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="citacion-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
