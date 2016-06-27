<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReferenciaFamiliar */

$this->title = 'Editar Referencia Familiar';
$this->params['breadcrumbs'][] = ['label' => 'Referencia Familiars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_referencia_familiar, 'url' => ['view', 'id' => $model->id_referencia_familiar]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="referencia-familiar-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
