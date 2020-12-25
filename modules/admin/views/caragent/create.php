<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CarAgent */

$this->title = 'اضافة وكيل';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Car Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-agent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
