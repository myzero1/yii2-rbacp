<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\BaseArrayHelper;

/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpRole */
/* @var $form yii\widgets\ActiveForm */

myzero1\adminlteiframe\gii\GiiAsset::register($this);

?>

<div class="rbacp-privilege-form">
    <?php $form = ActiveForm::begin(['id'=> 'layer-form-' . $this->context->action->id, 'options' => ['class' => 'adminlteiframe-form']]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList(
                \myzero1\rbacp\models\RbacpActiveRecord::status()
            )
        ?>

        <div class="form-group form-group-box">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('rbacp', '创建') : Yii::t('rbacp', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
