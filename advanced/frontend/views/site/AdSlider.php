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
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Пожалуйста, заполните следующие поля для входа:</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <div id="carousel" class="carousel slide" data-ride="carousel">
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
                    <!-- Элементы управления -->
                    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Предыдущий</span>
                    </a>
                    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Следующий</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
