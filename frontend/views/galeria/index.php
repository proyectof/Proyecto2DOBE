<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\searchs\GaleriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galerias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galeria-index">

    <h1><?= Html::encode($this->title) ?> <?= Html::a('Subir Fotos a la Galeria', ['create'], ['class' => 'btn btn-success']) ?></h1>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_foto',
            'extension',
            'fecha',
            'hora',

            [   
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}'
            ],
        ],
    ]); ?>

</div>
