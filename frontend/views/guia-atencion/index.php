<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GuiaAtencionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guia de Atenciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-atencion-index hidden-print">

    <h1><?= Html::encode($this->title) ?>  <?= Html::a('Nueva Guía de Atención', ['create'], ['class' => 'btn btn-success']) ?> <?= Html::a('Imprimir Formulario','#', ['class' => 'btn btn-info','onClick'=>'window.print()']) ?></h1>
    <hr>
    <br>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_guia_atencion',
            [
                 'attribute' => 'id_alumno',//<---Variable para filtro
                 'value'=>function($model){
                    return $model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre;
                }
            ],
            // [
            //      'attribute' => 'id_referencia_familiar',//<---Variable para filtro
            //      'value'=>function($model){
            //         return $model->idReferenciaFamiliar->apellidos." ".$model->idReferenciaFamiliar->nombres;
            //     }
            // ],
            'curso',
            'paralelo',
            //'fecha',
            // 'asunto:ntext',
            // 'proceso:ntext',
            // 'diagnostico:ntext',
            //'nueva_cita',
            // 'evaluacion_atencion',
            // 'conclusion:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <hr>
</div>


<!-- diseño de formulario de impresion-->

<div class="col-sm-12 visible-print">
    <center>
        <h3>Unidad Educativa Fiscomisional<br> Tecnica Deportiva <br> "San Daniel Comboni" <br> Esmeraldas - Ecuador</h3>
        <br><br>
        <h4>Guía de Atención para Padres de Familia</h4>
    </center>

    <?php
        echo $this->render('create', [
            'model' => $model,
        ]);
    ?>
    <br>
    <br>
    <h5>Firma de Responsables</h5>
    <br><br>
    <div>
        <div class="col-xs-6"><center>Coordinador del DOBE</center></div>
        <div class="col-xs-6"><center>Padre de Familia</center></div>
    </div>

</div>