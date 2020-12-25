<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Car */

$this->title = $model->cname;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="car-view">

      
    <div class="row">
        <div class="col-md-12">
            <div class="dashboard-wrapper dashboard-user-profile">
              <div class="media">
                <div class="pull-left text-center" href="#">
                    <img class="media-object user-img" src="<?= ($model->cover_img)? Url::toRoute(['/'.$model->cover_img])  : Url::toRoute(['/images/avater.jpg']) ?>" alt="Image">
                </div>
                <div class="media-body">
                  <ul class="user-profile-list">
                    <li><h1><?= Html::encode($this->title) ?></h1></li>
                    <li><?= Html::a('تعديل', ['update', 'id' => $model->cid], ['class' => 'btn btn-primary']) ?></li>
                    <li><?= Html::a('رجوع', ['index'], ['class' => 'btn btn-success']) ?></li>
                    <?php
                    if(!$model->adminacc){    
                        echo"<li>". Html::a('الموافقه', ['acceptallnew'], ['class' => 'btn btn-success']) ."</li>";
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
        </div>
    </div>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cid',
            'cname',
            //'uid',
            [
                'label' => Yii::t('app', 'مالك السياره'),
                'value' => function($data){
                    $type = \app\models\Users::find()->where(['uid' => $data->uid  ])->one();
                    return $type->name;
                }
            ],
//            'ctid',
            [
                'label' => Yii::t('app', 'فئه'),
                'value' => function($data){
                    $type =\app\models\CarType::find()->where(['ctid' => $data->ctid  ])->one();
                    return $type->ctname;
                }
            ],
            'cmodel',
            'cbrand',
            //'caid',
            [
                'label' => Yii::t('app', 'الوكيل'),
                'value' => function($data){
                    $type = \app\models\CarAgent::find()->where(['caid' => $data->caid  ])->one();
                    return $type->caname;
                }
            ],
            'descrp',
            'cbody',
            'elker',
            'machen',
            'fuel',
            [
                'label' => Yii::t('app', 'دائم'),
                'value' => function($data){
                    return ($data->deal['forever'])? 'لا موافق':'يوافق';
                }
            ],
            [
                'label' => Yii::t('app', 'يوم'),
                'value' => function($data){
                    return ($data->deal['day'])? 'لا موافق':'يوافق';
                }
            ],
            [
                'label' => Yii::t('app', 'اسبوع'),
                'value' => function($data){
                    return ($data->deal['weak'])? 'لا موافق':'يوافق';
                }
            ],
            [
                'label' => Yii::t('app', 'شهر'),
                'value' => function($data){
                    return ($data->deal['month'])? 'لا موافق':'يوافق';
                }
            ],
            [
                'label' => Yii::t('app', 'سته اشهر'),
                'value' => function($data){
                    return ($data->deal['6month'])? 'لا موافق':'يوافق';
                }
            ],
            [
                'label' => Yii::t('app', 'سنة'),
                'value' => function($data){
                    return ($data->deal['year'])? 'لا موافق':'يوافق';
                }
            ],
            'deal_forever',
            'deal_day',
            'deal_weak',
            'deal_month',
            'deal_6month',
            'deal_year',
            //'cgid',
            [
                'label' => Yii::t('app', 'المجموعه'),
                'value' => function($data){
                    $type = \app\models\CarGroup::find()->where(['cgid' => $data->cgid  ])->one();
                    return $type->cgname;
                }
            ],
            'date',
            //'cstat',
            [
                'label' => Yii::t('app', 'الحاله'),
                'value' => function($data){
                    
                    switch ($data->cstat) {
                        case 0:
                            return 'متاحه';
                            break;
                        case 1:
                            return 'صفقه لم تكتمل بعد';
                            break;
                        case 2:
                            return 'صفقه مكتمله';
                            break;
                        case 5:
                            return 'متوقفه';
                            break;
                        case 6:
                            return 'محذوفه';
                            break;

                        default:
                            break;
                    }
                }
            ],
            //'displaytouser',
            
        ],
    ]) ?>

</div>
