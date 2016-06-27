<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\searchs\ReferenciaEconomicaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referencia Economicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="referencia-economica-index">
  <div class="col-sm-12">
    <h2><?= Html::encode($this->title) ?> <?= Html::a("Nueva Referencia Económica", \Yii::$app->getUrlManager()->createUrl('referencia-economica/create')."&id=".$_GET['id'], ['class' => 'btn btn-success hidden-print']) ?></h2>
    <hr>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_referencia_economica',
            'trabaja',
            'grado_estudio',
            'ocupacion',
            'direccion_trabajo',
            // 'estado_civil',
            // 'edad',
            // 'id_referencia_familiar',
            // 'id_ficha',

            [
                'class' => 'yii\grid\ActionColumn',
                //'template'=>'{view}{update}{delete}{anadir}{revisar}',
                'template'=>'{editar} {eliminar}',
                'buttons'=>[
                    'editar'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', \Yii::$app->getUrlManager()->createUrl('referencia-economica/update')."&id=".$model->id_referencia_economica,['title'=>'Editar']);
                    },
                    'eliminar'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', \Yii::$app->getUrlManager()->createUrl('referencia-economica/delete')."&id=".$model->id_referencia_economica, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Deseas eliminar este registro?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }
                ]

            ],
        ],
    ]); ?>
    </div>
</div>
