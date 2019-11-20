<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Сайт объявлений';
?>

    <td class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="text-center">
                    <h2>Мои объявления</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Collect the nav links, forms, and other content for toggling -->

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <?php ActiveForm::begin(['class' => 'navbar-form navbar-left','id' => 'form-city', 'action' => Yii::$app->urlManager->createUrl('site/list-my-ads')]); ?>
                                <label class="control-label" for="ad-city">Город</label>
                                <select id="ad-city" class="form-control" name="ad-city">
                                    <?php echo $selectCity; ?>
                                </select>
                                <?php ActiveForm::end(); ?>
                            </li>
                            <li>
                                <?php ActiveForm::begin(['class' => 'navbar-form navbar-left','id' => 'form-category', 'action' => Yii::$app->urlManager->createUrl('site/list-my-ads')]); ?>
                                <label class="control-label" for="ad-category">Категория</label>
                                <select id="ad-category" class="form-control" name="ad-category">
                                    <?php echo $selectCategory; ?>
                                </select>
                                <?php ActiveForm::end(); ?>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <?php ActiveForm::begin(['class' => 'navbar-form navbar-right','id' => 'form-search', 'action' => Yii::$app->urlManager->createUrl('site/list-my-ads')]); ?>
                                    <table>
                                        <tr>
                                            <td><input type="text" class="form-control" placeholder="Search" id="in-search"></td>
                                            <td><button type="submit" class="btn btn-default" id="btn-search">Submit</button></td>
                                        </tr>
                                    </table>
                                <?php ActiveForm::end(); ?>
                            </li>
                        </ul>

                    </div><!-- /.navbar-collapse -->

                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <tr class="row">


            <table style="height: 100px; weight: 100px">
                <tbody>
                    <?php foreach ($userAds as $userAd): ?>
                        <tr>
                            <td class="align-top col-sm-6 col-md-8 col-lg-8">

                                    <div class="text-left">
                                        <h3><?= Html::encode("{$userAd->header}") ?></h3>
                                    </div>
                                    <div class="text-left">
                                        <h4>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?> Категория :  Город : </h4>
                                    </div>
                                    <div class="text-left">
                                        Содержание!
                                    </div>

                            </td>
                            <td class="align-top col-sm-6 col-md-4 col-lg-4 col-md-offset-8 col-lg-offset-8">

                                    <span class="text-right align-top">
                                        <h4>Статус :</h4>
                                        <h4>Цена: <?= Html::encode("{$userAd->amount}") ?></h4>
                                    </span>
                                    <img class="text-right align-top" src="<?= Html::encode("{$userAd->adPhotos[0]["photo_path"]}") ?>" alt="Image">


                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
        <div class="row">


            <div class="content-main">
                <?php foreach ($userAds as $userAd): ?>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="text-left">
                                <h3><?= Html::encode("{$userAd->header}") ?></h3>
                            </div>
                            <div class="text-left">
                                <h4>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?> Категория :  Город : </h4>
                            </div>
                            <div class="text-left">
                                Содержание!
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-5 col-md-offset-7 col-lg-offset-7">
                            <section>
                                <span class="text-right align-top">
                                    <h4>Статус :</h4>
                                    <h4>Цена: <?= Html::encode("{$userAd->amount}") ?></h4>
                                </span>
                                <img class="text-right align-top" src="<?= Html::encode("{$userAd->adPhotos[0]["photo_path"]}") ?>" alt="Image">

                            </section>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


        </div>
        <div class="row">
            <div class="text-center">
                <?= LinkPager::widget(['pagination' => $pagination]) ?>
            </div>
        </div>
    </div>





<?php
$script = <<< JS
   $(document).ready(function () { 
        $("#ad-city").on('change', function (event) {
           var action = $('#form-city').attr('action') + '?cit=' + $("#ad-city").val() + '&cat=' + $("#ad-category").val();
           //alert(action);
           $('#form-city').attr('action', action);
            
           this.form.submit();
           //$('#ad-test').click();
        });
        
        $("#ad-category").on('change', function (event) { 
           var action = $('#form-category').attr('action') + '?cit=' + $("#ad-city").val() + '&cat=' + $("#ad-category").val();
           //alert(action);
           $('#form-category').attr('action', action);
            
           this.form.submit();
           //$('#ad-test').click();
        });
        
        $("#btn-search").on('click', function (event) { 
           var action = $('#form-search').attr('action') + '?ser=' + $("#in-search").val();
           //alert(action);
           $('#form-search').attr('action', action);
            
           this.form.submit();
           //$('#ad-test').click();
        });
    });       

JS;
$this->registerJs($script);
?>

