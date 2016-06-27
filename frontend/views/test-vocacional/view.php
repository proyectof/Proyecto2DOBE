<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\GuiaEvaluacion */

$this->title = "Test Vocacional #". $model->id_test_vocacional."( ".$model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre." )";
$this->params['breadcrumbs'][] = ['label' => 'Guia Evaluacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-evaluacion-view">

    <center >
        <h3 class='visible-print'>Unidad Educativa Fiscomisional<br> Tecnica Deportiva <br> "San Daniel Comboni" <br> Esmeraldas - Ecuador</h3>
        <br><br>
    </center>
    <h1>
        <?= Html::encode($this->title) ?>  
        <?= Html::a("<span class='glyphicon glyphicon-print'></span> Imprimir", "#", ['class' => 'btn btn-primary hidden-print','onClick'=>'window.print()']) ?>
        <?= Html::a("Volver a Inicio", \Yii::$app->getUrlManager()->createUrl('test-vocacional/index'), ['class' => 'btn btn-info hidden-print']) ?>
    </h1 >
    <hr>

       <!--  select pregunta.enunciado, opcion.opcion, respuesta_opcion.porque
            from 
                (((respuesta inner join respuesta_opcion on respuesta.id_respuesta=respuesta_opcion.id_respuesta) 
                inner join pregunta on pregunta.id_pregunta=respuesta_opcion.id_pregunta))
                inner join opcion on opcion.id_opcion=respuesta_opcion.id_opcion
            where
                respuesta.id_encuesta=1 and 
                respuesta.id_ref=1 and 
                respuesta.id_tbl="FE"
            
            UNION
            
            select pregunta.enunciado, respuesta_abierta.respuesta as opcion, " " as porque
            from 
                (((respuesta inner join respuesta_abierta on respuesta.id_respuesta=respuesta_abierta.id_respuesta) 
                inner join pregunta on pregunta.id_pregunta=respuesta_abierta.id_pregunta))
            where
                respuesta.id_encuesta=1 and 
                respuesta.id_ref=1 and 
                respuesta.id_tbl="FE"
 -->
        <table class="table">
            <thead>
                <th>Enunciado</th>
                <th>Respuesta</th>
            </thead>
            <tbody>
                <?php  
                    $query = new \yii\db\Query();
                    $query->select("pregunta.enunciado, opcion.opcion")
                          ->from ("(((respuesta inner join respuesta_opcion on respuesta.id_respuesta=respuesta_opcion.id_respuesta) 
                            inner join pregunta on pregunta.id_pregunta=respuesta_opcion.id_pregunta))
                            inner join opcion on opcion.id_opcion=respuesta_opcion.id_opcion")
                          ->where([
                            "respuesta.id_encuesta"=>$model->id_encuesta,
                            'respuesta.id_ref'=>$model->id_test_vocacional,
                            'respuesta.id_tbl'=>'TV',
                          ]);
                    $data= $query->createCommand()->queryAll();

                    foreach ($data as $encuesta) {
                        if($encuesta["opcion"]=="Me Interesa"){
                            echo "<tr class='success'>";
                        }else{
                            echo "<tr>";
                        }
                        
                            echo "<td>".$encuesta["enunciado"]."</td>";
                            echo "<td>".$encuesta["opcion"]."</td>";
                        echo "</tr>";
                    }
                    
                ?>
            </tbody>
        </table>
</div>
