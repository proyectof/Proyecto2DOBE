<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "opcion".
 *
 * @property integer $id_opcion
 * @property integer $id_pregunta
 * @property string $opcion
 *
 * @property Pregunta $idPregunta
 */
class Opcion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opcion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pregunta', 'opcion'], 'required'],
            [['id_pregunta'], 'integer'],
            [['opcion'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_opcion' => 'Id Opcion',
            'id_pregunta' => 'Id Pregunta',
            'opcion' => 'Opcion',
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
