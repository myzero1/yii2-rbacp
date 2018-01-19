<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Affiche */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="affiche-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Run the migration of rbacp </h3>
        </div>
        <?php $form = ActiveForm::begin([
          'options' => ['class' => 'form-horizontal'],
          'fieldConfig' => [
              'template' => "<div class='col-xs-3 col-sm-3 text-right'>{label}</div><div class='col-xs-5 col-sm-5'>{input}</div><div class='col-xs-12 col-xs-offset-3 col-sm-3 col-sm-offset-0'>{error}</div>",
        ]]); ?>

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
                        <li>Create table rbacp_relationship.</li>
                        <li>Create view rbacp_user_view.</li>
                    </ol>

                    <br>
                    <br>
                    <br>

                    <?= $form->field($model,'id')->textInput() ?>
                    <?= $form->field($model,'username')->textInput() ?>
                </div>
            </div>




        </div>
        <div class="box-footer">
            <div class="form-group form-group-box">
            	    <?= Html::submitButton('Runnming', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
