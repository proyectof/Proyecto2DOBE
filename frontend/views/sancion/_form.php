<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Sancion */
/* @var $form yii\widgets\ActiveForm */
?>
<br><br>
<div class="sancion-form">

    <?php  $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
             'horizontalCssClasses' => [
                  'label' => 'col-sm-2',
                  'wrapper' => 'col-sm-6',
                  'error' => '',
                  'hint' => '',
             ],
        ],
    ]); ?>

    <?= $form->field($model, 'fecha')->textInput(['class'=>'form-control fecha']) ?>

    <?= $form->field($model, 'causa')->dropDownList(['R'=>'Rendimiento','D'=>'Disciplina'],['prompt'=>'-- Elija una causa --']); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'observacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_desde')->textInput(['class'=>'form-control fecha']) ?>

    <?= $form->field($model, 'fecha_hasta')->textInput(['class'=>'form-control fecha']) ?>

    <hr/>
    <div class="form-group col-md-3">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a("Cancelar", \Yii::$app->getUrlManager()->createUrl('ficha/update')."&id=".$model->id_ficha."&item=5", ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
