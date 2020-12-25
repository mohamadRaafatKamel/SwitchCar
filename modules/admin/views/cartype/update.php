<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CarType */

$this->title = ' تعديل : ' . $model->ctname;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Car Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ctid, 'url' => ['view', 'id' => $model->ctid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
