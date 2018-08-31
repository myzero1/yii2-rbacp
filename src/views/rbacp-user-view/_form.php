<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User2 */
/* @var $form yii\widgets\ActiveForm */

$defaultOptions = ['maxlength' => true, 'disabled' => 'disabled'];

?>

<div class="user2-form">

    <?php $form = ActiveForm::begin(['id'=> 'layer-form-' . $this->context->action->id, 'options' => ['class' => 'adminlteiframe-form']]) ?>

        <?= $form->field($model, 'id')->textInput($defaultOptions) ?>
        <?= $form->field($model, 'username')->textInput($defaultOptions) ?>
        <?= $form->field($model, 'role_id')->textInput(['maxlength' => true])->label(Yii::t('rbacp', '角色'))->dropDownList($aRoles, ['prompt' => Yii::t('rbacp', '请选择角色')]) ?>

        <div class="form-group">
            <?= Html::submitButton('修改', ['class' =>'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end() ?>

</div>

<style type="text/css">
    .adminlteiframe-form .form-group{
        float: left;
        width: 100%;
    }
</style>