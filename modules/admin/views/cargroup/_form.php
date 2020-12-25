<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CarGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-group-form">

    <?php $form = ActiveForm::begin(); ?>  

    <?= $form->field($model, 'cgname')->textInput(['maxlength' => true]) ?>
    <p>حدود المجموعه في السعر </p> 
    <p>تحذير : لا يجب ان تشترك مجموعتان في نفس السعر</p>
    <?= $form->field($model, 'price_min')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'price_max')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    <p>الاسعار</p>
    <?= $form->field($model, 'deal_day')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    
    <?= $form->field($model, 'deal_weak')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    
    <?= $form->field($model, 'deal_month')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    
    <?= $form->field($model, 'deal_6month')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    
    <?= $form->field($model, 'deal_year')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    <p>الخدمات</p>
    <?= $form->field($model, 'serv_day')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    
    <?= $form->field($model, 'serv_weak')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    
    <?= $form->field($model, 'serv_month')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    
    <?= $form->field($model, 'serv_6month')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    
    <?= $form->field($model, 'serv_year')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'serv_forever')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'ctid')->dropDownList(\app\models\CarType::getCarTypeList(), ['prompt' => '']); ?>
                   
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descr')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('حفظ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
