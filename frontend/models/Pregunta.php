<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pregunta".
 *
 * @property integer $id_pregunta
 * @property integer $id_seccion
 * @property string $enunciado
 * @property string $tipo
 *
 * @property Opcion[] $opcions
 * @property Seccion $idSeccion
 * @property RespuestaAbierta[] $respuestaAbiertas
 * @property RespuestaOpcion[] $respuestaOpcions
 */
class Pregunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pregunta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_seccion', 'enunciado', 'tipo'], 'required'],
            [['id_seccion'], 'integer'],
            [['enunciado'], 'string'],
            [['tipo'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pregunta' => 'Id Pregunta',
            'id_seccion' => 'Id Seccion',
            'enunciado' => 'Enunciado',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpcions()
    {
        return $this->hasMany(Opcion::className(), ['id_pregunta' => 'id_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSeccion()
    {
        return $this->hasOne(Seccion::className(), ['id_seccion' => 'id_seccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestaAbiertas()
    {
        return $this->hasMany(RespuestaAbierta::className(), ['id_pregunta' => 'id_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestaOpcions()
    {
        return $this->hasMany(RespuestaOpcion::className(), ['id_pregunta' => 'id_pregunta']);
    }
}
