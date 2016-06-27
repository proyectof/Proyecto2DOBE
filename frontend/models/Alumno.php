<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "alumno".
 *
 * @property integer $id_alumno
 * @property integer $id_ficha
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string $nombre
 * @property string $lugar_nacimiento
 * @property string $fecha_nacimiento
 * @property string $domicilio
 * @property string $establecimiento_proviene
 * @property double $promedio
 * @property double $conducta
 * @property string $telefono_celular
 * @property string $representante
 * @property string $cedula
 * @property string $email
 * @property string $telefono_convencional
 * @property integer $id_user
 *
 * @property Ficha $idFicha
 * @property User $idUser
 * @property GuiaAtencion[] $guiaAtencions
 * @property GuiaEvaluacion[] $guiaEvaluacions
 * @property SoporteDocente[] $soporteDocentes
 * @property TestVocacional[] $testVocacionals
 */
class Alumno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alumno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apellido_paterno','email', 'cedula' , 'apellido_materno', 'nombre', 'lugar_nacimiento', 'fecha_nacimiento', 'domicilio'], 'required'],
            [['id_ficha'], 'integer'],
            ['cedula', 'validateTel'],
            //[['fecha_nacimiento'], 'safe'],
            [['promedio', 'conducta','telefono_celular','telefono_convencional'], 'number'],
            [['apellido_paterno', 'apellido_materno'], 'string', 'max' => 50],
            [['nombre', 'lugar_nacimiento', 'representante'], 'string', 'max' => 100],
            [['domicilio', 'establecimiento_proviene'], 'string', 'max' => 200],
            //[['telefono_celular','telefono_convencional'], 'string', 'max' => 10],
            [['id_ficha','email','cedula'], 'unique'],
            [['email'], 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya ha sido utilizado.','on'=>'create'],
            ['cedula', 'unique', 'targetClass' => '\common\models\User','targetAttribute'=>'username', 'message' => 'Esta cedula ya ha sido utilizada.','on'=>'create'],
            [['promedio', 'conducta'], 'compare','compareValue'=>10,'operator'=>'<='],
            [['promedio', 'conducta'], 'compare','compareValue'=>0,'operator'=>'>='],
            
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
            'id_alumno' => 'Id Alumno',
            'id_ficha' => 'Id Ficha',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'nombre' => 'Nombre',
            'lugar_nacimiento' => 'Lugar Nacimiento',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'domicilio' => 'Domicilio',
            'establecimiento_proviene' => 'Establecimiento Proviene',
            'promedio' => 'Promedio',
            'conducta' => 'Conducta',
            'telefono_celular' => 'Telefono Celular',
            'representante' => 'Representante',
            'cedula' => 'Cedula',
            'email' => 'Email',
            'telefono_convencional' => 'Telefono Convencional',
            'id_user' => 'Id User',
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
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuiaAtencions()
    {
        return $this->hasMany(GuiaAtencion::className(), ['id_alumno' => 'id_alumno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuiaEvaluacions()
    {
        return $this->hasMany(GuiaEvaluacion::className(), ['id_alumno' => 'id_alumno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoporteDocentes()
    {
        return $this->hasMany(SoporteDocente::className(), ['id_alumno' => 'id_alumno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestVocacionals()
    {
        return $this->hasMany(TestVocacional::className(), ['id_alumno' => 'id_alumno']);
    }
}
