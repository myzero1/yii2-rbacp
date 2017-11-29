<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Affiche */
/* @var $form yii\widgets\ActiveForm */

$model = new backend\models\LoginForm();
?>

<div class="affiche-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <?php $form = ActiveForm::begin([
          'options' => ['class' => 'form-horizontal'],
          'fieldConfig' => [
              'template' => "<div class='col-xs-3 col-sm-2 text-right'>{label}</div><div class='col-xs-9 col-sm-7'>{input}</div><div class='col-xs-12 col-xs-offset-3 col-sm-3 col-sm-offset-0'>{error}</div>",
        ]]); ?>

        <div class="box-body">

        <?= $form->field($model,'username')->textInput() ?>

        <?php echo  $form
            // ->field(new \myzero1\rbacp\models\Captcha(['scenario'=>'php']),'verifyCode')
            ->field(new \myzero1\rbacp\models\Captcha(['scenario'=>'jsPhp']),'verifyCode')
            ->widget(
                myzero1\rbacp\widgets\Captcha::className(),
                [
                    'imageOptions'=>[
                        'alt'=>'点击换图',
                        'title'=>'点击换图',
                        'style'=>'cursor:pointer'
                    ]
                ]
            )
        ?>


        </div>
        <div class="box-footer">
            <div class="form-group form-group-box">
            	    <?= Html::submitButton(1 ? 'Create' : 'Update', ['class' => 1 ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
