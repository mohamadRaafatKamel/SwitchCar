<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Connectus */

$this->title = 'Update Connectus: ' . $model->cuid;
$this->params['breadcrumbs'][] = ['label' => 'Connectuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cuid, 'url' => ['view', 'id' => $model->cuid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="connectus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
