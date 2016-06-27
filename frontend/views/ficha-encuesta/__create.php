<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\FichaEncuesta */

$this->title = 'Create Ficha Encuesta';
$this->params['breadcrumbs'][] = ['label' => 'Ficha Encuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-encuesta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
