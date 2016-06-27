<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "respuesta_opcion".
 *
 * @property integer $id_respuesta_opcion
 * @property integer $id_pregunta
 * @property integer $id_opcion
 * @property string $porque
 * @property integer $id_respuesta
 *
 * @property Respuesta $idRespuesta
 * @property Pregunta $idPregunta
 */
class RespuestaOpcion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respuesta_opcion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pregunta', 'id_opcion', 'id_respuesta'], 'required'],
            [['id_pregunta', 'id_respuesta'], 'integer'],
            [['porque'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_respuesta_opcion' => 'Id Respuesta Opcion',
            'id_pregunta' => 'Id Pregunta',
            'id_opcion' => 'Id Opcion',
            'porque' => 'Porque',
            'id_respuesta' => 'Id Respuesta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRespuesta()
    {
        return $this->hasOne(Respuesta::className(), ['id_respuesta' => 'id_respuesta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPregunta()
    {
        return $this->hasOne(Pregunta::className(), ['id_pregunta' => 'id_pregunta']);
    }
}
