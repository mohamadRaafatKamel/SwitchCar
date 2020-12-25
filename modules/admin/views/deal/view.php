<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */

$this->title = $model->did;
$this->params['breadcrumbs'][] = ['label' => 'Deals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="deal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('تغيير الحاله', ['update', 'id' => $model->did], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('رجوع', ['index', 'id' => $model->did], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'did',
//            'user',
            [
                'label' => Yii::t('app', 'مقدم العرض'),
                'value' => function($data){
                    $type = \app\models\Users::find()->where(['uid' => $data->user  ])->one();
                    return $type->name." [ ".$type->email." / ".$type->uphone." ]";
                }
            ],
//            'like_car',
            [
                'label' => Yii::t('app', ' السياره'),
                'value' => function($data){
                    $type = \app\models\Car::find()->where(['cid' => $data->like_car  ])->one();
                    return $type->cname;
                }
            ],
//            'owner_car',
            [
                'label' => Yii::t('app', 'مالك السياره'),
                'value' => function($data){
                    $type = \app\models\Users::find()->where(['uid' => $data->owner_car  ])->one();
                    return $type->name." [ ".$type->email." / ".$type->uphone." ]";
                }
            ],
//            'owner_like',
            'deal_type',
//            'state',
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
        ],
    ]) ?>

</div>
