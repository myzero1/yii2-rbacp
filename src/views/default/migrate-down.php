<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Affiche */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="affiche-form">
    <div class="box box-primary box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Down the migration of rbacp </h3>
        </div>
        <?php $form = ActiveForm::begin(); ?>

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
                        <li>Drop table rbacp_policy.</li>
                        <li>Drop table rbacp_privilege.</li>
                        <li>Drop table rbacp_role.</li>
                        <li>Drop table rbacp_userv_role.</li>
                        <li>Drop view rbacp_user_view.</li>
                    </ol>

                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group form-group-box">
                    <?= Html::submitButton('migration down', ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
