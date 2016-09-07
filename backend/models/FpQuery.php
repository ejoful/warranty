<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Fp]].
 *
 * @see Fp
 */
class FpQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Fp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Fp|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
