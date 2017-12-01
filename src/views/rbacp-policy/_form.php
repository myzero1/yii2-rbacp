<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\BaseArrayHelper;

/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rbacp-role-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?=$sBoxTile?></h3>
        </div>
        <?php $form = ActiveForm::begin([
          'options' => ['class' => 'form-horizontal'],
          'fieldConfig' => [
              'template' => "<div class='col-xs-3 col-sm-2 text-right'>{label}</div><div class='col-xs-9 col-sm-7'>{input}</div><div class='col-xs-12 col-xs-offset-3 col-sm-3 col-sm-offset-0'>{error}</div>",
        ]]); ?>
        <div class="box-body">

            <?= $form->field($model, 'privilege_id')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


            <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type')->dropDownList(
                    \myzero1\rbacp\models\RbacpPolicy::type()
                )
            ?>

            <?= $form->field($model, 'scope')->dropDownList(
                    \myzero1\rbacp\models\RbacpPolicy::scope()
                )
            ?>

            <?= $form->field($model, 'status')->dropDownList(
                    \myzero1\rbacp\models\RbacpPolicy::status()
                )
            ?>

            <?= $form->field($model, 'rules')->textarea(['maxlength' => true]) ?>
        </div>
        <div class="box-footer">
            <div class="form-group form-group-box">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('rbacp', '创建') : Yii::t('rbacp', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>