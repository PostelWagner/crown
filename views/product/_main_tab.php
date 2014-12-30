<?php
    use yii\helpers\ArrayHelper;
    use app\models\ProductCategory;
    use app\models\Product;
?>


            <div class="product-form">

                

                <?= $form->field($productModel, 'name')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($productModel, 'description')->textarea(['rows' => 6]) ?>

                <?= $form->field($productModel, 'category_id')->dropDownList(ArrayHelper::map(ProductCategory::getCategories(), 'id', 'name')) ?>
                
                <!-- Button trigger modal -->
                <button type="button" id="modalCr" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  Добавить категорию
                </button>   
                
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                      </div>
                      <div class="modal-body">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="savemodal" type="button" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </div>
                </div>                
                
                <?= $form->field($productModel, 'status')->dropDownList(ArrayHelper::map(Product::getStatus(), 'id', 'name')) ?>

                <?= $form->field($productModel, 'cost')->textInput() ?>

                <?= $form->field($productModel, 'ean')->textInput(['maxlength' => 100]) ?>


            </div>                   