<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TestVocacional */

$this->title = 'Nuevo Test Vocacional';
$this->params['breadcrumbs'][] = ['label' => 'Test Vocacionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-vocacional-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
