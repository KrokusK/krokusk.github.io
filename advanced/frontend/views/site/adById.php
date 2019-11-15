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
                        <div class="col-sm-6 col-md-8">
                            <h3><?= Html::encode("{$userAd->header}") ?></h3>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <p>Цена: <?= Html::encode("{$userAd->amount}") ?></p>
                        </div>
                        <div class="col-sm-6 col-md-4 offset-md-4">
                            <p>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?>   Город:</p>
                        </div>
                    </div>

                    <div class="content-secondary">
                        <?php foreach ($userAd->adPhotos as $objPhoto): ?>

                            <div class="col-sm-6 col-md-4">
                                <img src="<?= Html::encode("{$objPhoto["photo_path"]}") ?>" alt="Image">
                            </div>

                        <?php endforeach; ?>
                    </div>
                    <br><br>
                    <div class="content-secondary">
                        <div class="caption">
                            <h3><?= Html::encode("{$userAd->header}") ?></h3>
                            <p>Цена: <?= Html::encode("{$userAd->amount}") ?></p>
                            <p>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?></p>
                            <p><a href="#" class="btn btn-primary" role="button">Посмотреть</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>
                        <div>
                            <p><?php var_dump($userAd->adPhotos); ?></p>
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