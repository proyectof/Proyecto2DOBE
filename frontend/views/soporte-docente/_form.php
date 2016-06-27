<?php
//use yii\jui\AutoCompleteAsset;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Alumno;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\SoporteDocente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soporte-docente-form">

    <?php  $form = ActiveForm::begin([
            //'action'=>($model->isNewRecord) ? 'index.php?r=alumno/create' : 'index.php?r=alumno/update&id='.$model->id_alumno,
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{hint}{error}",
            ]
    ]); ?>



    <?= $form->field(
                $model, 
                'fecha',[
                    'options'=>['class' => 'form-group col-xs-6']
                ])
             ->textInput([
                'maxlength' => 50,
                'class'=>'form-control fecha'
             ]); 
    ?>

    <?= $form->field(
                $model, 
                'curso',[
                    'options'=>['class' => 'form-group col-xs-3']
                ])
             ->textInput([
                'maxlength' => 50,
             ]); 
    ?>

    <?= $form->field(
                $model, 
                'paralelo',[
                    'options'=>['class' => 'form-group col-xs-3']
                ])
             ->textInput([
                'maxlength' => 1,
             ]); 
    ?>

            
    <?php 
            $items= Alumno::find()->select(['concat(concat(apellido_paterno," ",apellido_materno)," ",nombre) as nombre_completo','id_alumno'])->asArray()->all();
            // echo $form->field($model, 'id_alumno',['options'=>['class' => 'form-group col-xs-12']])
            //         ->widget(yii\jui\AutoComplete::className(), [
            //             'options'=>['id'=>'autoCompletarAlumno','class' => 'form-control'],
            //             'clientOptions' =>[
            //                 'source' => $items,
            //                 'select' => new JsExpression("function( event, ui ) {
            //                     $('#soportedocente-id_alumno').val(ui.item.id);
            //                  }")
            //             ],
            //         ])

    ?> 

    <?= $form->field(
            $model, 
            'id_alumno',[
                    'options'=>['class' => 'form-group col-xs-12']
            ])
        ->label("Estudiante")
        ->dropDownList(ArrayHelper::map(
            $items,
            'id_alumno',
            'nombre_completo'
        ), 
        [
            'prompt'=>'--Seleccione un estudiante--',
            'data-toggle'=>'popover',
        ]); 
    ?>

    <?= $form->field(
                $model, 
                'asignatura',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textInput([
                'maxlength' => 50,
             ]); 
    ?>

    <?= $form->field(
                $model, 
                'comportamiento',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textarea(['rows' => 6]) 
    ?>

    <?= $form->field(
                $model, 
                'rendimiento',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textarea(['rows' => 6]) 
    ?>

    <?= $form->field(
                $model, 
                'otro',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textarea(['rows' => 6]) 
    ?>

    <?= $form->field(
                $model, 
                'diagnostico',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textarea(['rows' => 6]) 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Ingresar' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success hidden-print' : 'btn btn-primary hidden-print']) ?>
    </div>
    <hr>

    <?php ActiveForm::end(); ?>

</div>
