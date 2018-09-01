<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel custom_components\modules\myzero1\rbacp\models\RbacpPrivilegeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

myzero1\adminlteiframe\gii\GiiAsset::register($this);

$this->title = Yii::t('rbacp', '权限管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbacp-privilege-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            'url',
            'status' =>[
               'class' => 'yii\grid\DataColumn',
               'label' => Yii::t('rbacp', '权限状态'),
               'attribute' => 'status',
               'value' => function ($row) {
                    return \myzero1\rbacp\models\RbacpPolicy::status()[$row->status];
                },
            ],
            'description',
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
            [
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
                        return Html::a(Yii::t('yii', 'Update'), '#', $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $options = array_merge([
                            'class'=>'btn btn-danger btn-xs use-layer',
                            'layer-config' => sprintf('{icon:3,area:["500px","200px"],type:0,title:"%s",content:"%s",shadeClose:false,btn:["确定","取消"],yes:function(index,layero){$.post("%s", {}, function(str){$(layero).find(".layui-layer-content").html(str);});},btn2:function(index, layero){layer.close(index);}}', Yii::t('yii', 'Delete'), '一旦删除，不能找回，你确定删除吗？',$url) ,
                            'rbacp_policy_sku' => 'rbacp|rbacp-privilege|index|rbacpPolicy|tag|rbacp权限列表删除按钮',
                        ]);
                        return Html::a(Yii::t('yii', 'Delete'), '#', $options);
                    }
                ],
            ],
        ],
        'options' => [
            'rbacp_policy_sku' => 'rbacp|rbacp-privilege|index|rbacpPolicy|list|rbacp权限列表',
            'class' => 'adminlteiframe-gridview',
        ],
        'tableOptions' => [
            'class' => 'gridview-table table table-bordered table-hover dataTable'
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

<?php 
$js=<<<eof
    function getTableHeight(){
        var heightToal = window.parent.$('html').outerHeight(true);
        var filterHeight = $(".adminlteiframe-action-box").height();
        height = heightToal - $(".adminlteiframe-action-box").height();// subtract filters
        height = height - 260;// subtract others
        return height;
    }

    function fixTable(){
        if (!($(".gridview-table .empty").length > 0 || $(".gridview-table tbody tr").length == 0)) {
                if(typeof mybootstrapTable!="undefined"){
                    mybootstrapTable.bootstrapTable('destroy');
                }

                mybootstrapTable = $(".gridview-table").bootstrapTable('destroy').bootstrapTable({
                    height: getTableHeight(),
                    fixedColumns: true
                });
        }
    }

    fixTable();

    $(window).resize(function(){
        fixTable();
    });

eof;

$this->registerJs($js);

?>

</div>
