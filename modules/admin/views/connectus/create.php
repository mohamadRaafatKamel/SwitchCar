<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Connectus */

$this->title = 'ارسال للكل';
$this->params['breadcrumbs'][] = ['label' => 'Connectuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connectus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
