<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel custom_components\modules\myzero1\rbacp\models\RbacpUserViewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

myzero1\adminlteiframe\gii\GiiAsset::register($this);

$this->title = Yii::t('rbacp', '赋予角色');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbacp-user-view-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            'rbacp_policy_sku' => 'rbacp|rbacp-user-view|index|rbacpPolicy|list|rbacp授权列表',
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
