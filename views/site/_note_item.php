<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyStrings;
 
    $user = app\models\Users::findByID($model->user);
    $car = app\models\Car::findByID($model->like_car);
?>
<tr>
        
        <td><a href="<?= Url::to(['viewcar', 'id' => $model->like_car]); ?>" class="btn btn-default"><?= $car->cname ?></a ></td>
        <td><?= $model->deal_type ?></td>
        <td><?= $model->date ?></td>
        <td>
            <?php 
            switch ($model->state) {
                case 0:
                    echo '<span class="label label-info">في انتظار الرد</span>';
                    break;
                case 1:
                    echo '<span class="label label-primary">في قائمه الانتظار</span>';
                    break;
                case 2:
                    echo '<span class="label label-warning">لم يقم بالتبادل مباشرتا</span>';
                    break;
                case 3:
                    echo '<span class="label label-success">تم الصفقه</span>';
                    break;
                case 4:
                    echo '<span class="label label-info">في انتظار الادمن سوف يتواصل معك</span>';
                    break;
                case 6:
                    echo '<span class="label label-danger">تم الغاء الصفقه</span>';
                    break;
                default:
                    break;
            }
            ?>
        
        </td>
        <?php if($model->user != Yii::$app->user->identity->id){ ?>
        <td><a href="<?= Url::to(['profile', 'id' => $model->user]); ?>" class="btn btn-default">عرض صفحته الشخصيه</a></td>
        <?php } ?>
</tr>
                        