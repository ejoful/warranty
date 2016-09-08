<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[FormInfo]].
 *
 * @see FormInfo
 */
class FormInfoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return FormInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FormInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
