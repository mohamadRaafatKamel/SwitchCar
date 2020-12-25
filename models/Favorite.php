<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorite".
 *
 * @property int $id
 * @property int $carid
 * @property int $userid
 * @property string $date
 *
 * @property Car $car
 * @property Users $user
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'carid', 'userid'], 'required'],
            [['id', 'carid', 'userid'], 'integer'],
            [['date'], 'safe'],
            [['carid'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['carid' => 'cid']],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'uid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carid' => 'Carid',
            'userid' => 'Userid',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Car]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['cid' => 'carid']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['uid' => 'userid']);
    }
    
    public static function inMyFavorite($car,$user)
    {
        return Favorite::find()->where(['carid'=>$car , 'userid'=>$user])->count();
    }
}
