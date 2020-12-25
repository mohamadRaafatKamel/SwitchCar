<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car_group".
 *
 * @property int $cgid
 * @property string $cgname
 * @property string $price_min
 * @property string $price_max
 * @property int $ctid
 * @property string $city
 * @property string $descr
 *
 * @property Car[] $cars
 * @property CarType $ct
 */
class CarGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [      
            [['cgname','price_min', 'price_max','deal_day','deal_weak','deal_month','deal_6month','deal_year', 'ctid', 'city','serv_forever','serv_day','serv_weak','serv_month','serv_6month','serv_year'], 'required','message'=>'{attribute} لا يجب ان يكون فارغ.'],
            [['ctid','deal_day','deal_weak','deal_month','deal_6month','deal_year'], 'integer'],
            [['serv_forever','serv_day','serv_weak','serv_month','serv_6month','serv_year'], 'integer'],
            [['cgname', 'city'], 'string', 'max' => 21],
            [['price_min', 'price_max','deal_day','deal_weak','deal_month','deal_6month','deal_year'], 'string', 'max' => 11],
            [['descr'], 'string', 'max' => 250],
            [['ctid'], 'exist', 'skipOnError' => true, 'targetClass' => CarType::className(), 'targetAttribute' => ['ctid' => 'ctid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cgid' => 'ID',
            'cgname' => 'اسم',
            'price_min' => 'اقل ثمن',
            'price_max' => 'اعلا ثمن',
            'ctid' => 'فئه',
            'city' => 'مديمه',
            'descr' => 'وصف',
            'deal_day' => 'سعر يوم',
            'deal_weak' => 'سعر اسبوع',
            'deal_month' => 'سعر شهر',
            'deal_6month' => 'سعر سته اشهر',
            'deal_year' => 'سعر سنة',
            'serv_day' => 'خدمات يوم',
            'serv_weak' => 'خدمات اسبوع',
            'serv_month' => 'خدمات شهر',
            'serv_6month' => 'خدمات ستة اشهر',
            'serv_year' => 'خدمات سنة',
            'serv_forever' => 'خدمات دائم',
        ];
    }

    /**
     * Gets query for [[Cars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::className(), ['cgid' => 'cgid']);
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
    
    public static function getCarGroupList(){
        $listData = CarGroup::find()->all();
        $list = [];
        
        foreach ($listData as $data){
            $list[$data->cgid] = $data->cgname;
        }
        
        return $list;
    }
    
    public static function updateAllCar($gID){
        
        $groupVal = CarGroup::find()->where(['cgid'=>$gID])->one();
        $cars = Car::find()->where(['cgid'=>$gID])->all();
        
        foreach ($cars as $car) {
            $car->deal_day = $groupVal->deal_day ;
            $car->deal_weak = $groupVal->deal_weak ;
            $car->deal_month = $groupVal->deal_month ;
            $car->deal_6month = $groupVal->deal_6month ;
            $car->deal_year = $groupVal->deal_year ;
            $car->update();
        }
    }
    
    public static function findByID($id)
    {
        return CarGroup::findOne(['cgid'=>$id]);
    }
    
}
