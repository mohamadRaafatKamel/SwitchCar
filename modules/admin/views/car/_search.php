<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'cid') ?>


   

<div class="col-md-3">
    <?= $form->field($model, 'cmodel') ?>
</div>

<div class="col-md-3">
    <?php  echo $form->field($model, 'cbrand') ?>
</div>

<div class="col-md-3">
    <?= $form->field($model, 'cgid')->dropDownList(\app\models\CarGroup::getCarGroupList(), ['prompt' => 'كل المجموعات']); ?>
</div>

<div class="col-md-3">
    <?= $form->field($model, 'cname') ?>
</div>
    <?php // echo $form->field($model, 'caid') ?>

    <?php // echo $form->field($model, 'descrp') ?>

    <?php // echo $form->field($model, 'cbody') ?>

    <?php // echo $form->field($model, 'elker') ?>

    <?php // echo $form->field($model, 'machen') ?>

    <?php // echo $form->field($model, 'fuel') ?>

    <?php // echo $form->field($model, 'deal_forever') ?>

    <?php // echo $form->field($model, 'deal_day') ?>

    <?php // echo $form->field($model, 'deal_weak') ?>

    <?php // echo $form->field($model, 'deal_month') ?>

    <?php // echo $form->field($model, 'deal_6month') ?>

    <?php // echo $form->field($model, 'deal_year') ?>

    <?php // echo $form->field($model, 'cgid') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'cstat') ?>

    <?php // echo $form->field($model, 'displaytouser') ?>

    <div class="form-group">
        <?= Html::submitButton('بحث', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
