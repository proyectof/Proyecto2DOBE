<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\GuiaEvaluacion */

$this->title = 'Nueva Guía de Evaluación';
$this->params['breadcrumbs'][] = ['label' => 'Guia Evaluacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-evaluacion-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
