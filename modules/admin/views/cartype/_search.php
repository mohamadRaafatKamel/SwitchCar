<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CartypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'ctid') ?>
    
    <?= $form->field($model, 'ctname') ?>
    <?= Html::submitButton('بحث', ['class' => 'btn btn-primary']) ?>
    
   

    <?php ActiveForm::end(); ?>

</div>
