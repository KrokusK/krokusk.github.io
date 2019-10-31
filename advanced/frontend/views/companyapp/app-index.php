<?php
//use yii\helpers\Html;
?>
<h1>Company Application Form</h1>

<p>Test message!</p>

<span  class="hand-cursor-pointer quick-add-contact" title="Add Contact"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Contact Via Model</span>

<?php
$url = Yii::$app->urlManager->createUrl('modulesname/controllername/add-contact');

$script = <<< JS
//QUICK CREARE CONTACT MODEL
$(document).on('click', '.quick-add-contact', function () {       
    $('#addContactFormModel').modal('show').find('.modal-dialog').load('$url');
});

JS;
$this->registerJs($script);
?>

<!-- POPUP MODAL CONTACT -->                            
<div class="modal inmodal contact" id="addContactFormModel" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md "></div>
</div> 
