<?php
namespace backend\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
     public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add user_identity to scenarios
        $scenarios['create'][]   = 'user_identity';
        $scenarios['update'][]   = 'user_identity';
        $scenarios['search'][]   = 'user_identity';
        $scenarios['register'][] = 'user_identity';
        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();
        // add some rules
        $rules['fieldRequired'] = ['user_identity', 'required'];
        $rules['fieldLength']   = ['user_identity', 'string', 'max' => 50];
        
        return $rules;
    }

    public static function getName($id){
        $model=self::find()
        ->where(['id' => $id])
        ->one();
        return $model->username;
    }
}