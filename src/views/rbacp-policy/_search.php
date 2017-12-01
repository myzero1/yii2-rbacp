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

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'type')->dropDownList(
            \myzero1\rbacp\models\RbacpPolicy::type(),
            ['prompt' => Yii::t('rbacp', '请选择')]
        )
    ?>

    <?= $form->field($model, 'scope')->dropDownList(
            \myzero1\rbacp\models\RbacpPolicy::scope(),
            ['prompt' => Yii::t('rbacp', '请选择')]
        )
    ?>

    <?= $form->field($model, 'status')->dropDownList(
            \myzero1\rbacp\models\RbacpPolicy::status(),
            ['prompt' => Yii::t('rbacp', '请选择')]
        )
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rbacp', '搜索'), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
