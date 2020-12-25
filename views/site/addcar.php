<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
//use kartik\widgets\FileInput;

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
            //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'template' => "<div class=\"col-lg-8\">{error}</div>\n<div class=\"col-lg-3\">{input}</div>\n{label}",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ]
    ]); ?>

        <?= $form->field($car, 'cname')->textInput(['required'=>true]) ?>
        <?= $form->field($car, 'ctid')->dropDownList(\app\models\CarType::getCarTypeList(), ['prompt' => 'أختر']); ?>
        <?= $form->field($car, 'cmodel')->textInput(['required'=>true]) ?>
        <?= $form->field($car, 'cbrand')->textInput(['required'=>true]) ?>
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
        <?= $form->field($car, 'descrp')->textarea(['required'=>true]) ?>
    
    
        <?= $form->field($car, 'deal_forever')->textInput(['type' => 'number','required'=>true]) ?>
        
        <p>اختر نوع الصفقه التي تريدها </p>
        <div class="container" style="direction: ltr;" >
            <div class="col-lg-2">
                <?= $form->field($car, 'deal[forever]')->checkBox(['data-size'=>'small'])->label('دائمة')  ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($car, 'deal[year]')->checkBox(['data-size'=>'small'])->label('سنه')  ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($car, 'deal[6month]')->checkBox(['data-size'=>'small'])->label('ستة اشهر')  ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($car, 'deal[month]')->checkBox(['data-size'=>'small'])->label('شهر')  ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($car, 'deal[weak]')->checkBox(['data-size'=>'small'])->label('اسبوع')  ?>
            </div>
            <div class="col-lg-1">
                <?php $form->field($car, 'deal[day]')->checkBox(['data-size'=>'small'])->label('يوم')  ?>
            </div>
        </div>
        
        
        <?= $form->field($car, 'cover_img')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]); ?>
        
        <?= $form->field($car, 'cover_img')->fileInput(['required'=>true ,'accept'=>'image/*']) ?>
        
        <?= $form->field($media, 'path[]')->fileInput(['multiple'=>true ,'required'=>true ,'accept'=>'image/*'])->label(' صور') ?>
        
        <?= $form->field($media, 'path[]')->fileInput(['required'=>true ,'accept'=>'video/*'])->label(' فيديو')  ?>
    
        <div class="form-group">
            <?= Html::submitButton('أصافة سيارة', ['class' => 'btn btn-main btn-small btn-round' ]) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-addcar -->
