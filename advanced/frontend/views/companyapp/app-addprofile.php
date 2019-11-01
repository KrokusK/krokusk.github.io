<?php
//use yii\helpers\Html;
use  yii\bootstrap\Modal;

?>
<h1>Company Application Form</h1>

<p>Test message!</p>

<button type="button" class="btn btn-primary" id="add-app">Подать заявку</button>

<!--
<span  class="hand-cursor-pointer quick-add-contact" title="Add Contact"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Contact Via Model</span>
-->

<?php
$url = Yii::$app->urlManager->createUrl('companyapp/addprofile');

$script = <<< JS
//QUICK CREARE CONTACT MODEL
$(document).on('click', '#add-app', function () {       
    $('#addAppFormModel').modal('show').find('.modal-dialog').load('$url');
});

JS;
$this->registerJs($script);
?>

<!-- POPUP MODAL CONTACT -->                            
<div class="modal inmodal contact" id="addAppFormModel" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md "></div>
</div> 
