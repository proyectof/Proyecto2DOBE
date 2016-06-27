<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\AspectoAcademico */

$this->title = 'Editar Aspecto Académico';
$this->params['breadcrumbs'][] = ['label' => 'Aspecto Academicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_asp_acad_esp, 'url' => ['view', 'id' => $model->id_asp_acad_esp]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aspecto-academico-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
