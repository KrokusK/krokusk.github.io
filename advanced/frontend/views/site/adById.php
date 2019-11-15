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

    <div class="container">
        <div class="row">



            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <?php foreach ($userAd->adPhotos as $objPhoto): ?>
                        <img src="<?= Html::encode("{$objPhoto["photo_path"]}") ?>" alt="Image">
                    <?php endforeach; ?>
                    <div class="caption">
                        <p><?php var_dump($userAd->adPhotos); ?></p>
                        <h3><?= Html::encode("{$idAd}") ?></h3>
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