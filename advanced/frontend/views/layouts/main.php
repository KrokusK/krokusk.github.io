<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        //'brandLabel' => Yii::$app->name,
        'brandLabel' => 'Логотип',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    /*
    $menuItems = [
        ['label' => 'Домой', 'url' => ['/site/index']],
        ['label' => 'О нас', 'url' => ['/site/about']],
        ['label' => 'Контакты', 'url' => ['/site/contact']],
    ];
    */
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/signup'], 'get')
            . Html::submitButton(
                'Регистрация',
                ['class' => 'btn btn-primary', 'id' => 'board-signup']
            )
            . Html::endForm()
            . '</li>';
        //$menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/login'], 'get')
            . Html::submitButton(
                'Вход',
                ['class' => 'btn btn-outline-primary', 'id' => 'board-login']
            )
            . Html::endForm()
            . '</li>';
    } else {
        //$menuItems[] = ['label' => 'Добавить объявление', 'url' => ['/site/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/index'], 'get')
            . Html::submitButton(
                'Добавить объявление',
                ['class' => 'btn btn-primary', 'id' => 'add-ad']
            )
            . Html::endForm()
            . '</li>';
        //$menuItems[] = ['label' => 'Мои объявления', 'url' => ['/site/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/index'], 'get')
            . Html::submitButton(
                'Мои объявления',
                ['class' => 'btn btn-link', 'id' => 'personal-ad']
            )
            . Html::endForm()
            . '</li>';
        //$menuItems[] = ['label' => 'Личный кабинет', 'url' => ['/site/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/index'], 'get')
            . Html::submitButton(
                'Личный кабинет',
                ['class' => 'btn btn-link', 'id' => 'personal-account']
            )
            . Html::endForm()
            . '</li>';
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->username . ')',
                //['class' => 'btn btn-link logout']
                ['class' => 'btn btn-outline-primary', 'id' => 'account-logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
