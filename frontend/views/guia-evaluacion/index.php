<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Encuesta;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GuiaEvaluacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guia de Evaluación';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-evaluacion-index hidden-print">

    <h1><?= Html::encode($this->title) ?>  <?= Html::a('Nueva Guía de Evaluación', ['create'], ['class' => 'btn btn-success']) ?>  <?= Html::a('Imprimir Formulario','#', ['class' => 'btn btn-info','onClick'=>'window.print()']) ?></h1>
    <hr>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_guia_evaluacion',
            //'id_encuesta',
            [
                 'attribute' => 'id_alumno',//<---Variable para filtro
                 'value'=>function($model){
                    return $model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre;
                }
            ],
            [
                 'attribute' => 'id_referencia_familiar',//<---Variable para filtro
                 'value'=>function($model){
                    return $model->idReferenciaFamiliar->apellidos." ".$model->idReferenciaFamiliar->nombres;
                }
            ],
            //'fecha',
            //'hora',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <hr>
</div>

<div class="visible-print">
    <center >
        <h3 class='visible-print'>Unidad Educativa Fiscomisional<br> Tecnica Deportiva <br> "San Daniel Comboni" <br> Esmeraldas - Ecuador</h3>
        <br><br>
    </center>
    <?php
        $modelEncuesta= Encuesta::findOne(['id_encuesta'=>2]);
        $modelEncuesta->generarEncuesta(NULL);
    ?>
</div>

