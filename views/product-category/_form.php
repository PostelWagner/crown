<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ProductCategory;


/* @var $this yii\web\View */
/* @var $model app\models\ProductCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-category-form">

    <?php $form = ActiveForm::begin(['id' => 'create_category',]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php 
        $categories = ArrayHelper::map(ProductCategory::getCategories(), 'id', 'name');
        if (isset($model->id) && $model->id !== null)
            unset($categories[$model->id]);

    ?>
    
    
    <?= $form->field($model, 'parent_id')->dropDownList($categories, ['prompt'=>'']) ?>    

    <?= $form->field($model, 'status')->dropDownList(ArrayHelper::map(ProductCategory::getStatus(), 'id', 'name')) ?>

    
    <?= $form->field($model, 'image')->
            textInput(['maxlength' => 1000])->
            widget(mihaildev\elfinder\InputFile::className(),[
                                            'language'      => 'ru',
                                            'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                                            'path'          => 'category_image',
                                            'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                                            'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                                            'options'       => ['class' => 'form-control', 'rememberLastDir' => false],
                                            'buttonOptions' => ['class' => 'btn btn-default'],
                                            'multiple'      => false       // возможность выбора нескольких файлов
                                        ]);

    ?>    


    <?php if (!$for_ajax): ?> 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php endif; ?>
    
    <?php ActiveForm::end(); ?>

</div>
