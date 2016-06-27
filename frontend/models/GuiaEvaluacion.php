<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "guia_evaluacion".
 *
 * @property integer $id_guia_evaluacion
 * @property integer $id_encuesta
 * @property string $fecha
 * @property string $hora
 * @property integer $id_alumno
 * @property integer $id_referencia_familiar
 *
 * @property ReferenciaFamiliar $idReferenciaFamiliar
 * @property Encuesta $idEncuesta
 * @property Alumno $idAlumno
 */
class GuiaEvaluacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $aux;

    public static function tableName()
    {
        return 'guia_evaluacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_encuesta', 'fecha', 'hora', 'id_alumno', 'id_referencia_familiar'], 'required'],
            [['id_encuesta', 'id_alumno', 'id_referencia_familiar'], 'integer'],
            [['fecha', 'hora'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_guia_evaluacion' => 'Id Guia Evaluacion',
            'id_encuesta' => 'Id Encuesta',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'id_alumno' => 'Nombre del Alumno',
            'id_referencia_familiar' => 'Nombre del Familiar',
            'aux'=>'Nombre del Alumno'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdReferenciaFamiliar()
    {
        return $this->hasOne(ReferenciaFamiliar::className(), ['id_referencia_familiar' => 'id_referencia_familiar']);
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
    public function getIdAlumno()
    {
        return $this->hasOne(Alumno::className(), ['id_alumno' => 'id_alumno']);
    }
}
