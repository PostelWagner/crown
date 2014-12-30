<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attribute-form">

    <?php $form = ActiveForm::begin(['id' => 'create_attribute',]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'measure')->textInput(['maxlength' => 100]) ?>


    
    <?php if (!$for_ajax): ?>         
    <?= $form->field($model, 'category')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php else: ?>
        <?= Html::label('Использовать параметр для всех товаров в категории?') ?>        
        <?= Html::checkbox('attrInCat', $checked, $options); ?>   
    <?php endif; ?>
    
    <?php ActiveForm::end(); ?>

</div>
