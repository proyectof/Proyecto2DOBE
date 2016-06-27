<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use frontend\models\Alumno;
use frontend\models\AspectoAcademico;
use frontend\models\ReferenciaFamiliar;
use frontend\models\ReferenciaEconomica;
use frontend\models\Citacion;
use frontend\models\Sancion;
use frontend\models\FichaEncuesta;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ficha */

$this->title = "Vista de Impresión";
?>
<div class="ficha-view">

    <center><h1 class='hidden-print'><?= Html::encode($this->title) ?></h1></center>

    <!-- div para imprimir ficha -->
    <div class="col-md-12">
        <center >
            <h3 class='visible-print'>Unidad Educativa Fiscomisional<br> Tecnica Deportiva <br> "San Daniel Comboni" <br> Esmeraldas - Ecuador</h3>
            <br><br>
        </center>
        <?php
            echo "<h2>Datos del Alumno</h2><br>";
            echo DetailView::widget([
                'model' => Alumno::findOne(['id_ficha'=>$model->id_ficha]),
                'attributes' => [
                    //'id_alumno',
                    //'id_ficha',
                    'cedula',
                    'apellido_paterno',
                    'apellido_materno',
                    'nombre',
                    'lugar_nacimiento',
                    'fecha_nacimiento',
                    'domicilio',
                    'establecimiento_proviene',
                    'promedio',
                    'conducta',
                    'telefono_celular',
                    'telefono_convencional',
                    'representante',
                    'email',
                    //''
                ],
            ]);
            echo "<hr>";
        ?>
        <!-- nueva seccion  -->
        <h2>Aspectos Academicos</h2><br>
        <table class="table">
            <thead>
                <th>Curso</th>
                <th># Matricula</th>
                <th>Paralelo</th>
                <th>Especialidad</th>
                <th>Zona</th>
                <th>Repetidor</th>
            </thead>
            <tbody>
                <?php
                    $data= AspectoAcademico::findAll(['id_ficha'=>$model->id_ficha]);
                    foreach ($data as $aspectoAcademico) {
                        echo "<tr>";
                            echo "<td>".$aspectoAcademico["curso_in"]."</td>";
                            echo "<td>".$aspectoAcademico["num_matricula"]."</td>";
                            echo "<td>".$aspectoAcademico["paralelo"]."</td>";
                            echo "<td>".$aspectoAcademico["especialidad"]."</td>";
                            echo "<td>".(($aspectoAcademico["zona"]=='R') ? "Rural":"Urbana")."</td>";
                            echo "<td>".(($aspectoAcademico["repetidor"]=='S') ? "Si":"No")."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <hr>
        <!-- nueva seccion  -->
        <h2>Referencia Familiar</h2><br>
        <table class="table">
            <thead>
                <th>Parentesco</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Telefono</th>
            </thead>
            <tbody>
                <?php
                    $data= ReferenciaFamiliar::findAll(['id_ficha'=>$model->id_ficha]);
                    foreach ($data as $referenciaFamiliar) {
                        echo "<tr>";
                            echo "<td>".$referenciaFamiliar["parentesco"]."</td>";
                            echo "<td>".$referenciaFamiliar["nombres"]."</td>";
                            echo "<td>".$referenciaFamiliar["apellidos"]."</td>";
                            echo "<td>".$referenciaFamiliar["cedula"]."</td>";
                            echo "<td>".$referenciaFamiliar["telefono_celular"]."</td>";
                            echo "<td>".$referenciaFamiliar["telefono_convencional"]."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <hr>

        <!-- nueva seccion  -->
        <h2>Referencia Económica</h2><br>
        <table class="table">
            <thead>
                <th>Nombre del Familiar</th>
                <th>Trabaja ?</th>
                <th>Grado de estudio</th>
                <th>Ocupación</th>
                <th>Dirección de trabajo</th>
                <th>Estado civil</th>
                <th>Edad</th>
            </thead>
            <tbody>
                <?php
                    $data= ReferenciaEconomica::find()->where(['id_ficha'=>$model->id_ficha])->all();
                    foreach ($data as $referenciaEconomica) {
                        echo "<tr>";
                            echo "<td>".$referenciaEconomica->idReferenciaFamiliar->nombres." ".$referenciaEconomica->idReferenciaFamiliar->apellidos."</td>";
                            echo "<td>".$referenciaEconomica->trabaja."</td>";
                            echo "<td>".$referenciaEconomica->grado_estudio."</td>";
                            echo "<td>".$referenciaEconomica->ocupacion."</td>";
                            echo "<td>".$referenciaEconomica->direccion_trabajo."</td>";
                            echo "<td>".$referenciaEconomica->estado_civil."</td>";
                            echo "<td>".$referenciaEconomica->edad."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <hr>
        <!-- nueva seccion  -->
        <h2>Citaciones</h2><br>
        <table class="table">
            <thead>
                <th>Fecha</th>
                <th>Curso</th>
                <th>Paralelo</th>
                <th>Causa</th>
                <th>Descripción</th>
                <th>Observación</th>
            </thead>
            <tbody>
                <?php
                    $data= Citacion::findAll(['id_ficha'=>$model->id_ficha]);
                    foreach ($data as $citacion) {
                        echo "<tr>";
                            echo "<td>".$citacion["fecha"]."</td>";
                            echo "<td>".$citacion["curso"]."</td>";
                            echo "<td>".$citacion["paralelo"]."</td>";
                            echo "<td>".$citacion["causa"]."</td>";
                            echo "<td>".$citacion["descripcion"]."</td>";
                            echo "<td>".$citacion["observacion"]."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <hr>
        <!-- nueva seccion  -->
        <h2>Sanciones</h2><br>
        <table class="table">
            <thead>
                <th>Fecha</th>
                <th>Causa</th>
                <th>Descripción</th>
                <th>Observación</th>
                <th>Sanción desde</th>
                <th>Sanción hasta</th>
            </thead>
            <tbody>
                <?php
                    $data= Sancion::findAll(['id_ficha'=>$model->id_ficha]);
                    foreach ($data as $sancion) {
                        echo "<tr>";
                            echo "<td>".$sancion["fecha"]."</td>";
                            echo "<td>".$sancion["causa"]."</td>";
                            echo "<td>".$sancion["descripcion"]."</td>";
                            echo "<td>".$sancion["observacion"]."</td>";
                            echo "<td>".$sancion["fecha_desde"]."</td>";
                            echo "<td>".$sancion["fecha_hasta"]."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <hr>
        <h2>Encuesta</h2><br>

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
        <h4>Preguntas de Opción Múltiple</h4>
        <table class="table">
            <thead>
                <th>Enunciado</th>
                <th>Respuesta</th>
                <th>Porqué ?</th>
            </thead>
            <tbody>
                <?php
                    $modelFichaEncuesta= FichaEncuesta::findOne(['id_ficha'=>$model->id_ficha]);    
                    $query = new \yii\db\Query();
                    $query->select("pregunta.enunciado, opcion.opcion,respuesta_opcion.porque")
                          ->from ("(((respuesta inner join respuesta_opcion on respuesta.id_respuesta=respuesta_opcion.id_respuesta) 
                            inner join pregunta on pregunta.id_pregunta=respuesta_opcion.id_pregunta))
                            inner join opcion on opcion.id_opcion=respuesta_opcion.id_opcion")
                          ->where([
                            "respuesta.id_encuesta"=>$modelFichaEncuesta->id_encuesta,
                            'respuesta.id_ref'=>$modelFichaEncuesta->id_ficha_encuesta,
                            'respuesta.id_tbl'=>'FE',
                          ]);
                    $data= $query->createCommand()->queryAll();

                    foreach ($data as $encuesta) {
                        echo "<tr>";
                            echo "<td>".$encuesta["enunciado"]."</td>";
                            echo "<td>".$encuesta["opcion"]."</td>";
                            echo "<td>".$encuesta["porque"]."</td>";
                        echo "</tr>";
                    }
                    
                ?>
            </tbody>
        </table>
        <h4>Preguntas Abiertas</h4>
        <table class="table">
            <thead>
                <th>Enunciado</th>
                <th>Respuesta</th>
            </thead>
            <tbody>
                <?php
                    $query->select("pregunta.enunciado, respuesta_abierta.respuesta as opcion")
                          ->from ("(((respuesta inner join respuesta_abierta on respuesta.id_respuesta=respuesta_abierta.id_respuesta) 
                                    inner join pregunta on pregunta.id_pregunta=respuesta_abierta.id_pregunta))")
                          ->where([
                            "respuesta.id_encuesta"=>$modelFichaEncuesta->id_encuesta,
                            'respuesta.id_ref'=>$modelFichaEncuesta->id_ficha_encuesta,
                            'respuesta.id_tbl'=>'FE',
                          ]);
                    $dataAbiertas = $query->createCommand()->queryAll();

                    foreach ($dataAbiertas as $encuesta) {
                        echo "<tr>";
                            echo "<td>".$encuesta["enunciado"]."</td>";
                            echo "<td>".$encuesta["opcion"]."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

</div>
