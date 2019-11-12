<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Сайт объявлений';
?>
<div class="site-index">

    <?php Pjax::begin(); ?>

    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left">
                            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">Link</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                            <li>
                                <label class="control-label" for="ad-city">Город</label>
                                <select id="ad-city" class="form-control" name="ArrayCity[city]">
                                    <?php echo $selectCity; ?>
                                </select>
                            </li>
                            <li>
                                <?php ActiveForm::begin(['id' => 'form-category', 'action' => Yii::$app->urlManager->createUrl('site/index')]); ?>
                                <label class="control-label" for="ad-city">Категория</label>
                                <select id="ad-city" class="form-control" name="ArrayCity[city]">
                                    <?php echo $selectCategory; ?>
                                </select>
                                <?php ActiveForm::end(); ?>
                            </li>
                            <li>
                                <?= Html::a(
                                    'Случайная строка',
                                    ['/site/index?page='.((($pagination->offset)/($pagination->limit)) + 1)],
                                    ['class' => 'btn btn-lg btn-primary']
                                ) ?>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-right">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <div class="row">


            <?php foreach ($userAds as $userAd): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="<?= Html::encode("{$userAd->adPhotos[0]["photo_path"]}") ?>" alt="Image">
                        <div class="caption">
                            <h3><?= Html::encode("{$userAd->header}") ?></h3>
                            <p>Цена: <?= Html::encode("{$userAd->amount}") ?></p>
                            <p>Создано: <?= Html::encode("{$userAd->created_at}") ?></p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
        <div class="row">
            <h1>Users</h1>
            <ul>
                <?php foreach ($userAds as $userAd): ?>
                    <li>
                        <?= Html::encode("/site/index?page=".((($pagination->offset)/($pagination->limit)) + 1)) ?>

                        <?= Html::encode(var_dump($userAd->adPhotos[0]["photo_path"])) ?>
                        <?= Html::encode(var_dump($userAd->header)) ?>
                        <?= Html::encode(var_dump($userAd->created_at)) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="row">
            <div class="text-center">
                <?= LinkPager::widget(['pagination' => $pagination]) ?>
            </div>
        </div>
    </div>

    <?php Pjax::end(); ?>


</div>