<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DealSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'الصفقات';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
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

//            'did',
//            'user',
            [
                'label' => Yii::t('app', 'مقدم الطلب'),
                'value' => function($data){
                    $type = \app\models\Users::find()->where(['uid' => $data->user  ])->one();
                    return $type->name;
                }
            ],
//            'like_car',
            [
                'label' => Yii::t('app', 'السياره'),
                'value' => function($data){
                    $type = \app\models\Car::find()->where(['cid' => $data->like_car  ])->one();
                    return $type->cname;
                }
            ],
            //'owner_car',
            [
                'label' => Yii::t('app', 'صاحب السياره'),
                'value' => function($data){
                    $type = \app\models\Users::find()->where(['uid' => $data->owner_car  ])->one();
                    return $type->name;
                }
            ],
//            'owner_like',
            'deal_type',
            //'state',
            [
                'label' => Yii::t('app', 'الحاله'),
                'value' => function($data){
                    switch ($data->state) {
                        case 0:
                            return 'انتظار رد';
                            break;
                        case 1:
                            return 'قائمه الانتظار';
                            break;
                        case 2:
                            return 'رفض';
                            break;
                        case 3:
                            return 'صفقه تمت';
                            break;
                        case 4:
                            return 'انتظار الادمن';
                            break;
                        case 6:
                            return 'تم الغاء';
                            break;
                        default:
                            break;
                    }
                }
            ],
            'date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>

 </div>
    </div>
    </div>
    </div>
</div>
