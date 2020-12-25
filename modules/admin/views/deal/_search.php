<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DealSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
    <?php // $form->field($model, 'did') ?>
        <div class="col-md-3">
    <?php $form->field($model, 'user') ?>
            
            <?php // $form->field($model, 'user')->dropDownList(\app\models\CarGroup::getCarGroupList(), ['prompt' => 'اختر .. ']); ?>
     
        </div>
        <div class="col-md-3">
    <?php $form->field($model, 'like_car') ?>
</div>
    <?php // $form->field($model, 'owner_car') ?>

    <?php // $form->field($model, 'owner_like') ?>
            <div class="col-md-3">
    <?php $form->field($model, 'deal_type') ?>
                </div>
                <div class="col-md-3">
    <?php //echo $form->field($model, 'state') ?>
    <?= $form->field($model, 'state')->dropDownList(
            ['0' => 'انتظار رد', 
                '1' => 'قائمه الانتظار',
                '2' => 'رفض',
                '3' => 'صفقه تمت',
                '4' => 'انتظار الادمن',
                '6' => 'تم الغاء',
                ], ['prompt' => 'أختر']
        ); ?>
</div>
    <?php // echo $form->field($model, 'date') ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('بحث', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
