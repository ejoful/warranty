<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%lookup}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 */
class Lookup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lookup}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'type', 'position'], 'required'],
            [['code', 'position'], 'integer'],
            [['name', 'type'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '主键'),
            'name' => Yii::t('app', '名字'),
            'code' => Yii::t('app', '编码'),
            'type' => Yii::t('app', '类型'),
            'position' => Yii::t('app', '显示顺序'),
        ];
    }

    /**
     * @inheritdoc
     * @return LookupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LookupQuery(get_called_class());
    }
}
