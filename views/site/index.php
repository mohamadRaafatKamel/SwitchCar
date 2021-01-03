<?php

/* @var $this yii\web\View */

$this->title = 'الرئيسية';

use yii\helpers\Html; 
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ListView;
?>

<div class="col-md-8 col-sm-12 col-xs-12">



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

    <div class="topbar-filter">
        <div class="pagination2">
            <a class="active" href="#">1</a>
            <a href="#">2</a>
            <a href="#"><i class="ion-arrow-left-b"></i></a>
        </div>
    </div>
</div>


<div class="col-md-4 col-sm-12 col-xs-12">
    <div class="sidebar">
        <div class="celebrities">
            <h4 class="sb-title">موديلات اخري</h4>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava1.jpg" alt=""></a></div>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava2.jpg" alt=""></a></div>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava2.jpg" alt=""></a></div>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava1.jpg" alt=""></a></div>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava2.jpg" alt=""></a></div>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava2.jpg" alt=""></a></div>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava1.jpg" alt=""></a></div>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava2.jpg" alt=""></a></div>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava2.jpg" alt=""></a></div>
            <div class="celeb-item"><a href="#"><img src="images/uploads/ava2.jpg" alt=""></a></div>
        </div>
    </div>
</div>



