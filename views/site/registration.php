<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */

$this->title = 'انشاء حساب';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registration">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'method' => 'POST',
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n <div class=\"col-lg-3\">{error}</div>",
            'template' => "<div class=\"col-lg-8\">{error}</div>\n<div class=\"col-lg-3\">{input}</div>\n{label}",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'uphone')->textInput() ?>
        <?= $form->field($model, 'ucity')->textInput() ?>
        
        <div class="form-group">
        </div>
            <?= Html::submitButton('انشاء حساب', ['class' => 'btn btn-main btn-small btn-round']) ?>
    <?php ActiveForm::end(); ?>

</div><!-- registration -->
