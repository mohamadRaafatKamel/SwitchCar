<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car_media".
 *
 * @property int $cmid
 * @property int $cid
 * @property string $type
 * @property string $path
 * @property string $date
 *
 * @property Car $c
 */
class CarMedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path'], 'required','message'=>'{attribute} لا يجب ان يكون فارغ.'],
            [['path'], 'image', 'maxFiles'=>10, 'extensions' => 'jpg,jpeg,png'],
            [['date'], 'safe'],
            [['type'], 'string', 'max' => 21],
            [['path'], 'string', 'max' => 250],
            [['cid'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['cid' => 'cid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmid' => 'Cmid',
            'cid' => 'Cid',
            'type' => 'Type',
            'path' => 'الملف',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[C]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getC()
    {
        return $this->hasOne(Car::className(), ['cid' => 'cid']);
    }
    
    public static function findByID($id)
    {
        return CarMedia::findOne(['cid'=>$id]);
    }
}
