<?php
use yii\helpers\Html;
?>
<h1>POST request</h1>

<p>You have entered the following information:</p>

<ul>
    <?php 
        foreach ($model as $key => $value) {
            echo "<li><label>Parameter</label>:".Html::encode($key." => ".$value)."</li>";
        } 
    ?>
</ul>

