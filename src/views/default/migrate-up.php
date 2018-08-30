<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Affiche */
/* @var $form yii\widgets\ActiveForm */

\myzero1\adminlteiframe\gii\GiiAsset::register($this);

?>

<div class="affiche-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Up the migration of rbacp </h3>
        </div>

        <?php $form = ActiveForm::begin(['id'=> 'layer-form-' . $this->context->action->id, 'options' => ['class' => 'adminlteiframe-form']]) ?>

        <div class="box-body">

            <?php if (!empty($message)) { ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    The message of the running
                </div>
                <div class="panel-body">
                    <?php echo $message; ?>
                </div>
            </div>
            <?php } ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    It will do following:
                </div>
                <div class="panel-body">
                    <ol>
                        <li>Create table rbacp_policy.</li>
                        <li>Create table rbacp_privilege.</li>
                        <li>Create table rbacp_role.</li>
                        <li>Create table rbacp_userv_role.</li>
                        <li>Create view rbacp_user_view.</li>
                    </ol>

                    <br>
                    <br>
                    <br>

                    <?= $form->field($model,'table')->textInput() ?>
                    <?= $form->field($model,'id')->textInput() ?>
                    <?= $form->field($model,'username')->textInput() ?>
                    <?= $form->field($model,'status')->textInput() ?>
                </div>
            </div>




        </div>
        <div class="box-footer">
            <div class="form-group form-group-box">
                    <?= Html::submitButton('migration up', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>

<style type="text/css">
    .adminlteiframe-form .form-group{
        width: 100% !important;
    }
</style>