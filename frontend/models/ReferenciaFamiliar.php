<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "referencia_familiar".
 *
 * @property integer $id_referencia_familiar
 * @property integer $id_ficha
 * @property string $parentesco
 * @property string $nombres
 * @property string $apellidos
 * @property string $cedula
 * @property string $telefono
 *
 * @property Ficha $idFicha
 */
class ReferenciaFamiliar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referencia_familiar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ficha', 'parentesco', 'nombres', 'apellidos', 'cedula'], 'required'],
            [['id_ficha'], 'integer'],
            [['cedula','telefono_celular','telefono_convencional'], 'number'],
            [['parentesco'], 'string', 'max' => 50],
            [['nombres', 'apellidos'], 'string', 'max' => 100],
            [['cedula'], 'string', 'max' => 10],
            ['cedula','validateTel']
        ];
    }

    public function validateTel($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (trim($this->telefono_celular)=="" and trim($this->telefono_convencional)=="") {
                $this->addError("telefono_convencional", 'Debe ingresar al menos un numero de telefono.');
                $this->addError("telefono_celular", '');
            }
             
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_referencia_familiar' => 'Id Referencia Familiar',
            'id_ficha' => 'Id Ficha',
            'parentesco' => 'Parentesco',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'cedula' => 'Cédula',
            'telefono_celular' => 'Teléfono Celular',
            'telefono_convencional' => 'Teléfono Convencional',
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
