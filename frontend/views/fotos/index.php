<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Fotos;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fotos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotos-index">
    <br>
    <center>
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    
        <div class="datos-personales-create">
            <?php 
                $modelFoto=new Fotos;
                $modelFoto->id_ficha=$idFicha;
            ?>
            <?= $this->render('_form', [
                'model' => $modelFoto,
            ]) ?>

        </div>
    <hr>
    </center>
    <br>

    <div class="row">
        <?php
            foreach (Fotos::find()->where(['id_ficha'=>$idFicha])->all() as $foto) {
                echo '<div class="col-sm-2">';
                echo '    <img src="img/fotos/'.$foto->id_foto.$foto->nombre.'" width="100%">';
                echo '    <center>'.$foto->fecha.'</center>';
                echo '<center>';
                echo Html::a('Eliminar foto', ['fotos/delete', 'id' => $foto->id_foto], [
                    'class' => 'btn btn-danger btn-xs',
                    'data' => [
                        'confirm' => 'Deseas elminar esta foto?',
                        'method' => 'post',
                    ],
                ]);
                echo '</center>';
                echo '</div>';
            }
        ?>
    </div>

</div>
