<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "citacion".
 *
 * @property integer $id_citacion
 * @property integer $id_ficha
 * @property integer $fecha
 * @property string $curso
 * @property string $paralelo
 * @property string $causa
 * @property string $descripcion
 * @property string $observacion
 *
 * @property Ficha $idFicha
 */
class Citacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'citacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ficha', 'fecha', 'curso', 'paralelo', 'causa'], 'required'],
            [['id_ficha'], 'integer'],
            //[['fecha'], 'date','format'=>'Y-M-dd'],
            [['descripcion', 'observacion'], 'string'],
            [['curso'], 'string', 'max' => 100],
            [['paralelo', 'causa'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_citacion' => 'Id Citacion',
            'id_ficha' => 'Id Ficha',
            'fecha' => 'Fecha',
            'curso' => 'Curso',
            'paralelo' => 'Paralelo',
            'causa' => 'Causa',
            'descripcion' => 'Descripción',
            'observacion' => 'Observación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFicha()
    {
        return $this->hasOne(Ficha::className(), ['id_ficha' => 'id_ficha']);
    }
}
