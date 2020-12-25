<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CarGroup */

$this->title = $model->cgname;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Car Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="car-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('تعديل', ['update', 'id' => $model->cgid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('مسح', ['delete', 'id' => $model->cgid], [
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
            'cgid',
            'cgname',
            'price_min',
            'price_max',
            'deal_day',
            'deal_weak',
            'deal_month',
            'deal_6month',
            'deal_year',
            'serv_forever',
            'serv_day',
            'serv_weak',
            'serv_month',
            'serv_6month',
            'serv_year',
            'ctid',
            'city',
            'descr',
        ],
    ]) ?>

</div>
