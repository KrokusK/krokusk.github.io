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
            <div class="col-md-8 col-lg-8">

                    <div class="content-main">
                        <div class="col-sm-6 col-md-9 col-lg-9">
                            <h2><?= Html::encode("{$userAd->header}") ?></h2>
                            <h4>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?>   Город: <?= Html::encode("{$userAd->userCities['city_name']}") ?></h4>
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
                            <br><br>
                            <p><?= Html::encode("{$userAd->content}") ?></p>
                            <p>
                                <p><?php var_dump($userAd->userDescs); ?></p>
                            </p>
                        </div>
                    </div>

            </div>
            <div class="col-md-4 col-lg-4">
                <div class="thumbnail">
                    <img src="<?= Html::encode("{$userAd->userDescs["avatar"]}") ?>" alt="Image">
                    <div class="caption">
                        <p><b>Имя : </b><?= Html::encode("{$userAd->userDescs["name"]}") ?></p>
                        <p><b>На сайте с : </b><?= Html::encode(date('d.m.Y H:i:s', $userAd->userDescs->users["created_at"])) ?></p>
                        <p><b>Активных объявлений : </b><?= Html::encode("{$countActAds}") ?></p>
                        <p><b>Телефон : </b><?= Html::encode("{$userAd->userDescs["phone"]}") ?></p>
                        <p><b>О себе : </b><?= Html::encode("{$userAd->userDescs["about"]}") ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <?php //Pjax::end(); ?>

</div>