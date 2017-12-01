<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpUserViewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rbacp-user-view-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-horizontal filter-form'],
        'fieldConfig' => [
            'template' => "<div class='field-lable'>{label}</div><div class='field-input'>{input}</div>",
        ]
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'role_name') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rbacp', '查询'), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
