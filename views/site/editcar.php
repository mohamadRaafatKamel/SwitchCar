<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $car app\models\Car */
/* @var $form ActiveForm */

$this->title = 'اضف سيارتك';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-addcar">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'method' => 'POST',
        'options' => [
            'enctype'=> 'multipart/form-data',
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ]
    ]); ?>

        <?= $form->field($car, 'cname') ?>
        <?= $form->field($car, 'ctid')->dropDownList(\app\models\CarType::getCarTypeList(), ['prompt' => 'أختر']); ?>
        <?= $form->field($car, 'cmodel') ?>
        <?= $form->field($car, 'cbrand') ?>
        <?= $form->field($car, 'caid')->dropDownList(\app\models\CarAgent::getCarAgentList(), ['prompt' => 'أختر']); ?>
        <?= $form->field($car, 'cbody')->dropDownList(
                ['وكالة' => 'وكالة', 'يوجد رش' => 'يوجد رش', 'في الوصف' => 'التفاصيل في الوصف'], ['prompt' => 'أختر']
            ); ?>
        <?= $form->field($car, 'elker')->dropDownList(
                ['عادي' => 'عادي', 'توماتيك' => 'توماتيك'], ['prompt' => 'أختر']
            ); ?>
        <?= $form->field($car, 'machen')->dropDownList(
                ['V12' => 'V12', 'V8' => 'V8', 'V6' => 'V6', 'v4' => 'v4'], ['prompt' => 'أختر']
            ); ?>
        <?= $form->field($car, 'fuel')->dropDownList(
                ['بنزين' => 'بنزين', 'ديزل' => 'ديزل', 'هجين' => 'هجين'], ['prompt' => 'أختر']
            ); ?>
        <?= $form->field($car, 'descrp')->textarea() ?>
    
        <p>الصفقه الذي لا تريده اجعله بصفر</p>
        <?= $form->field($car, 'deal_forever') ?>
        <?= $form->field($car, 'deal_day') ?>
        <?= $form->field($car, 'deal_weak') ?>
        <?= $form->field($car, 'deal_month') ?>
        <?= $form->field($car, 'deal_6month') ?>
        <?= $form->field($car, 'deal_year') ?>
        
        
        <?= $form->field($media, 'path[]')->fileInput(['multiple'=>true ,'accept'=>'image/*']) ?>
        
        <?= $form->field($media, 'path[]')->fileInput(['multiple'=>true ,'accept'=>'video/*']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-addcar -->
