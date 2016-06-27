<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\data\ActiveDataProvider;

use frontend\searchs\AspectoAcademicoSearch;
use frontend\searchs\ReferenciaFamiliarSearch;
use frontend\searchs\CitacionSearch;
use frontend\searchs\SancionSearch;
use frontend\searchs\ReferenciaEconomicaSearch;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ficha */

$this->title = 'Update Ficha: ' . ' ' . $modelFicha->id_ficha;
$this->params['breadcrumbs'][] = ['label' => 'Fichas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelFicha->id_ficha, 'url' => ['view', 'id' => $modelFicha->id_ficha]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ficha-update">
	<div class="col-md-12 hidden-print">
		    <?php
		    /*se define el active menu por defecto*/
		      $active=1;
		      if(isset($_GET["item"])){
		      	$active=$_GET["item"];
		      }

		      /*********/
		      $searchModelAspAcad=new AspectoAcademicoSearch();
		      $searchModelRefFam=new ReferenciaFamiliarSearch();
		      $searchModelCitacion=new CitacionSearch();
		      $searchModelSancion=new SancionSearch();
		      $searchModelRefEco=new ReferenciaEconomicaSearch();
		      /*********/

		      echo Tabs::widget([
			      'items' => [
			          [
			              'label' => 'Datos del Estudiante',
			              'content' => $this->render('../alumno/_form', ['model' => $modelAlumno]),
			              'active' => ($active==1) ? true : false ,
			              //'linkOptions' => ['url' => 'ad'],
			          ],
			          [
			              'label' => 'Fotos',
			              'content' => $this->render('../fotos/index', ['idFicha' => $modelFicha->id_ficha]),
			              'active' => ($active==8) ? true : false,
			          ],
			          [
			              'label' => 'Aspectos Académicos',
			              'content' => $this->render('../aspecto-academico/index', ['dataProvider' => $searchModelAspAcad->search(Yii::$app->request->queryParams,$modelFicha->id_ficha),'searchModel'=>$searchModelAspAcad]),
			              'active' => ($active==2) ? true : false,
			          ],
			         [
			              'label' => 'Referencia Familiar',
			              'content' => $this->render('../referencia-familiar/index', ['dataProvider' => $searchModelRefFam->search(Yii::$app->request->queryParams,$modelFicha->id_ficha),'searchModel'=>$searchModelRefFam]),
			              'active' => ($active==3) ? true : false,
			          ],
			          [
			              'label' => 'Referencia Económica',
			              'content' => $this->render('../referencia-economica/index', ['dataProvider' => $searchModelRefEco->search(Yii::$app->request->queryParams,$modelFicha->id_ficha),'searchModel'=>$searchModelRefEco]),
			              'active' => ($active==7) ? true : false,
			          ],
			          [
			              'label' => 'Citaciones',
			              'content' => $this->render('../citacion/index', ['dataProvider' => $searchModelCitacion->search(Yii::$app->request->queryParams,$modelFicha->id_ficha),'searchModel'=>$searchModelCitacion]),
			              'active' => ($active==4) ? true : false,
			          ],
			          [
			              'label' => 'Sanciones',
			              'content' => $this->render('../sancion/index', ['dataProvider' => $searchModelSancion->search(Yii::$app->request->queryParams,$modelFicha->id_ficha),'searchModel'=>$searchModelSancion]),
			              'active' => ($active==5) ? true : false,
			          ],

			          [
			              'label' => 'Encuesta',
			              'content' => $this->render('../ficha-encuesta/index', ['idFicha' => $modelFicha->id_ficha]),
			              'active' => ($active==6) ? true : false,
			          ],

			     ],
			 ]);
		 ?>
	</div>
</div>
