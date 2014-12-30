<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!-- Button trigger modal -->
        <button type="button" id="myModalPr" class="btn btn-success" data-toggle="modal" data-target="#myModalProductCreate">
          Добавить продукт
        </button>         
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => 'image',
                'value' => function($data) { return $data->previewImg->thumb_path; },
            ],
            'id',
            'name',
            'description:ntext',
            'category_id',
            'status',
            // 'ordering',
            // 'cost',
            // 'ean',
            // 'image',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
<!-- Modal -->
<div class="modal fade" id="myModalProductCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
            <?= $this->render('_mini_product_create', [
                'productModel'  => $productModel,
            ]) ?> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="savemodal3" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div> 