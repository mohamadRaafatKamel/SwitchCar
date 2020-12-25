<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CarGroup */

$this->title = 'Update Car Group: ' . $model->cgid;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Car Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cgid, 'url' => ['view', 'id' => $model->cgid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
