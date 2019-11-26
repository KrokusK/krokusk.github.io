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
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Collect the nav links, forms, and other content for toggling -->

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <?php ActiveForm::begin(['class' => 'navbar-form navbar-left','id' => 'form-city', 'action' => Yii::$app->urlManager->createUrl('site/index')]); ?>
                                <label class="control-label" for="ad-city">Город</label>
                                <select id="ad-city" class="form-control" name="ad-city">
                                    <?php echo $selectCity; ?>
                                </select>
                                <?php ActiveForm::end(); ?>
                            </li>
                            <li>
                                <?php ActiveForm::begin(['class' => 'navbar-form navbar-left','id' => 'form-category', 'action' => Yii::$app->urlManager->createUrl('site/index')]); ?>
                                <label class="control-label" for="ad-category">Категория</label>
                                <select id="ad-category" class="form-control" name="ad-category">
                                    <?php echo $selectCategory; ?>
                                </select>
                                <?php ActiveForm::end(); ?>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <?php ActiveForm::begin(['class' => 'navbar-form navbar-right','id' => 'form-search', 'action' => Yii::$app->urlManager->createUrl('site/index')]); ?>
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
        <div class="row">


            <?php foreach ($userAds as $userAd): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="/site/ad?ad=<?= Html::encode("{$userAd["id"]}") ?>">
                            <img src="<?= (empty($userAd->adPhotos)) ? '' : Html::encode("{$userAd->adPhotos[0]["photo_path"]}") ?>" alt="Image">
                        </a>
                        <div class="caption">
                            <h3><?= Html::encode("{$userAd->header}") ?></h3>
                            <p>Цена: <?= Html::encode("{$userAd->amount}") ?></p>
                            <p>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
        <div class="row">
            <div class="text-center">
                <?= LinkPager::widget(['pagination' => $pagination]) ?>
            </div>
        </div>
    </div>



    <?php //Pjax::end(); ?>

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

</div>