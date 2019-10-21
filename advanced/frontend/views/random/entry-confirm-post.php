<?php
use yii\helpers\Html;
?>
<p>You have entered the following information:</p>

<ul>
    <?php 
        foreach ($model as $key => $value) {
            echo "<h1>POST request</h1>";
            echo "<li><label>Parametr</label>:".Html::encode($key." => ".$value)."</li>";
        } 
    ?>
</ul>

