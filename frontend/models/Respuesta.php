<?php

namespace frontend\models;

use Yii;
use frontend\models\RespuestaOpcion;
use frontend\models\RespuestaAbierta;

/**
 * This is the model class for table "respuesta".
 *
 * @property integer $id_respuesta
 * @property integer $id_encuesta
 * @property integer $id_ref
 * @property string $id_tbl
 * @property string $fecha
 * @property string $hora
 *
 * @property Encuesta $idEncuesta
 * @property RespuestaOpcion[] $respuestaOpcions
 */
class Respuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_encuesta', 'id_ref', 'id_tbl', 'fecha', 'hora'], 'required'],
            [['id_encuesta', 'id_ref'], 'integer'],
            [['fecha', 'hora'], 'safe'],
            [['id_tbl'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_respuesta' => 'Id Respuesta',
            'id_encuesta' => 'Id Encuesta',
            'id_ref' => 'Id Ref',
            'id_tbl' => 'Id Tbl',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
        ];
    }

    public function guardarRespuestaSimple($pregunta){

        $modelRespuestaOpcion= RespuestaOpcion::findOne(['id_respuesta'=>$this->id_respuesta,'id_pregunta'=>$pregunta['id_pregunta']]);
        $modelRespuestaOpcion= ($modelRespuestaOpcion==NULL) ? new RespuestaOpcion : $modelRespuestaOpcion;

        $modelRespuestaOpcion->id_respuesta=$this->id_respuesta;
        $modelRespuestaOpcion->id_pregunta=$pregunta['id_pregunta'];
        $modelRespuestaOpcion->id_opcion=$_POST[$pregunta['id_pregunta']][1];;
        $modelRespuestaOpcion->porque=($this->id_encuesta==3)? " " : $_POST[$pregunta['id_pregunta']][0];
        $modelRespuestaOpcion->save();
    }

    public function guardarRespuestaMultiple($pregunta){
         $delete = new \yii\db\Query();
         $delete->createCommand()->delete('respuesta_opcion', ['id_respuesta'=>$this->id_respuesta,'id_pregunta'=>$pregunta['id_pregunta']])->execute(); 
         
         foreach ($_POST[$pregunta['id_pregunta']] as $respuesta) {
            if($respuesta!=$_POST[$pregunta['id_pregunta']][0]){

                $modelRespuestaOpcion= new RespuestaOpcion;
                $modelRespuestaOpcion->id_respuesta=$this->id_respuesta;
                $modelRespuestaOpcion->id_pregunta=$pregunta['id_pregunta'];
                $modelRespuestaOpcion->id_opcion=$respuesta;
                $modelRespuestaOpcion->porque=$_POST[$pregunta['id_pregunta']][0];
                $modelRespuestaOpcion->save();

            }
         }
    }

    public function guardarRespuestaAbierta($pregunta){
         $modelRespuestaAbierta= RespuestaAbierta::findOne(['id_respuesta'=>$this->id_respuesta,'id_pregunta'=>$pregunta['id_pregunta']]);
         $modelRespuestaAbierta= ($modelRespuestaAbierta==NULL) ? new RespuestaAbierta : $modelRespuestaAbierta;

         $modelRespuestaAbierta->id_respuesta=$this->id_respuesta;
         $modelRespuestaAbierta->id_pregunta=$pregunta['id_pregunta'];
         $modelRespuestaAbierta->respuesta=$_POST[$pregunta['id_pregunta']][1];
         $modelRespuestaAbierta->save();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEncuesta()
    {
        return $this->hasOne(Encuesta::className(), ['id_encuesta' => 'id_encuesta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestaOpcions()
    {
        return $this->hasMany(RespuestaOpcion::className(), ['id_respuesta' => 'id_respuesta']);
    }
}
