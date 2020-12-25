<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "deal".
 *
 * @property int $did
 * @property int $user
 * @property int $like_car
 * @property int $owner_car
 * @property int $owner_like
 * @property int $state
 *
 * @property User $user0
 * @property User $ownerCar
 * @property Car $likeCar
 */
class Deal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['deal_type'], 'required','message'=>'{attribute} لا يجب ان يكون فارغ.'],
            [['user', 'like_car', 'owner_car', 'owner_like', 'state'], 'integer'],
            [['deal_type','date'], 'safe'],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user' => 'uid']],
            [['owner_car'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['owner_car' => 'uid']],
            [['like_car'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['like_car' => 'cid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'did' => 'ID',
            'user' => 'مقدم العرض',
            'like_car' => 'السياره',
            'owner_car' => 'مالك السياره',
            'owner_like' => 'موافقه علي العرض',
            'deal_type' => 'نوع العرض',
            'state' => 'الحاله',
            'date'  =>  'التاريخ',
        ];
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['uid' => 'user']);
    }

    /**
     * Gets query for [[OwnerCar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwnerCar()
    {
        return $this->hasOne(User::className(), ['uid' => 'owner_car']);
    }
    
    public static function findBy2user($id1,$id2)
    {
        return Deal::findOne(['user'=>$id1,'owner_car'=>$id2]);
    }

    /**
     * Gets query for [[LikeCar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikeCar()
    {
        return $this->hasOne(Car::className(), ['cid' => 'like_car']);
    }
    
    public function getDeal($params, $filter = null) {
        
        $query = Deal::find(); 
        
        if($filter === null){
            $filter=[
                'DealState'=>' ',
                'myDeal'   =>' ',
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
        
        if($filter['myDeal']==' '){
//            $query->orFilterWhere(['user' => Yii::$app->user->identity->uid ,
//                              'owner_car' => Yii::$app->user->identity->uid ]);
            $query->orFilterWhere([ '=' , 'user',Yii::$app->user->identity->uid ]);
            $query->orFilterWhere([ '=' , 'owner_car',Yii::$app->user->identity->uid ]);
        } else if($filter['myDeal']==1){  // i sender
            $query->andFilterWhere(['user' => Yii::$app->user->identity->uid]);
        } else if($filter['myDeal']==2){  // i car owner
            $query->andFilterWhere(['owner_car' => Yii::$app->user->identity->uid]);
        }
        
        
            
        $query->andFilterWhere([
            //'user ' => $this->user,
            'like_car' => $this->like_car,
            //'owner_car' => $this->owner_car,
            'owner_like' => $this->owner_like,
            'deal_type' => $this->deal_type,
            'state' => $filter['DealState'],
            'date' => $this->date,
            
        ]);
        
        //print_r($query);die(); 
        return $dataProvider;   
    }
    
    public function beforeSave($insert) {
        
        if($this->deal_type){
            $this->deal_type = serialize($this->deal_type);
        }
        
        return parent::beforeSave($insert);
    }
    
    public function afterFind() {
        
        if($this->deal_type){
            $this->deal_type = @unserialize($this->deal_type);
        }
        
    }
    
    
}
