<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'الاعضاء';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

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

            'name',
            'username',
            'password',
            'email:email',
            //'uphone',
            //'ucity',
            //'uimg',
            //'ustat',
            //'udate',
            //'authKey',
            //'accessToken',
                         
            [
              'format' => 'raw',
              'value' => function($data) {
                    return Html::a('رساله', ['/admin/connectus/index','id'=>$data->uid], ['class' => 'btn']);
              }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{Reply}{view}',
            ],
        ],
    ]); ?>
</div>
    </div>
    </div>
    </div>

</div>
