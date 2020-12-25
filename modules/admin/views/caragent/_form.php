<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CarAgent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-agent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'caname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('حفظ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
