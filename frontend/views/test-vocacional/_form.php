<?php

use yii\web\JsExpression;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Alumno;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\TestVocacional */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-vocacional-form">

    <?php  $form = ActiveForm::begin([
            //'action'=>($model->isNewRecord) ? 'index.php?r=alumno/create' : 'index.php?r=alumno/update&id='.$model->id_alumno,
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{hint}",
            ]
    ]); ?>

    <?php 
            $items= Alumno::find()->select(['concat(concat(apellido_paterno," ",apellido_materno)," ",nombre) as value', 'concat(concat(apellido_paterno," ",apellido_materno)," ",nombre) as label','id_alumno as id'])->asArray()->all();
            echo $form->field($model,'aux',['options'=>['class' => 'form-group col-xs-12']])
                    ->widget(yii\jui\AutoComplete::className(), [
                        'options'=>[
                            'id'=>'autoCompletarAlumno',
                            'class' => 'form-control',
                            'value'=>(!$model->isNewRecord)? $model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre: " ",
                        ],
                        'clientOptions' =>[
                            'source' => $items,
                            'select' => new JsExpression("function( event, ui ) {
                                cargar(ui.item.id,'guiaatencion-id_referencia_familiar','".Yii::$app->getUrlManager()->createUrl("referencia-familiar/cargar")."');
                                $('#testvocacional-id_alumno').val(ui.item.id);
                             }")
                        ],
                    ]);
    ?> 

    <?php echo Html::activeHiddenInput($model, 'id_alumno'); ?>

    <div class="form-group">
        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
