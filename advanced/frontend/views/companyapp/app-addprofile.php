<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Companyapp;
?>

<div class="modal-content animated bounceInTop" >
    <?php
    	$form = ActiveForm::begin(['id' => 'form-add-app-profile', 'action' => Yii::$app->urlManager->createUrl('companyapp/profile'), 'enableAjaxValidation' => true, 'validationUrl' => Yii::$app->urlManager->createUrl('companyapp/profilevalidate')]);
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-left">Профиль компании</h4>
    </div>
    <div class="modal-body">
        <?= $form->field($model, 'company_name')->input('text', ['maxlength' => true])->hint('Пожалуйста, введите Имя компании')->label('Имя компании'); ?>
        <?= $form->field($model, 'company_address')->input('text', ['maxlength' => true])->hint('Пожалуйста, введите Адрес компании')->label('Адрес компании'); ?>
        <?= $form->field($model, 'company_phone')->input('text')->hint('Пожалуйста, введите Телефон компании')->label('Телефон компании в формате: +7 (999) 999-99-99'); ?>
        <?= $form->field($model, 'company_site')->input('text', ['maxlength' => true])->hint('Пожалуйста, введите Сайт компании')->label('Сайт компании'); ?>


        <div class=" view-btn text-left">
            <?= Html::submitButton($model->isNewRecord ? 'Далее (Create)' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
            <button  type="button" class="btn btn-primary" data-dismiss="modal">Отмена</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
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
                       toastr.success("",response.message); 
                       $('#form-add-app-profile').modal('hide');
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
