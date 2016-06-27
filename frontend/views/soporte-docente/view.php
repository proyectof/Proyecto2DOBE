<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SoporteDocente */

$this->title = "Soporte Docente #".$model->id_soporte_docente;
$this->params['breadcrumbs'][] = ['label' => 'Soporte Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soporte-docente-view">
    <center >
        <h3 class='visible-print'>Unidad Educativa Fiscomisional<br> Tecnica Deportiva <br> "San Daniel Comboni" <br> Esmeraldas - Ecuador</h3>
        <br><br>
    </center>
    <h1>
        <?= Html::encode($this->title) ?>  
        <?= Html::a("<span class='glyphicon glyphicon-print'></span> Imprimir", "#", ['class' => 'btn btn-primary hidden-print','onClick'=>'window.print()']) ?>
        <?= Html::a("Volver a Inicio", \Yii::$app->getUrlManager()->createUrl('soporte-docente/index'), ['class' => 'btn btn-info hidden-print']) ?>
    </h1 >
    <hr>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_soporte_docente',
            [
                 'attribute' => 'id_alumno',//<---Variable para filtro
                 'value'=> $model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre,
            ],
            //'nombre_docente',
            'asignatura',
            'curso',
            'paralelo',
            'fecha',
            'comportamiento:ntext',
            'rendimiento:ntext',
            'otro:ntext',
            'diagnostico:ntext',
        ],
    ]) ?>
    <div class="visible-print">
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
    
</div>
