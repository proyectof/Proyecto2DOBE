<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ficha */

$this->title = 'Nueva Ficha';
$this->params['breadcrumbs'][] = ['label' => 'Fichas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-create">
 <?php
      echo Tabs::widget([
	      'items' => [
	          [
	              'label' => 'Datos del Estudiante',
	              'content' => $this->render('../alumno/_form', ['model' => $modelAlumno]),
	              'active' => true
	          ],
	     ],
	 ]);
 ?>

</div>
