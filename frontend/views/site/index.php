<?php

use frontend\models\Galeria;

/* @var $this yii\web\View */
$this->title = 'Dobe';

?>
<div class="container">
    <h1><center>Galeria de fotos</center></h1>
    <hr>
    <center>
    <form class="form-inline">
        <div class="form-group">
            <button id="image-gallery-button" type="button" class="btn btn-primary btn-lg">
                <i class="glyphicon glyphicon-picture"></i>
                Mostrar Galeria de fotos
            </button>
        </div>
        <br>
        <br>
        <div class="btn-group" data-toggle="buttons">
          <label class="btn btn-success btn-lg">
            <i class="glyphicon glyphicon-leaf"></i>
            <input id="borderless-checkbox" type="checkbox"> Sin bordes
          </label>
          <label class="btn btn-primary btn-lg">
            <i class="glyphicon glyphicon-fullscreen"></i>
            <input id="fullscreen-checkbox" type="checkbox"> Pantalla completa
          </label>
        </div>
    </form>
    </center>
    <hr>
    <br>
    <!-- The container for the list of example images -->
    <div id="links">
        <?php 
            $model = Galeria::find()->orderBy("id_foto desc")->all();
            foreach ($model as $foto) {
                //echo $foto->extension;
                echo '<a href="img/galeria/'.$foto->id_foto.$foto->extension.'" title="'.$foto->fecha.' - '.$foto->id_foto.$foto->extension.'" data-gallery="">';
                echo '    <img width="50" src="img/galeria/'.$foto->id_foto.$foto->extension.'">';
                echo '</a>';
            }
        ?>
    </div>
    <br>
</div>
<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
