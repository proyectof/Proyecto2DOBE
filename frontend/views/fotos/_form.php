<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Fotos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fotos-form">

    <?php $form = ActiveForm::begin([
    	'action'=>'index.php?r=fotos/create',
        'options' => [
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'nombre')->fileInput() ?>
    <?= $form->field($model, 'id_ficha')->label("")->hiddenInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Subir foto', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
