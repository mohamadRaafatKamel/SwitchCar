<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyStrings;
?>
<?php
    $cover =Url::toRoute(["images/shop/products/product-1.jpg"]) ;
    if($model->cover_img){
        $cover =Url::toRoute(["/".$model->cover_img]) ;
    }
    //print_r( $img );//die();
?>

<!--start-->
<div class="movie-item-style-2">
    <img src="<?= $cover  ?>" alt="">
    <div class="mv-item-infor">
        <h6><a href="<?= Url::to(['viewcar', 'id' => $model->cid]); ?>"> <?= $model->cname ?></a></h6>
        <p class="describe"><?= $model->descrp ?></p>
        <p class="run-time">
            <span>اللون : احمر </span>     .
            <span>العجل : 4 </span>    .
            <span>الموديل : 5252</span>
        </p>
        <p> المكان : <a href="#">الرياض</a></p>
    </div>
</div>
<!--end-->

