<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AspectoAcademico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aspecto-academico-form">

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

        <?= $form->field(
                    $model, 
                    'curso_in',[
                        //'options'=>['class' => 'form-group col-sm-6']
                    ])
                 ->textInput(['maxlength' => 50]); 
        ?>

        <?= $form->field(
                    $model, 
                    'especialidad',[
                        //'options'=>['class' => 'form-group col-sm-6']
                    ])
                 ->textInput(['maxlength' => 200]); 
        ?>

        <?= $form->field(
                    $model, 
                    'zona',[
                        //'options'=>['class' => 'form-group col-sm-3']
                    ])
                 ->dropDownList(['R'=>'Rural','U'=>'Urbana'],['prompt'=>'-- Elija una zona --']); 
        ?>

        <?= $form->field(
                    $model, 
                    'repetidor',[
                        //'options'=>['class' => 'form-group col-sm-3']
                    ])
                 ->dropDownList(['S'=>'Si','N'=>'No'],['prompt'=>'-- Elija una opción --']);  
        ?>

        <?= $form->field(
                    $model, 
                    'num_matricula',[
                        //'options'=>['class' => 'form-group col-sm-3']
                    ])
                 ->textInput(); 
        ?>

        <?= $form->field(
                    $model, 
                    'paralelo',[
                        //'options'=>['class' => 'form-group col-sm-3']
                    ])
                 ->textInput(['maxlength' => 1]); 
        ?>
        <hr/>
        <div class="form-group col-md-3">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            <?= Html::a("Cancelar", \Yii::$app->getUrlManager()->createUrl('ficha/update')."&id=".$model->id_ficha."&item=2", ['class' => 'btn btn-danger']) ?>
        </div>
        
    <?php ActiveForm::end(); ?>

</div>
