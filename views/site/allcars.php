<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = 'سيارات متاحه للتبادل';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="col-lg-9 col-md-8 padding-right-30">

        <div class="row">
            <?php           // print_r($carList);die();
            Pjax::begin(['id' => 'allCars', 'enablePushState' => 0]);
            echo ListView::widget([
                'dataProvider' => $carList,
                'options' => [
                    'tag' => null,
                    //'class' => 'list-wrapper',
                    //'id' => 'list-wrapper',
                ],
                'itemOptions' => [
                    'tag' => null,
                ],
                'layout' => "{items}\n<div class='clearfix'></div><div class='pagination-container margin-top-30 margin-bottom-0 text-center'>{summary}\n{pager}</div>",
                'itemView' => '_car_item',
                'emptyText' => 'لا يوجد سيارات ',
            ]);
            Pjax::end();
            ?>
        </div>
    </div>
    
    
</div>
