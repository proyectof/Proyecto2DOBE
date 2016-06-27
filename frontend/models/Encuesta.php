<?php

namespace frontend\models;

use Yii;

use frontend\models\Seccion;
use frontend\models\Pregunta;
use frontend\models\Opcion;
use frontend\models\RespuestaOpcion;
use frontend\models\RespuestaAbierta;


/**
 * This is the model class for table "encuesta".
 *
 * @property integer $id_encuesta
 * @property string $nombre
 * @property string $fecha
 * @property string $hora
 *
 * @property FichaEncuesta[] $fichaEncuestas
 * @property GuiaEvaluacion[] $guiaEvaluacions
 * @property Respuesta[] $respuestas
 * @property Seccion[] $seccions
 */
class Encuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'encuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'hora'], 'required'],
            [['fecha', 'hora'], 'safe'],
            [['nombre'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_encuesta' => 'Id Encuesta',
            'nombre' => 'Nombre',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
        ];
    }

    public function generarEncuesta($modelRespuesta){
        
        $querySeccion = seccion::findAll(['id_encuesta' => $this->id_encuesta]);

        foreach ($querySeccion as $seccion) {

            echo "<h3 class='col-sm-offset-1 col-sm-11'>".$seccion["nombre"]."</h3><br><br>";
            $queryPregunta = pregunta::findAll(['id_seccion' => $seccion["id_seccion"]]);
            $contPregunta =1;

            foreach ($queryPregunta as $pregunta) {

                echo "<p class='col-sm-offset-2 col-sm-10'>".$contPregunta++.". ".$pregunta["enunciado"]."</p>";
                $queryOpcion = opcion::findAll(['id_pregunta' => $pregunta["id_pregunta"]]);
                $cont=1;
                $porque="";
                foreach ($queryOpcion as $opcion) {

                    //colocar las respuestas llenadas anteriormente en caso de haberlas */
                    $isChecked="";
                    if($modelRespuesta!=NULL){
                        $modelRespuestaOpcion=RespuestaOpcion::findOne(['id_respuesta'=>$modelRespuesta->id_respuesta,'id_pregunta'=>$pregunta["id_pregunta"],'id_opcion'=>$opcion["id_opcion"]]);
                        if($modelRespuestaOpcion!=NULL){
                            $isChecked="checked";
                            $porque=$modelRespuestaOpcion->porque;
                        }
                    }
                    /*******************************************************************/

                    echo "<div class='col-xs-offset-3 col-xs-9'>";
                        if($pregunta["tipo"]=="RS"){
                            echo '<div><label><input '.$isChecked.' type="radio"  name="'.$pregunta['id_pregunta'].'[1]" value="'.$opcion["id_opcion"].'">  '.$opcion["opcion"]."</label></div>";
                        }elseif($pregunta["tipo"]=="RM"){
                            echo '<div><label><input '.$isChecked.' type="checkbox"  name="'.$pregunta['id_pregunta'].'['.$cont++.']" value="'.$opcion["id_opcion"].'">  '.$opcion["opcion"]."</label></div>";
                        }
                    echo "</div>";
                }

                if($pregunta["tipo"]=="RA"){

                    //colocar las respuestas llenadas anteriormente en caso de haberlas */
                    $respuesta="";
                    if($modelRespuesta!=NULL){
                        $modelRespuestaOpcion=RespuestaAbierta::findOne(['id_respuesta'=>$modelRespuesta->id_respuesta,'id_pregunta'=>$pregunta["id_pregunta"]]);
                        if($modelRespuestaOpcion!=NULL){
                            $respuesta=$modelRespuestaOpcion->respuesta;
                        }
                    }
                    /*******************************************************************/

                    echo "<div class='col-sm-offset-3 col-sm-9'>";
                        echo '<textarea class="form-control" rows="4" name="'.$pregunta['id_pregunta'].'[1]" >'.$respuesta.'</textarea><br><br>';
                    echo "</div>";
                }elseif($this->id_encuesta!=3){// si no es RA entonces agrega la opcion xq?
                    echo "<div class='col-sm-offset-3 col-sm-9'>";
                        echo "<div class='form-group'>";
                            echo "<label>Porque ?</label>";
                            echo '<input type="text" class="form-control" value="'.$porque.'" name="'.$pregunta['id_pregunta'].'[0]" />';
                        echo "</div>";
                    echo "</div>";
                }
                echo "<br><br><hr>";

            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichaEncuestas()
    {
        return $this->hasMany(FichaEncuesta::className(), ['id_encuesta' => 'id_encuesta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuiaEvaluacions()
    {
        return $this->hasMany(GuiaEvaluacion::className(), ['id_encuesta' => 'id_encuesta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['id_encuesta' => 'id_encuesta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccions()
    {
        return $this->hasMany(Seccion::className(), ['id_encuesta' => 'id_encuesta']);
    }
}
