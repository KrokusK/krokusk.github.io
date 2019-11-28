<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Сайт объявлений';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8">
                <p><a href="/site/index" class="btn btn-default" role="button">Объявления</a> / <a href="/site/list-my-ads" class="btn btn-default" role="button">Мои объявления</a></p>
            </div>
        </div>
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
        <div class="row">


            <table>
                <tbody>
                    <?php foreach ($userAds as $userAd): ?>
                        <tr>
                            <td class="align-top col-sm-6 col-md-12 col-lg-12">
                                    <div class="text-left">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <h3>
                                                        <?php
                                                            echo Html::encode("{$userAd->header}");
                                                        ?>
                                                    </h3>
                                                    <h4>Создано: <?= Html::encode(date('d.m.Y H:i:s', $userAd->created_at)) ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Категория : <?= Html::encode("{$userAd->adCategories["name"]}") ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Город : <?= Html::encode("{$userAd->userCities["city_name"]}") ?></h4>
                                                </td>
                                                <td>
                                                    <?php if ($userAd["status_id"] == 2) { ?>
                                                    &nbsp;
                                                        <?php $form = ActiveForm::begin(['method' => 'put', 'id' => 'form-update-ad', 'action' => Yii::$app->urlManager->createUrl('site/update-ad')]); ?>
                                                            <?= Html::hiddenInput('nad', $userAd["id"]) ?>
                                                            <button type="submit" class="btn btn-default">
                                                                <img src="/uploads/Icons/pensil.png" alt="Image">
                                                            </button>
                                                        <?php ActiveForm::end(); ?>
                                                    &nbsp;
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($userAd["status_id"] == 2) { ?>
                                                    &nbsp;
                                                        <?php $form = ActiveForm::begin(['method' => 'delete', 'id' => 'form-disable-ad', 'action' => Yii::$app->urlManager->createUrl('site/disable-ad')]); ?>
                                                            <?= Html::hiddenInput('nad', $userAd["id"]) ?>
                                                            <button type="submit" class="btn btn-default">
                                                                <img src="/uploads/Icons/close.png" alt="Image">
                                                            </button>
                                                        <?php ActiveForm::end(); ?>
                                                    &nbsp;
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <p>Содержание!</p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                            </td>
                            <td class="align-top col-sm-6 col-md-6 col-lg-6">
                                    <div class="text-left align-top">
                                        <h4>Статус : <?= Html::encode("{$userAd->adStatus["name"]}") ?></h4>
                                        <h4>Цена: <?= Html::encode("{$userAd->amount}") ?> руб.</h4>

                                            <img class="text-right align-top" id="AdPhoto<?= Html::encode("{$userAd["id"]}") ?>" src="<?= Html::encode("{$userAd->adPhotos[0]["photo_path"]}") ?>" alt="Image">

                                    </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
        <div class="row">
            <br><br>
            <p><?php //echo "UserDescMyAds : ".var_dump($UserDescMyAds) ?></p>
            <br><br>
            <p><?php //echo "arrayMyAdsId : ".var_dump($arrayMyAdsId) ?></p>
        </div>
        <div class="row">
            <div class="text-center">
                <?= LinkPager::widget(['pagination' => $pagination]) ?>
            </div>
        </div>
    </div>





<!-- POPUP MODAL CONTACT -->
<div class="modal inmodal contact" id="AdPhotoList" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md "></div>
</div>

<?php
foreach ($userAds as $userAd):

$AdPhotoId = 'AdPhoto'.$userAd['id'];
$urlLogin = Yii::$app->urlManager->createUrl('/site/ad-slider?ad='.$userAd['id']);

$script = <<< JS
//QUICK CREARE CONTACT MODEL
$(document).on('click', '#$AdPhotoId', function () {       
    $('#AdPhotoList').modal('show').find('.modal-dialog').load('$urlLogin');
});

JS;
$this->registerJs($script);

endforeach;
?>

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

