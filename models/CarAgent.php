<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car_agent".
 *
 * @property int $caid
 * @property string $caname
 *
 * @property Car[] $cars
 */
class CarAgent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_agent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caname'], 'required','message'=>'{attribute} لا يجب ان يكون فارغ.'],
            [['caname'], 'string', 'max' => 21],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'caid' => 'ID',
            'caname' => 'الوكيل',
        ];
    }

    /**
     * Gets query for [[Cars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::className(), ['caid' => 'caid']);
    }
    
    public static function getCarAgentList(){
        $listData = CarAgent::find()->all();
        $list = [];
        foreach ($listData as $data){
            $list[$data->caid] = $data->caname;
        }
        
        return $list;
    }
}
