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

<div class="col-md-4">
    <a href="<?= Url::to(['viewcar', 'id' => $model->cid]); ?>">
        <div class="product-item">
            <div class="product-thumb">
                <img class="img-responsive" src="<?= $cover  ?>" alt="product-img" />
                <div class="preview-meta">
                    <ul>
                        <li>
                            <span  data-toggle="modal" data-target="#product-modal">
                                    <i class="tf-ion-ios-search-strong"></i>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="product-content">
                <h4><?= $model->cname ?></h4>

            </div>
        </div>
    </a>
</div>