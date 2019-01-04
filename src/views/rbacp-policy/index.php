<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\User3Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

myzero1\adminlteiframe\gii\GiiAsset::register($this);

$this->title = Yii::t('rbacp', '数据策略');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user2-index">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'headerOptions' => ['width'=>'30'],
                'class' => yii\grid\CheckboxColumn::className(),
                'name' => 'z1selected',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                },
            ],
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
            'updated' => [
               'class' => 'yii\grid\DataColumn',
               'label' => Yii::t('rbacp', '更新时间'),
               'attribute' => 'updated',
               'value' => function ($row) {
                    return date('Y-m-d H:i:s', $row->updated);
                },
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
                    'update' => function ($url, $model, $key) {
                        $options = array_merge([
                            'class'=>'btn btn-primary btn-xs use-layer',
                            'layer-config' => sprintf('{type:2,title:"%s",content:"%s",shadeClose:false}', Yii::t('yii', 'Update'), $url) ,
                            'rbacp_policy_sku' => 'rbacp|rbacp-privilege|index|rbacpPolicy|tag|rbacp权限列表修改按钮'
                        ]);
                        return Html::a(Yii::t('yii', '修改'), '#', $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $options = array_merge([
                            'class'=>'btn btn-danger btn-xs use-layer',
                            'layer-config' => sprintf('{icon:3,area:["500px","200px"],type:0,title:"%s",content:"%s",shadeClose:false,btn:["确定","取消"],yes:function(index,layero){$.post("%s", {}, function(str){$(layero).find(".layui-layer-content").html(str);});},btn2:function(index, layero){layer.close(index);}}', Yii::t('yii', 'Delete'), '一旦删除，不能找回，你确定删除吗？',$url) ,
                            'rbacp_policy_sku' => 'rbacp|rbacp-privilege|index|rbacpPolicy|tag|rbacp权限列表删除按钮',
                        ]);
                        return Html::a(Yii::t('yii', '删除'), '#', $options);
                    }
                ],
            ],
        ],
        'options' => [
            'class' => 'adminlteiframe-gridview',
        ],
        'tableOptions' => [
            'class' => 'gridview-table table table-bordered table-hover dataTable',
            'data-provide' => 'z1table',
            'data-z1table-config' => '{"fixedColumns":true,"subtraction1":220,"subtraction2Selector":[".adminlteiframe-action-box"]}',
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
