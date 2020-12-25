<?php

namespace app\models;

use Yii;
use app\models\Car;


/**
 * This is the model class for table "users".
 *
 * @property int $uid
 * @property int $username
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $uphone
 * @property string $ucity
 * @property string $uimg
 * @property int $ustat
 * @property string $udate
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Car[] $cars
 * @property Connectus[] $connectuses
 * @property Deal[] $deals
 * @property Deal[] $deals0
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'name','password', 'uphone', 'ucity'], 'required','message'=>'{attribute} لا يجب ان يكون فارغ.'],
            [['ustat', 'uphone'], 'integer'],
            [['udate'], 'safe'],
            [['username'], 'unique','message'=>'أسم المستخدم موجود من قبل'],
            [['email'], 'unique','message'=>'الايميل مستخدم من قبل'],
            [['email'], 'email'],
            [['email', 'password', 'name', 'uphone', 'ucity'], 'string', 'max' => 21],
            [['uimg'], 'image', 'extensions' => 'jpg,jpeg,png'],
            [['password'], 'required', 'on' => 'insert'],
            [['password'], 'string', 'min' => 5, 'max' => 21],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'username' => 'اسم المستخدم',
            'email' => 'البريد الالكتروني',
            'password' => 'كلمه المرور',
            'name' => 'الاسم',
            'uphone' => 'رقم الهاتف',
            'ucity' => 'المدينه',
            'uimg' => 'صوره',
            'ustat' => 'الحالة',
            'udate' => 'التاريخ',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::className(), ['uid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnectuses()
    {
        return $this->hasMany(Connectus::className(), ['uid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeals()
    {
        return $this->hasMany(Deal::className(), ['user' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeals0()
    {
        return $this->hasMany(Deal::className(), ['owner_car' => 'uid']);
    }
    
    ###### Log in #####
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['accessToken'=>$token]);
    }
    
    /**
     * Finds user by username
     *
     * @param string $Email
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return Users::findOne(['username'=>$username]);
    }
    
    public static function findByID($id)
    {
        return Users::findOne(['uid'=>$id]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->uid;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }
    
    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return password_verify($password, $this->password);
        return $this->password === $password;
    }
    
    /**
     * Finds user by isAdmin
     *
     * @param string $Email
     * @return static|null
     */
    public function getIsadmin()
    {
        if( Yii::$app->user->identity->ustat === 5) return 1; else return 0 ;
    }
    
    
    public function getCarCount()
    {
        return Car::find()->where(['uid'=>Yii::$app->user->identity->uid ])->count();
    }
    
    public static function getDealCount()
    {
        return Deal::find()->where(['owner_car'=>Yii::$app->user->identity->uid, 'state'=>0 ])->count();
    }
    
    public static function getMassgCount()
    {
        return Connectus::find()->where(['uid'=>Yii::$app->user->identity->uid, 'custst'=>0 ])->count();
    }
    
    
    ## ----- circle
    
    /*  old try bt Array */
    public function actionCircledeal()
    {
        /*
        $type = 'يوم';
//        $rejectLists = Deal::find()->where(['state'=> 2,'type'=>$type])->all();
        $rejectLists= array(); 
        $rejectLists[]=['user'=>'1' ,'owner_car'=>'2'];
        $rejectLists[]=['user'=>'2' ,'owner_car'=>'3'];
        $rejectLists[]=['user'=>'3' ,'owner_car'=>'4'];
        $rejectLists[]=['user'=>'4' ,'owner_car'=>'1'];
        $rejectLists[]=['user'=>'1' ,'owner_car'=>'3'];
        $rejectLists[]=['user'=>'4' ,'owner_car'=>'2'];
        $rejectLists[]=['user'=>'5' ,'owner_car'=>'2'];
        
        $dealCircle = array();
        
//        Users::MyJoin($rejectLists, $rejectLists, $dealCircle);
        
        //$firstVal = reset($rejectLists);
        //$lastVal = end($rejectLists);
        //$keyList = array_keys($rejectLists);
//        print_r($rejectLists[-1]);die();
        //print_r($rejectLists);die();
        $circleLVL1 =array();
        foreach ($rejectLists as $rejectList) {
            foreach ($rejectLists as $list) {
                if($list['user'] ==  $rejectList['owner_car'] && $list['deal_type'] ==  $rejectList['deal_type'] ){
                    
                    if($rejectList['user'] == $list['owner_car']){
                        $dealCircle[] =[
                            '0'=>$rejectList['user'] , 
                            'car0'=>$rejectList['like_car'],
                            '1'=>$rejectList['owner_car'],
                            'car1'=>$list['like_car'],
                            '2'=>$list['owner_car'],
                            'type'=>$list['deal_type'],
                            
                        ];
                    } else {
                        $circleLVL1[] =[
                            '0'=>$rejectList['user'] , 
                            'car0'=>$rejectList['like_car'],
                            '1'=>$rejectList['owner_car'],
                            'car1'=>$list['like_car'],
                            '2'=>$list['owner_car'],
                            'type'=>$list['deal_type']
                        ];
                    }
                }
            }
        }
        //print_r($circleLVL1);die();
        
        $circleLVL2 =array();
        foreach ($circleLVL1 as $rejectList) {
            foreach ($rejectLists as $list) {
                if($list['user'] ==  $rejectList['2'] && $list['deal_type'] ==  $rejectList['deal_type']){
                    
                    if($rejectList['0'] == $list['owner_car']){
                        $dealCircle[] =[
                            '0'=>$rejectList['0'] , 
                            'car0'=>$rejectList['car0'],
                            '1'=>$rejectList['1'],
                            'car1'=>$rejectList['car1'],
                            '2'=>$rejectList['2'],
                            'car2'=>$list['owner_car'],
                            '3'=>$list['owner_car'],
                            'type'=>$list['deal_type'],
                        ];
                    } else {
                        $circleLVL2[] =[
                            '0'=>$rejectList['0'] , 
                            'car0'=>$rejectList['car0'],
                            '1'=>$rejectList['1'],
                            'car1'=>$rejectList['car1'],
                            '2'=>$rejectList['2'],
                            'car2'=>$list['owner_car'],
                            '3'=>$list['owner_car'],
                            'type'=>$list['deal_type'],
                        ];
                    }
                }
            }
        }
        //print_r($dealCircle);die();
        
        $circleLVL3 =array();
        foreach ($circleLVL2 as $rejectList) {
            foreach ($rejectLists as $list) {
                if($list['user'] ==  $rejectList['3'] && $list['deal_type'] ==  $rejectList['deal_type']){
                    
                    if($rejectList['0'] == $list['owner_car']){
                        $dealCircle[] =[
                            '0'=>$rejectList['0'] , 
                            'car0'=>$rejectList['car0'],
                            '1'=>$rejectList['1'],
                            'car1'=>$rejectList['car1'],
                            '2'=>$rejectList['2'],
                            'car2'=>$rejectList['car2'],
                            '3'=>$rejectList['3'],
                            'car4'=>$rejectList['car4'],
                            '4'=>$list['owner_car'],
                            'type'=>$list['deal_type'],
                        ];
                    } else {
                        $circleLVL3[] =[
                            '0'=>$rejectList['0'] , 
                            'car0'=>$rejectList['car0'],
                            '1'=>$rejectList['1'],
                            'car1'=>$rejectList['car1'],
                            '2'=>$rejectList['2'],
                            'car2'=>$rejectList['car2'],
                            '3'=>$rejectList['3'],
                            'car4'=>$rejectList['car4'],
                            '4'=>$list['owner_car'],
                            'type'=>$list['deal_type'],
                        ];
                    }
                }
            }
        }
        //print_r($dealCircle);die();
        return $dealCircle ;
        */
    }
    
    function MyJoin($table , $circles, $dealCircle) {
        //global $dealCircle;
        $circleLVLUp =array();
        $up=0;
        //$dl=count($dealCircle);
        foreach ($circles as $circle) {
            foreach ($table as $row) {
                if($row['user'] ==  end($circle)){
                    
                    if(reset($circle) == end($row) ){
                        $i=0;
                        foreach ($circle as $value) {
                            $dealCircle[$dl][$i++] = $value;
                        }
                        //$circleLVLUp[$up][$i++] = $row['like_car'];
                        $dealCircle[$dl][$i++] = $row['owner_car'];
                    } else {
                        $i=0;
                        foreach ($circle as $value) {
                            $circleLVLUp[$up][$i++] = $value;
                        }
                        //$circleLVLUp[$up][$i++] = $row['like_car'];
                        $circleLVLUp[$up][$i++] = $row['owner_car'];
                    }
                    $up++;
                }
            }
        }
        //print_r($circleLVLUp);die();
        return $circleLVLUp;
    }
    
    
    
    /*
    function dealCar($Time,$userID) {
        $allDeals = Deal::find()->select(['did','user','owner_car'])->where(['deal_type'=>$Time ,'state'=>2])->all();
        $tree = $this->buildTree($allDeals,$userID);
        print_r($this->allTree($userID, $tree));
        echo '***';
        
    }
    
    
    function buildTree(array $elements, $parentId) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['owner_car'] == $parentId) {
                $children = $this->buildTree($elements, $element['user']);
                if ($children) {
                    $element = [
                        'did' => $element['did'],
                        'user' => $element['user'],
                        'owner_car' => $element['owner_car'],
                        'children' => $children,
                    ];
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    
    function allTree($userID, $array) {
        //$list = array();
//        if( $array['name'] == $find ) {
//            return $array['category_id'];
//        }

        if( empty($array['children']) ) {
            return null;
        }

        foreach($array['children'] as $child) {
            $result = $this->allTree($userID, $child);
            if( $result !== null ) {
                return $result['did'];
            }
        }

        return null;
    }

    */
}
