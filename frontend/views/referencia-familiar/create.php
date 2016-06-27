<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ReferenciaFamiliar */

$this->title = 'Nueva Referencia Familiar';
$this->params['breadcrumbs'][] = ['label' => 'Referencia Familiars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencia-familiar-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
