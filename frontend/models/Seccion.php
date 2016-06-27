<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "seccion".
 *
 * @property integer $id_seccion
 * @property integer $id_encuesta
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha
 * @property string $hora
 *
 * @property Pregunta[] $preguntas
 * @property Encuesta $idEncuesta
 */
class Seccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_encuesta', 'nombre', 'fecha', 'hora'], 'required'],
            [['id_encuesta'], 'integer'],
            [['descripcion'], 'string'],
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
            'id_seccion' => 'Id Seccion',
            'id_encuesta' => 'Id Encuesta',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntas()
    {
        return $this->hasMany(Pregunta::className(), ['id_seccion' => 'id_seccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEncuesta()
    {
        return $this->hasOne(Encuesta::className(), ['id_encuesta' => 'id_encuesta']);
    }
}
