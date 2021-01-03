<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">  
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Car For every day">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="keywords" content="Car swish">
    <meta name="author" content="DevMRM">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode('سياره كل يوم | '.$this->title) ?></title>
    <?php $this->head() ?>
    
    <!-- Favicon|Logo in title -->
<!--    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />-->

</head>
<body>
<?php $this->beginBody() ?>

<!-- BEGIN | Header -->
<header class="ht-header">
    <div class="container">
        <nav class="navbar navbar-default navbar-custom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header logo">
                <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <div id="nav-icon1">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <a href="<?= Url::toRoute(['/']) ?>">
                    <img class="logo" src="<?= Url::toRoute(['images/logo1.png']) ?>" alt="" width="119" height="58">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav flex-child-menu menu-left">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li><a href="<?= Url::toRoute(['/']) ?>">الرئيسية</a></li>
                    <li><a href="<?= Url::toRoute(['/dealcars']) ?>">صفقات جاهزه</a></li>
                    <li class="dropdown first">
                        <a class="btn dropdown-toggle lv1" data-toggle="dropdown">
                            رسائل
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="#">رسائل خاصة</a></li>
                            <li><a href="#">رسائل جماعية</a></li>
                            <li><a href="#">رسائل الاداره</a></li>
                        </ul>
                    </li>
                    <?php if(! Yii::$app->user->isGuest ){ ?>
                        <?php if(Yii::$app->user->identity->ustat == 5){ ?>
                            <li class="dropdown "><a href="<?= Url::toRoute(['/admin/default/index']) ?>">Admin</a></li>
                        <?php }
                    } ?>


                </ul>
                <ul class="nav navbar-nav flex-child-menu menu-right">
                    <?php if(Yii::$app->user->isGuest ): ?>
                        <li class="loginLink0"><a href="<?= Url::toRoute(['/login']) ?>">تسجيل دخول</a></li>
                        <li class="btn signupLink0"><a href="<?= Url::toRoute(['/registration']) ?>">حساب جديد</a></li>
                    <?php else : ?>
                        <li class="dropdown first">
                            <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown">

<!--                                <i class="fa fa-angle-down" aria-hidden="true"></i>-->
                                <?= Yii::$app->user->identity->username ?> <i class="tf-ion-android-person"></i>
                            </a>
                            <ul class="dropdown-menu level1">
                                <li><a href="<?= Url::toRoute(['/mydeal']) ?>">
                                        <?= ($dcount = \app\models\Users::getDealCount() )?'<span class="badge badge-danger">'. $dcount.'</span>' : "" ?>
                                        صفقاتي</a></li>
                                <li><a href="<?= Url::toRoute(['/mymssg']) ?>">
                                        <?= ($dcount = \app\models\Users::getMassgCount() )?'<span class="badge badge-danger">'. $dcount.' </span>' : "" ?>
                                        الرسائل</a></li>
                                <li><a href="<?= Url::toRoute(['/profile']) ?>">الصفحه الشخصيه</a></li>
                                <li><a href="<?= Url::toRoute(['/addcar']) ?>">اضافة سيارة</a></li>
                                <li><a href="<?= Url::toRoute(['/editprofile']) ?>">تعديل صفحتي</a></li>

                                <li>
                                    <?=
                                    Html::beginForm(['/logout'], 'post')
                                    . Html::submitButton('نسجيل خروج',['class' => 'btn btn-small ', 'style' => "font-weight: 700;"])
                                    . Html::endForm()
                                    ?>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

    </div>
</header>
<!-- END | Header -->

<div class="hero common-hero" style="background: url('<?= Url::toRoute(['images/user-hero-bg.jpg']) ?>') no-repeat;"></div>

<div class="page-single movie_list">
    <div class="container">
        <div class="row ipad-width2">
            <?= Breadcrumbs::widget([
                // 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>

<!--
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <? date('Y') ?></p>

        <p class="pull-right"><?php // Yii::powered() ?></p>
    </div>
</footer>-->

<!-- footer section-->
<footer class="ht-footer" style="background: url('<?= Url::toRoute(['images/user-hero-bg.jpg']) ?>') no-repeat;">
    <div class="container">
        <div class="flex-parent-ft">
            <div class="flex-child-ft item1">
                الاشعارات
            </div>
            <div class="flex-child-ft item1">
                اضف سيارة
            </div>
            <div class="flex-child-ft item1">
                المفضل
            </div>
        </div>
    </div>
    <div class="ft-copyright">
        <p>Power By : <a target="_blank" href="http://www.devmrm.com">DevMRM</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
