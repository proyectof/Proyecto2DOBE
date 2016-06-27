<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Citaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="citacion-index">
    <div class="col-sm-12">
        <h2><?=$this->title ?>  <?= Html::a("Ingresar", \Yii::$app->getUrlManager()->createUrl('citacion/create')."&id=".$_GET['id'], ['class' => 'btn btn-success']) ?></h2>
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
                'curso',
                'paralelo',
                [
                    'attribute'=>'causa',
                    'content'=>function($model){
                        return ($model->causa=='R') ? "Rendimiento":"Disciplina";
                    }
                ],
                'descripcion:ntext',
                'observacion:ntext',

                [
                    'class' => 'yii\grid\ActionColumn',
                    //'template'=>'{view}{update}{delete}{anadir}{revisar}',
                    'template'=>'{editar}{eliminar}',
                    'buttons'=>[
                        'editar'=>function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', \Yii::$app->getUrlManager()->createUrl('citacion/update')."&id=".$model->id_citacion,['title'=>'Editar']);
                        },
                        'eliminar'=>function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', \Yii::$app->getUrlManager()->createUrl('citacion/delete')."&id=".$model->id_citacion, [
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
