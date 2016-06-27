<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referencias Familiares';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="referencia-familiar-index">
    <div class="col-sm-12">
        <h2><?=$this->title ?>  <?= Html::a("Ingresar", \Yii::$app->getUrlManager()->createUrl('referencia-familiar/create')."&id=".$_GET['id'], ['class' => 'btn btn-success']) ?></h2>
        <hr>
        <br>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'=>$searchModel,
            'tableOptions'=>['class'=>'table table-striped'],

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

               // 'id_referencia_familiar',
               // 'id_ficha',
                'cedula',
                'parentesco',
                'nombres',
                'apellidos',
                //'cedula',
                //'telefono_celular',
                [
                    'class' => 'yii\grid\ActionColumn',
                    //'template'=>'{view}{update}{delete}{anadir}{revisar}',
                    'template'=>'{editar} {eliminar}',
                    'buttons'=>[
                        'editar'=>function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', \Yii::$app->getUrlManager()->createUrl('referencia-familiar/update')."&id=".$model->id_referencia_familiar,['title'=>'Editar']);
                        },
                        'eliminar'=>function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', \Yii::$app->getUrlManager()->createUrl('referencia-familiar/delete')."&id=".$model->id_referencia_familiar, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Desea eliminar este elemento?'),
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
