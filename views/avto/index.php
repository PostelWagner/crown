<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvtoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avtos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Avto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'brand',
            'model',
            'years',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
