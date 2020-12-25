<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car_type".
 *
 * @property int $ctid
 * @property string $ctname
 *
 * @property Car[] $cars
 * @property CarGroup[] $carGroups
 */
class CarType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctname'], 'required','message'=>'{attribute} لا يجب ان يكون فارغ.'],
            [['ctname'], 'string', 'max' => 21],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ctid' => 'ID',
            'ctname' => 'فئه ',
        ];
    }

    /**
     * Gets query for [[Cars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::className(), ['ctid' => 'ctid']);
    }

    /**
     * Gets query for [[CarGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarGroups()
    {
        return $this->hasMany(CarGroup::className(), ['ctid' => 'ctid']);
    }
    
    public static function getCarTypeList(){
        $listData = CarType::find()->all();
        $list = [];
        foreach ($listData as $data){
            $list[$data->ctid] = $data->ctname;
        }
        
        return $list;
    }
}
