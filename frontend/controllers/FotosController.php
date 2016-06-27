<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Fotos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FotosController implements the CRUD actions for Fotos model.
 */
class FotosController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create','delete'],
                        'allow' => true,
                        'roles' => ['coordinador'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Creates a new Fotos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fotos();

        if ($model->load(Yii::$app->request->post())) {
            // Subir foto
             $file = \yii\web\UploadedFile::getInstance($model, 'nombre');
             $model->nombre= ".".$file->extension;
             $model->fecha = date("Y-m-d");
             if($model->save()){
                $file->saveAs(Yii::$app->basePath . '/web/img/fotos/'.$model->id_foto.$model->nombre);
                Yii::$app->session->setFlash('success', 'La imagen ha sido subida con exito');
             }else{
                Yii::$app->session->setFlash('error', 'Ocurrio un problema al subir la imagen');

             }
             
            return $this->redirect("index.php?r=ficha/update&id=".$model->id_ficha."&item=8");
            
        }

        return $this->redirect("index.php?r=ficha/index");
        
    }

    /**
     * Deletes an existing Fotos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->delete())
            Yii::$app->session->setFlash('success', 'La foto fue eliminada con exito');
        else
            Yii::$app->session->setFlash('error', 'Ocurrio un problema al eliminar la imagen');


        unlink(Yii::$app->basePath . '/web/img/fotos/'.$model->id_foto.$model->nombre);

        return $this->redirect("index.php?r=ficha/update&id=".$model->id_ficha."&item=8");
    }

    /**
     * Finds the Fotos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fotos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fotos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
