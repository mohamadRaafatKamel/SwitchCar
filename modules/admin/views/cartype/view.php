<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CarType */

$this->title = $model->ctname;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Car Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="car-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('تعديل', ['update', 'id' => $model->ctid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('مسح', ['delete', 'id' => $model->ctid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('رجوع', ['index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ctid',
            'ctname',
        ],
    ]) ?>

</div>
