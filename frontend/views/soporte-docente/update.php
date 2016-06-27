<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SoporteDocente */

$this->title = 'Editar Soporte Docente';
$this->params['breadcrumbs'][] = ['label' => 'Soporte Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_soporte_docente, 'url' => ['view', 'id' => $model->id_soporte_docente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soporte-docente-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
