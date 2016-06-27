<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">

    <p>Por favor ingrese los datos correspondientes</p>
    <br>

    <div class="row">
        <div class="col-lg-8">
            <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

                <?= $form->field($model, 'username')->label("Nombre de Usuario") ?>

                <?= $form->field($model, 'email')->label("Correo Electronico") ?>

                <?= $form->field($model, 'password')->label("Contraseña")->passwordInput() ?>

                <? if($nuevo){ ?>
		            <?= $form->field($model, 'rol',['options'=>['class'=>'form-group']])->label("Rol")
		                ->dropDownList(ArrayHelper::map(
		                    Yii::$app->db->createCommand("select name, description from auth_item where name!='estudiante'")->queryAll(),
		                    'name',
		                    'description'
		                ), 
		                [
		                    'prompt'=>'--Seleccione un rol--',
		                    'data-toggle'=>'popover',
		                ]); 
		            ?>
		        <? } ?>

                <div class="form-group">
	                <div class="col-md-8 col-md-offset-3">
	                    <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
	                </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
