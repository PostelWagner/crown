<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attribute-list">
    <?php
            $rows = $productAttributes->getModels();
            foreach ($rows as $row) { 
                 echo Html::label($row->name.'('.$row->measure.')');
                  foreach ($row->productAttrValues as $attr) {
                    echo  Html::input('text', $row->name, $attr['value']);
                } 
            }
    ?>
</div>
