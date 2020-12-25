<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConnectusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'الرسائل';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connectus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(isset($_GET['id'])){ ?>
    <h4>ارسال رساله</h4>
    <div>
        <?php echo $this->render('_form', ['model' => $Model]); ?>
    </div>
    <?php } ?>
    <?= Html::a('رساله لكل الاعضاء', ['create'], ['class' => 'btn btn-success']) ?>
    <h4>البحث في الرسائل</h4>
    <div>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    
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

            // 'cuid',
            [
                'label' => Yii::t('app', 'عضو'),
                'value' => function($data){
                    $type = \app\models\Users::find()->where(['uid' => $data->uid  ])->one();
                    return $type->name;
                }
            ],
            'massg',
            [
                'label' => Yii::t('app', 'الحاله'),
                'value' => function($data){
                    switch ($data->custst) {
                        case 0:
                            return 'لم يقرئها العضو';
                            break;
                        case 1:
                            return 'تمت القرائه';
                            break;
                        case 2:
                            return 'لم يقرئها الادمن';
                            break;
                        case 3:
                            return 'تمت القرائه';
                            break;
            
                        default:
                            break;
                    }
                }
            ],
            
            //'custst',
            'cudate',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>
  </div>
    </div>
    </div>
    </div>

</div>
