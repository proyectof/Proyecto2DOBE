<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "galeria".
 *
 * @property integer $id_foto
 * @property string $extension
 * @property string $fecha
 * @property string $hora
 */
class Galeria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'galeria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
       return [
            [
               'extension', 'file',
               'skipOnEmpty' => false,
               'uploadRequired' => 'No has seleccionado ningún archivo', //Error
               //'maxSize' => 1024*1024*, //1 MB
               //'tooBig' => 'El tamaño máximo permitido es 1MB', //Error
               //'minSize' => 10, //10 Bytes
               //'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
               'extensions' => 'png, jpg, jpeg',
               'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
               'maxFiles' => 20,
               'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
               'on'=>'subir'
            ],
        ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_foto' => 'Nombre foto',
            'extension' => 'Extension',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
        ];
    }
}
