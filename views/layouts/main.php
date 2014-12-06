<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\widgets\Typeahead;
use app\models\LoginForm;

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
                'brandLabel' => '<img src="/logo-v-230px.png" />',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $signup = '';
            if(Yii::$app->user->isGuest) $signup = ['label' => 'SignUp', 'url' => ['/user/registration/register']];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'TOS List', 'url' => ['/site/contact']],
                    $signup,
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/user/security/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/user/security/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            	?><a class="btn btn-lg btn-success navbar-right navbar-create" href="/index.php/create">Create</a><?php
            $model = new LoginForm();
            echo Typeahead::widget([
			    'model' => $model, 
			    'attribute' => 'username',
			    'options' => ['placeholder' => 'eg. FaceBook, Twitter ...', 'class' => 'navbar-search navbar-right'],
			    'pluginOptions' => ['highlight'=>true],
			    'dataset' => [
			        [
			            'local' =>  "test",
			            'limit' => 10
			        ]
			    ]
			]);
		
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; TOSCLOUD <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
