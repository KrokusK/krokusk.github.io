<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">


                <div class="content-main">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="thumbnail">
                                <img src="http://avatars.mds.yandex.net/get-direct/196252/C-kJri9Flw-S0RlC2uHK7A/y300" alt="Image">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8 col-lg-8">
                            <div class="animated bounceInTop" >
                                <?php $form = ActiveForm::begin(['id' => 'form-user-profile', 'action' => Yii::$app->urlManager->createUrl('site/profile'), 'enableAjaxValidation' => true, 'validationUrl' => Yii::$app->urlManager->createUrl('site/profile-validate')]); ?>
                                    <?= $form->field($model, 'name')->input('text', ['maxlength' => true])->hint('Пожалуйста, введите ваше Имя')->label('Имя'); ?>
                                    <?= $form->field($model, 'phone')->input('text')->hint('Пожалуйста, введите ваш телефон')->label('Телефон в формате: +7 (999) 999-99-99'); ?>
                                    <?= $form->field($model, 'about')->input('text', ['maxlength' => true])->hint('Пожалуйста, напишите о себе')->label('О себе'); ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-4 col-md-offset-8 col-lg-offset-8">
                            <div class=" view-btn text-left">
                                <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
    </div>
</div>

<?php
$script = <<< JS

   $(document).ready(function () { 
        $("#form-add-app-profile").on('beforeSubmit', function (event) { 
            //alert("test");

            event.preventDefault();            
            var form_data = new FormData($('#form-add-app-profile')[0]);
            $.ajax({
                   url: $("#form-add-app-profile").attr('action'), 
                   dataType: 'JSON',  
                   cache: false,
                   contentType: false,
                   processData: false,
                   data: form_data, //$(this).serialize(),                      
                   type: 'post',                        
                   beforeSend: function() {
                       alert("beforeSend");
                   },
                   success: function(response){                      
                       alert("success");
                       //toastr.success(response.message);
                       //toastr["success"](response.message,response.status); 
                       alert(response.message);
                       $('#addAppFormModel').modal('hide');
                   },
                   complete: function() {
                       alert("complete");
                   },
                   error: function (data) {
                      toastr.warning("","There may a error on uploading. Try again later");    
                      alert("error");
                   }
                });                
            return false;

        });
    });       

JS;
$this->registerJs($script);
?>
