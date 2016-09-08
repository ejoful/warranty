<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FormInfo;

/**
 * FormInfoSearch represents the model behind the search form about `backend\models\FormInfo`.
 */
class FormInfoSearch extends FormInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country', 'firstlevel_problem', 'secondlevel_problem', 'status', 'wwid', 'reviewerid', 'logisid'], 'integer'],
            [['consumer_name', 'consumer_phone', 'watch_id', 'email', 'address', 'problem_des', 'video', 'create_time', 'update_time'], 'safe'],
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
        $query = FormInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'country' => $this->country,
            'firstlevel_problem' => $this->firstlevel_problem,
            'secondlevel_problem' => $this->secondlevel_problem,
            'create_time' => $this->create_time,
            'status' => $this->status,
            'update_time' => $this->update_time,
            'wwid' => $this->wwid,
            'reviewerid' => $this->reviewerid,
            'logisid' => $this->logisid,
        ]);

        $query->andFilterWhere(['like', 'consumer_name', $this->consumer_name])
            ->andFilterWhere(['like', 'consumer_phone', $this->consumer_phone])
            ->andFilterWhere(['like', 'watch_id', $this->watch_id])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'problem_des', $this->problem_des])
            ->andFilterWhere(['like', 'video', $this->video]);

        return $dataProvider;
    }
}
