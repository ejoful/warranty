<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%fp}}".
 *
 * @property integer $id
 * @property string $des
 * @property integer $position
 *
 * @property Check[] $checks
 * @property FormInfo[] $formInfos
 * @property Sp[] $sps
 */
class Fp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['des'], 'required'],
            [['position'], 'integer'],
            [['des'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '序号'),
            'des' => Yii::t('app', '一级问题描述'),
            'position' => Yii::t('app', '问题显示顺序'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChecks()
    {
        return $this->hasMany(Check::className(), ['fpid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormInfos()
    {
        return $this->hasMany(FormInfo::className(), ['firstlevel_problem' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSps()
    {
        return $this->hasMany(Sp::className(), ['fpid' => 'id']);
    }

    /**
     * @inheritdoc
     * @return FpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FpQuery(get_called_class());
    }

    private static $_items=array();
    public static function items(){
        self::loadItems();
        return self::$_items;
    }
    
    public static function item($id)
    {
        if(!isset(self::$_items[$id]))
            self::loadItems();
            return isset(self::$_items[$id]) ? self::$_items[$id] : false;
    }
    
    private static function loadItems()
    {
        $models=self::find()
        ->orderBy('position')
        ->all();
        foreach ($models as $model) {
            self::$_items[$model->id] = $model->des;
        }
    }
}
