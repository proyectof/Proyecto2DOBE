<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "respuesta_abierta".
 *
 * @property integer $id_respuesta_abierta
 * @property integer $id_pregunta
 * @property string $respuesta
 *
 * @property Pregunta $idPregunta
 */
class RespuestaAbierta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respuesta_abierta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pregunta', 'respuesta'], 'required'],
            [['id_pregunta'], 'integer'],
            [['respuesta'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_respuesta_abierta' => 'Id Respuesta Abierta',
            'id_pregunta' => 'Id Pregunta',
            'respuesta' => 'Respuesta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPregunta()
    {
        return $this->hasOne(Pregunta::className(), ['id_pregunta' => 'id_pregunta']);
    }
}
