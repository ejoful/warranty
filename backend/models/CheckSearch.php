<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Check;

/**
 * CheckSearch represents the model behind the search form about `backend\models\Check`.
 */
class CheckSearch extends Check
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fpid', 'spid', 'position'], 'integer'],
            [['des', 'yes', 'no'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Check::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fpid' => $this->fpid,
            'spid' => $this->spid,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'des', $this->des])
            ->andFilterWhere(['like', 'yes', $this->yes])
            ->andFilterWhere(['like', 'no', $this->no]);

        return $dataProvider;
    }
}
