<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Connectus;
use app\models\ConnectusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Users;

/**
 * ConnectusController implements the CRUD actions for Connectus model.
 */
class ConnectusController extends Controller
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
     * Lists all Connectus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConnectusSearch();
        $Model = new Connectus();
        if(isset($_GET['id'])){
            $searchModel->uid = $_GET['id'] ;
            
            if ($Model->load(Yii::$app->request->post())) {
                $Model->uid = $_GET['id'];
                $Model->cudate = date("Y-m-d");
                $Model->custst = 0;
                $Model->save();
                return $this->redirect(['index', 'id' => $_GET['id']]);
            }
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'Model' => $Model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Connectus model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Connectus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Connectus();

        if ($model->load(Yii::$app->request->post())) {
            $users = Users::find()->select('uid')->all() ;
            foreach ($users as $user){
                $mult = new Connectus();
                $mult->uid = $user['uid'];
                $mult->cudate = date("Y-m-d");
                $mult->custst = 0;
                $mult->massg= $model->massg;
                $mult->save();
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Connectus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cuid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Connectus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Connectus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Connectus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Connectus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
