<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%country}}".
 *
 * @property integer $id
 * @property string $country_name
 * @property integer $position
 *
 * @property FormInfo[] $formInfos
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_name'], 'required'],
            [['position'], 'integer'],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '序号'),
            'country_name' => Yii::t('app', '国家名'),
            'position' => Yii::t('app', '显示顺序'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormInfos()
    {
        return $this->hasMany(FormInfo::className(), ['country' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountryQuery(get_called_class());
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
            self::$_items[$model->id] = $model->country_name;
        }
    }
}
