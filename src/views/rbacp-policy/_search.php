<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rbacpt\models\RbacpPolicySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rbacp-policy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-horizontal filter-form'],
        'fieldConfig' => [
            'template' => "<div class='field-lable'>{label}</div><div class='field-input'>{input}</div>",
        ]
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'rules') ?>

    <?php // echo $form->field($model, 'scope') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'privilege_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary  btn-sm']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default  btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
