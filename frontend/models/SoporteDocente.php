<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "soporte_docente".
 *
 * @property integer $id_soporte_docente
 * @property integer $id_alumno
 * @property string $id_user
 * @property string $asignatura
 * @property string $curso
 * @property string $paralelo
 * @property string $fecha
 * @property string $comportamiento
 * @property string $rendimiento
 * @property string $otro
 * @property string $diagnostico
 *
 * @property Alumno $idAlumno
 */
class SoporteDocente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'soporte_docente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_alumno', 'id_user', 'asignatura', 'curso', 'paralelo', 'fecha', 'diagnostico'], 'required'],
            [['id_soporte_docente', 'id_alumno'], 'integer'],
            [['fecha'], 'safe'],
            [['comportamiento', 'rendimiento', 'otro', 'diagnostico'], 'string'],
            [['asignatura', 'curso'], 'string', 'max' => 50],
            [['paralelo'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_soporte_docente' => 'Id Soporte Docente',
            'id_alumno' => 'Nombre del Estudiante',
            'id_user' => 'Nombre del Docente',
            'asignatura' => 'Asignatura',
            'curso' => 'Curso',
            'paralelo' => 'Paralelo',
            'fecha' => 'Fecha',
            'comportamiento' => 'Comportamiento',
            'rendimiento' => 'Rendimiento',
            'otro' => 'Otro',
            'diagnostico' => 'Diagnóstico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlumno()
    {
        return $this->hasOne(Alumno::className(), ['id_alumno' => 'id_alumno']);
    }
}
