<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Connectus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="connectus-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'massg')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('أرسال', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
