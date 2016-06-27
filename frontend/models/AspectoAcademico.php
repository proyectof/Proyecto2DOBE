<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "asp_acad_esp".
 *
 * @property integer $id_asp_acad_esp
 * @property integer $id_ficha
 * @property string $curso_in
 * @property integer $num_matricula
 * @property string $paralelo
 * @property string $especialidad
 * @property string $zona
 * @property string $repetidor
 *
 * @property Ficha $idFicha
 */
class AspectoAcademico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    

    public static function tableName()
    {
        return 'asp_acad_esp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ficha', 'curso_in', 'num_matricula', 'paralelo', 'especialidad', 'zona', 'repetidor'], 'required'],
            [['id_ficha', 'num_matricula'], 'integer'],
            [['num_matricula'], 'number'],
            [['curso_in'], 'string', 'max' => 100],
            [['paralelo', 'zona', 'repetidor'], 'string', 'max' => 1],
            [['especialidad'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_asp_acad_esp' => 'Id Asp Acad Esp',
            'id_ficha' => 'Id Ficha',
            'curso_in' => 'Curso',
            'num_matricula' => '# de Matricula',
            'paralelo' => 'Paralelo',
            'especialidad' => 'Especialidad',
            'zona' => 'Zona',
            'repetidor' => 'Repetidor ?',
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
