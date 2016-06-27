<?php

namespace frontend\controllers;

use Yii;
use frontend\models\GuiaEvaluacion;
use frontend\searchs\GuiaEvaluacionSearch;
use frontend\models\Respuesta;
use frontend\models\RespuestaAbierta;
use frontend\models\RespuestaOpcion;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * GuiaEvaluacionController implements the CRUD actions for GuiaEvaluacion model.
 */
class GuiaEvaluacionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['update','create','delete','index','view','guardar-respuesta'],
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
     * Lists all GuiaEvaluacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GuiaEvaluacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GuiaEvaluacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GuiaEvaluacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GuiaEvaluacion();

        if ($model->load(Yii::$app->request->post())) {
            $model->fecha=date('Y-m-d');
            $model->hora=date('H:m:s');
            $model->id_encuesta=2;
            $model->save();
            return $this->redirect(['update', 'id' => $model->id_guia_evaluacion]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GuiaEvaluacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelGuiaEvaluacion = $this->findModel($id);

        return $this->render('update', [
            'modelGuiaEvaluacion' => $modelGuiaEvaluacion,
        ]);
    }

    /**
     * Deletes an existing GuiaEvaluacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $modelRespuesta= Respuesta::findOne(['id_ref'=>$id,'id_tbl'=>'GE']);
        $query = new \yii\db\Query();
        $query->createCommand()->delete("respuesta_abierta","id_respuesta=".$modelRespuesta->id_respuesta."")->execute();
        $query->createCommand()->delete("respuesta_opcion","id_respuesta=".$modelRespuesta->id_respuesta."")->execute();
        $modelRespuesta->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the GuiaEvaluacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GuiaEvaluacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GuiaEvaluacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionGuardarRespuesta(){

        $modelGuiaEvaluacion = GuiaEvaluacion::findOne(['id_guia_evaluacion'=>$_POST['id_guia_evaluacion']]);

        $query = new \yii\db\Query();
        $query->select("id_pregunta, tipo")
              ->from ("((encuesta inner join seccion on encuesta.id_encuesta=seccion.id_encuesta) inner join pregunta on seccion.id_seccion= pregunta.id_seccion)")
              ->where(["encuesta.id_encuesta"=>$modelGuiaEvaluacion->id_encuesta]);

        $command= $query->createCommand();
        $data= $command->queryAll();
        //echo var_dump($data);
        //creamos la respuesta
        $modelRespuesta=Respuesta::findOne(['id_encuesta'=>$modelGuiaEvaluacion->id_encuesta,'id_ref'=>$modelGuiaEvaluacion->id_guia_evaluacion,'id_tbl'=>'GE']);
        if($modelRespuesta==NULL){
            $modelRespuesta= new Respuesta;
            $modelRespuesta->id_encuesta=$modelGuiaEvaluacion->id_encuesta;
            $modelRespuesta->id_ref=$modelGuiaEvaluacion->id_guia_evaluacion;
            $modelRespuesta->id_tbl="GE"; // 0=> ficha encuesta 1=>
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
        return $this->redirect("index.php?r=guia-evaluacion/view&id=".$modelGuiaEvaluacion->id_guia_evaluacion);
    }
}
