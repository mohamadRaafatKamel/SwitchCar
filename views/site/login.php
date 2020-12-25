<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'تسجيل الدخول';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    
    <h2 class="text-center"><?= Html::encode($this->title) ?></h2>

<!--    <p>Please fill out the following fields to login:</p>-->
    <div class="block text-center">
    <?php $form = ActiveForm::begin([
        //'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "<div class=\"col-lg-8\">{error}</div>\n<div class=\"col-lg-3\">{input}</div>\n{label}",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true ])->input('text', ['placeholder' => "اسم المستخدم"])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => "كلمه المرور"])->label(false)?>
        
        

        <div class="form-group">
            
            <div class="col-lg-offset-1 col-lg-11">
                <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->label('تذكرني') ?>
                <?= Html::submitButton('تسجيل الدخول', ['class' => 'btn btn-main btn-small btn-round', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
    
</div>
