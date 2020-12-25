<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CartypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'فئة السياره';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= Html::a('انشاء فئة', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

  <div class="row">
    <div class="col-md-12">
        <div class="dashboard-wrapper user-dashboard">
            <div class="table-responsive">  

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ctid',
            'ctname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
     </div>
    </div>
    </div>
    </div>


</div>
