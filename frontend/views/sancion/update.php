<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Sancion */

$this->title = 'Editar Sanción';
$this->params['breadcrumbs'][] = ['label' => 'Sancions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sancion, 'url' => ['view', 'id' => $model->id_sancion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sancion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
