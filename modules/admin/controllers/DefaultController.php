<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Car;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $user = new Users();
        $car = new Car();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        if(Yii::$app->user->identity->ustat != 5){
            return $this->redirect(['/admin/default/login']);
        }
        //End Check Admin
            
        return $this->render('index',[
            'car' => $car,
        ]);
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $user = new Users();
        if (!Yii::$app->user->isGuest) {
            if( $user->isadmin ){
                return $this->redirect(['index']);
            }
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if( $user->isadmin ){
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash( 'danger', "هذا الحساب ليس ادمن ايضا ");                    
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    public function actionCircledeal()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        if(Yii::$app->user->identity->ustat != 5){
            return $this->redirect(['/admin/default/login']);
        }
        //End Check Admin
        
        $dealCircle = Users::actionCircledeal();
        
        return $this->render('circleDeal', [    
            'dealCircle'=> $dealCircle,
        ]);
    }
    
    
    
    

}
