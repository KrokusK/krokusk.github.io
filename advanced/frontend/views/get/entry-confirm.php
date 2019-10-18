<?php
use yii\helpers\Html;
?>
<p>You have entered the following information:</p>

<ul>
    <?php 
        foreach ($model as $key => $value) {
            echo "<li><label>Name</label>:".Html::encode($key." => ".$value)."</li>";
        } 
    ?>
</ul>

