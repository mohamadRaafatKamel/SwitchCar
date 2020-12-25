<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConnectusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="connectus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index','id'=>$_GET['id']],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'massg') ?>

    <div class="form-group">
        <?= Html::submitButton('بحث', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
