<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sancion".
 *
 * @property integer $id_sancion
 * @property integer $id_ficha
 * @property string $fecha
 * @property string $causa
 * @property string $descripcion
 * @property string $observacion
 * @property string $fecha_desde
 * @property string $fecha_hasta
 *
 * @property Ficha $idFicha
 */
class Sancion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sancion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ficha', 'fecha', 'causa', 'descripcion', 'observacion', 'fecha_desde', 'fecha_hasta'], 'required'],
            [['id_ficha'], 'integer'],
            //[['fecha', 'fecha_desde', 'fecha_hasta'], 'date','format'=>'Y-M-dd'],
            [['fecha', 'fecha_desde', 'fecha_hasta'], 'safe'],
            [['descripcion', 'observacion'], 'string'],
            [['causa'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sancion' => 'Id Citacion',
            'id_ficha' => 'Id Ficha',
            'fecha' => 'Fecha',
            'causa' => 'Causa',
            'descripcion' => 'Descripcion',
            'observacion' => 'Observación',
            'fecha_desde' => 'Sanción desde',
            'fecha_hasta' => 'Sanción hasta',
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
