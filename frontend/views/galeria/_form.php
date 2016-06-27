<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Galeria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="galeria-form">
	<?php $form = ActiveForm::begin([
	     "method" => "post",
	     "enableClientValidation" => true,
	     "options" => ["enctype" => "multipart/form-data"],
	     ]);
	?>
	<?= $form->field($model, "extension[]")->label("Seleccionar fotos")->fileInput(['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton( 'Subir Fotos', ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
