<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "car".
 *
 * @property int $cid
 * @property string $cname
 * @property int $uid
 * @property int $ctid
 * @property string $cmodel
 * @property string $cbrand
 * @property int $caid
 * @property string $descrp
 * @property string $cbody
 * @property string $elker
 * @property string $machen
 * @property string $fuel
 * @property int $deal_forever
 * @property int $deal_day
 * @property int $deal_weak
 * @property int $deal_month
 * @property int $deal_6month
 * @property int $deal_year
 * @property int $cgid
 * @property string $date
 * @property int $cstat
 *
 * @property User $u
 * @property CarType $ct
 * @property CarAgent $ca
 * @property CarGroup $cg
 * @property CarMedia[] $carMedia
 * @property Deal[] $deals
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cname', 'ctid', 'cmodel', 'cbrand', 'caid', 'descrp', 'cbody', 'elker', 'machen', 'fuel', 'deal_forever','cover_img'], 'required','message'=>'{attribute} لا يجب ان يكون فارغ.'],
            [['uid', 'ctid', 'caid', 'deal_forever', 'deal_day', 'deal_weak', 'deal_month', 'deal_6month', 'deal_year', 'cgid', 'cstat'], 'integer'],
            [['date','displaytouser','deal','adminacc'], 'safe'],
            [['deal_forever', 'deal_day', 'deal_weak', 'deal_month', 'deal_6month', 'deal_year'], 'integer'],
            [['cname', 'cmodel', 'cbrand', 'cbody', 'elker', 'machen', 'fuel'], 'string', 'max' => 21],
            [['descrp'], 'string', 'max' => 250],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['uid' => 'uid']],
            [['ctid'], 'exist', 'skipOnError' => true, 'targetClass' => CarType::className(), 'targetAttribute' => ['ctid' => 'ctid']],
            [['caid'], 'exist', 'skipOnError' => true, 'targetClass' => CarAgent::className(), 'targetAttribute' => ['caid' => 'caid']],
            [['cgid'], 'exist', 'skipOnError' => true, 'targetClass' => CarGroup::className(), 'targetAttribute' => ['cgid' => 'cgid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'ID',
            'cname' => 'اسم السياره',
            'uid' => 'صاحب السياره',
            'ctid' => 'فئه',
            'cmodel' => 'موديل',
            'cbrand' => 'شركت',
            'caid' => 'الوكيل',
            'descrp' => 'الوصف',
            'cbody' => 'البودي ',
            'elker' => 'القير ',
            'machen' => 'المكينة ',
            'fuel' => 'الوقود ',
            'deal_forever' => 'سعر صفقه دائمه',
            'deal_day' => 'سعر صفقه ليوم',
            'deal_weak' => 'سعر صفقه لاسبوع',
            'deal_month' => 'سعر صفقه لشهر',
            'deal_6month' => 'سعر صفقه لسته اشهر',
            'deal_year' => 'سعر صفقه لسنه',
            'cgid' => 'المجموعه',
            'date' => 'تاريخ الاضافه',
            'cstat' => 'الحاله',
            'cover_img' => 'الغلاف',
        ];
    }

    /**
     * Gets query for [[U]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['uid' => 'uid']);
    }
    
    public static function findByID($id)
    {
        return Car::findOne(['cid'=>$id]);
    }

    /**
     * Gets query for [[Ct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCt()
    {
        return $this->hasOne(CarType::className(), ['ctid' => 'ctid']);
    }

    /**
     * Gets query for [[Ca]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCa()
    {
        return $this->hasOne(CarAgent::className(), ['caid' => 'caid']);
    }

    /**
     * Gets query for [[Cg]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCg()
    {
        return $this->hasOne(CarGroup::className(), ['cgid' => 'cgid']);
    }

    /**
     * Gets query for [[CarMedia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarMedia()
    {
        return $this->hasMany(CarMedia::className(), ['cid' => 'cid']);
    }

    /**
     * Gets query for [[Deals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeals()
    {
        return $this->hasMany(Deal::className(), ['like_car' => 'cid']);
    }
    
    
    public function getCar($params, $filter = null) {
        
        $query = Car::find(); 
        
        if($filter === null){
            $filter=[
                'cgid'=>" ",
                'cstat'=>" ",
                'owner'=>" ",
            ];
        }
        //print_r($filter);die();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 20,
            ],
            'sort' => ['defaultOrder' => ['date' => SORT_DESC]]
        ]);

        $this->load($params);
        
        if($filter['owner']!=' '){
            $query->andFilterWhere([ '=' , 'uid',$filter['owner'] ]);
        } else {
            $query->andFilterWhere(['uid' => $this->uid]);
        }
        
        
        if(isset($filter['group'])){
            $query->andFilterWhere([ '!=' , 'cgid', $filter['group'] ]);
        }else{
            $query->andFilterWhere(['cgid' => $this->cgid]);
        }
        
        $query->andFilterWhere([
            //'cgid' => $this->cgid,
            'cstat' => $filter['cstat'],
            'cname' => $this->cname,
            'cmodel' => $this->cmodel,
            'cbrand' => $this->cbrand,
            'descrp' => $this->descrp,
            'cbody' => $this->cbody,
            'elker' => $this->elker,
            
        ]);
        
                
        return $dataProvider;   
    }
    
    public function getMycargroups() {
        return Car::find()->select('cgid,cstat')->where(['uid'=>Yii::$app->user->identity->uid,'cstat'=>[0,1] ])->one();
        
    }
    
    public static function getCarDealList($id){
        $car = car::find()->where(['cid'=>$id])->one();
        $deals = [];
        ($car->deal['forever'])? $deals['دائم'] = 'دائم ': '';
        ($car->deal['day'])? $deals['يوم'] =  'يوم ' : '';
        ($car->deal['weak'])? $deals['اسبوع'] =  'اسبوع ' : '';
        ($car->deal['month'])? $deals['شهر'] =  'شهر ' : '';
        ($car->deal['6month'])? $deals['سته اشهر'] =  'سته اشهر ' : '';
        ($car->deal['year'])? $deals['سنه'] =  'سنه  ': '';
        
        return $deals;
    }
    
    public function payOrwin($hisCarID) {
        $mycars = $this->find()->where(['uid'=> Yii::$app->user->identity->uid])->all();
        $hiscar = $this->find()->where(['cid'=> $hisCarID ])->one();
        $hisGrp = CarGroup::find()->where(['cgid'=>$hiscar['cgid']])->one();
        
        $mssg = "";
        foreach ($mycars as $mycar) {
            $costDay = $mycar['deal_day'] - $hiscar['deal_day'] - $hisGrp['serv_day'];
            $costWeak = $mycar['deal_weak'] - $hiscar['deal_weak'] - $hisGrp['serv_weak'];
            $costMonth = $mycar['deal_month'] - $hiscar['deal_month'] - $hisGrp['serv_month'];
            $cost6month = $mycar['deal_6month'] - $hiscar['deal_6month'] - $hisGrp['serv_6month'];
            $costyear = $mycar['deal_year'] - $hiscar['deal_year'] - $hisGrp['serv_year'];
            $costforever = $mycar['deal_forever'] - $hiscar['deal_forever'] - $hisGrp['serv_forever'];
            
            (Users::getCarCount() - 1)? $mssg .= "عند التبديل بالسياره ".$mycar['cname'] ."<br/>" : $mssg .= '';
//            $mssg .= "";
            
            ($hiscar->deal['forever'])? $mssg .= $this->payOrwinX1('دائم', $costforever) : $mssg .= "";
            ($hiscar->deal['day'])? $mssg .= $this->payOrwinX1('يوم', $costDay) : $mssg .= "";
            ($hiscar->deal['weak'])? $mssg .= $this->payOrwinX1('اسبوع', $costWeak) : $mssg .= "";
            ($hiscar->deal['month'])? $mssg .= $this->payOrwinX1('شهر', $costMonth) : $mssg .= "";
            ($hiscar->deal['6month'])? $mssg .= $this->payOrwinX1('سته اشهر', $cost6month) : $mssg .= "";
            ($hiscar->deal['year'])? $mssg .= $this->payOrwinX1('سنه', $costyear) : $mssg .= "";
        }
        
        return $mssg ;
    }
    
    public function payOrwinX1($time , $price) {
        if($price >= 0){
            return ' لليبديل '.$time.' سوف تكسب '.$price."<br/>";
        }else{
            return' لليبديل '.$time.' سوف تدفع '.$price."<br/>" ;
        }
    }
    
    public function addCarToGroup($carPrice) {
        $groupList = CarGroup::find()->all();
        foreach ($groupList as $group) {
            if($carPrice >= $group['price_min'] && $carPrice < $group['price_max']){
                return [
                    'cgid' => $group['cgid'],
                    'deal_day' => $group['deal_day'],
                    'deal_weak' => $group['deal_weak'],
                    'deal_month' => $group['deal_month'],
                    'deal_6month' => $group['deal_6month'],
                    'deal_year' => $group['deal_year'],
                ];
            }
        }
        return [
            'cgid' => 0,
            'deal_day' => 0,
            'deal_weak' => 0,
            'deal_month' => 0,
            'deal_6month' => 0,
            'deal_year' => 0,
        ];
    }
    
    public function getUnaccepted() {
        return $this->find()->where(['adminacc'=>0])->count();
    }


    public function beforeSave($insert) {
        
        if($this->deal){
            $this->deal = serialize($this->deal);
        }
        
        return parent::beforeSave($insert);
    }
    
    public function afterFind() {
        
        if($this->deal){
            $this->deal = @unserialize($this->deal);
        }
        
    }
    
}
