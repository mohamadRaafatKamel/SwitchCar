<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'الادمن';
$this->params['breadcrumbs'][] = $this->title;
?>

     
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8"> 
                <?php
                if($car->unaccepted){
                    echo Html::a('سيارات جديده', ['/admin/car/index','admnacc'=>'0'], ['class' => 'btn']);
                }
                ?>
            </div>
            <div class="col-md-4">
                <aside class="sidebar">
                    <!-- Widget Category -->
                    <div class="widget widget-category">
                            <h4 class="widget-title">Admin</h4>
                            <ul class="widget-category-list0">
                            <li><a href="<?= Url::toRoute(['/admin/car/index']) ?>">السيارات</a>
                            </li>
                            <li><a href="<?= Url::toRoute(['/admin/cartype/index']) ?>">نوع السيارة</a>
                            </li>
                            <li><a href="<?= Url::toRoute(['/admin/caragent/index']) ?>">الوكيل</a>
                            </li>
                            <li><a href="<?= Url::toRoute(['/admin/cargroup/index']) ?>">مجموعات</a>
                            </li>
                            <li><a href="<?= Url::toRoute(['/admin/users/index']) ?>">الاعضاء</a>
                            </li>
                            <li><a href="<?= Url::toRoute(['/admin/deal/index']) ?>">الصفقات</a>
                            </li>
                            <li><a href="<?= Url::toRoute(['circledeal']) ?>">حلقه من الصفقات</a>
                            </li>
                        </ul>
                    </div> <!-- End category  -->
                </aside>
            </div>
        </div>
    </div>
</div>