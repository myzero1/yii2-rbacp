<?php

namespace myzero1\rbacp\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use myzero1\rbacp\models\RbacpRole;

/**
 * RbacpRoleSearch represents the model behind the search form about `myzero1\rbacp\models\RbacpRole`.
 */
class RbacpRoleSearch extends RbacpRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created', 'updated', 'author'], 'integer'],
            [['name', 'description', 'policy_ids', 'privilege_ids', 'policy_datas'], 'safe'],
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
        $query = RbacpRole::find();

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
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
            'author' => $this->author,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'policy_ids', $this->policy_ids])
            ->andFilterWhere(['like', 'privilege_ids', $this->privilege_ids])
            ->andFilterWhere(['like', 'policy_datas', $this->policy_datas]);

        return $dataProvider;
    }
}
