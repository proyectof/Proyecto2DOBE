<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\searchs\ReferenciaEconomicaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referencia-economica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_referencia_economica') ?>

    <?= $form->field($model, 'trabaja') ?>

    <?= $form->field($model, 'grado_estudio') ?>

    <?= $form->field($model, 'ocupacion') ?>

    <?= $form->field($model, 'direccion_trabajo') ?>

    <?php // echo $form->field($model, 'estado_civil') ?>

    <?php // echo $form->field($model, 'edad') ?>

    <?php // echo $form->field($model, 'id_referencia_familiar') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
