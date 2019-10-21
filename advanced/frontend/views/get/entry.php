<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>GET request</h1>

<?php $form = ActiveForm::begin(['method' => 'get']); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
