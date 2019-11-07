<div class="modal-content animated bounceInTop" >
    <?php
    $form = ActiveForm::begin(['id' => 'form-add-app-profile', 'enableAjaxValidation' => true, 'validationUrl' => Yii::$app->urlManager->createUrl('companyapp/profilevalidate')]);
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-left">Add Contact</h4>
    </div>
    <div class="modal-body">
        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'company_phone')->textInput(['maxlength' => true]) ?>
        <div class=" view-btn text-left">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
            <button  type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<< JS

   $(document).ready(function () { 
        $("#form-add-app-profile").on('beforeSubmit', function (event) { 
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
                   },
                   success: function(response){                      
                       toastr.success("",response.message); 
                       $('#addAppFormModel').modal('hide');
                   },
                   complete: function() {
                   },
                   error: function (data) {
                      toastr.warning("","There may a error on uploading. Try again later");    
                   }
                });                
            return false;
        });
    });       

JS;
$this->registerJs($script);