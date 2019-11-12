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
                            <li>
                                <?php ActiveForm::begin(['class' => 'navbar-form navbar-left','id' => 'form-category', 'action' => Yii::$app->urlManager->createUrl('site/index')]); ?>
                                <a href=/site/index?page="<?php echo ((($pagination->offset)/($pagination->limit)) + 1) ?>">
                                <label class="control-label" for="ad-city">Город</label>
                                <select id="ad-city" class="form-control" name="ad-city">
                                    <?php echo $selectCity; ?>
                                </select>
                                </a>
                                <?php ActiveForm::end(); ?>
                            </li>
                            <li>
                                <label class="control-label" for="ad-city">Категория</label>
                                <select id="ad-category" class="form-control" name="ad-category">
                                    <?php echo $selectCategory; ?>
                                </select>
                            </li>
                            <li>
                                <?= Html::a(
                                    'Случайная строка',
                                    ['/site/index?page='.((($pagination->offset)/($pagination->limit)) + 1)],
                                    ['class' => 'btn btn-lg btn-primary']
                                ) ?>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <form class="navbar-form navbar-right">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </form>
                            </li>
                        </ul>

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