<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Galeria;
use frontend\searchs\GaleriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * GaleriaController implements the CRUD actions for Galeria model.
 */
class GaleriaController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create','delete','index'],
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
     * Lists all Galeria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GaleriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Galeria model.
     * @param integer $id
     * @return mixed
     */
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    /**
     * Creates a new Galeria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Galeria();
        $model->scenario="subir";

        if ($model->load(Yii::$app->request->post())){
              $model->extension = UploadedFile::getInstances($model, 'extension');
              
              if ($model->extension && $model->validate()) {
                    foreach ($model->extension as $foto) {
                        $modelIngreso = new Galeria;
                        $modelIngreso->extension = '.' . $foto->extension;
                        $modelIngreso->fecha=date("Y-m-d");
                        $modelIngreso->hora=date("H:i:s");

                        if($modelIngreso->save()){
                            $foto->saveAs('img/galeria/' . $modelIngreso->id_foto  . $modelIngreso->extension);
                            Yii::$app->session->setFlash('success', 'La foto <b> '.$foto->baseName . $foto->extension.' </b> fue subida con exito.');
                        }else
                            Yii::$app->session->setFlash('error', 'Ocurrio un problema al subir la foto '.$foto->baseName . '.' . $foto->extension.' -- '.var_dump($modelIngreso->getErrors()));
                    }
                    return $this->redirect(['site/index']);
             }
        }


        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Galeria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id_foto]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Deletes an existing Galeria model.
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


        unlink(Yii::$app->basePath . '/web/img/galeria/'.$model->id_foto.$model->extension);

        return $this->redirect("index.php?r=galeria/index");
    }

    /**
     * Finds the Galeria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Galeria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Galeria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
