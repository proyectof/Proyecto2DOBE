<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "referencia_economica".
 *
 * @property integer $id_referencia_economica
 * @property integer $trabaja
 * @property string $grado_estudio
 * @property string $ocupacion
 * @property string $direccion_trabajo
 * @property string $estado_civil
 * @property integer $edad
 * @property integer $id_referencia_familiar
 * @property integer $id_ficha
 *
 * @property ReferenciaFamiliar $idReferenciaFamiliar
 * @property Ficha $idFicha
 */
class ReferenciaEconomica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referencia_economica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trabaja', 'grado_estudio', 'ocupacion', 'estado_civil', 'edad', 'id_referencia_familiar'], 'required'],
            [['edad', 'id_referencia_familiar'], 'integer'],
            [['grado_estudio', 'ocupacion', 'estado_civil'], 'string', 'max' => 100],
            [['direccion_trabajo'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_referencia_economica' => 'Referencia Economica',
            'trabaja' => 'Trabaja',
            'grado_estudio' => 'Grado Estudio',
            'ocupacion' => 'Ocupacion',
            'direccion_trabajo' => 'Direccion Trabajo',
            'estado_civil' => 'Estado Civil',
            'edad' => 'Edad',
            'id_referencia_familiar' => 'Referencia Familiar',
            'id_ficha' => 'Id Ficha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdReferenciaFamiliar()
    {
        return $this->hasOne(ReferenciaFamiliar::className(), ['id_referencia_familiar' => 'id_referencia_familiar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFicha()
    {
        return $this->hasOne(Ficha::className(), ['id_ficha' => 'id_ficha']);
    }
}
