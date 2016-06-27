<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


use frontend\models\Encuesta;
use frontend\models\Respuesta;
use frontend\models\GuiaEvaluacion;

/* @var $this yii\web\View */
/* @var $model frontend\models\GuiaEvaluacion */

//$this->title = 'Update Guia Evaluacion: ' . ' ' . $modelGuiaEvaluacion->id_guia_evaluacion;
?>
<div class="guia-evaluacion-update">

    <div class="col-sm-12">
        <h1><?php //echo Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin([
                'action'=>'index.php?r=guia-evaluacion/guardar-respuesta',
        ]);  ?>
        <?php
            $modelEncuesta= Encuesta::findOne(['id_encuesta'=>$modelGuiaEvaluacion->id_encuesta]);
            $modelRespuesta=Respuesta::findOne(['id_encuesta'=>$modelGuiaEvaluacion->id_encuesta,'id_ref'=>$modelGuiaEvaluacion->id_guia_evaluacion,'id_tbl'=>'GE']);
            
            echo "<input type='hidden' name='id_guia_evaluacion' value='".$modelGuiaEvaluacion->id_guia_evaluacion."'/>";
            $modelEncuesta->generarEncuesta($modelRespuesta);

        ?>
        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>