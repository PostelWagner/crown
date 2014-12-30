<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Avto */

$this->title = 'Create Avto';
$this->params['breadcrumbs'][] = ['label' => 'Avtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
