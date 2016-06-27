<?php

namespace frontend\controllers;

use Yii;
use frontend\models\FichaEncuesta;
use frontend\models\Respuesta;
use frontend\searchs\FichaEncuestaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FichaEncuestaController implements the CRUD actions for FichaEncuesta model.
 */
class FichaEncuestaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all FichaEncuesta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FichaEncuestaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FichaEncuesta model.
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
     * Creates a new FichaEncuesta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new FichaEncuesta();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id_ficha_encuesta]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Updates an existing FichaEncuesta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id_ficha_encuesta]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Deletes an existing FichaEncuesta model.
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
     * Finds the FichaEncuesta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FichaEncuesta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FichaEncuesta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
    * Guardar la respuesta de ficha encuesta
    *
    */
    public function actionGuardarRespuesta(){

        $modelFichaEncuesta = FichaEncuesta::findOne(['id_ficha'=>$_POST['id_ficha']]);

        $query = new \yii\db\Query();
        $query->select("id_pregunta, tipo")
              ->from ("((encuesta inner join seccion on encuesta.id_encuesta=seccion.id_encuesta) inner join pregunta on seccion.id_seccion= pregunta.id_seccion)")
              ->where(["encuesta.id_encuesta"=>$modelFichaEncuesta->id_encuesta]);

        $command= $query->createCommand();
        $data= $command->queryAll();
        //echo var_dump($data);
        //creamos la respuesta
        $modelRespuesta=Respuesta::findOne(['id_encuesta'=>$modelFichaEncuesta->id_encuesta,'id_ref'=>$modelFichaEncuesta->id_ficha_encuesta,'id_tbl'=>'FE']);
        if($modelRespuesta==NULL){
            $modelRespuesta= new Respuesta;
            $modelRespuesta->id_encuesta=$modelFichaEncuesta->id_encuesta;
            $modelRespuesta->id_ref=$modelFichaEncuesta->id_ficha_encuesta;
            $modelRespuesta->id_tbl="FE"; // 0=> ficha encuesta 1=>
            $modelRespuesta->fecha=date("Y-m-d");
            $modelRespuesta->hora=date("H:m:s");
            $modelRespuesta->save();
        }
        

        foreach ($data as $pregunta) {            
            if(isset($_POST[$pregunta['id_pregunta']][1])){

                if($pregunta['tipo']=="RS"){
                    $modelRespuesta->guardarRespuestaSimple($pregunta);
                }elseif($pregunta['tipo']=="RA") {
                    $modelRespuesta->guardarRespuestaAbierta($pregunta);
                }elseif($pregunta['tipo']=="RM"){
                    $modelRespuesta->guardarRespuestaMultiple($pregunta);
                }
            }
        }
        Yii::$app->session->setFlash('success', 'Las respuestas fueron guardadas con exito, puede seguir modificando la encuesta cuando desee ');
        return $this->redirect("index.php?r=ficha/update&id=".$modelFichaEncuesta->id_ficha."&item=6");
    }
}
