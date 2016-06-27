<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "guia_atencion".
 *
 * @property integer $id_guia_atencion
 * @property integer $id_alumno
 * @property string $curso
 * @property string $paralelo
 * @property string $fecha
 * @property string $asunto
 * @property string $proceso
 * @property string $diagnostico
 * @property string $nueva_cita
 * @property string $evaluacion_atencion
 * @property string $conclusion
 * @property integer $id_referencia_familiar
 *
 * @property ReferenciaFamiliar $idReferenciaFamiliar
 * @property Alumno $idAlumno
 */
class GuiaAtencion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $aux;

    public static function tableName()
    {
        return 'guia_atencion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_alumno', 'curso', 'paralelo', 'fecha', 'asunto', 'proceso', 'diagnostico', 'nueva_cita', 'evaluacion_atencion', 'id_referencia_familiar'], 'required'],
            [['id_alumno', 'id_referencia_familiar'], 'integer'],
            [['fecha', 'nueva_cita'], 'safe'],
            [['asunto', 'proceso', 'diagnostico', 'conclusion'], 'string'],
            [['curso'], 'string', 'max' => 50],
            [['paralelo'], 'string', 'max' => 1],
            [['evaluacion_atencion'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_guia_atencion' => 'Id Guia Atencion',
            'id_alumno' => 'Nombre del Alumno',
            'curso' => 'Curso',
            'paralelo' => 'Paralelo',
            'fecha' => 'Fecha',
            'asunto' => 'Asunto',
            'proceso' => 'Proceso',
            'diagnostico' => 'Diagnostico',
            'nueva_cita' => 'Nueva Cita',
            'evaluacion_atencion' => 'Evaluacion Atencion',
            'conclusion' => 'Conclusion',
            'id_referencia_familiar' => 'Nombre del Familiar',
            'aux'=>'Nombre del Alumno'
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
    public function getIdAlumno()
    {
        return $this->hasOne(Alumno::className(), ['id_alumno' => 'id_alumno']);
    }
}
