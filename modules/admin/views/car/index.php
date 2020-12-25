<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'السيارة';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <!--<p>-->
    <?php
    if($searchModel->unaccepted){    
        echo Html::a('موافقه علي كل الجديد', ['acceptallnew'], ['class' => 'btn btn-success']) ;
    }
    ?>
    <!--</p>-->

    
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

            //'cid',
            'cname',
            //'uid',
            //'ctid',
            'deal_forever',
            'cmodel',
            'cbrand',
            [
                'label' => Yii::t('app', 'المجموعه'),
                'value' => function($data){
                    $type =\app\models\CarGroup::find()->where(['cgid' => $data->cgid  ])->one();
                    return $type->cgname;
                }
            ],
            [
                'label' => Yii::t('app', 'دائم'),
                'value' => function($data){
                    return ($data->deal['forever'])? 'موافق' : 'لا يوافق' ;
                }
            ],
            [
                'label' => Yii::t('app', 'يوم'),
                'value' => function($data){
                    return ($data->deal['day'])? 'موافق' : 'لا يوافق' ;
                }
            ],
            [
                'label' => Yii::t('app', 'اسبوع'),
                'value' => function($data){
                    return ($data->deal['weak'])? 'موافق' : 'لا يوافق' ;
                }
            ],
            [
                'label' => Yii::t('app', 'شهر'),
                'value' => function($data){
                    return ($data->deal['month'])? 'موافق' : 'لا يوافق' ;
                }
            ],
            [
                'label' => Yii::t('app', 'سته اشهر'),
                'value' => function($data){
                    return ($data->deal['6month'])? 'موافق' : 'لا يوافق' ;
                }
            ],
            [
                'label' => Yii::t('app', 'سنة'),
                'value' => function($data){
                    return ($data->deal['year'])? 'موافق' : 'لا يوافق' ;
                }
            ],
            //'caid',
            //'descrp',
            //'cbody',
            //'elker',
            //'machen',
            //'fuel',
            //'cgid',
            // 'date',
            //'cstat',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>
    </div>
    </div>
    </div>
    </div>


</div>
