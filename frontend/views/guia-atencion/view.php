<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\GuiaAtencion */

$this->title = "Guia de Atención #".$model->id_guia_atencion;
$this->params['breadcrumbs'][] = ['label' => 'Guia Atencions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-atencion-view">
    <center >
        <h3 class='visible-print'>Unidad Educativa Fiscomisional<br> Tecnica Deportiva <br> "San Daniel Comboni" <br> Esmeraldas - Ecuador</h3>
        <br><br>
    </center>
    <h1>
        <?= Html::encode($this->title) ?>  
        <?= Html::a("<span class='glyphicon glyphicon-print'></span> Imprimir", "#", ['class' => 'btn btn-primary hidden-print','onClick'=>'window.print()']) ?>
        <?= Html::a("Volver a Inicio", \Yii::$app->getUrlManager()->createUrl('guia-atencion/index'), ['class' => 'btn btn-info hidden-print']) ?>
    </h1 >
    <hr>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                 'attribute' => 'id_alumno',//<---Variable para filtro
                 'value'=> $model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre,
            ],
            [
                 'attribute' => 'id_referencia_familiar',//<---Variable para filtro
                 'value'=>$model->idReferenciaFamiliar->apellidos." ".$model->idReferenciaFamiliar->nombres,
            ],
            'curso',
            'paralelo',
            'fecha',
            'asunto:ntext',
            'proceso:ntext',
            'diagnostico:ntext',
            'nueva_cita',
            'evaluacion_atencion',
            'conclusion:ntext',
        ],
    ]) ?>
    <div class="visible-print">
        <br>
        <br>
        <h5>Firma de Responsables</h5>
        <br><br>
        <div>
            <div class="col-xs-6"><center>Coordinador del DOBE</center></div>
            <div class="col-xs-6"><center>Padre de Familia</center></div>
        </div>
    </div>

</div>
