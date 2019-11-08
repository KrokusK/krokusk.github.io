<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-content animated bounceInTop" >


            <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => Yii::$app->urlManager->createUrl('/site/login-modal')]); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Пожалуйста, заполните следующие поля для входа:</p>
            </div>
            <div class="modal-body">

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    Если вы забыли свой пароль, вы можете <?= Html::a('сбросить пароль', ['site/request-password-reset']) ?>.
                    <br>
                    Отправить новое письмо для верификации почты? <?= Html::a('Отправить', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
</div>
