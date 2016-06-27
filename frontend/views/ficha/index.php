<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Alumno;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fichas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-index">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?> <?= Html::a('Ingresar una Nueva Ficha', ['create'], ['class' => 'btn btn-success']) ?></h1>
        <hr>
        <br>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions'=>['class'=>'table table-striped'],
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                'idAlumno.cedula',
                [
                    //'header'=>'Nombres y Apellidos',
                    'attribute'=>'nombre_completo',
                    'content'=>function ($model) {
                        return $model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre;
                    }
                ],
                'fecha_creacion',
                //'hora_creacion',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{update}{imprimir}',
                    'buttons'=>[
                            'update'=>function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span> Actualizar ', \Yii::$app->getUrlManager()->createUrl('ficha/update')."&id=".$model->id_ficha,['title'=>'Editar','class'=>'btn btn-primary btn-sm']);
                            },
                            'imprimir'=>function ($url, $model) {
                               return "  ".Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', \Yii::$app->getUrlManager()->createUrl('ficha/view')."&id=".$model->id_ficha,['title'=>'Vista de Impresión','class'=>'btn btn-primary btn-sm']);
                            },
                        ]
                ],
            ],
        ]); ?>
    </div>
</div>
