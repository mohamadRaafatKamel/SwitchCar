<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = $car->cname ;
$this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="container">
        <div class="row mt-20">
                <div class="col-md-5">
                        <div class="single-product-slider">
                                <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
                                        <div class='carousel-outer'>
                                                <!-- me art lab slider -->
                                                <?php if($carMedia){ ?>
                                                <div class='carousel-inner '>
                                                    <?php 
                                                        
                                                            $x=1;
                                                            foreach ($carMedia as $media) {
                                                                $type = explode("/", $media['type']);
                                                                if($type[0] == "image"){
                                                    ?>
                                                                    <div class='item <?= ($x)?"active":"" ?>'>
                                                                        <img src='<?=  Url::toRoute([ $media['path'] ])  ?>' width="100%" height="100%" alt='' data-zoom-image="<?= $media['path'] ?>" />
                                                                    </div>
                                                    <?php              
                                                                }elseif ($type[0] == "video") {
                                                    ?>
                                                                    <div class='item <?= ($x)?"active":"" ?>'>
                                                                        <video width="100%" height="100%" controls>
                                                                          <source src="<?= Url::toRoute([ $media['path'] ])  ?>" type="<?= $media['type'] ?>">
                                                                        توجد مشكله في الفيديو
                                                                        </video>
                                                                    </div>
                                                    <?php        
                                                                }
                                                                $x = 0;
                                                            }
                                                        
                                                    ?>
                                                </div>

                                                <!-- sag sol -->
                                                <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                                                        <i class="tf-ion-ios-arrow-left"></i>
                                                </a>
                                                <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                                                        <i class="tf-ion-ios-arrow-right"></i>
                                                </a>
                                                
                                                <?php }else{
                                                            echo 'No Image';
                                                        }
                                                        ?>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="col-md-7">
                        <div class="single-product-details">
                                <h2><?= $car->cname ?></h2>
                                
                                <p class="product-description mt-20">
                                    
                                    <?= $car->descrp ?>
                                </p>
                                <p>
                                    <?= $car->payOrwin($car->cid); ?>
                                </p>
                                
    <?php if(!isset($deal->state) || isset($deal->state)&&$deal->state ==3 || isset($deal->state)&&$deal->state ==6 ): ?>
      <?php if($car->uid != Yii::$app->user->identity->uid){ ?>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'method' => 'POST',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
                                
            <div class="product-size">
                <span>نوع العرض :</span>
                <?= $form->field($deal, 'deal_type')->dropDownList(\app\models\Car::getCarDealList($id), ['prompt' => 'أختر'])->label(false); ?>
            </div>
               
            <?=  Html::submitButton('قدم عرض', ['class' => 'btn btn-main mt-20']) ?>
        <?php ActiveForm::end(); ?>
       <?php  } ?>
    <?php else : ?> 
    
        <?php
            switch ($deal->state) {
                 case 0 :
                     echo 'في انتظار الرد' ;
                     break;
                 case 1 :
                     echo 'الصفقه في قائمه الانتظار' ;
                     break;
                 case 2 :
                     echo 'تم رفض الصفقه من قبل المالك في انتظار عميل اخر يستبدل معك السياره و يقبل المالك بسيارته' ;
                     break;
                 case 3 :
                     echo 'تم الموفقه من قبل المالك' ;
                     break;
                 case 4 :
                     echo 'سيتم التواصل معك من قبل الادمن' ;
                     break;
                 default:
                     break;
             }
        ?>
            <?php 
            
            if($deal->owner_car == Yii::$app->user->identity->uid){
                ?>
                <?php if($deal->state != '4'){ ?>
                    <?= Html::beginForm(['/site/dealchange', 'st' => "4",'id' => $deal->did], 'post')
                    . Html::submitButton('اريد التبديل',['class' => 'btn btn-small ', 'style' => "font-weight: 700;"])
                    . Html::endForm() ?><br/>
                <?php }
                if($deal->state != '1'){ ?>
                <?= Html::beginForm(['/site/dealchange', 'st' => "1",'id' => $deal->did], 'post')
                . Html::submitButton('في قائمه الانتظار',['class' => 'btn btn-small ', 'style' => "font-weight: 700;"])
                . Html::endForm() ?><br/>
                <?php }
                if($deal->state != '2'){ ?>    
                <?= Html::beginForm(['/site/dealchange', 'st' => "2",'id' => $deal->did], 'post')
                . Html::submitButton('لا اريد التبديل',['class' => 'btn btn-small ', 'style' => "font-weight: 700;"])
                . Html::endForm() ?><br/>
                <?php     }            
            }else {
                 
                ?> 
                <br/>
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'method' => 'POST',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
                ]);  ?>
                <?php $deal->deal_type='Remove' ?>
                <?= $form->field($deal, 'deal_type')->hiddenInput()->label(false) ?>
                <?= Html::submitButton('حذف العرض', ['class' => 'btn btn-danger']) ?>
                <?php ActiveForm::end(); ?>
            <?php } ?>
        
    
    <?php endif; ?>
                              
                        </div>
                </div>
        </div>
</div>
