<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Сайт объявлений';
?>
<div class="container-fluid">
        <div class="row">
            <div class="animated bounceInTop" >
                <div class="content-main">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
                        <table>
                            <tbody>
                            <tr>
                                <td class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="thumbnail">

                                        <?php $form = ActiveForm::begin(['id' => 'form-send-ad', 'action' => ($modelUserAd->isNewRecord) ? Yii::$app->urlManager->createUrl('site/create-ad') : Yii::$app->urlManager->createUrl('site/update-ad'), 'validationUrl' => Yii::$app->urlManager->createUrl('site/ad-validate')]); ?>

                                        <?= $form->field($modelUserAd, 'header', ['enableAjaxValidation' => true])->input(['class' => 'form-control', 'value'=>$modelUserAd->header, 'maxlength' => true])->hint('Пожалуйста, введите ваше Имя')->label('Заголовок'); ?>
                                        <?php
                                        $paramsCategory = [
                                            'prompt' => 'Выберите категорию...',
                                            'options' => [$modelUserAd->category_id => ["Selected"=>true]]
                                        ];

                                        echo $form->field($modelUserAd, 'category_id')->dropDownList(ArrayHelper::map($selectCategory, 'id', 'name'), $paramsCategory)->hint('Пожалуйста, выберите категорию')->label('Категория');

                                        echo $form->field($modelUserAd, 'content', ['enableAjaxValidation' => true])->textarea(['class' => 'form-control', 'rows' => 3, 'value' => $modelUserAd->content, 'maxlength' => true])->hint('Пожалуйста, напишите текст объявления')->label('Описание');

                                        $paramsCity = [
                                            'prompt' => 'Выберите город...',
                                            'options' => [$modelUserAd->city_id => ["Selected"=>true]]
                                        ];

                                        echo $form->field($modelUserAd, 'city_id')->dropDownList(ArrayHelper::map($selectCity, 'id', 'city_name'), $paramsCity)->hint('Пожалуйста, выберите город')->label('Город');

                                        echo $form->field($modelUserAd, 'amount', ['enableAjaxValidation' => true])->input(['class' => 'form-control', 'value' => $modelUserAd->amount])->hint('Пожалуйста, напишите цену')->label('Цена');

                                        //echo $form->field($modelUserAd, 'nad')->hiddenInput(['class' => 'form-control', 'value' => $modelUserAd->id]);
                                        ?>
                                        <?= Html::hiddenInput('nad', $modelUserAd->id) ?>
                                        <div class="thumbnail">
                                            <div class="view-btn text-center">
                                                <div class="preview">
                                                    <p>Нет фотографий для загрузки</p>
                                                </div>
                                                <?php echo $form->field($modelPhotoAd, 'imageFiles[]')->fileInput(['class' => 'form-control', 'multiple' => true])->hint('Пожалуйста, загрузите фотографии (не более 3-х фотографий и не более 10 Мб каждая)')->label('Фотографии'); ?>
                                            </div>
                                        </div>

                                        <?php ActiveForm::end(); ?>

                                        <div class="text-right">
                                            <?= Html::submitButton(($modelUserAd->isNewRecord) ? 'Сохранить' : 'Обновить', ['id' => 'button-send-ad', 'class' => ($modelUserAd->isNewRecord) ? 'btn btn-default' : 'btn btn-default']) ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
            <p><?php //var_dump($modelUserAd); ?></p>
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
        $("#button-send-ad").on('click', function (event) { 
            //alert("test");

            event.preventDefault();            
            var form_data = new FormData($('#form-send-ad')[0]);
            $.ajax({
                   url: $("#form-send-ad").attr('action'), 
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
                           inerHtmlMessage += "<br>" + response.message;                           
                           $('#modalAlert').on('hidden.bs.modal', function () {
                                window.location.href = '/site/list-my-ads';
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
        
        //update images 
        var input = document.querySelector('#photoad-imagefiles');
        var preview = document.querySelector('.preview');
    
        //input.style.opacity = 0;
        
        input.addEventListener('change', updateImageDisplay);
        
        function updateImageDisplay() {
            while(preview.firstChild) {
                preview.removeChild(preview.firstChild);
            }
            
            var curFiles = input.files;
            if(curFiles.length === 0) {
                var para = document.createElement('p');
                para.textContent = 'Файлы не выбраны для загрузки';
                preview.appendChild(para);
            } else {
                var list = document.createElement('ol');
                preview.appendChild(list);
                for(var i = 0; i < curFiles.length; i++) {
                    var listItem = document.createElement('li');
                    var para = document.createElement('p');
                    var btnClose = document.createElement('button');
                    btnClose.type = 'button';
                    btnClose.className = 'close';
                    btnClose.textContent = 'x';                         
                    //btnClose.id = 'removeBtn';
                    if(validFileType(curFiles[i])) {
                        para.textContent = 'Имя файла ' + curFiles[i].name + ', размер файла ' + returnFileSize(curFiles[i].size) + '.';
                        var image = document.createElement('img');
                        image.src = window.URL.createObjectURL(curFiles[i]);
                        image.style = 'height:170px; width:auto; max-width:170px;';
                        
                        listItem.appendChild(image); 
                        if (i == 0) listItem.appendChild(btnClose);
                        listItem.appendChild(para);
                
                    } else {
                        para.textContent = 'Имя файла ' + curFiles[i].name + ': Выбраны неверные типы файлов.';
                        listItem.appendChild(para);
                    }      
                    
                    list.appendChild(listItem);                    
                    
                    //var file = document.querySelector('.test'),
                    removeBtn = document.querySelector('.close');
        
                    removeBtn.addEventListener('click', function () {
                        input.value = '';
                        updateImageDisplay();
                    }, false);
                }
            }
        }
        
        var fileTypes = [
            'image/gif',
            'image/jpeg',
            'image/pjpeg',
            'image/png'
        ]
        
        function validFileType(file) {
              for(var i = 0; i < fileTypes.length; i++) {
                    if(file.type === fileTypes[i]) {
                      return true;
                    }
              }
        
          return false;
        }
        
        function returnFileSize(number) {
              if(number < 1024) {
                return number + 'bytes';
              } else if(number > 1024 && number < 1048576) {
                return (number/1024).toFixed(1) + 'KB';
              } else if(number > 1048576) {
                return (number/1048576).toFixed(1) + 'MB';
              }
        }
    });       

JS;
$this->registerJs($script);
?>
