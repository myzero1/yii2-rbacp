<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbacp', '角色管理');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="rbacp-role-index">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('rbacp', '角色列表')?></h3>
            <?php
                echo yii\helpers\BaseHtml::tag('a', '创建', array(
                    'href' => yii\helpers\Url::toRoute(['create']),
                    'class' => 'btn btn-success btn-sm',
                    'rbacp_policy_sku' => 'rbacp|rbacp-role|index|rbacpPolicy|tag|角色列表创建按钮'
                ));
            ?>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'rbacp_policy_sku' => 'rbacp|rbacp-role|index|rbacpPolicy|list|角色列表'
                ],
                'columns' => [
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
                                    'href' => yii\helpers\Url::toRoute(['update', 'id' => $model->id]),
                                    'class' => 'operation btn btn-primary btn-xs delete-role list-delete',
                                    'rbacp_policy_sku' => 'rbacp|rbacp-role|index|rbacpPolicy|tag|角色列表修改按钮'
                                ));
                            },
                            'delete' => function ($url, $model) {
                                return yii\helpers\BaseHtml::tag('a', '删除', array(
                                    'href' => yii\helpers\Url::toRoute(['delete', 'id' => $model->id]),
                                    'class' => 'operation btn btn-primary btn-xs delete-role list-delete',
                                    'rbacp_policy_sku' => 'rbacp|rbacp-role|index|rbacpPolicy|tag|角色列表删除按钮',
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


 <?php
  /*  if ( Yii::$app->session->hasFlash('deleteFail') ) {
        $deleteFail = Yii::$app->session->getFlash('deleteFail');
        $deleteFailJson = json_decode($deleteFail, TRUE);
        $msg = $deleteFailJson['msg'];

        $sJS = <<<JS
function rateAlert(title, message, alert_class){
  if (message) {
    message = '<br>' + message;
  }
  var ele = '<div class="rate_alert_wrap" style="display: none;"><div class="alert '+ alert_class +'">\
              <strong>'+title+'</strong>'+message+'\
            </div></div>';
  $("body").prepend(ele);
  $('.rate_alert_wrap').slideDown(1000);

  setTimeout("\$('.rate_alert_wrap').slideUp(1000,function(){\$('.rate_alert_wrap').remove();});", 5000 );
}
JS;


        $this->registerJs ($sJS);
        $this->registerJs ( "rateAlert('$msg', '', 'alert alert alert-success');",
            $position = $this::POS_READY,
            $key = 'specialSuccess' );
    }*/
 ?>