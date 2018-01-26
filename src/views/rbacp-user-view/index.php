<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel custom_components\modules\myzero1\rbacp\models\RbacpUserViewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbacp', '赋予角色');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbacp-user-view-index">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('rbacp', '待修改角色的用户列表')?></h3>
        </div>
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'rbacp_policy_sku' => 'rbacp|rbacp-user-view|index|rbacpPolicy|list|rbacp授权列表'
                ],
                'columns' => [
                    'id',
                    'username', 
                    'role_name' => [
                        'label'=>Yii::t('rbacp', '角色名称'),
                        'attribute' => 'role_name',
                        'value' => 'role.name'
                    ],

                    'operation' => [
                        'header' => Yii::t('rbacp', '操作'),
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return yii\helpers\BaseHtml::tag('a', '修改', array(
                                    'href' => yii\helpers\Url::toRoute(['update', 'id' => $model->id]),
                                    'class' => 'operation btn btn-primary btn-xs delete-role list-delete',
                                    'rbacp_policy_sku' => 'rbacp|rbacp-user-view|index|rbacpPolicy|tag|rbacp授权列表修改按钮'
                                ));
                            },

                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
