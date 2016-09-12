<?php

namespace frontend\models;

use Yii;
use backend\models\Country;
use backend\models\Fp;
use backend\models\Sp;
/**
 * This is the model class for table "{{%form_info}}".
 *
 * @property integer $id
 * @property string $consumer_name
 * @property string $consumer_phone
 * @property string $watch_id
 * @property string $email
 * @property integer $country
 * @property string $address
 * @property string $zip_code
 * @property integer $firstlevel_problem
 * @property integer $secondlevel_problem
 * @property string $certificate
 * @property string $problem_des
 * @property string $video
 * @property string $create_time
 * @property integer $status
 * @property string $update_time
 * @property string $wwid
 * @property integer $reviewerid
 * @property integer $logisid
 *
 * @property Country $country0
 * @property Fp $firstlevelProblem
 * @property Sp $secondlevelProblem
 */
class FormInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consumer_name', 'consumer_phone', 'watch_id', 'email', 'country', 'address', 'zip_code', 'certificate', 'create_time', 'wwid'], 'required'],
            [['country', 'firstlevel_problem', 'secondlevel_problem', 'status', 'reviewerid', 'logisid'], 'integer'],
            [['certificate', 'problem_des'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['consumer_name', 'watch_id', 'wwid'], 'string', 'max' => 100],
            [['consumer_phone'], 'string', 'max' => 30],
            [['email', 'address'], 'string', 'max' => 200],
            [['zip_code'], 'string', 'max' => 20],
            [['video'], 'string', 'max' => 255],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country' => 'id']],
            [['firstlevel_problem'], 'exist', 'skipOnError' => true, 'targetClass' => Fp::className(), 'targetAttribute' => ['firstlevel_problem' => 'id']],
            [['secondlevel_problem'], 'exist', 'skipOnError' => true, 'targetClass' => Sp::className(), 'targetAttribute' => ['secondlevel_problem' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '序号'),
            'consumer_name' => Yii::t('app', '姓名'),
            'consumer_phone' => Yii::t('app', '电话'),
            'watch_id' => Yii::t('app', '手表sn码'),
            'email' => Yii::t('app', '邮箱'),
            'country' => Yii::t('app', '收货国家'),
            'address' => Yii::t('app', '收货地址'),
            'zip_code' => Yii::t('app', '邮编'),
            'firstlevel_problem' => Yii::t('app', '问题类别'),
            'secondlevel_problem' => Yii::t('app', '问题描述'),
            'certificate' => Yii::t('app', '凭证'),
            'problem_des' => Yii::t('app', '问题详细描述'),
            'video' => Yii::t('app', '视频链接'),
            'create_time' => Yii::t('app', '问题提交日期'),
            'status' => Yii::t('app', '审核状态'),
            'update_time' => Yii::t('app', '问题审核日期'),
            'wwid' => Yii::t('app', '问问id'),
            'reviewerid' => Yii::t('app', '审核人员'),
            'logisid' => Yii::t('app', '物流人员'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Country::className(), ['id' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstlevelProblem()
    {
        return $this->hasOne(Fp::className(), ['id' => 'firstlevel_problem']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondlevelProblem()
    {
        return $this->hasOne(Sp::className(), ['id' => 'secondlevel_problem']);
    }

    /**
     * @inheritdoc
     * @return FormInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormInfoQuery(get_called_class());
    }

    public static function item($id){
        $model = self::find()
        ->where(['id'=>$id])
        ->one();
        if(!($model->problem_des)){
            $sp = Sp::find()
            ->where(['id' => $model->secondlevel_problem])
            ->one();
            return $sp->des;
        }
        else{
            return $model->problem_des;
        }
    }
}
