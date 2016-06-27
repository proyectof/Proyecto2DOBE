<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TestVocacional;
use frontend\searchs\TestVocacionalSearch;
use frontend\models\Respuesta;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TestVocacionalController implements the CRUD actions for TestVocacional model.
 */
class TestVocacionalController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','update','create','delete','view','resultado','guardar-respuesta'],
                        'allow' => true,
                        'roles' => ['estudiante'],
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
     * Lists all TestVocacional models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestVocacionalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SoporteDocente model.
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
     * Displays a single TestVocacional model.
     * @param integer $id
     * @return mixed
     */
    public function actionResultado($id)
    {
        /*
            select pregunta.area
            from 
                (((respuesta inner join respuesta_opcion on respuesta.id_respuesta=respuesta_opcion.id_respuesta) 
                inner join pregunta on pregunta.id_pregunta=respuesta_opcion.id_pregunta))
                inner join opcion on opcion.id_opcion=respuesta_opcion.id_opcion
            where
                respuesta.id_encuesta=3 and 
                respuesta.id_ref=1 and 
                respuesta.id_tbl="TV" and
                opcion.opcion="Me Interesa"
            group by 
                pregunta.area
            order by count(*) desc
            limit 1
        */
        $modelTestVocacional = $this->findModel($id);    
        $query = new \yii\db\Query();
        $query->select("pregunta.area")
              ->from ("(((respuesta inner join respuesta_opcion on respuesta.id_respuesta=respuesta_opcion.id_respuesta) 
                inner join pregunta on pregunta.id_pregunta=respuesta_opcion.id_pregunta))
                inner join opcion on opcion.id_opcion=respuesta_opcion.id_opcion")
              ->where([
                "respuesta.id_encuesta"=>$modelTestVocacional->id_encuesta,
                'respuesta.id_ref'=>$modelTestVocacional->id_test_vocacional,
                'respuesta.id_tbl'=>'TV',
                'opcion.opcion'=>'Me Interesa'
              ])
              ->groupBy(["pregunta.area"])
              ->orderBy("count(*) desc")
              ->limit(1);

        return $this->render('_resultado', [
            'area' => $query->createCommand()->queryScalar(),
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TestVocacional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TestVocacional();
        $model->id_encuesta=3;
        $model->id_alumno = Yii::$app->db->createCommand("select id_alumno from alumno where id_user=".Yii::$app->user->id)->queryScalar();
        $model->fecha=date('Y-m-d');
        $model->hora=date('H:m:s');
        $model->save();

        return $this->redirect(['update', 'id' => $model->id_test_vocacional]);
        // if ($model->load(Yii::$app->request->post())) {
            
            
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Updates an existing TestVocacional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        return $this->render('update', [
            'modelTestVocacional' => $model,
        ]);
    }

    /**
     * Deletes an existing TestVocacional model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $modelRespuesta= Respuesta::findOne(['id_ref'=>$id,'id_tbl'=>'TV']);

        if($modelRespuesta!=null){
            $query = new \yii\db\Query();
            $query->createCommand()->delete("respuesta_abierta","id_respuesta=".$modelRespuesta->id_respuesta."")->execute();
            $query->createCommand()->delete("respuesta_opcion","id_respuesta=".$modelRespuesta->id_respuesta."")->execute();
            $modelRespuesta->delete();
        }
        
        return $this->redirect(['index']);    }

    /**
     * Finds the TestVocacional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestVocacional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestVocacional::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    public function actionGuardarRespuesta(){

        $modelTestVocacional = TestVocacional::findOne(['id_test_vocacional'=>$_POST['id_test_vocacional']]);

        $query = new \yii\db\Query();
        $query->select("id_pregunta, tipo")
              ->from ("((encuesta inner join seccion on encuesta.id_encuesta=seccion.id_encuesta) inner join pregunta on seccion.id_seccion= pregunta.id_seccion)")
              ->where(["encuesta.id_encuesta"=>$modelTestVocacional->id_encuesta]);

        $command= $query->createCommand();
        $data= $command->queryAll();
        //echo var_dump($data);
        //creamos la respuesta
        $modelRespuesta=Respuesta::findOne(['id_encuesta'=>$modelTestVocacional->id_encuesta,'id_ref'=>$modelTestVocacional->id_test_vocacional,'id_tbl'=>'TV']);
        if($modelRespuesta==NULL){
            $modelRespuesta= new Respuesta;
            $modelRespuesta->id_encuesta=$modelTestVocacional->id_encuesta;
            $modelRespuesta->id_ref=$modelTestVocacional->id_test_vocacional;
            $modelRespuesta->id_tbl="TV"; // 0=> ficha encuesta 1=>
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
        return $this->redirect("index.php?r=test-vocacional/resultado&id=".$modelTestVocacional->id_test_vocacional);
    }
}
