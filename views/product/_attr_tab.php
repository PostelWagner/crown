<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use app\models\ProductAttribute;
?>


<div class="product-attribute-list">
        <table name="product_attr_table" class="table table-striped">
        <thead>
               <tr>
                 <th>Наименование</th>
                 <th>Размерность</th>
                 <th>Значение</th>
                 <th></th>
               </tr>
        </thead>                   
        <?php
                $rows = $productModel->getProductAttributes();
                foreach ($rows as $row) { ?>      
                    <?php if (count($row->getValuesForProduct($productModel->id))==0): ?>
                        <tr prod_attr_id="0" class="pr_attribute_row">  
                           <td class="pr_attribute_cell attr_name">
                               <?= Html::label($row->name) ?>
                           </td> 
                           <td class="pr_attribute_cell attr_measure">
                               <?= Html::label($row->measure) ?>
                           </td>                                 
                           <td class="pr_attribute_cell attr_value">
                                   <?=  Html::input('text', 'ProductNewAttr['.$row->id.']') ?>
                           </td>
                           <td class="pr_attribute_del_btn">
                               <button disabled="disabled" name="prod_attr_del" prod_attr_id = "<?= $attr->id ?>" type="button" class="btn btn-default">
                                   <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                               </button>
                           </td>
                       </tr>                                 
                    <?php endif; ?>
                    <?php  foreach ($row->getValuesForProduct($productModel->id) as $attr) { ?>
                    <tr prod_attr_id="<?= $attr->id ?>" class="pr_attribute_row">  
                        <td class="pr_attribute_cell attr_name">
                            <?= Html::label($row->name) ?>
                        </td> 
                        <td class="pr_attribute_cell attr_measure">
                            <?= Html::label($row->measure) ?>
                        </td>                                 
                        <td class="pr_attribute_cell attr_value">
                                <?=  Html::input('text', $attr->formName().'['.$attr->id.'][value]', $attr['value']) ?>
                        </td>
                        <td class="pr_attribute_del_btn">
                            <button name="prod_attr_del" prod_attr_id = "<?= $attr->id ?>" type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                        </td>
                    </tr>                                                                
                    <?php } ?>                                                                 
                <?php }                        
        ?>
        </table>

        <?= Html::activeDropDownList($productAttributeModel, 'id', ArrayHelper::map(ProductAttribute::getAllAttributes(), 'id', 'name')) ?>

        <button name="prod_attr_add" product_id="<?= $productModel->id ?>" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>                
        <p></p>
        <p></p>
        <button type="button" id="modalAttr" product_id="<?= $productModel->id ?>" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
          Создать новый атрибут
        </button> 


        <!-- Modal -->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <button id="savemodal2" type="button" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>                  

</div>