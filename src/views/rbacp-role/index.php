<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\User3Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

myzero1\adminlteiframe\gii\GiiAsset::register($this);

$this->title = Yii::t('rbacp', '角色管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user2-index">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->

    <div class="adminlteiframe-action-box user2-search">
        <div class="form-group aciotns">
            <?= Html::a('添加', '#', [
                'class' => 'btn btn-success use-layer',
                'layer-config' => sprintf('{area:["735px","400px"],type:2,title:"%s",content:"%s",shadeClose:false}', '添加', Url::to(['create'])) ,
                 'rbacp_policy_sku' => 'rbacp|rbacp-role|index|rbacpPolicy|tag|角色列表创建按钮',
            ]); ?>

            <?= Html::a('批量删除', '#', [
                    'id'=>'delete-selected',
                    'url'=>Url::to(['delete-selected','ids' => '']),
                    'class'=>'btn btn-danger use-layer',
                    'layer-config' => sprintf('{icon:3,area:["500px","200px"],type:0,title:"%s",content:"%s",shadeClose:false,btn:["确定","取消"],yes:function(index,layero){var url=$("#delete-selected").attr("url");$.post(url, {}, function(str){$(layero).find(".layui-layer-content").html(str);});},btn2:function(index, layero){layer.close(index);}}', '批量删除', '一旦删除，无法恢复，是否删除选定的数据？') 
                ]); ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => yii\grid\CheckboxColumn::className(),
                'name' => 'id',
                'headerOptions' => ['width'=>'30'],
            ],
            'id' => ['label'=>Yii::t('rbacp', '角色ID'), 'attribute' => 'id',  'value' => 'id' ],
            'name',
            'description',
            'status' =>[
               'class' => 'yii\grid\DataColumn',
               'label' => Yii::t('rbacp', '策略状态'),
               'attribute' => 'status',
               'value' => function ($row) {
                    return \myzero1\rbacp\models\RbacpRole::status()[$row->status];
                },
            ],
            'created' => [
               'class' => 'yii\grid\DataColumn',
               'label' => Yii::t('rbacp', '创建时间'),
               'attribute' => 'created',
               'value' => function ($row) {
                    return date('Y-m-d H:i:s', $row->created);
                },
            ],
            'updated' => [
               'class' => 'yii\grid\DataColumn',
               'label' => Yii::t('rbacp', '更新时间'),
               'attribute' => 'updated',
               'value' => function ($row) {
                    return date('Y-m-d H:i:s', $row->updated);
                },
            ],
            'author' => [
                'label'=>Yii::t('rbacp', '作者'),
                'attribute' => 'author',
                'value' => function($row){
                    return \myzero1\rbacp\models\RbacpUserView::getUsernameById($row->author);
                }
            ],

            'operation' => [
                'header' => Yii::t('rbacp', '操作'),
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return yii\helpers\BaseHtml::tag('a', '修改', array(
                            'class'=>'btn btn-primary btn-xs use-layer',
                            'layer-config' => sprintf('{area:["735px","400px"],type:2,title:"%s",content:"%s",shadeClose:false}', '修改', yii\helpers\Url::toRoute(['update', 'id' => $model->id])) ,
                            'rbacp_policy_sku' => 'rbacp|rbacp-role|index|rbacpPolicy|tag|角色列表修改按钮'
                        ));
                    },
                    'delete' => function ($url, $model) {
                        return yii\helpers\BaseHtml::tag('a', '删除', array(
                            'class'=>'btn btn-danger btn-xs use-layer',
                            'layer-config' => sprintf('{icon:3,area:["500px","200px"],type:0,title:"%s",content:"%s",shadeClose:false,btn:["确定","取消"],yes:function(index,layero){$.post("%s", {}, function(str){$(layero).find(".layui-layer-content").html(str);});},btn2:function(index, layero){layer.close(index);}}', '删除', '一旦删除，不能找回，你确定删除吗？',yii\helpers\Url::toRoute(['delete', 'id' => $model->id])) ,
                            'rbacp_policy_sku' => 'rbacp|rbacp-role|index|rbacpPolicy|tag|角色列表删除按钮',
                        ));
                    },
                ]
            ],
        ],
        'options' => [
            'class' => 'adminlteiframe-gridview',
        ],
        'tableOptions' => [
            'class' => 'gridview-table table table-bordered table-hover dataTable',
            'data-provide' => 'z1table',
            'data-z1table-config' => '{"fixedColumns":true,"subtraction1":60,"subtraction2Selector":[".adminlteiframe-action-box"]}',
        ],
        'summary' => '
            <div class="admlteiframe-gv-summary">
                共 <span class="total">{totalCount}</span> 条
            </div>
        ',
        'layout'=> '
            {items}
            <div class="admlteiframe-gv-footer">
                {pager}{summary}
            </div>
        ',
        'pager' => [
            'class' => \myzero1\adminlteiframe\widgets\LinkPager::className(),
            'firstPageLabel'=>"<<",
            'prevPageLabel'=>'<',
            'nextPageLabel'=>'>',
            'lastPageLabel'=>'>>',
            'maxButtonCount'=>'5',
            // 'activePageCssClass' => 'btn btn-primary btn-xs',
            'hideOnSinglePage'=>false,
            'options' => [
                'class' => 'admlteiframe-gv-pagination'
            ],
        ],
    ]); ?>

</div>
