<?php
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Alumno;
use frontend\models\ReferenciaFamiliar;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\models\GuiaAtencion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guia-atencion-form">

    <?php  $form = ActiveForm::begin([
            //'action'=>($model->isNewRecord) ? 'index.php?r=alumno/create' : 'index.php?r=alumno/update&id='.$model->id_alumno,
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{hint}",
            ]
    ]); ?>

    <?= $form->field(
                $model, 
                'fecha',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textInput([
                'class'=>'form-control fecha'
             ]); 
    ?>


    <?php 
            $items= Alumno::find()->select(['concat(concat(apellido_paterno," ",apellido_materno)," ",nombre) as nombre_completo','id_alumno'])->asArray()->all();
            // echo $form->field($model,'aux',['options'=>['class' => 'form-group col-xs-12']])
            //         ->widget(yii\jui\AutoComplete::className(), [
            //             'options'=>[
            //                 'id'=>'autoCompletarAlumno',
            //                 'class' => 'form-control',
            //                 'value'=>(!$model->isNewRecord)? $model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre: " ",
            //             ],
            //             'clientOptions' =>[
            //                 'source' => $items,
            //                 'select' => new JsExpression("function( event, ui ) {
            //                     cargar(ui.item.id,'guiaatencion-id_referencia_familiar','".Yii::$app->getUrlManager()->createUrl("referencia-familiar/cargar")."');
            //                     $('#guiaatencion-id_alumno').val(ui.item.id);
            //                  }")
            //             ],
            //         ]);
    ?> 

    <?= $form->field(
            $model, 
            'id_alumno',[
                    'options'=>[
                        'class' => 'form-group col-xs-12',
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
            'onchange' => "cargar(this.value,'guiaatencion-id_referencia_familiar','".Yii::$app->getUrlManager()->createUrl("referencia-familiar/cargar")."')"
        ]); 
    ?>

    <?php //echo Html::activeHiddenInput($model, 'id_alumno'); ?>

     <?=$form->field($model, 'id_referencia_familiar',['options'=>['class' => 'form-group col-xs-8']])
            ->dropDownList((!$model->isNewRecord) ? ArrayHelper::map(ReferenciaFamiliar::find()->select(['concat(apellidos," ",nombres) as nombre','id_referencia_familiar as id'])->where(['id_ficha'=>$model->idAlumno->id_ficha])->asArray()->all(),'id','nombre'): array(), 
            [
                'prompt'=>'--Seleccione una referencia familiar--',
                'data-toggle'=>'popover',
            ]); 
    ?>

    <?= $form->field(
                $model, 
                'curso',[
                    'options'=>['class' => 'form-group col-xs-2']
                ])
             ->textInput([
                'maxlength' => 50,
             ]); 
    ?>

    <?= $form->field(
                $model, 
                'paralelo',[
                    'options'=>['class' => 'form-group col-xs-2']
                ])
             ->textInput([
                'maxlength' => 1,
             ]); 
    ?>


    <?= $form->field(
                $model, 
                'asunto',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textarea(['rows' => 6]) 
    ?>

    <?= $form->field(
                $model, 
                'proceso',[
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

    <?= $form->field(
                $model, 
                'nueva_cita',[
                    'options'=>['class' => 'form-group col-xs-6']
                ])
             ->textInput([
                'class'=>'form-control fecha'
             ]); 
    ?>
    <?= $form->field(
                    $model, 
                    'evaluacion_atencion',[
                        'options'=>['class' => 'form-group col-xs-6']
                    ])
                 ->dropDownList(['Muy Buena'=>'Muy Buena','Buena'=>'Buena','Regular'=>'Regular','Mala'=>'Mala'],['prompt'=>'-- Elija una opción --']); 
        ?>

    <?= $form->field(
                $model, 
                'conclusion',[
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
