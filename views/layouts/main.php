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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode('سياره كل يوم | '.$this->title) ?></title>
    <?php $this->head() ?>
    
    <!-- Favicon|Logo in title -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

</head>
<body>
<?php $this->beginBody() ?>
    
    

<!-- Start Top Header Bar -->
<section class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-4">
				<div class="contact-number">
					<i class="tf-ion-ios-telephone"></i>
					<span>01028095934</span>
<!--                                        <span>للدعم </span>-->
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="<?= Url::toRoute(['/']) ?>">
						<!-- replace logo here -->
						<svg width="135px" height="29px" viewBox="0 0 175 29" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" font-size="40" font-family="AustinBold, Austin" font-weight="bold">
						        <g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
						            <text id="AVIATO">
						                <tspan x="108.94" y="325">سيارة كل يوم</tspan>
						            </text>
						        </g>
						    </g>
						</svg>
					</a>
				</div>
			</div>
            <div class="col-md-4 col-xs-12 col-sm-4">
		<!-- User -->
		<ul class="top-menu text-right list-inline">
                    
                <?php if(Yii::$app->user->isGuest ): ?>
	          <li class="dropdown cart-nav dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">دخول <i class="tf-ion-android-person"></i></a>
	            <div class="dropdown-menu cart-dropdown">
	            	
                        <ul class="text-center cart-buttons">
                            <li><a href="<?= Url::toRoute(['/registration']) ?>" class="btn btn-small btn-solid-border" style="font-weight: 700;">أنشاء حساب</a></li>
                            <li><a href="<?= Url::toRoute(['/login']) ?>" class="btn btn-small btn-solid-border" style="font-weight: 700;">تسجيل دخول</a></li>
                        </ul>
                    </div>

	          </li>
                <?php else : ?>
                  <li class="dropdown dropdown-slide cart-nav user-info-menu" >
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">
                         <?= Yii::$app->user->identity->username ?> <i class="tf-ion-android-person"></i> </a>
	            <ul class="dropdown-menu">
                        
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
	          </li><!-- / Blog -->
                  
                <?php endif; ?>
                <!-- / User -->
<!--
	           Search 
	          <li class="dropdown search dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-ios-search-strong"></i> Search</a>
	            <ul class="dropdown-menu search-dropdown">
	              <li><form action="post"><input type="search" class="form-control" placeholder="Search..."></form></li>
	            </ul>
	          </li> / Search -->

	        </ul><!-- / .nav .navbar-nav .navbar-right -->
            </div>
	</div>
    </div>
</section><!-- End Top Header Bar -->



<!-- Main Menu Section -->
<section class="menu">
	<nav class="navbar navigation">
	    <div class="container">
	      <div class="navbar-header">
	      	<h2 class="menu-title">Main Menu</h2>
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	        </button>

	      </div><!-- / .navbar-header -->

	      <!-- Navbar Links -->
	      <div id="navbar" class="navbar-collapse collapse text-center">
	        <ul class="nav navbar-nav">
                <?php if(! Yii::$app->user->isGuest ){ ?>
                <?php if(Yii::$app->user->identity->ustat == 5){ ?>
	          <li class="dropdown ">
	            <a href="<?= Url::toRoute(['/admin/default/index']) ?>">Admin</a>
	          </li><!-- / Home -->
	            <?php }} ?>
                  <!-- Home -->
	          <li class="dropdown ">
	            <a href="<?= Url::toRoute(['/howlog']) ?>">طريقه التسجيل</a>
	          </li><!-- / Home -->
                  
                  <?php if(! Yii::$app->user->isGuest ){ ?>
                  <!-- Home -->
                  <li class="dropdown dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">
                         <span class="tf-ion-ios-arrow-down"></span> السيارات </a>
	            <ul class="dropdown-menu">
					<li><a href="<?= Url::toRoute(['/allcars']) ?>">كل السيارات</a></li>
					<li><a href="<?= Url::toRoute(['/dealcars']) ?>">صفقات جاهزه</a></li>
	            </ul>
	          </li>
                  <?php } ?>

