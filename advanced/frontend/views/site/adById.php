<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Сайт объявлений';
?>
<div class="site-index">

    <?php //Pjax::begin(); ?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8">
                <div class="thumbnail">

                    <div class="content-main">
                        <div class="col-sm-6 col-md-9 col-lg-9">
                            <h3><?= Html::encode("{$userAd->header}") ?></h3>
                            <h4>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?>   Город:</h4>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <h3></h3>
                            <h4>Цена: <?= Html::encode("{$userAd->amount}") ?><h4>
                        </div>
                    </div>

                    <div class="content-secondary">
                        <?php foreach ($userAd->adPhotos as $objPhoto): ?>

                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <img src="<?= Html::encode("{$objPhoto["photo_path"]}") ?>" alt="Image">
                            </div>

                        <?php endforeach; ?>
                    </div>
                    <br><br>
                    <div class="content-secondary">
                        <div class="col-sm-6 col-md-12 col-lg-12">
                            <h3><?= Html::encode("{$userAd->header}") ?></h3>
                            <p>Цена: <?= Html::encode("{$userAd->amount}") ?></p>
                            <p>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?></p>
                            <p><a href="#" class="btn btn-primary" role="button">Посмотреть</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                            <p>
                                <p><?php var_dump($userAd->adPhotos); ?></p>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="<?= Html::encode("{$userAd->adPhotos[0]["photo_path"]}") ?>" alt="Image">
                    <div class="caption">
                        <h3><?= Html::encode("{$userAd->header}") ?></h3>
                        <p>Цена: <?= Html::encode("{$userAd->amount}") ?></p>
                        <p>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?></p>
                        <p><a href="#" class="btn btn-primary" role="button">Посмотреть</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <?php //Pjax::end(); ?>

</div>