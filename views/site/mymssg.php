<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = 'الرسائل';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <h1><?php // Html::encode($this->title) ?></h1>
    

    <div class="col-md-12">
        <div class="dashboard-wrapper user-dashboard">
            <div class="table-responsive">
                    <table class="table">
                            <thead>
                                    <tr>
                                            <th style="text-align: right">الرساله</th>
                                            <th style="text-align: right">التاريخ</th>
                                            <th></th>
                                    </tr>
                            </thead>
                            <tbody>
            <?php 
            Pjax::begin(['id' => 'allMssgs', 'enablePushState' => 0]);
            echo ListView::widget([
                'dataProvider' => $mssgList,
                'options' => [
                    'tag' => null,
                    //'class' => 'list-wrapper',
                    //'id' => 'list-wrapper',
                ],
                'itemOptions' => [
                    'tag' => null,
                ],
                'layout' => "{items}\n<div class='clearfix'></div><div class='pagination-container margin-top-30 margin-bottom-0 text-center'>{summary}\n{pager}</div>",
                'itemView' => '_mssg_item',
                'emptyText' => 'لا يوجد رسائل بعد',
            ]);
            Pjax::end();
            ?>
                            </tbody>
                    </table>
            </div>
        </div>
    </div>
    
    
</div>
