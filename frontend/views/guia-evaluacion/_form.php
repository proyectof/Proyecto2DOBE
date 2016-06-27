<?php

use yii\web\JsExpression;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Alumno;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\GuiaEvaluacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guia-evaluacion-form">

    <?php  $form = ActiveForm::begin([
            //'action'=>($model->isNewRecord) ? 'index.php?r=alumno/create' : 'index.php?r=alumno/update&id='.$model->id_alumno,
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{hint}",
            ]
    ]); ?>

    <?php
            $items= Alumno::find()->select(['concat(concat(apellido_paterno," ",apellido_materno)," ",nombre) as nombre_completo','id_alumno'])->asArray()->all();
            // echo $form->field($model, 'aux',['options'=>['class' => 'form-group col-xs-8']])
            //         ->widget(yii\jui\AutoComplete::className(), [
            //             'options'=>['id'=>'autoCompletarAlumno','class' => 'form-control'],
            //             'clientOptions' =>[
            //                 'source' => $items,
            //                 'select' => new JsExpression("function( event, ui ) {
            //                     cargar(ui.item.id,'guiaevaluacion-id_referencia_familiar','".Yii::$app->getUrlManager()->createUrl("referencia-familiar/cargar")."');
            //                     $('#guiaevaluacion-id_alumno').val(ui.item.id);
            //                  }")
            //             ],
            //         ]);
    ?>

    <?= $form->field(
            $model, 
            'id_alumno',[
                    'options'=>[
                        'class' => 'form-group col-xs-8',
                    ]
            ])
        ->label("Nombre del alumno")
        ->dropDownList(ArrayHelper::map(
            $items,
            'id_alumno',
            'nombre_completo'
        ), 
        [
            'prompt'=>'--Seleccione un alumno--',
            'onchange' => "cargar(this.value,'guiaevaluacion-id_referencia_familiar','".Yii::$app->getUrlManager()->createUrl("referencia-familiar/cargar")."');"
        ]); 
    ?>

    <?=$form->field($model, 'id_referencia_familiar',['options'=>['class' => 'form-group col-xs-8']])
            ->dropDownList(array(), 
            [
                'prompt'=>'--Seleccione una referencia familiar--',
                'data-toggle'=>'popover',
            ]); 
    ?>


    <div class="form-group col-xs-8">
        <?= Html::submitButton('Ingresar', ['class' =>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
