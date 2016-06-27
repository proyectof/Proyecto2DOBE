<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sanciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="sancion-index">
    <div class="col-sm-12">
        <h2><?=$this->title ?>  <?= Html::a("Ingresar", \Yii::$app->getUrlManager()->createUrl('sancion/create')."&id=".$_GET['id'], ['class' => 'btn btn-success']) ?></h2>
        <hr>
        <br>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'=>$searchModel,
            'tableOptions'=>['class'=>'table table-striped'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id_citacion',
                //'id_ficha',
                'fecha',
                [
                    'attribute'=>'causa',
                    'content'=>function($model){
                        return ($model->causa=='R') ? "Rendimiento":"Disciplina";
                    }
                ],
                'descripcion:ntext',
                'observacion:ntext',
                'fecha_desde',
                'fecha_hasta',

                [
                    'class' => 'yii\grid\ActionColumn',
                    //'template'=>'{view}{update}{delete}{anadir}{revisar}',
                    'template'=>'{editar}{eliminar}',
                    'buttons'=>[
                        'editar'=>function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', \Yii::$app->getUrlManager()->createUrl('sancion/update')."&id=".$model->id_sancion,['title'=>'Editar']);
                        },
                        'eliminar'=>function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', \Yii::$app->getUrlManager()->createUrl('sancion/delete')."&id=".$model->id_sancion, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        }
                    ]

                ],
            ],
        ]); ?>
        <hr>
    </div>
</div>
