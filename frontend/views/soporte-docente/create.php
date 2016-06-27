<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\SoporteDocente */

$this->title = 'Nuevo Soporte Docente';
$this->params['breadcrumbs'][] = ['label' => 'Soporte Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soporte-docente-create">

    <h1 class="hidden-print"><?= Html::encode($this->title) ?></h1>
    <hr class="hidden-print">
    <br>
    <h5 class="visible-print">Llenar los datos requeridos por favor : </h5>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
