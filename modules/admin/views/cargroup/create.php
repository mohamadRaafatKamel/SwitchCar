<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CarGroup */

$this->title = 'انشاء مجموعة';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Car Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
