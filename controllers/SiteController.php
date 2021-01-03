<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
use app\models\Car;
use yii\web\UploadedFile;
use app\models\CarMedia;
use yii\db\ActiveRecord;
use \app\models\Deal;
use \app\models\Connectus;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     * see all cars
     * @return array of cars
     */
    public function actionIndex()
    {
        //$this->checkUsers();
        $car = new Car();

        $carFilter=[
            'cstat'=> [0,1],
            'owner'=> ' ',
            'group'=>'0',
        ];
        $carList = $car->getCar(Yii::$app->request->get(), $carFilter);

        return $this->render('index',[
            'carList' => $carList,
        ]);
    }
    
    /**
     * Registration homepage.
     *
     * @return string
     */
    public function actionRegistration()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->accessToken= password_hash(random_bytes(10), PASSWORD_DEFAULT);
            $model->authKey= md5(random_bytes(5));
            $model->uimg="";
            $model->ustat=0;
            $model->udate=date("Y-m-d");
            
            if($model->save()){
                Yii::$app->session->setFlash( 'success', Yii::t('app', 'تم انشاء حساب جديد') );
                return $this->redirect(['login']);
            } else {
                //Yii::$app->session->setFlash( 'danger', "some thing is Error");                    
                //return print_r($model->errors);
            }
        }
        return $this->render('registration', [
            'model' => $model,
        ]);
    }
    
    

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Edit profile
     *
     * @return Response
     */
    public function actionEditprofile()
    {
        //$this->checkUsers();
        
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        // if($model->carCount == 0){
        //     return $this->redirect(['addcar']);
        // }
        //End Check user
        
        $model = $this->findUser(Yii::$app->user->identity->uid);
        $current_image = $model->uimg;
        
        if ($model->load(Yii::$app->request->post())) {
            //print_r($model);die();
            $image= UploadedFile::getInstance($model, 'uimg');
            if ($this->imageFile instanceof UploadedFile) {
                //$this->user_image = $this->imageFile->extension;
                $imgFile = $this->id . "." . $this->user_image;

                ManageUploadedProfileFiles::getInstance(Users::ConfigData(), $this->user_code)->saveImage($imgFile, $this->imageFile, null);
                //Yii::$app->db->createCommand(sprintf("UPDATE users SET user_image=%s WHERE id=%d", Yii::$app->db->quoteValue($this->user_image), $this->id))->execute();
            } else {
//            if(!empty($image) && $image->size !== 0 && isset($image->extension)) {
//                //print_r($image);print_r("1");die();
//                $path = 'imgUser/' . $model->uid . '.' .$image->extension ;
//                if($image->saveAs($path)){
//                    $model->uimg = $path; 
//                }
//            } else {
                //print_r($image);print_r("2".$current_image);die();
                $model->uimg = $current_image;
            }
//            if($model->uimg == ""){
//                //print_r($image);print_r("3");die();
//                $model->uimg = $current_image;
//            }
            
            if($model->save()){
                Yii::$app->session->setFlash( 'success', Yii::t('app', 'تم التعديل') );
                return $this->redirect(['index']);
            } else {
                //Yii::$app->session->setFlash( 'danger', "some thing is Error");                    
                //return print_r($model->errors);
            }
        }

        return $this->render('editprofile', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAboutus()
    {
        return $this->render('aboutus');
    }
    
    public function actionWhyus()
    {
        return $this->render('whyus');
    }
    
    public function actionQanda()
    {
        return $this->render('qanda');
    }
    
    public function actionHowlog()
    {
        return $this->render('howlog');
    }
    
    protected function findUser($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    private function checkUsers()
    {
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        if($model->carCount == 0){
            return $this->redirect(['addcar']);
        }
        
    }
    
    public function actionMydeal()
    {
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        
        //$this->checkUsers();
        $deal = new Deal();
        
//        if(!$car->mycargroups['cgid']){ // if car not in group
//            //print_r($car->mycargroups['cgid']);die();
//            return $this->render('waitfor',[
//                'massag' => "في انتظار المراجعه",
//            ]);
//        }
        //print_r($car->mycargroups); die();
        $dealFilter=[
                'DealState'=>' ',
                'myDeal'   =>'1',
            ];
        $dealList = $deal->getDeal(Yii::$app->request->get(), $dealFilter);
            
        return $this->render('mydeal',[
            'dealList' => $dealList,
        ]);
    }
    
    public function actionDealsend()
    {
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        
        //$this->checkUsers();
        $deal = new Deal();
        
//        if(!$car->mycargroups['cgid']){ // if car not in group
//            //print_r($car->mycargroups['cgid']);die();
//            return $this->render('waitfor',[
//                'massag' => "في انتظار المراجعه",
//            ]);
//        }
        //print_r($car->mycargroups); die();
        $dealFilter=[
                'DealState'=>' ',
                'myDeal'   =>'2',
            ];
        $dealList = $deal->getDeal(Yii::$app->request->get(), $dealFilter);
            
        return $this->render('dealsend',[
            'dealList' => $dealList,
        ]);
    }
    
    public function actionMymssg()
    {
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        //End Check user
        
        //$this->checkUsers();
        $mssg = new Connectus();
        $mssg->readAll();
        $mssgFilter=[
                'uid'   =>Yii::$app->user->identity->uid ,
            ];
        $mssgList = $mssg->getMssg(Yii::$app->request->get(), $mssgFilter);
            
        return $this->render('mymssg',[
            'mssgList' => $mssgList,
        ]);
    }
    
    public function actionProfile()
    {
        //$this->checkUsers();
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        // if($model->carCount == 0){
        //     return $this->redirect(['addcar']);
        // }
        //End Check user
        $user = new Users();
        $car = new Car();
        
        if(isset($_GET['id'])){
            $id=$_GET['id'] ;
        } else {
            $id= Yii::$app->user->identity->uid ;
        }
        
        $carFilter=[
                'cstat'=> '',
                'owner'=> $id,
            ];
        $mycarList = $car->getCar(Yii::$app->request->get(), $carFilter);
        
        //$dealList = $deal->getDeal(Yii::$app->request->get(), $dealFilter);
            
        return $this->render('profile',[
            'user' => $user->findByID($id),
            'mycarList'=> $mycarList,
        ]);
    }
    
    #####################  Car  ##################################3
    
    /**
     * car form
     *
     * @return string
     */
    public function actionAddcar()
    {
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        //End Check user
        
        $car = new Car();
        $media = new CarMedia();
        
        if ($car->load(Yii::$app->request->post())) {
            
            $car->uid = Yii::$app->user->identity->uid ;
            $group = $car->addCarToGroup($car->deal_forever) ;
            $car->cgid = $group['cgid'];
            $car->deal_day = $group['deal_day'];
            $car->deal_weak = $group['deal_weak'];
            $car->deal_month = $group['deal_month'];
            $car->deal_6month = $group['deal_6month'];
            $car->deal_year = $group['deal_year'];
            $car->date = date("Y-m-d") ;
            $car->cstat = '0' ;
            $car->adminacc = '0' ;
            
            //cover
            $cover= UploadedFile::getInstance($car, 'cover_img');
            if(!empty($cover) && $cover->size !== 0 && isset($cover->extension)) {
                $path = 'carUser/' . md5(random_bytes(3)) . '.' .$cover->extension ;
                if($cover->saveAs($path)){
                    $car->cover_img = $path; 
                }
            }
            if($car->save()){ 
                 $carID= Yii::$app->db->getLastInsertID() ;
                
                // insert img
                
                $images= UploadedFile::getInstances($media, 'path');
                if(!empty($images[0]) && $images[0]->size !== 0 && isset($images[0]->extension)) {
                    foreach ($images as $image){
                        //print_r(Yii::$app->db->getLastInsertID());
                        $path = 'carUser/' . $carID . md5(random_bytes(2)) . '.' .$image->extension ;
                         if($image->saveAs($path)){
                            Yii::$app->db->createCommand()->insert('car_media',[
                                'cid'=> $carID,
                                'path'=> $path,
                                'type'=> $image->type,
                                'date'=> date("Y-m-d"),
                            ])->execute();
                        }
                    }
                }
                
                return $this->redirect(['index']);
            }
            
        }

        return $this->render('addcar', [
            'car' => $car,
            'media'=> $media,
        ]);
    }
    
    public function actionAllcars()
    {
        $this->checkUsers();
        $model = new Users();
        //End Check user
        $car = new Car();
        
        if($model->carCount == 0){ // if car not in group
            //print_r($car->mycargroups['cgid']);die();
            return $this->render('waitfor',[
                'massag' => "في انتظار المراجعه",
            ]);
        }
        //print_r($car->mycargroups); die();
        $carFilter=[
                'cstat'=> [0,1],
                'owner'=> ' ',
                'group'=>'0',
            ];
        $carList = $car->getCar(Yii::$app->request->get(), $carFilter);
            
        return $this->render('allcars',[
            'carList' => $carList,
        ]);
    }
    
    public function actionDealcars()
    {
        ##  for Day  ##
        //$this->checkUsers();
        $user = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        if($user->carCount == 0){
            return $this->redirect(['addcar']);
        }
        //End Check user
        $car = new Car();
        
        //$user->dealCar('يوم', Yii::$app->user->identity->id);
//        $deal= 
//        
//        $deal->find()->where([''])
//        if(!$car->mycargroups['cgid']){ // if car not in group
//            //print_r($car->mycargroups['cgid']);die();
//            return $this->render('waitfor',[
//                'massag' => "في انتظار المراجعه",
//            ]);
//        }
        
        
        
        return $this->render('dealcars',[
           // 'carList' => $carList,
        ]);
    }
    
    public function actionViewcar()
    {
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        if($model->carCount == 0){
            return $this->redirect(['addcar']);
        }
        //End Check user
        if(!isset($_GET['id'])){
            return $this->redirect(['allcars']);
        } else {
            $id =$_GET['id'];
        }
        
        if(!$car = Car::find()->where(['cid'=>$id])->one()){
            return $this->redirect(['allcars']);
        }
        
        if($deal = Deal::find()->where(['user'=>Yii::$app->user->identity->uid ,'like_car'=>$id,'state'=>['0','1','2','4'] ])->one()){
            $userAndDeal="sendOffer";
        }elseif ($deal = Deal::find()->where(['owner_car'=>Yii::$app->user->identity->uid ,'user'=>$car->uid ,'state'=>['0','1','2','4'] ])->one()) {
            $userAndDeal="ownerCheckOffer";
        } else {
            $deal = new Deal();
            $userAndDeal="firstTime";
        }
        
        $carMedia = CarMedia::find()->where(['cid'=>$id])->all();
        
        // 
        if ($deal->load(Yii::$app->request->post())) {
            if($deal->deal_type != 'Remove'){
                $d=0;
                foreach ($deal->deal_type as $value) {
                    $d +=$value ;
                }
                if($d > 0){
                    $deal->user = Yii::$app->user->identity->uid ;
                    $deal->like_car =$id;
                    $deal->owner_car  =$car->uid;
                    $deal->owner_like =['forever'=>0,'year'=>0,'6month'=>0,'month'=>0,'weak'=>0,'day'=>0];
                    $deal->state =0;
                    $deal->date =date("Y-m-d");

                    if($deal->save()){
                        Yii::$app->session->setFlash( 'success', Yii::t('app', 'تم تقديم العرض') );
                        return $this->redirect(['viewcar','id'=>$id]);
                    } 
                } else {
                    Yii::$app->session->setFlash( 'danger', "اختار نوع العرض");
                    return $this->redirect(['viewcar','id'=>$id]);
                }
                
            }else if($deal->deal_type == 'Remove'){
                //$deal->update()->set(['state'=>6])->where(['did'=> $deal->did ]);
                Yii::$app->db->createCommand()->update('deal', ['state' => 6], 'did = '.$deal->did )->execute();
                return $this->redirect(['allcars']);
            }
        }
        
        return $this->render('viewcar',[
            'id' => $id,
            'car' => $car,
            'deal' => $deal,
            'carMedia' => $carMedia,
            'userAndDeal'=> $userAndDeal,
        ]);
    }
    
    public function actionEditcar()
    {
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        //End Check user
        if(!isset($_GET['id'])){
            return $this->redirect(['allcars']);
        } else {
            $id =$_GET['id'];
        }
        
        if(!$car = Car::find()->where(['cid'=>$id])->one()){
            return $this->redirect(['allcars']);
        }
        
        if ($model->load(Yii::$app->request->post())) {
            
            if($model->save()){
                return $this->redirect(['viewcar', 'id' => $model->cid]);
            } 
        }
        return $this->render('editcar', [
            'car' => $car,
        ]);
    }
    
    public function actionDealchange()
    {
        $this->checkUsers();
        if(isset($_GET['st']) && isset($_GET['id'])){
            Yii::$app->db->createCommand()->update('deal', ['state' => $_GET['st']], 'did = '.$_GET['id'] )->execute();
            return $this->redirect(['mydeal']);
            
            
            
        }
    }
    
    
    ##################### End Car  ##################################3
    
    public function circleDeal()
    {
//        $this->checkUsers();
//        $listRejctDeal = Deal::find()->where(['state'=>'2' ,'owner_car'=> Yii::$app->user->identity->uid])->all();
//        //print_r($listRejctDeal[0]['user']);
//        $listRejctDealLVL2 =array();
//        foreach ($listRejctDeal as $RejctDeal) {
//            $listRejctDealLVL2 += Deal::find()->where(['state'=>'2' ,'owner_car'=>$RejctDeal['user'] ,'deal_type'=>$RejctDeal['deal_type'] ])->all();
//            
//        }
//            print_r($listRejctDealLVL2);
    }
    
    public function CheackCircleDeal()
    {
        //$this->checkUsers();
        $model = new Users();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        if($model->carCount == 0){
            return $this->redirect(['addcar']);
        }
        //End Check user
        $listRejctDeal = Deal::find()->where(['state'=>'2' ,'owner_car'=> Yii::$app->user->identity->uid])->all();
        //print_r($listRejctDeal[0]['user']);
        //$listRejctDealLVL2 =array();
        foreach ($listRejctDeal as $RejctDeal) {
            $listRejctDealLVL2 = Deal::find()->where(['state'=>'2' ,'owner_car'=>$RejctDeal['user'] ,'deal_type'=>$RejctDeal['deal_type'] ])->all();
            foreach ($listRejctDealLVL2 as $RejctDeallvl2) {
                $RejctDeallvl2['owner_like']= $RejctDeal['user']."/" ;
            }
        }
         
        
        
        //print_r($listRejctDealLVL2);
    }
    
}
