<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User2Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adminlteiframe-action-box user2-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'status')->dropDownList(
            \myzero1\rbacp\models\RbacpActiveRecord::status(),
            ['prompt' => Yii::t('rbacp', '请选择')]
        )
    ?>

    <div class="form-group aciotns">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>

        <?= Html::a('添加', '#', [
            'class' => 'btn btn-success use-layer',
            'layer-config' => sprintf('{type:2,title:"%s",content:"%s",shadeClose:false}', '添加', Url::to(['create'])) ,
        ]); ?>



        <?= Html::a('批量删除', '#', [
                'id'=>'delete-selected',
                'url'=>Url::to(['delete-selected','ids' => '']),
                'class'=>'btn btn-danger use-layer',
                'layer-config' => sprintf('{icon:3,area:["500px","200px"],type:0,title:"%s",content:"%s",shadeClose:false,btn:["确定","取消"],yes:function(index,layero){var url=$("#delete-selected").attr("url");$.post(url, {}, function(str){$(layero).find(".layui-layer-content").html(str);});},btn2:function(index, layero){layer.close(index);}}', '批量删除', '一旦删除，无法恢复，是否删除选定的数据？') 
            ]); ?>

    </div>
    <?php ActiveForm::end(); ?>

</div>
