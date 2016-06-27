<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ReferenciaFamiliar;
use frontend\models\Alumno;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ReferenciaFamiliarController implements the CRUD actions for ReferenciaFamiliar model.
 */
class ReferenciaFamiliarController extends Controller
{
     public $layout="column2";
     
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create','update','delete','cargar'],
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
     * Lists all ReferenciaFamiliar models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $dataProvider = new ActiveDataProvider([
    //         'query' => ReferenciaFamiliar::find(),
    //     ]);

    //     return $this->render('index', [
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    // /**
    //  * Displays a single ReferenciaFamiliar model.
    //  * @param integer $id
    //  * @return mixed
    //  */
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    public function actionCargar(){
       
        $modelAlumno= Alumno::findOne(['id_alumno'=>$_POST['id']]);
        $data=\Yii::$app->db->createCommand('SELECT id_referencia_familiar, concat(apellidos," ",nombres) as nombre_familiar FROM referencia_familiar where id_ficha=:id', [':id'=>$modelAlumno->id_ficha])->queryAll();

        echo "<option value=''>--Seleccione una referencia familiar--</option>";
        foreach ($data as $referencia_familiar) {
             echo "<option value='".$referencia_familiar['id_referencia_familiar']."'>".$referencia_familiar['nombre_familiar']."</option>";
        }
    }

    /**
     * Creates a new ReferenciaFamiliar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new ReferenciaFamiliar();
        $model->id_ficha=$id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect("index.php?r=ficha/update&id=".$model->id_ficha."&item=3");
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ReferenciaFamiliar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect("index.php?r=ficha/update&id=".$model->id_ficha."&item=3");
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ReferenciaFamiliar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        try {
            $model->delete(); 
        } catch (\yii\db\IntegrityException $ex) {
            Yii::$app->session->setFlash('error', 'Este registro esta siendo utilizado en otras tablas como referencia, elimine estas referencias y posteriormente este registro.');
        }

        return $this->redirect("index.php?r=ficha/update&id=".$model->id_ficha."&item=3");
    }

    /**
     * Finds the ReferenciaFamiliar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReferenciaFamiliar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReferenciaFamiliar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
