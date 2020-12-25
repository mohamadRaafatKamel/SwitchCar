<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Car */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group">
        <?= Html::submitButton('حفظ', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?= $form->field($model, 'cgid')->dropDownList(\app\models\CarGroup::getCarGroupList(), ['prompt' => 'أختر']); ?>

    <?= $form->field($model, 'cname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ctid')->dropDownList(\app\models\CarType::getCarTypeList(), ['prompt' => 'أختر']); ?>
        
    <?= $form->field($model, 'cmodel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cbrand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caid')->dropDownList(\app\models\CarAgent::getCarAgentList(), ['prompt' => 'أختر']); ?>
        
    <?= $form->field($model, 'cbody')->dropDownList(
            ['وكالة' => 'وكالة', 'يوجد رش' => 'يوجد رش', '0' => 'التفاصيل في الوصف'], ['prompt' => 'أختر']
        ); ?>
    <?= $form->field($model, 'elker')->dropDownList(
            ['عادي' => 'عادي', 'توماتيك' => 'توماتيك'], ['prompt' => 'أختر']
        ); ?>
    <?= $form->field($model, 'machen')->dropDownList(
            ['V12' => 'V12', 'V8' => 'V8', 'V6' => 'V6', 'v4' => 'v4'], ['prompt' => 'أختر']
        ); ?>
    <?= $form->field($model, 'fuel')->dropDownList(
            ['بنزين' => 'بنزين', 'ديزل' => 'ديزل', 'هجين' => 'هجين'], ['prompt' => 'أختر']
        ); ?>
    <?= $form->field($model, 'descrp')->textarea() ?>
    
        <div class="container" style="direction: rtl;" >
            <div class="col-lg-2">
                <?= $form->field($model, 'deal[forever]')->checkBox(['data-size'=>'small','label'=>''])->label('دائمة')  ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'deal[year]')->checkBox(['data-size'=>'small','label'=>''])->label('سنه')  ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'deal[6month]')->checkBox(['data-size'=>'small','label'=>''])->label('ستة اشهر')  ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'deal[month]')->checkBox(['data-size'=>'small','label'=>''])->label('شهر')  ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'deal[weak]')->checkBox(['data-size'=>'small','label'=>''])->label('اسبوع')  ?>
            </div>
            <div class="col-lg-1">
                <?= $form->field($model, 'deal[day]')->checkBox(['data-size'=>'small','label'=>''])->label('يوم')  ?>
            </div>
        </div>
        
    <?= $form->field($model, 'deal_forever')->textInput() ?>

    <?= $form->field($model, 'deal_day')->textInput() ?>

    <?= $form->field($model, 'deal_weak')->textInput() ?>

    <?= $form->field($model, 'deal_month')->textInput() ?>

    <?= $form->field($model, 'deal_6month')->textInput() ?>

    <?= $form->field($model, 'deal_year')->textInput() ?>

    
     
    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'cstat')->dropDownList(
            ['0' => 'متاحه', '1' => 'صفقه لم تكتمل بعد', '2' => 'صفقه مكتمله', '5' => 'ايقاف السياره','6' => 'حزف السياره'], ['prompt' => 'أختر']
        ); ?>

    <div class="form-group">
        <?= Html::submitButton('حفظ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
