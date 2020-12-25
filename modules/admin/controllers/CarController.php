<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Car;
use app\models\CarSearch;
use app\models\CarGroup;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarController implements the CRUD actions for Car model.
 */
class CarController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Car models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        if(Yii::$app->user->identity->ustat != 5){
            return $this->redirect(['/admin/default/login']);
        }
        //End Check Admin
        $searchModel = new CarSearch();
        if(isset($_GET['admnacc'])){
            $searchModel->adminacc = $_GET['admnacc'] ;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Car model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        if(Yii::$app->user->identity->ustat != 5){
            return $this->redirect(['/admin/default/login']);
        }
        //End Check Admin
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAcceptallnew($id = null)
    {
        $qu = "";
        if($id != null){
            $qu = ",'cid'=>".$id ;
        }
        $cars = Car::find()->where(['adminacc'=>0 .$qu])->all() ;
        foreach ($cars as $car){
            $car->adminacc = 1;
            $car->update();
        }
        return $this->redirect(['index']);
    }
    /**
     * Updates an existing Car model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        if(Yii::$app->user->identity->ustat != 5){
            return $this->redirect(['/admin/default/login']);
        }
        //End Check Admin
        
        $model = $this->findModel($id);
        $modelOld = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            
            // Yii::$app->db->createCommand()->update('car',[
            //     'cname'=> $model->cname,
            //     'uid'=> $model->uid,
            //     'ctid'=> $model->ctid,
            //     'cmodel'=> $model->cmodel,
            //     'cbrand'=> $model->cbrand,
            //     'caid'=> $model->caid,
            //     'descrp'=> $model->descrp,
            //     'cbody'=> $model->cbody,
            //     'elker'=> $model->elker,
            //     'machen'=> $model->machen,
            //     'fuel'=> $model->fuel,
            //     'deal_forever'=> $model->deal_forever,
            //     'deal_day'=> $model->deal_day,
            //     'deal_weak'=> $model->deal_weak,
            //     'deal_month'=> $model->deal_month,
            //     'deal_6month'=> $model->deal_6month,
            //     'deal_year'=> $model->deal_year,
            //     'cgid'=> $model->cgid,
            //     'date'=> $model->date,
            //     'cstat'=> $model->cstat,
            // ],['cid'=> $model->cid ])->execute();
            
            // print_r($newRecord);
            // //print_r($model);
            
            if($modelOld->cgid != $model->cgid){
                
                $newCost = CarGroup::findByID($model->cgid);
                
                $model->deal_day = $newCost->deal_day ;
                $model->deal_weak = $newCost->deal_weak ;
                $model->deal_month = $newCost->deal_month ;
                $model->deal_6month = $newCost->deal_6month ;
                $model->deal_year = $newCost->deal_year ;
                
            }
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->cid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Car model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Car model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Car the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Car::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
