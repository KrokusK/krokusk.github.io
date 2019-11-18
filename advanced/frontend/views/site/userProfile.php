<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">

            <div class="animated bounceInTop" >
                <?php $form = ActiveForm::begin(['id' => 'form-user-profile', 'action' => Yii::$app->urlManager->createUrl('site/profile'), 'enableAjaxValidation' => true, 'validationUrl' => Yii::$app->urlManager->createUrl('site/profile-validate')]); ?>

                <div class="content-main">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="thumbnail">
                                <img src="http://avatars.mds.yandex.net/get-direct/196252/C-kJri9Flw-S0RlC2uHK7A/y300" alt="Image">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8 col-lg-8">
                            <?= $form->field($model, 'name')->input('text', ['maxlength' => true])->hint('Пожалуйста, введите ваше Имя')->label('Имя'); ?>
                            <?php
                                //$params = [
                                //    'prompt' => 'Выберите город...'
                                //];
                                //$temp = [
                                //    '1' => 'Северск',
                                //    '2' => 'Томск'
                                //];
                                //$form->field($model, 'city_id')->dropDownList($temp,$params)->hint('Пожалуйста, выберите город')->label('Город');
                            ?>
                            <?= $form->field($model, 'city_id')->dropDownList(\yii\helpers\ArrayHelper::map($selectCity, 'id', 'city_name')); ?>
                            <?= $form->field($model, 'phone')->input('text')->hint('Пожалуйста, введите ваш телефон')->label('Телефон в формате: +7 (999) 999-99-99'); ?>
                            <?= $form->field($model, 'about')->input('text', ['maxlength' => true])->hint('Пожалуйста, напишите о себе')->label('О себе'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-2 col-lg-2 col-md-offset-10 col-lg-offset-10">
                            <div class=" view-btn text-left">
                                <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <p><?php var_dump($selectCity); ?></p>
    </div>
</div>

<!-- POPUP MODAL CONTACT -->
<div class="modal inmodal contact" id="modalAlert" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md "></div>
</div>

<?php
$script = <<< JS

   $(document).ready(function () { 
        $("#form-user-profile").on('beforeSubmit', function (event) { 
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
