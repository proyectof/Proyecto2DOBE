<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use frontend\models\ReferenciaFamiliar;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReferenciaEconomica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referencia-economica-form">


    <?php  $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                 'horizontalCssClasses' => [
                      'label' => 'col-sm-2',
                      'wrapper' => 'col-sm-6',
                      'error' => '',
                      'hint' => '',
                 ],
            ],
        ]); ?>

        
        <?= $form->field(
                    $model, 
                    'id_referencia_familiar',[
                        //'options'=>['class' => 'form-group col-sm-3']
                    ])->label("Elija el familiar")
                 ->dropDownList(ArrayHelper::map(
                    ReferenciaFamiliar::findBySql("select concat(nombres,' ',apellidos) as nombres, id_referencia_familiar from referencia_familiar where id_ficha=".$model->id_ficha)->all(),
                    'id_referencia_familiar',
                    'nombres'
                ),['prompt'=>'-- Elija un familiar --']);  
        ?>

        <?= $form->field(
                    $model, 
                    'trabaja',[
                        //'options'=>['class' => 'form-group col-sm-3']
                    ])
                 ->dropDownList(['Si'=>'Si','No'=>'No'],['prompt'=>'-- Elija una opción --']);  
        ?>

        <?= $form->field(
                    $model, 
                    'grado_estudio',[
                        //'options'=>['class' => 'form-group col-sm-3']
                    ])
                 ->dropDownList([
                    'Profesional'=>'Profesional',
                    'Bachiller'=>'Bachiller',
                    'Primaria'=>'Primaria',
                    'Ninguna'=>'Ninguna',
                ],[
                    'prompt'=>'-- Elija una opción --'
                ]);  
        ?>

        <?= $form->field(
                    $model, 
                    'ocupacion',[
                        //'options'=>['class' => 'form-group col-sm-6']
                    ])
                 ->textInput(['maxlength' => 100]); 
        ?>

        <div class="row">
            <div id="map_direccion_trabajo" class="form-group col-sm-8" style="height: 300px;">
            
            </div>
        </div>

        <?= $form->field(
                    $model, 
                    'direccion_trabajo',[
                        //'options'=>['class' => 'form-group col-sm-6']
                    ])
                 ->textInput(['maxlength' => 200,'readonly'=>true]); 
        ?>

        <?= $form->field(
                    $model, 
                    'estado_civil',[
                        //'options'=>['class' => 'form-group col-sm-3']
                    ])
                 ->dropDownList([
                    'Soltero/a'=>'Soltero/a',
                    'Casado/a'=>'Casado/a',
                    'Divorciado/a'=>'Divorciado/a',
                    'Viudo/a'=>'Viudo/a',
                ],[
                    'prompt'=>'-- Elija una opción --'
                ]);  
        ?>

        <?= $form->field(
                    $model, 
                    'edad',[
                        //'options'=>['class' => 'form-group col-sm-6']
                    ])
                 ->textInput(); 
        ?>
        <hr/>
        <div class="form-group col-md-3">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            <?= Html::a("Cancelar", \Yii::$app->getUrlManager()->createUrl('ficha/update')."&id=".$model->id_ficha."&item=7", ['class' => 'btn btn-danger']) ?>
        </div>
        
    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    var geocoder;


    function initMap() {
        var myOptions = {
            center: new google.maps.LatLng(-2, -78 ),
            zoom: 6,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById("map_direccion_trabajo"),myOptions);

        var marker;
        marker = new google.maps.Marker({ map: map});
        google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng);
            getAddress(event.latLng,"#referenciaeconomica-direccion_trabajo");
        });
    }

    // function placeMarker(location,map,marker) {

    //     // if(marker){ //on vérifie si le marqueur existe
    //     //marker.setPosition(location); //on change sa position
    //     // }else{
    //     //     marker = new google.maps.Marker({ //on créé le marqueur
    //     //         position: location, 
    //     //         map: map,
    //     //         //draggable:true,
    //     //     });
    //     // }
    //     //document.getElementById('alumno-cedula').value=location.lat();
    //     //document.getElementById('lng').value=location.lng();
    //     //getAddress(location);
    // }

    function getAddress(latLng,lugar) {
      geocoder.geocode( {'latLng': latLng},
      function(results, status) {
        if(status == google.maps.GeocoderStatus.OK) {
          if(results[0]) {
            $(lugar).val(results[0].formatted_address);
          }else {
            $(lugar).val("Lugar no encontrado");
          }
        }else {
          alert(status);
        }
      });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb16Og9hgNucFgqJmAE6m8e5gFazPuvt0&callback=initMap" async defer></script>