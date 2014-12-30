

<tr prod_img_id="<?= $product_id ?>">  
    <td class="pr_img_cell preview">
        <img src="<?= $productImages->thumb_path ?>" alt="">                        
    </td> 
    <td class="pr_img_cell path">
        <label><?= $productImages->path ?></label>                        
    </td>                                 
    <td class="pr_img_del_btn">
        <button name="prod_img_del" img_id="<?= $productImages->id ?>" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </button>
    </td>
    <td class="pr_img_sp_btn">
        <button name="prod_img_set_preview" img_id="<?= $productImages->id ?>" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
        </button>
    </td>                        
</tr>