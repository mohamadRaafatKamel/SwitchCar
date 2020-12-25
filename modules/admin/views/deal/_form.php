<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php /* $form->field($model, 'user')->textInput() ?>

    <?= $form->field($model, 'like_car')->textInput() ?>

    <?= $form->field($model, 'owner_car')->textInput() ?>

    <?= $form->field($model, 'owner_like')->textInput() ?>

    <?= $form->field($model, 'deal_type')->textInput(['maxlength' => true])*/ ?>

    <?php // $form->field($model, 'state')->textInput() ?>
    <?= $form->field($model, 'state')->dropDownList(
            ['0' => 'انتظار رد', 
                '1' => 'قائمه الانتظار',
                '2' => 'رفض',
                '3' => 'صفقه تمت',
                '4' => 'انتظار الادمن',
                '6' => 'تم الغاء',
                ], ['prompt' => 'أختر']
        ); ?>

    <?php // $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
