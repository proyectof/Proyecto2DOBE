<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FichaEncuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ficha-encuesta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_encuesta')->textInput() ?>

    <?= $form->field($model, 'id_ficha')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>