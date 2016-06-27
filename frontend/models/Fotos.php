<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "fotos".
 *
 * @property integer $id_foto
 * @property integer $id_ficha
 * @property string $fecha
 * @property string $nombre
 *
 * @property Ficha $idFicha
 */
class Fotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fotos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'fecha', 'nombre'], 'required'],
            [['id_foto', 'id_ficha'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_foto' => 'Id Foto',
            'id_ficha' => 'Id Ficha',
            'fecha' => 'Fecha',
            'nombre' => 'Nombre',
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
