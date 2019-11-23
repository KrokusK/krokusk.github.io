<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Сайт объявлений';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-md-10 col-lg-10">
            <div class="content-main">
                <div class="thumbnail">
                    <div class="caption">
                        <table>
                            <tbody>
                            <tr>
                                <td class="text-left align-top col-sm-8 col-md-8 col-lg-8">
                                    <div><?php //Html::encode("{$userAd->header}") ?></div>
                                </td>
                                <td class="text-right align-top col-sm-4 col-md-4 col-lg-4">
                                    &nbsp;&nbsp;
                                    <button class="btn btn-default" style="border-radius: 50%" data-action="prev">&lt;</button>
                                    <button class="btn btn-default" style="border-radius: 50%" data-action="next">&gt;</button>
                                    <button type="button" class="btn btn-default close" data-dismiss="modal">&times;</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="carousel" class="carousel slide" data-ride="false">
                        <!-- Индикаторы -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel" data-slide-to="1"></li>
                            <li data-target="#carousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="https://41.img.avito.st/208x156/2596509641.jpg" alt="...">
                            </div>
                            <div class="item">
                                <img src="https://23.img.avito.st/208x156/6035099023.jpg" alt="...">
                            </div>
                            <div class="item">
                                <img src="https://93.img.avito.st/208x156/5922273093.jpg" alt="...">
                            </div>
                        </div>
                        <!-- Элементы управления
                        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Предыдущий</span>
                        </a>
                        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Следующий</span>
                        </a>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS

    $(function () {
        // метод cycle
        $('.btn').click(function () {
            var action = $(this).attr('data-action');
            if (action.indexOf('to') >= 0) {
                var action = parseInt(action.substring(3))-1;
            }
            $('#carousel').carousel(action);
        });
    });

JS;
$this->registerJs($script);
?>