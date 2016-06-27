<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


use frontend\models\FichaEncuesta;
use frontend\models\Encuesta;
use frontend\models\Respuesta;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FichaEncuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ficha Encuestas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-encuesta-index">
    <div class="col-sm-12">
        <h1><?php //echo Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin([
                'action'=>'index.php?r=ficha-encuesta/guardar-respuesta',
        ]);  ?>
        <?php
            $modelFichaEncuesta = FichaEncuesta::findOne(['id_ficha'=>$idFicha]);
            $modelEncuesta= Encuesta::findOne(['id_encuesta'=>$modelFichaEncuesta->id_encuesta]);
            $modelRespuesta=Respuesta::findOne(['id_encuesta'=>$modelFichaEncuesta->id_encuesta,'id_ref'=>$modelFichaEncuesta->id_ficha_encuesta,'id_tbl'=>'FE']);
            
            echo "<input type='hidden' name='id_ficha' value='".$idFicha."'/>";
            $modelEncuesta->generarEncuesta($modelRespuesta);

        ?>
        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>
