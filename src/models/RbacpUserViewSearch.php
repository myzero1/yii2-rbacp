<?php

namespace myzero1\rbacp\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use myzero1\rbacp\models\RbacpUserView;

/**
 * RbacpUserViewSearch represents the model behind the search form about `custom_components\modules\myzero1\rbacp\models\RbacpUserView`.
 */
class RbacpUserViewSearch extends RbacpUserView
{
    public $role_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username'], 'safe'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $aLabelNew = [
            'role_name' => Yii::t('rbacp', '角色名称'),
        ];

        $aLabelOld = parent::attributeLabels();

        return array_merge($aLabelOld, $aLabelNew);
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
        $query = RbacpUserView::find();

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
            'rbacp_user_view.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username]);


        // //自定义条件
        // $query->andFilterWhere([
        //     'rbacp_user_view.status' => 10,
        // ]);

        // 调用数据库查询策略
        $query->andFilterWhere([
            '=',
            'rbacp_user_view.id',
            $this->id
        ]);

        $query->andFilterWhere([
            '<>',
            'rbacp_user_view.id',
            'rbacp_policy_sku=rbacp|rbacp-user-view|index|rbacpPolicy|read|赋予角色列表'
        ]);


        // add role
        // $query->joinWith( $with = ['role'], $eagerLoading = true, $joinType = 'LEFT JOIN' );
        $query->joinWith( $with = ['role']);

        $query->andFilterWhere(['like', 'rbacp_role.name', $this->role_name]);



        // $attributOld = parent::attributes;
        $attributesOld = $dataProvider->getSort()->attributes;
        // var_dump($dataProvider->getSort());exit;
        $attributesNew = [
            'role_name' => [
                'asc' => ['rbacp_role.name' => SORT_ASC],
                'desc' => ['rbacp_role.name' => SORT_DESC],
                'label' => self::attributeLabels()['role_name']
            ],
        ];
        $attributesEnd = array_merge($attributesOld, $attributesNew);
        $dataProvider->setSort([
            'attributes' => $attributesEnd,
            'defaultOrder' => [
                'id' => SORT_DESC,
            ]
        ]);

        // var_dump($dataProvider->getSort());exit;

        return $dataProvider;
    }
}
