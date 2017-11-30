<?php

namespace myzero1\rbacp\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use myzero1\rbacp\models\RbacpUservRole;

/**
 * RbacpUservRoleSearch represents the model behind the search form about `myzero1\rbacp\models\RbacpUservRole`.
 */
class RbacpUservRoleSearch extends RbacpUservRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role_id', 'userv_id', 'status', 'created', 'updated'], 'integer'],
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
        $query = RbacpUservRole::find();

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
            'role_id' => $this->role_id,
            'userv_id' => $this->userv_id,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        return $dataProvider;
    }
}
