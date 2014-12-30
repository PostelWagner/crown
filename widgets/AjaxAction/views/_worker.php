<?php
/* @var $this yii\web\View */
/* @var $worker app\models\Worker */    
?>
<div class = "agent_unit agent_unit_featured" data-link = "http://wpresidence.net/agents/michael-rutter/">
    <div class = "agent-unit-img-wrapper">
        <img src = "<?= $worker->photo; ?>" class = "lazyload img-responsive wp-post-image" alt = "260" data-original = "<?= $worker->photo; ?>" height = "163" width = "265">
        <div class = "listing-cover"></div>
        <a href = "http://wpresidence.net/agents/michael-rutter/"> <span class = "listing-cover-plus">+</span></a>
    </div>
    <div class = "">
        <h4> <a href = "http://wpresidence.net/agents/michael-rutter/"><?= $worker->name.' '.$worker->surname; ?></a></h4>
        <div class = "agent_position"><?= $worker->post; ?></div><div class = "agent_featured_details">
            <div class = "agent_detail"><i class = "fa fa-phone"></i>
                <?= $worker->phone; ?>
            </div>
            <div class = "agent_detail">
                <i class = "fa fa-mobile"></i>
                <?= $worker->mobilephone; ?>
            </div>
            <div class = "agent_detail">
                <i class = "fa fa-envelope-o"></i>
               <?= $worker->email; ?>
            </div>
        </div>
        <div class = "featured_agent_notes">
            <?= mb_substr($worker->description,0,150).'...'; ?>
        </div>
       <!-- <a class = "wpb_button_a see_my_list_featured" href = "http://wpresidence.net/agents/michael-rutter/" target = "_blank">
            <span class = "wpb_button  wpb_wpb_button wpb_regularsize wpb_mail  vc_button">Объекты</span>
        </a>
       -->
    </div>
</div>