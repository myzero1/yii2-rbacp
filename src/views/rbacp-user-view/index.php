<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\User3Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

myzero1\adminlteiframe\gii\GiiAsset::register($this);

$this->title = Yii::t('rbacp', '授权管理');
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
                'class' => yii\grid\CheckboxColumn::className(),
                'name' => 'id',
                'headerOptions' => ['width'=>'30'],
            ],
            'id',
            'username', 
            'role_name' => [
                'label'=>Yii::t('rbacp', '角色名称'),
                'attribute' => 'role_name',
                'value' => 'role.name'
            ],
            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $options = array_merge([
                            'class'=>'btn btn-primary btn-xs use-layer',
                            'layer-config' => sprintf('{type:2,title:"%s",content:"%s",shadeClose:false}', '修改',  yii\helpers\Url::toRoute(['update', 'id' => $model->id])) ,
                             'rbacp_policy_sku' => 'rbacp|rbacp-user-view|index|rbacpPolicy|tag|rbacp授权列表修改按钮'

                        ]);
                        return Html::a('修改', '#', $options);
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
