<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Encuesta;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TestVocacionalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Vocacional';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-vocacional-index hidden-print">

    <h1><?= Html::encode($this->title) ?>  <?= Html::a('Nuevo Test Vocacional', ['create'], ['class' => 'btn btn-success']) ?> <?= Html::a('Imprimir Formulario','#', ['class' => 'btn btn-info','onClick'=>'window.print()']) ?></h1>
    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_test_vocacional',
            //'id_encuesta',
            // [
            //      'attribute' => 'id_alumno',//<---Variable para filtro
            //      'value'=>function($model){
            //         return $model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre;
            //     }
            // ],
            'fecha',
            'hora',

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
        $modelEncuesta= Encuesta::findOne(['id_encuesta'=>3]);
        $modelEncuesta->generarEncuesta(NULL);
    ?>
</div>