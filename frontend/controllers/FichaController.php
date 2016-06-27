<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Ficha;
use frontend\searchs\FichaSearch;
use frontend\models\Alumno;
use frontend\models\FichaEncuesta;
use backend\models\SignupForm;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FichaController implements the CRUD actions for Ficha model.
 */
class FichaController extends Controller
{
    public $layout;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['update','create','delete','index','view'],
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
     * Lists all Ficha models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FichaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ficha model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout="column_print_ficha";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ficha model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelFicha = new Ficha();
        $modelAlumno = new Alumno();
        $modelFichaEncuesta= new FichaEncuesta();

        $modelAlumno->scenario="create";

        if ($modelAlumno->load(Yii::$app->request->post())) {
            $modelFicha->fecha_creacion=date("Y-m-d");
            $modelFicha->hora_creacion=date("H:m:s");
            $modelFicha->save();

            $modelFichaEncuesta->id_ficha= $modelFicha->id_ficha;
            $modelFichaEncuesta->id_encuesta=1;
            $modelFichaEncuesta->save();

            $modelAlumno->id_ficha=$modelFicha->id_ficha;
            if($modelAlumno->validate()){



                // Creacion de usuario

                    $model = new SignupForm;
                    $model->rol = "estudiante";
                    $model->username = $modelAlumno->cedula;
                    $model->password = $modelAlumno->cedula;
                    $model->email= $modelAlumno->email;

                    if ($user = $model->signup()) {
                        $modelAlumno->scenario="default";
                        $modelAlumno->id_user=$user->id;
                        $modelAlumno->save();
                        Yii::$app->session->setFlash('success', 'Ficha creada con exito');
                    }else{
                        Yii::$app->session->setFlash('error', 'La ficha fue creada con exito, pero el usuario para el estudiante no se creo por algun problema. Por favor comunique este error al administrador del sistema');
                    }

                    return $this->redirect(['index']);

                //**********
            }else{
                $modelFichaEncuesta->delete();
                $modelFicha->delete();
            }
                
        }

        return $this->render('create', [
            //'modelFicha' => $modelFicha,
            'modelAlumno' => $modelAlumno,
        ]);
        
    }

    /**
     * Updates an existing Ficha model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //$this->layout="column_print_ficha";
        $modelFicha = Ficha::findOne($id);
        $modelAlumno = Alumno::findOne(['id_ficha'=>$id]);

        //$modelAlumno->scenario="update";

        if ($modelAlumno->load(Yii::$app->request->post()) && $modelAlumno->save()) {
             return $this->redirect("index.php?r=ficha/update&id=".$modelAlumno->id_ficha."&item=1");
        } else {
            return $this->render('update', [
                'modelFicha' => $modelFicha,
                'modelAlumno' => $modelAlumno,
            ]);
        }
    }

    /**
     * Deletes an existing Ficha model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the Ficha model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ficha the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ficha::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
