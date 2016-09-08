<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%check}}".
 *
 * @property integer $id
 * @property integer $fpid
 * @property integer $spid
 * @property string $des
 * @property integer $position
 *
 * @property Fp $fp
 * @property Sp $sp
 */
class Check extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%check}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fpid', 'spid', 'des', 'position'], 'required'],
            [['fpid', 'spid', 'position'], 'integer'],
            [['des'], 'string'],
            [['fpid'], 'exist', 'skipOnError' => true, 'targetClass' => Fp::className(), 'targetAttribute' => ['fpid' => 'id']],
            [['spid'], 'exist', 'skipOnError' => true, 'targetClass' => Sp::className(), 'targetAttribute' => ['spid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '序号'),
            'fpid' => Yii::t('app', '一级问题类别'),
            'spid' => Yii::t('app', '二级问题类别'),
            'des' => Yii::t('app', '检查步骤'),
            'position' => Yii::t('app', '显示顺序'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFp()
    {
        return $this->hasOne(Fp::className(), ['id' => 'fpid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSp()
    {
        return $this->hasOne(Sp::className(), ['id' => 'spid']);
    }

    /**
     * @inheritdoc
     * @return CheckQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CheckQuery(get_called_class());
    }
}
