<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\AspectoAcademico */

$this->title = $model->id_asp_acad_esp;
$this->params['breadcrumbs'][] = ['label' => 'Aspecto Academicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aspecto-academico-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_asp_acad_esp], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_asp_acad_esp], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_asp_acad_esp',
            'id_ficha',
            'curso_in',
            'num_matricula',
            'paralelo',
            'especialidad',
            'zona',
            'repetidor',
        ],
    ]) ?>

</div>
