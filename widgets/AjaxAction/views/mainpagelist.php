<?php


/* @var $this yii\web\View */
/* @var $data */


?>


<div class="vc_row wpb_row vc_row-fluid vc_custom_1401619113429 vc_row">
        <div class="vc_col-sm-12 wpb_column vc_column_container vc_column">
            <div class="wpb_wrapper">
                <div class="article_container bottom-estate_property nobutton">
                    <h2 class="shortcode_title">Наши агенты</h2>  
                   <?php
                   
                   foreach ($data as $worker) {
                     echo $this->render('_worker.php',['worker' => $worker]);
                   }
                   ?>
                </div>
            </div>
        </div>
    </div>

