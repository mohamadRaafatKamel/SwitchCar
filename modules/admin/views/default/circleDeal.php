<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'حلقه من الصفقات';
$this->params['breadcrumbs'][] = $this->title;
?>

     
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8"> 
                <?php
                /*
                $count=1;
                foreach ($dealCircle as $Circle) {
                   
                    echo '**Circle '.$count.'**<br/>';
//                    foreach ($Circle as $cir){
//                        $user = app\models\Users::findByID($cir);
//                        echo $user['name'].' [ '.$user['uphone'].' / '.$user['email'].' ]<br/>';
//                    }
                    for ($i = 0; $i < (count($Circle)/2)-1; $i++) {
                        $user = app\models\Users::findByID($Circle[$i]);
                        //$deal = \app\models\Deal::findBy2user($Circle[$i],$Circle[$i+1]);
                        $car  = \app\models\Car::findByID($Circle['car'.$i]);
                        
                        echo $user['name'].' [ '.$user['uphone'].' / '.$user['email'].' ]<br/>'
                        . $car['cname'].'<br/>'
                        . $Circle['type']
                        . '<br/>-----------<br/>';
                    }
                    $count++;
                }
                 * 
                 */
                ?>
               
            </div>
            <div class="col-md-4">
                <aside class="sidebar">
                    <!-- Widget Category -->
                    <div class="widget widget-category">
                            <h4 class="widget-title">Admin</h4>
                            <ul class="widget-category-list0">
                            <li><a href="<?= Url::toRoute(['/admin/cartype/index']) ?>">نوع السيارة</a>
                            </li>
                            <li><a href="<?= Url::toRoute(['/admin/caragent/index']) ?>">الوكيل</a>
                            </li>
                            <li><a href="<?= Url::toRoute(['/admin/cargroup/index']) ?>">مجموعات</a>
                            </li>
                            <li><a href="<?= Url::toRoute(['/admin/car/index']) ?>">السيارات</a>
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