<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */

$this->title = 'حسابي';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-editprofile">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'method' => 'POST',
        'options' => [
            'enctype'=> 'multipart/form-data',
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ]
    ]); ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'uphone') ?>
        <?= $form->field($model, 'ucity') ?>
    
    
        <?= $form->field($model, 'uimg')->fileInput() ?>
    
    <br/><br/>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-editprofile -->
