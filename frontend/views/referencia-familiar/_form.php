<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReferenciaFamiliar */
/* @var $form yii\widgets\ActiveForm */
?>
<br><br>
<div class="referencia-familiar-form">

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

    <?= $form->field($model, 'parentesco')
             ->dropDownList([
                'Padre'=>'Padre',
                'Madre'=>'Madre',
                'Tío/a'=>'Tío/a',
                'Hermano/a'=>'Hermano/a',
                'Abuelo/a'=>'Abuelo/a',
                'Otro/a'=>'Otro/a'
              ],[
                'prompt'=>'-- Elija un parentesco --'
              ]);  
    ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'cedula')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'telefono_celular')->textInput() ?>

    <?= $form->field($model, 'telefono_convencional')->textInput() ?>

    <hr/>
    <div class="form-group col-md-3">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a("Cancelar", \Yii::$app->getUrlManager()->createUrl('ficha/update')."&id=".$model->id_ficha."&item=3", ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
