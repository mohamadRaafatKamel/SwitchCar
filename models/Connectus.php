<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "connectus".
 *
 * @property int $cuid
 * @property int $uid
 * @property string $massg
 * @property int $custst
 * @property string $cudate
 *
 * @property User $u
 */
class Connectus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'connectus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['massg'], 'required','message'=>'{attribute} لا يجب ان يكون فارغ.'],
            [['cuid', 'uid', 'custst'], 'integer'],
            [['cudate'], 'safe'],
            [['massg'], 'string', 'max' => 250, 'message'=>'لا يجب ان يكون محتوي الرساله اكثر من 250 حرف'],
            [['cuid'], 'unique'],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['uid' => 'uid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cuid' => 'Cuid',
            'uid' => 'Uid',
            'massg' => 'الرساله',
            'custst' => 'الحاله',
            'cudate' => 'التاريخ',
        ];
    }

    /**
     * Gets query for [[U]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(Users::className(), ['uid' => 'uid']);
    }
    
    public function ThisState($id)
    {
        switch ($id) {
            case 0:
                return 'لم يقرئها العضو';
                break;
            case 1:
                return 'تمت القرائه';
                break;
            case 2:
                return 'لم يقرئها الادمن';
                break;
            case 3:
                return 'تمت القرائه';
                break;

            default:
                break;
        }
    }
    
    public function getMssg($params, $filter = null) {
        
        $query = Connectus::find(); 
        
        if($filter === null){
            $filter=[
                'uid'   =>' ',
            ];
        }
        //print_r($filter);die();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 20,
            ],
            'sort' => ['defaultOrder' => ['cudate' => SORT_DESC]]
        ]);

        $this->load($params);
        
        if($filter['uid']==' '){
            $query->andFilterWhere(['uid' => $this->uid]);
        } else {
            $query->andFilterWhere(['uid' => $filter['uid'] ]);
        }
        
        
            
        $query->andFilterWhere([
            'cudate' => $this->cudate,
            
        ]);
        
        //print_r($query);die(); 
        return $dataProvider;   
    }
    
    public function readAll()
    {
        $unReaded = Connectus::find()->where(['uid'=>Yii::$app->user->identity->uid,'custst'=>0])->all();
        if($unReaded){
            foreach ($unReaded as $mssg) {
                $mssg->custst = 1;
                $mssg->update();
            }
        }
    }
    
}
