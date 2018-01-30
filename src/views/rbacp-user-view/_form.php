<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php
        $defaultOptions = ['maxlength' => true, 'disabled' => 'disabled'];
    ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('rbacp', '修改用户 #{id} 的角色', ['id' => $model->id])?></h3>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <?= $form->field($model, 'id')->textInput($defaultOptions) ?>
            <?= $form->field($model, 'username')->textInput($defaultOptions) ?>
            <?= $form->field($model, 'role_id')->textInput(['maxlength' => true])->label(Yii::t('rbacp', '角色'))->dropDownList($aRoles, ['prompt' => Yii::t('rbacp', '请选择角色')]) ?>
        </div>
        <div class="box-footer">
            <div class="form-group form-group-box">
                <?= Html::submitButton(Yii::t('rbacp', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
