<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = 'الصفحه الشخصيه';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <!--          
        <ul class="list-inline dashboard-menu text-center">
          <li><a href="dashboard.html">Dashboard</a></li>
          <li><a href="order.html">Orders</a></li>
          <li><a href="address.html">Address</a></li>
          <li><a class="active"  href="profile-details.html">Profile Details</a></li>
        </ul>-->

        <div class="dashboard-wrapper dashboard-user-profile">
          <div class="media">
            <div class="pull-left text-center" href="#">
              <img class="media-object user-img" src="<?= ($user->uimg)? Url::toRoute([$user->uimg])  : Url::toRoute(['/images/avater.jpg']) ?>" alt="Image">
              <!--<a href="#x" class="btn btn-transparent mt-20">Change Image</a>-->
            </div>
            <div class="media-body">
              <ul class="user-profile-list">
                <li><span>الاسم :</span><?= $user->name ?></li>
                <li><span>المدينه :</span><?= $user->ucity ?></li>

              </ul>
            </div>
          </div>
        </div>
    </div>
</div>

<!--d-->
<br/><br/><br/>
<div class="row">
    
    <?php 
        Pjax::begin(['id' => 'CarProfile', 'enablePushState' => 0]);
        echo ListView::widget([
            'dataProvider' => $mycarList,
            'options' => [
                'tag' => null,
                //'class' => 'list-wrapper',
                //'id' => 'list-wrapper',
            ],
            'itemOptions' => [
                'tag' => null,
            ],
            'layout' => "{items}\n<div class='clearfix'></div><div class='pagination-container margin-top-30 margin-bottom-0 text-center'>{summary}\n{pager}</div>",
            'itemView' => '_car_item',
            'emptyText' => 'لا يوجد سيارات  ',
        ]);
        Pjax::end();
    ?>
			
    
</div>
