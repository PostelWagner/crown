<?php

use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'create_product',]); ?>

    <?= $form->field($productModel, 'name')->textInput(['maxlength' => 255]) ?>

<?php
 ActiveForm::end();