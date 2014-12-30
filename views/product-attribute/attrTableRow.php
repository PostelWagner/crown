

            <tr prod_attr_id="<?= $productAttrValue->id ?>" class="pr_attribute_row">  
                <td class="pr_attribute_cell attr_name">
                    <label><?= $productAttrValue->attr->name ?></label>                                </td> 
                <td class="pr_attribute_cell attr_measure">
                    <label><?= $productAttrValue->attr->measure ?></label>                                </td>                                 
                <td class="pr_attribute_cell attr_value">
                        <input type="text" name="<?= $productAttrValue->formName() ?>[<?= $productAttrValue->id ?>][value]" value="<?= $productAttrValue->value ?>">                                </td>
                <td class="pr_attribute_del_btn">
                    <button name="prod_attr_del" attr_id="<?= $productAttrValue->id ?>" type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>