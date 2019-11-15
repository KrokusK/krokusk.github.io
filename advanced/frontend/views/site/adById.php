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

            <table>
                <tr>
                    <td>
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
                    <td>
                        <div class="container">
                            <div class="card-group">
                                <div class="card img-fluid">
                                    <img class="card-img-top" src="https://via.placeholder.com/260x313.png?text=placeholder+image" alt="Card image" style="width:100%">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">FIRST CARD</h5>
                                        <hr>
                                        <p class="card-text">Tech virtual drone online browser platform through in a system. Document fab developers encryption smartphone powered, bespoke blockstack edit atoms.</p>
                                    </div>
                                </div>

                                <div class="card img-fluid">
                                    <img class="card-img-top" src="https://via.placeholder.com/260x313.png?text=placeholder+image" alt="Card image" style="width:100%">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">SECOND CARD</h5>
                                        <hr>
                                        <p class="card-text">But stream software offline. Professor install angel sector anywhere create at components smart.</p>
                                    </div>
                                </div>

                                <div class="card img-fluid">
                                    <img class="card-img-top" src="https://via.placeholder.com/260x313.png?text=placeholder+image" alt="Card image" style="width:100%">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">THIRD CARD WITH MUCH LONGER TITLE</h5>
                                        <hr>
                                        <p class="card-text">Document fab developers encryption smartphone powered, bespoke blockstack edit atoms.</p>
                                    </div>
                                </div>

                                <div class="card img-fluid">
                                    <img class="card-img-top" src="https://via.placeholder.com/260x313.png?text=placeholder+image" alt="Card image" style="width:100%">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">FOURTH CARD</h5>
                                        <hr>
                                        <p class="card-text">Now digital designs id anywhere atoms. Now strategy startups documents designs. Venture crypto adopters niche. Video algorithm system ultra-private policies engineering.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
        <div class="row">

        </div>

    </div>



    <?php //Pjax::end(); ?>

</div>