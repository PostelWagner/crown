<?php
    use yii\helpers\Html;
?>

<div class="product-images-list">
        <table name="product_img_table" class="table table-striped">
        <thead>
               <tr>
                 <th></th>
                 <th>Путь</th>
                 <th>Удалить</th>
                 <th>Поставить как миниатюру</th>
               </tr>
        </thead> 
        <?php        
        $rows = $productModel->productImages;
        foreach ($rows as $row) { ?>  
                    <tr <?php if ($row->id==$productModel->preview_img_id) echo 'class="success"'; ?> prod_img_id="<?= $row->id ?>" class="pr_img_row">  
                        <td class="pr_img_cell preview">
                            <?= Html::img($row->thumb_path) ?>
                        </td> 
                        <td class="pr_img_cell path">
                            <?= Html::label($row->path) ?>
                        </td>                                 
                        <td class="pr_img_del_btn">
                            <button name="prod_img_del" img_id = "<?= $row->id ?>" type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td class="pr_img_sp_btn">
                            <button <?php if ($row->id==$productModel->preview_img_id) echo 'disabled="disabled"'; ?>  name="prod_img_set_preview" img_id = "<?= $row->id ?>" type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                            </button>
                        </td>                        
                    </tr>         
        <?php } ?> 
        </table>
</div>
<?= $form->field($productImages, 'path')->
        textInput(['maxlength' => 1000])->
        widget(mihaildev\elfinder\InputFile::className(),[
                                        'language'      => 'ru',
                                        'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                                        'path'          => 'product'.$productModel->id,            
                                        'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                                        'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                                        'options'       => ['class' => 'form-control', ],
                                        'buttonOptions' => ['class' => 'btn btn-default'],
                                        'multiple'      => false       // возможность выбора нескольких файлов
                                    ]);

?>   

<button name="prod_img_add" product_id="<?= $productModel->id ?>" type="button" class="btn btn-default">
    <span>Добавить</span>
</button> 