<!--			 Shop 
	          <li class="dropdown dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="tf-ion-ios-arrow-down"></span> سيارات </a>
	            <ul class="dropdown-menu">
	              <li><a href="typography.html">Typography</a></li>
	              <li><a href="buttons.html">Buttons</a></li>
	              
	            </ul>
	          </li> / Blog -->
                  
                  
                  <!-- Blog -->
	          <li class="dropdown dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">
                         <span class="tf-ion-ios-arrow-down"></span> خدماتنا </a>
	            <ul class="dropdown-menu">
					<li><a href="<?= Url::toRoute(['/aboutus']) ?>">من نحن</a></li>
					<li><a href="<?= Url::toRoute(['/whyus']) ?>">لماذا نحن</a></li>
					<li><a href="<?= Url::toRoute(['/qanda']) ?>">اساله شائعه</a></li>
                                        <!--<li><a href="<?php // Url::toRoute(['/contact']) ?>">تواصل معنا</a></li>-->
	            </ul>
	          </li><!-- / Blog -->

                  <!-- Home -->
	          <li class="dropdown ">
	            <a href="<?= Url::toRoute(['/']) ?>">الرئيسية</a>
	          </li><!-- / Home -->
	        </ul><!-- / .nav .navbar-nav -->

	      	</div><!--/.navbar-collapse -->
	    </div><!-- / .container -->
	</nav>
</section>


<div class="wrap">
    <?php
//    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
//        ],
//    ]);
    
//    $navItems=[
//        ['label' => 'الرئيسية', 'url' => ['/site/index']],
//        ['label' => 'من نحن', 'url' => ['/site/aboutus']],
//        ['label' => 'لماذا نحن', 'url' => ['/site/whyus']],
//        ['label' => 'اساله و اجوبه', 'url' => ['/site/qanda']],
//        ['label' => 'متحه للتبادل', 'url' => ['/site/allcars']],
//        ['label' => 'صفقات جاهزع', 'url' => ['/site/dealcars']],
//        ['label' => 'طريقه التسجيل', 'url' => ['/site/howlog']],
//        ['label' => 'تواصل معنا', 'url' => ['/site/contact']]
//    ];
//    if(Yii::$app->user->isGuest ){
//        array_push($navItems, 
//                ['label' => 'تسجيل دخول', 'url' => ['/site/login']],
//                ['label' => 'انشاء حساب', 'url' => ['/site/registration']]);
//    }else {
//        array_push($navItems,
//                ['label' => 'Admin', 'url' => ['/admin/default/index']],  // *************************
//                ['label' => 'صفقاتي', 'url' => ['/site/mydeal']],
//                ['label' => 'رسائل', 'url' => ['/site/index']],
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'خروج (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>');
//    }
//    
    
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => $navItems,
//    ]);
//    NavBar::end();
    ?>

    <div class="container main-container">
        <?= Breadcrumbs::widget([
           // 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<!--
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <? date('Y') ?></p>

        <p class="pull-right"><?php // Yii::powered() ?></p>
    </div>
</footer>-->


<footer class="footer section text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="social-media">
					<li>
						<a href="">
							<i class="tf-ion-social-facebook"></i>
						</a>
					</li>
					<li>
						<a href="">
							<i class="tf-ion-social-instagram"></i>
						</a>
					</li>
					<li>
						<a href="">
							<i class="tf-ion-social-twitter"></i>
						</a>
					</li>
					<li>
						<a href="">
							<i class="tf-ion-social-pinterest"></i>
						</a>
					</li>
				</ul>
				<ul class="footer-menu">
					<li>
						<a href="">CONTACT</a>
					</li>
					<li>
						<a href="">SHIPPING</a>
					</li>
					<li>
						<a href="">TERMS OF SERVICE</a>
					</li>
					<li>
						<a href="">PRIVACY POLICY</a>
					</li>
				</ul>
                            <p class="copyright-text">Powered by <a href="http://www.devmrm.com">DevMRM</a></p>
			</div>
		</div>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
