<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Ingreso al sistema';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <p>Por favor ingrese sus datos de acceso :</p>
    <br>

    <div class="row">
        <div class="col-lg-8">
            <?php $form = ActiveForm::begin(['id' => 'login-form','layout' => 'horizontal']); ?>
                <?= $form->field($model, 'username')->label("Nombre de Usuario") ?>
                <?= $form->field($model, 'password')->label("Contraseña")->passwordInput() ?>
                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-4">
                        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
