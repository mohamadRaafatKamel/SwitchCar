<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CargroupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-group-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

   <div class="col-md-6">
    <?= $form->field($model, 'cgname') ?>
    </div>
    
    <div class="col-md-6">
    <?= $form->field($model, 'city') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('بحث', ['class' => 'btn btn-primary']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
