<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ficha".
 *
 * @property integer $id_ficha
 * @property string $fecha_creacion
 * @property string $hora_creacion
 *
 * @property Alumno[] $alumnos
 * @property AspAcadEsp[] $aspAcadEsps
 * @property Citacion[] $citacions
 * @property ReferenciaFamiliar[] $referenciaFamiliars
 * @property Sancion[] $sancions
 */
class Ficha extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $nombre_completo;

    public static function tableName()
    {
        return 'ficha';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_creacion', 'hora_creacion'], 'required'],
            [['fecha_creacion', 'hora_creacion'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ficha' => '# de Ficha',
            'fecha_creacion' => 'Fecha de Creación',
            'hora_creacion' => 'Hora de Creación',
            'nombre_completo'=> 'Apellidos y Nombres',
            'idAlumno.cedula'=> 'Cedula'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumno::className(), ['id_ficha' => 'id_ficha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAspAcadEsps()
    {
        return $this->hasMany(AspAcadEsp::className(), ['id_ficha' => 'id_ficha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitacions()
    {
        return $this->hasMany(Citacion::className(), ['id_ficha' => 'id_ficha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferenciaFamiliars()
    {
        return $this->hasMany(ReferenciaFamiliar::className(), ['id_ficha' => 'id_ficha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSancions()
    {
        return $this->hasMany(Sancion::className(), ['id_ficha' => 'id_ficha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlumno()
    {
        return $this->hasOne(Alumno::className(), ['id_ficha' => 'id_ficha']);
    }
}
