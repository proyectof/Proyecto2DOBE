<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'DOBE',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top hidden-print',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                   // ['label' => 'Inicio', 'url' => ['/site/index']],
                    [
                        'label' => 'Modulo 1 (Fichas)', 
                        'url' => ['/ficha/index'],
                        'visible'=>Yii::$app->user->can("coordinador")
                    ],
                    [
                        'label' => 'Modulo 2 (S. Docente)', 
                        'url' => ['/soporte-docente/index'],
                        'visible'=>Yii::$app->user->can("docente") or Yii::$app->user->can("coordinador")
                    ],
                    [
                        'label' => 'Modulo 3 (G. Atención)', 
                        'url' => ['/guia-atencion/index'],
                        'visible'=>Yii::$app->user->can("coordinador")
                    ],
                    [
                        'label' => 'Modulo 4 (G. Evaluacion)', 
                        'url' => ['/guia-evaluacion/index'],
                        'visible'=>Yii::$app->user->can("coordinador")
                    ],
                    [
                        'label' => 'Modulo 5 (Test Vocacional)', 
                        'url' => ['/test-vocacional/index'],
                        'visible'=>Yii::$app->user->can("estudiante")
                    ],
                    [
                        'label' => 'Modulo 6 (Galeria de fotos)', 
                        'url' => '#',
                        'visible'=>Yii::$app->user->can("coordinador"),
                        'items'=>[
                            [
                                'label'=>'Subir Fotos',
                                'url'=>['/galeria/create'],
                            ],[
                                'label'=>'Administrar Fotos',
                                'url'=>['/galeria/index'],
                            ]
                        ]
                    ],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer hidden-print">
        <div class="container">
        <p class="pull-left">&copy; DOBE <?= date('Y') ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    <script type="text/javascript">
        // fecha de nacimiento (Alumno)
        $('.fecha').datetimepicker({
            //language:'es'
            pickTime: false,
            format:"YYYY-MM-DD"
        });
    </script>
</body>
</html>
<?php $this->endPage() ?>
