<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
if (!$productModel->isNewRecord) {
    $this->title = 'Update Product: ' . ' ' . $productModel->name;
    $this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $productModel->name, 'url' => ['view', 'id' => $productModel->id]];
    $this->params['breadcrumbs'][] = 'Update';
} else {
    $this->title = 'Create Product';
    $this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>
       
    <?php $form = ActiveForm::begin(); ?> 
    <div class="form-group">
        <?= Html::submitButton($productModel->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>  

    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id="ProductTabs">
          <li role="presentation" class="active"><a href="#main" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
          <li  role="presentation"><a href="#attributes" aria-controls="profile" role="tab" data-toggle="tab">Attributes</a></li>
          <li  role="presentation"><a href="#cars" aria-controls="messages" role="tab" data-toggle="tab">Cars</a></li>
          <li  role="presentation"><a href="#images" aria-controls="settings" role="tab" data-toggle="tab">Images</a></li>
          <li  role="presentation"><a href="#relatedproducts" aria-controls="settings" role="tab" data-toggle="tab">RelatedProducts</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="main">

            <?= $this->render('_main_tab', [
                'productModel'  => $productModel,
                'form'          => $form,
            ]) ?> 

            </div>
            <div role="tabpanel" class="tab-pane" id="attributes">

            <?= $this->render('_attr_tab', [
                'productModel'  => $productModel,
                'productAttributeModel'  => $productAttributeModel,
            ]) ?> 

            </div>
            <div role="tabpanel" class="tab-pane" id="cars">3</div>
            <div role="tabpanel" class="tab-pane" id="images">

            <?= $this->render('_images_tab', [
                'productModel'  => $productModel,
                'form'          => $form,
                'productImages' => $productImages,
            ]) ?>      

            </div>
            <div role="tabpanel" class="tab-pane" id="relatedproducts">5</div>
        </div>

     <?php ActiveForm::end(); ?>

    </div>

</div>
