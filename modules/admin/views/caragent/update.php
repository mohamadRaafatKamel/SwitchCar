<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CarAgent */

$this->title = 'تعديل : ' . $model->caname;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Car Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->caid, 'url' => ['view', 'id' => $model->caid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-agent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
