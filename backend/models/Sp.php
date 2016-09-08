<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%sp}}".
 *
 * @property integer $id
 * @property string $des
 * @property integer $position
 * @property integer $fpid
 *
 * @property Check[] $checks
 * @property FormInfo[] $formInfos
 * @property Fp $fp
 */
class Sp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fpid'], 'required'],
            [['position', 'fpid'], 'integer'],
            [['des'], 'string', 'max' => 255],
            [['fpid'], 'exist', 'skipOnError' => true, 'targetClass' => Fp::className(), 'targetAttribute' => ['fpid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '序号'),
            'des' => Yii::t('app', '二级问题描述'),
            'position' => Yii::t('app', '问题显示顺序'),
            'fpid' => Yii::t('app', '一级问题分类'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChecks()
    {
        return $this->hasMany(Check::className(), ['spid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormInfos()
    {
        return $this->hasMany(FormInfo::className(), ['secondlevel_problem' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFp()
    {
        return $this->hasOne(Fp::className(), ['id' => 'fpid']);
    }

    /**
     * @inheritdoc
     * @return SpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpQuery(get_called_class());
    }

    private static $_items=array();
    public static function items($fid){
        if(!isset($_items[$fid]))
            self::loadItems($fid);
        return self::$_items[$fid];
    }
    
    public static function item($fid,$sid)
    {
        if(!isset($_items[$fid][$sid]))
            self::loadItems($fid);
        return isset(self::$_items[$fid][$sid]) ? self::$_items[$fid][$sid] : false;
    }
    
    private static function loadItems($fid)
    {
        self::$_items[$fid]=array();
        $models=self::find()
        ->where(['fpid' => $fid])
        ->orderBy('position')
        ->all();
        foreach ($models as $model) {
            self::$_items[$fid][$model->id] = $model->des;
        }
    }
}
