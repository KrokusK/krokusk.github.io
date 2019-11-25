<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Сайт объявлений';
?>
<div class="container-fluid">
    <div class="thumbnail">
        <div class="row">
            <div class="col-md-12 col-lg-12">

                <div class="animated bounceInTop" >

                    <div class="thumbnail">

                    <div class="content-main">
                        <?php $form = ActiveForm::begin(['id' => 'form-user-profile', 'action' => Yii::$app->urlManager->createUrl('site/profile'), 'validationUrl' => Yii::$app->urlManager->createUrl('site/profile-validate')]); ?>

                            <div class="col-md-offset-2 col-lg-offset-2">

                                <div class="thumbnail">

                                    <table><tbody><tr><td class="col-sm-6 col-md-12 col-lg-12"><div class="thumbnail">

                                    <div class="col-sm-6 col-md-8 col-lg-8"> 

                                        <div class="row">

                                            <?php //$form = ActiveForm::begin(['id' => 'form-user-profile', 'action' => Yii::$app->urlManager->createUrl('site/profile'), 'enableAjaxValidation' => true, 'validationUrl' => Yii::$app->urlManager->createUrl('site/profile-validate')]); ?>

                                                <?= $form->field($model, 'name', ['enableAjaxValidation' => true])->input(['class' => 'form-control', 'value'=>$model->name, 'maxlength' => true])->hint('Пожалуйста, введите ваше Имя')->label('Имя'); ?>
                                                <?php
                                                    $params = [
                                                        'prompt' => 'Выберите город...',
                                                        'options' => [$model->city_id => ["Selected"=>true]]
                                                    ];

                                                    echo $form->field($model, 'city_id')->dropDownList(ArrayHelper::map($selectCity, 'id', 'city_name'), $params)->hint('Пожалуйста, выберите город')->label('Город');
                                                ?>
                                                <?= $form->field($model, 'phone', ['enableAjaxValidation' => true])->input(['class' => 'form-control', 'value'=>$model->phone])->hint('Пожалуйста, введите ваш телефон')->label('Телефон в формате: +7 (999) 999-99-99'); ?>
                                                <?= $form->field($model, 'about', ['enableAjaxValidation' => true])->textarea(['class' => 'form-control', 'rows' => 3, 'value' => $model->about, 'maxlength' => true])->hint('Пожалуйста, напишите о себе')->label('О себе'); ?>
                                            <?php //ActiveForm::end(); ?>

                                        </div>
                                        <div class="row">

                                            <div class="thumbnail">
                                                <div class=" view-btn text-center">
                                                    <img src="<?= Html::encode("{$model->avatar}") ?>" alt="Image">
                                                    <?php echo $form->field($model, 'imageFile')->fileInput(['class' => 'form-control'])->hint('Пожалуйста, загрузить ваш аватар')->label('Аватар'); ?>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                            </div></td><td></td></tr></tbody></table>

                                </div>

                            </div>

                        <?php ActiveForm::end(); ?>
                        <div class="row">
                            <div class="col-sm-2 col-md-2 col-lg-2 col-md-offset-8 col-lg-offset-8">
                                <div class=" view-btn text-left">
                                    <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['id' => 'button-user-profile', 'class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
                                </div>
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
                   enctype: 'multipart/form-data',
                   data: form_data, //$(this).serialize(), 
                   //data: data, //$(this).serialize(),                     
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
