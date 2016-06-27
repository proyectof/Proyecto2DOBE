<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\models\Encuesta;
use frontend\models\Respuesta;

/* @var $this yii\web\View */
/* @var $model frontend\models\TestVocacional */

/*$this->title = 'Update Test Vocacional: ' . ' ' . $model->id_test_vocacional;
$this->params['breadcrumbs'][] = ['label' => 'Test Vocacionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_test_vocacional, 'url' => ['view', 'id' => $model->id_test_vocacional]];
$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="test-vocacional-update">

    <div class="col-sm-12">
        <h1><?php //echo Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin([
                'action'=>'index.php?r=test-vocacional/guardar-respuesta',
        ]);  ?>
        <?php
            $modelEncuesta= Encuesta::findOne(['id_encuesta'=>$modelTestVocacional->id_encuesta]);
            $modelRespuesta=Respuesta::findOne(['id_encuesta'=>$modelTestVocacional->id_encuesta,'id_ref'=>$modelTestVocacional->id_test_vocacional,'id_tbl'=>'TV']);
            
            echo "<input type='hidden' name='id_test_vocacional' value='".$modelTestVocacional->id_test_vocacional."'/>";
            $modelEncuesta->generarEncuesta($modelRespuesta);

        ?>
        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>
