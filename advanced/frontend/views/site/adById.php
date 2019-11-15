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

            <table style="height: 100px;">
                <tbody>
                <tr>
                    <td class="align-top">
                        <div class="thumbnail">

                            <div class="caption">
                                <h3><?= Html::encode("{$userAd->header}") ?></h3>
                                <p>Цена: <?= Html::encode("{$userAd->amount}") ?></p>
                                <p>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?></p>
                                <p><a href="#" class="btn btn-primary" role="button">Посмотреть</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                            </div>

                            <?php foreach ($userAd->adPhotos as $objPhoto): ?>

                                <div class="col-sm-6 col-md-4">
                                    <img src="<?= Html::encode("{$objPhoto["photo_path"]}") ?>" alt="Image">
                                </div>

                            <?php endforeach; ?>

                            <div>
                                <p><?php var_dump($userAd->adPhotos); ?></p>
                            </div>

                        </div>
                    </td>
                    <td class="align-top">
                        <div class="thumbnail">
                            <img src="<?= Html::encode("{$userAd->adPhotos[0]["photo_path"]}") ?>" alt="Image">
                            <div class="caption">
                                <h3><?= Html::encode("{$userAd->header}") ?></h3>
                                <p>Цена: <?= Html::encode("{$userAd->amount}") ?></p>
                                <p>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?></p>
                                <p><a href="#" class="btn btn-primary" role="button">Посмотреть</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="row">
            <table style="height: 100px;">
                <tbody>
                <tr>
                    <td class="align-baseline">baseline</td>
                    <td class="align-top">top</td>
                    <td class="align-middle">middle</td>
                    <td class="align-bottom">bottom</td>
                    <td class="align-text-top">text-top</td>
                    <td class="align-text-bottom">text-bottom</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>




    <?php //Pjax::end(); ?>

</div>