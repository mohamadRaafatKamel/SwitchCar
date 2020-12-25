<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = 'صفقاتي';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <h1><?php // Html::encode($this->title) ?></h1>
    

    <div class="col-md-12">
        <ul class="list-inline dashboard-menu text-center">
          <li><a href="<?= Url::toRoute(['/mydeal']) ?>">عروض ارسلتها</a></li>
          <li><a class="active" href="<?= Url::toRoute(['/dealsend']) ?>">عروض مرسله لي</a></li>
        </ul>
        <div class="dashboard-wrapper user-dashboard">
            <div class="table-responsive">
                    <table class="table">
                            <thead>
                                    <tr>
                                            <th style="text-align: right">مرسل العرض</th>
                                            <th style="text-align: right">صفقه مع السياره</th>
                                            <th style="text-align: right">نوع العرض</th>
                                            <th style="text-align: right">التاريخ</th>
                                            <th style="text-align: right">الحاله</th>
                                            <!--<th></th>-->
                                    </tr>
                            </thead>
                            <tbody>
            <?php 
            Pjax::begin(['id' => 'allCars', 'enablePushState' => 0]);
            echo ListView::widget([
                'dataProvider' => $dealList,
                'options' => [
                    'tag' => null,
                    //'class' => 'list-wrapper',
                    //'id' => 'list-wrapper',
                ],
                'itemOptions' => [
                    'tag' => null,
                ],
                'layout' => "{items}\n<div class='clearfix'></div><div class='pagination-container margin-top-30 margin-bottom-0 text-center'>{summary}\n{pager}</div>",
                'itemView' => '_note_item',
                'emptyText' => 'لا يوجد صفقات بعد',
            ]);
            Pjax::end();
            ?>
                            </tbody>
                    </table>
            </div>
        </div>
    </div>
    
    
</div>
