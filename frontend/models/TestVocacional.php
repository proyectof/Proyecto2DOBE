<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "test_vocacional".
 *
 * @property integer $id_test_vocacional
 * @property integer $id_encuesta
 * @property integer $id_alumno
 * @property string $fecha
 * @property string $hora
 *
 * @property Encuesta $idEncuesta
 * @property Alumno $idAlumno
 */
class TestVocacional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $aux;

    public static function tableName()
    {
        return 'test_vocacional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_encuesta', 'id_alumno', 'fecha', 'hora'], 'required'],
            [['id_encuesta', 'id_alumno'], 'integer'],
            [['fecha', 'hora'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_test_vocacional' => 'Id Test Vocacional',
            'id_encuesta' => 'Id Encuesta',
            'id_alumno' => 'Nombre del Alumno',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'aux'=>'Nombre del Alumno'
        ];
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
