<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CargroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'المجموعات';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('انشاء مجموعه جديده', ['create'], ['class' => 'btn btn-success']) ?>
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

            //'cgid',
            'cgname',
            'price_min',
            'price_max',
            [
                'label' => Yii::t('app', 'فئه'),
                'value' => function($data){
                    $type =\app\models\CarType::find()->where(['ctid' => $data->ctid  ])->one();
                    return $type->ctname;
                }
            ],
            
            'deal_day',
            'deal_weak',
            'deal_month',
            'deal_6month',
            'deal_year',
            
            //'ctid',
            
            //'city',
            //'descr',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
    </div>
    </div>
    </div>

</div>
