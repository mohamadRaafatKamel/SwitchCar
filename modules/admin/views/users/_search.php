<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    

<div class="col-md-3">
    <?= $form->field($model, 'email') ?>
</div>
<div class="col-md-3">
    <?= $form->field($model, 'password') ?>
</div>
<div class="col-md-3">
    <?= $form->field($model, 'username') ?>
</div>
<div class="col-md-3">
    <?= $form->field($model, 'name') ?>
</div>
    <?php // echo $form->field($model, 'uphone') ?>

    <?php // echo $form->field($model, 'ucity') ?>

    <?php // echo $form->field($model, 'uimg') ?>

    <?php // echo $form->field($model, 'ustat') ?>

    <?php // echo $form->field($model, 'udate') ?>

    <?php // echo $form->field($model, 'authKey') ?>

    <?php // echo $form->field($model, 'accessToken') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
