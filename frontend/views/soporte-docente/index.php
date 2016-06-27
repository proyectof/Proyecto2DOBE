<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SoporteDocenteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soporte Docentes';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soporte-docente-index hidden-print">

    <h1>
        <?= Html::encode($this->title) ?> 
        <?php  
            if(Yii::$app->user->can("docente")){
                echo Html::a('Ingresar Nuevo Soporte Docente', ['create'], ['class' => 'btn btn-success']);
            }
        ?>
        <?= Html::a('Imprimir Formulario','#', ['class' => 'btn btn-info','onClick'=>'window.print()']) ?>
    </h1>
    <hr>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_soporte_docente',
            [
                 'attribute' => 'id_alumno',//<---Variable para filtro
                 'value'=>function($model){
                    return $model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre;
                }
            ],
           //'id_alumno',
            //'nombre_docente',
            'asignatura',
            'curso',
            'paralelo',
            'fecha',
            // 'comportamiento:ntext',
            // 'rendimiento:ntext',
            // 'otro:ntext',
            // 'diagnostico:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                'visible'=>Yii::$app->user->can("coordinador"),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'visible'=>Yii::$app->user->can("docente"),
            ],
        ],
    ]); ?>
    
    <hr>

</div>

<!-- diseño de formulario de impresion-->

<div class="col-sm-12 visible-print">
    <center>
        <h3>Unidad Educativa Fiscomisional<br> Tecnica Deportiva <br> "San Daniel Comboni" <br> Esmeraldas - Ecuador</h3>
        <br><br>
        <h4>Soporte para los Docentes referente a faltas tanto de conducta o aprovechamiento</h4>
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
        <div class="col-xs-6"><center>Docente</center></div>
        <div class="col-xs-6"><center>Estudiante</center></div>
        <br>
        <br>
        <br>
        <div class="col-xs-12"><center>Coordinador DOBE/a</center></div>
    </div>

</div>
