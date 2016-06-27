<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Alumno */
/* @var $form yii\widgets\ActiveForm */
?>
<br><br>
<div class="alumno-form">

    <?php  $form = ActiveForm::begin([
            'action'=>($model->isNewRecord) ? 'index.php?r=ficha/create' : 'index.php?r=ficha/update&id='.$model->id_ficha,
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}{endWrapper}",
            ]
    ]); ?>

    <?= $form->field(
                $model, 
                'apellido_paterno',[
                    'options'=>['class' => 'form-group col-xs-6']
                ])
             ->textInput([
                'maxlength' => 50,
             ]); 
    ?>

    <?= $form->field(
                $model, 
                'apellido_materno',[
                    'options'=>['class' => 'form-group col-xs-6']
                ])
             ->textInput([
                'maxlength' => 50
            ]); 
    ?>

    <?= $form->field(
                $model, 
                'nombre',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textInput([
                'maxlength' => 100
            ]); 
    ?>

    <?= $form->field(
                $model, 
                'cedula',[
                    'options'=>['class' => 'form-group col-xs-4']
                ])
             ->textInput([
                'maxlength' => 100,
             ]); 
    ?>

    <?= $form->field(
                $model, 
                'email',[
                    'options'=>['class' => 'form-group col-xs-4']
                ])
             ->textInput(['class'=>'form-control']); 
    ?>

    <?= $form->field(
                $model, 
                'fecha_nacimiento',[
                    'options'=>['class' => 'form-group col-xs-4']
                ])
             ->textInput(['class'=>'form-control fecha']); 
    ?>


    <?= $form->field(
                $model, 
                'lugar_nacimiento',[
                    'options'=>['class' => 'form-group col-xs-6']
                ])
             ->textInput([
                'maxlength' => 100,
                'readonly'=>true
             ]); 
    ?>



    <div id="map_lugar_nacimiento" class="form-group col-xs-6" style="height: 300px;">
        
    </div>

    <?= $form->field(
                $model, 
                'domicilio',[
                    'options'=>['class' => 'form-group col-xs-6']
                ])
             ->textInput([
                'maxlength' => 200,
                'readonly'=>true
            ]); 
    ?>

    <div id="map_domicilio" class="form-group col-xs-6" style="height: 300px;">
        
    </div>

    <?= $form->field(
                $model, 
                'establecimiento_proviene',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textInput([
                'maxlength' => 200
            ]); 
    ?>

    <?= $form->field(
                $model, 
                'promedio',[
                    'options'=>['class' => 'form-group col-xs-3']
                ])
             ->textInput(); 
    ?>


    <?= $form->field(
                $model, 
                'conducta',[
                    'options'=>['class' => 'form-group col-xs-3']
                ])
             ->textInput(); 
    ?>

    <?= $form->field(
                $model, 
                'telefono_convencional',[
                    'options'=>['class' => 'form-group col-xs-3']
                ])
             ->textInput(['maxlength' => 10]); 
    ?>

    <?= $form->field(
                $model, 
                'telefono_celular',[
                    'options'=>['class' => 'form-group col-xs-3']
                ])
             ->textInput(['maxlength' => 10]); 
    ?>

    <?= $form->field(
                $model, 
                'representante',[
                    'options'=>['class' => 'form-group col-xs-12']
                ])
             ->textInput([
                'maxlength' => 100
            ]); 
    ?>

        <div class="col-xs-12">
            <?= Html::submitButton('Guardar', ['class' =>'btn btn-primary hidden-print']) ?>
            <?= Html::a("Cancelar", \Yii::$app->getUrlManager()->createUrl('ficha/index'),['class'=>'btn btn-danger hidden-print']) ?>
        </div>    

    <?php ActiveForm::end(); ?>

</div>



<!-- Geolocalizacion de google -->

<script type="text/javascript">
    var geocoder;


    function initMap() {
        var myOptions = {
            center: new google.maps.LatLng(-2, -78 ),
            zoom: 6,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById("map_lugar_nacimiento"),myOptions);
        map2 = new google.maps.Map(document.getElementById("map_domicilio"),myOptions);

        var marker;
        marker = new google.maps.Marker({ map: map});
        google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng);
            getAddress(event.latLng,"#alumno-lugar_nacimiento");
        });

        var marker2;
        marker2 = new google.maps.Marker({ map: map2});
        google.maps.event.addListener(map2, 'click', function(event) {
            marker2.setPosition(event.latLng);
            getAddress(event.latLng,"#alumno-domicilio");
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