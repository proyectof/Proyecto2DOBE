<?php

use yii\helpers\Html;
use yii\grid\GridView;

use frontend\models\AspectoAcademico;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aspecto Académicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="aspecto-academico-index">
    <div class="col-sm-12 hidden-print">
        <h2><?=$this->title ?>  <?= Html::a("Ingresar", \Yii::$app->getUrlManager()->createUrl('aspecto-academico/create')."&id=".$_GET['id'], ['class' => 'btn btn-success hidden-print']) ?></h2>
        <hr>
        <br>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'=>$searchModel,
            'tableOptions'=>['class'=>'table table-striped'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id_asp_acad_esp',
                //'id_ficha',
                'num_matricula',
                'curso_in',   
                'paralelo',
                //'especialidad',
                [
                    'attribute'=>'zona',
                    'content'=>function($model){
                        return ($model->zona=='R') ? "Rural":"Urbana";
                    },
                    'filter' => array("R"=>"Rural","U"=>"Urbana")
                ],
                [
                    'attribute'=>'repetidor',
                    'content'=>function($model){
                        return ($model->zona=='S') ? "Si":"No";
                    },
                    'filter' => array("S"=>"Si","N"=>"No")

                ],
                

                [
                    'class' => 'yii\grid\ActionColumn',
                    //'template'=>'{view}{update}{delete}{anadir}{revisar}',
                    'template'=>'{editar} {eliminar}',
                    'buttons'=>[
                        'editar'=>function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', \Yii::$app->getUrlManager()->createUrl('aspecto-academico/update')."&id=".$model->id_asp_acad_esp,['title'=>'Editar']);
                        },
                        'eliminar'=>function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', \Yii::$app->getUrlManager()->createUrl('aspecto-academico/delete')."&id=".$model->id_asp_acad_esp, [
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
