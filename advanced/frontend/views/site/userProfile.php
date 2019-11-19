<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">

            <div class="animated bounceInTop" >

                <div class="content-main">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="thumbnail">
                                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']], ['id' => 'form-user-avatar', 'action' => Yii::$app->urlManager->createUrl('site/avatar'), 'enableAjaxValidation' => true, 'validationUrl' => Yii::$app->urlManager->createUrl('site/avatar-validate')]); ?>

                                    <img src="http://avatars.mds.yandex.net/get-direct/196252/C-kJri9Flw-S0RlC2uHK7A/y300" alt="Image">
                                    <?= $form->field($modelUploadOneFile, 'imageFile')->fileInput(['class' => 'form-control', 'src' => $model->avatar])->hint('Пожалуйста, загрузить ваш аватар') ?>

                                    <?= Html::submitButton($isNewRecordUserDesc ? 'Сохранить' : 'Обновить', ['id' => 'button-user-profile', 'class' => $isNewRecordUserDesc ? 'btn btn-default' : 'btn btn-default']) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8 col-lg-8">
                            <?php $form = ActiveForm::begin(['id' => 'form-user-profile', 'action' => Yii::$app->urlManager->createUrl('site/profile'), 'enableAjaxValidation' => true, 'validationUrl' => Yii::$app->urlManager->createUrl('site/profile-validate')]); ?>

                                <?= $form->field($model, 'name')->input(['class' => 'form-control', 'value'=>$model->name, 'maxlength' => true])->hint('Пожалуйста, введите ваше Имя')->label('Имя'); ?>
                                <?php
                                    $params = [
                                        'prompt' => 'Выберите город...',
                                        'options' => [$model->city_id => ["Selected"=>true]]
                                    ];

                                    echo $form->field($model, 'city_id')->dropDownList(ArrayHelper::map($selectCity, 'id', 'city_name'), $params)->hint('Пожалуйста, выберите город')->label('Город');
                                ?>
                                <?= $form->field($model, 'phone')->input(['class' => 'form-control', 'value'=>$model->phone])->hint('Пожалуйста, введите ваш телефон')->label('Телефон в формате: +7 (999) 999-99-99'); ?>
                                <?= $form->field($model, 'about')->textarea(['class' => 'form-control', 'rows' => 3, 'value' => $model->about, 'maxlength' => true])->hint('Пожалуйста, напишите о себе')->label('О себе'); ?>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-2 col-lg-2 col-md-offset-10 col-lg-offset-10">
                            <div class=" view-btn text-left">
                                <?= Html::submitButton($isNewRecordUserDesc ? 'Сохранить' : 'Обновить', ['id' => 'button-user-profile', 'class' => $isNewRecordUserDesc ? 'btn btn-default' : 'btn btn-default']) ?>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="row">
        <br><br>
        <p><?php //echo "User id : ".$model->user_id ?></p>
        <br><br>
        <p><?php //echo "User name : ".var_dump($model->name) ?></p>
        <br><br>
        <p><?php //var_dump($selectCity); ?></p>
        <br><br>
        <p><?php //var_dump(ArrayHelper::map($selectCity, 'id', 'city_name')); ?></p>
    </div>
</div>

<!-- POPUP MODAL CONTACT -->
<div class="modal inmodal contact" id="modalAlert" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md "></div>
</div>

<?php
$script = <<< JS

   $(document).ready(function () { 
        $("#button-user-profile").on('click', function (event) { 
            //alert("test");

            event.preventDefault();            
            var form_data = new FormData($('#form-user-profile')[0]);
            $.ajax({
                   url: $("#form-user-profile").attr('action'), 
                   dataType: 'JSON',  
                   cache: false,
                   contentType: false,
                   processData: false,
                   data: form_data, //$(this).serialize(),                      
                   type: 'post',                        
                   beforeSend: function() {
                       //alert("beforeSend");
                   },
                   success: function(response){                      
                       //alert("success");
                       //toastr.success(response.message);
                       //toastr["success"](response.message,response.status); 
                       //alert(response.message);
                       //message = response.message;
                       if (parseInt(response.status) == 1) {
                           inerHtmlMessage = "<div class=\"alert alert-success\" role=\"alert\">";
                           inerHtmlMessage += "<div class=\"modal-header\">";                           
                           inerHtmlMessage += "<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
                           inerHtmlMessage += "<h3 class=\"modal-title text-left\">Данные переданы!</h3>";
                           inerHtmlMessage += "</div>";
                           inerHtmlMessage += "<h4 class=\"text-center\">" + response.message + "</h4>";
                           inerHtmlMessage += "</div>";                           
                           $('#modalAlert').on('hidden.bs.modal', function () {
                                window.location.href = '/site/index';
                           });
                           $('#modalAlert').modal('show').find('.modal-dialog').html(inerHtmlMessage);
                           
                           //$('#addAppFormModel').modal('hide');
                       } else {
                           inerHtmlMessage = "<div class=\"alert alert-danger\" role=\"alert\">";
                           inerHtmlMessage += "<div class=\"modal-header\">";
                           inerHtmlMessage += "<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
                           inerHtmlMessage += "<h3 class=\"modal-title text-left\">Внимание!</h3>";
                           inerHtmlMessage += "</div>";
                           inerHtmlMessage += "<h4 class=\"text-center\">" + response.message + "</h4>";
                           inerHtmlMessage += "</div>";
                           $('#modalAlert').modal('show').find('.modal-dialog').html(inerHtmlMessage);
                           //$('#addAppFormModel').modal('hide');
                       }
                   },
                   complete: function() {
                       //alert("complete");
                   },
                   error: function (data) {
                      //toastr.warning("","There may a error on uploading. Try again later");    
                      //alert(response.message);
                   }
                });                
            return false;

        });
        
        
    });       

JS;
$this->registerJs($script);
?>
