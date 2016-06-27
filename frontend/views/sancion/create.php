<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Sancion */

$this->title = 'Nueva Sanción';
$this->params['breadcrumbs'][] = ['label' => 'Sancions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sancion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
