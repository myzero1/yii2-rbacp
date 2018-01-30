<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel custom_components\modules\myzero1\rbacp\models\RbacpUserViewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbacp', '策略管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbacp-user-view-index">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('rbacp', '策略列表')?></h3>
            <?php
                echo yii\helpers\BaseHtml::tag('a', '创建', array(
                    'href' => yii\helpers\Url::toRoute(['create']),
                    'class' => 'btn btn-success btn-sm',
                    'rbacp_policy_sku' => 'rbacp|rbacp-policy|index|rbacpPolicy|tag|rbacp策略列表创建按钮'
                ));
            ?>
        </div>
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([ 
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'options' => [
                    'rbacp_policy_sku' => 'rbacp|rbacp-policy|index|rbacpPolicy|list|rbacp策略列表'
                ],
                'columns' => [
                    'id',
                    'name',
                    'description',
                    'sku' =>[
                       'class' => 'yii\grid\DataColumn',
                       'attribute' => 'sku',
                       'options' => [
                            'style' => 'width:200px',
                       ]
                    ],
                    'type' =>[
                       'class' => 'yii\grid\DataColumn',
                       'label' => Yii::t('rbacp', '策略类型'),
                       'attribute' => 'type',
                       'value' => function ($row) {
                            return \myzero1\rbacp\models\RbacpPolicy::type()[$row->type];
                        },
                    ],
                    'scope' =>[
                       'class' => 'yii\grid\DataColumn',
                       'label' => Yii::t('rbacp', '策略作用域'),
                       'attribute' => 'scope',
                       'value' => function ($row) {
                            return \myzero1\rbacp\models\RbacpPolicy::scope()[$row->scope];
                        },
                    ],
                    'status' =>[
                       'class' => 'yii\grid\DataColumn',
                       'label' => Yii::t('rbacp', '策略状态'),
                       'attribute' => 'status',
                       'value' => function ($row) {
                            return \myzero1\rbacp\models\RbacpPolicy::status()[$row->status];
                        },
                    ],
                    'rules' =>[
                       'class' => 'yii\grid\DataColumn',
                       'attribute' => 'rules',
                       'options' => [
                            'style' => 'width:200px',
                       ]
                    ],

                    'operation' => [
                        // 'contentOptions' => [
                        //     'width'=>'100'
                        // ],
                        'headerOptions' => [
                            'width'=>'100px'
                        ],
                        'header' => Yii::t('rbacp', '操作'),
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return yii\helpers\BaseHtml::tag('a', '修改', array(
                                    'href' => yii\helpers\Url::toRoute(['update', 'id' => $model->id]),
                                    'class' => 'operation btn btn-primary btn-xs delete-role list-delete',
                                    'rbacp_policy_sku' => 'rbacp|rbacp-policy|index|rbacpPolicy|tag|rbacp策略列表修改按钮'
                                ));
                            },
                            'delete' => function ($url, $model) {
                                return yii\helpers\BaseHtml::tag('a', '删除', array(
                                    'href' => yii\helpers\Url::toRoute(['delete', 'id' => $model->id]),
                                    'class' => 'operation btn btn-primary btn-xs delete-role list-delete',
                                    'rbacp_policy_sku' => 'rbacp|rbacp-policy|index|rbacpPolicy|tag|rbacp策略列表删除按钮',
                                    'data-confirm' => Yii::t('rbacp', '请问你确定删除吗？'),
                                    'data-method' => 'post',
                                ));
                            },

                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
