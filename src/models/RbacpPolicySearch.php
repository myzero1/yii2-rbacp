<?php

namespace myzero1\rbacp\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use myzero1\rbacp\models\RbacpPolicy;

/**
 * RbacpPolicySearch represents the model behind the search form about `custom_components\modules\myzero1\rbacp\models\RbacpPolicy`.
 */
class RbacpPolicySearch extends RbacpPolicy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'privilege_id', 'status', 'created', 'updated', 'scope', 'type'], 'integer'],
            [['name', 'description', 'rules', 'sku', 'type'], 'safe'],
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
        $query = RbacpPolicy::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
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
            'privilege_id' => $this->privilege_id,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
            'scope' => $this->scope,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'rules', $this->rules])
            ->andFilterWhere(['like', 'sku', $this->sku]);

        return $dataProvider;
    }
}
