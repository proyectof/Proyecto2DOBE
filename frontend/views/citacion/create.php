<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Citacion */

$this->title = 'Nueva Citación';
$this->params['breadcrumbs'][] = ['label' => 'Citacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="citacion-create">

    <h1><?= Html::encode($this->title) ?></h1>
	<hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
