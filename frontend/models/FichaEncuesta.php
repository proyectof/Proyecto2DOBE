<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ficha_encuesta".
 *
 * @property integer $id_ficha_encuesta
 * @property integer $id_encuesta
 * @property integer $id_ficha
 *
 * @property Ficha $idFicha
 * @property Encuesta $idEncuesta
 */
class FichaEncuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ficha_encuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_encuesta', 'id_ficha'], 'required'],
            [['id_encuesta', 'id_ficha'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ficha_encuesta' => 'Id Ficha Encuesta',
            'id_encuesta' => 'Id Encuesta',
            'id_ficha' => 'Id Ficha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFicha()
    {
        return $this->hasOne(Ficha::className(), ['id_ficha' => 'id_ficha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEncuesta()
    {
        return $this->hasOne(Encuesta::className(), ['id_encuesta' => 'id_encuesta']);
    }
}
