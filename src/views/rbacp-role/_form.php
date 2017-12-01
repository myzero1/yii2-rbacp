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
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList(
                    \myzero1\rbacp\models\RbacpActiveRecord::status(), ['prompt' => Yii::t('rbacp', '请选择状态')]
                )
            ?>


            <div class="privilege-policy">
                  <table class="table table-striped table-bordered">
                       <thead>
                            <tr>
                                 <th width="30%"><a href="#">权限</a></th>
                                 <th><a href="#">策略</a></th>
                            </tr>
                       </thead>
                       <tbody>
                            <?php foreach ($aPrivilegePolicys as $key => $value) {
                                printf('<tr>');
                                    printf('<td>');
                                        echo Html::checkboxList ( "RbacpRole[rbacp_privilege_ids][{$value['id']}]", explode(',', $model->privilege_ids), array($value['id'] => sprintf('%s(%s)', $value['name'], $value['url'])), $options = ['class' => "privilege-item privilege-item-{$value['id']}", 'privilege_id' => $value['id']]);
                                        // var_dump($value);
                                    printf('</td>');
                                    printf('<td>');
                                        // echo Html::checkboxList ( "RbacpRole[rbacp_policy_ids][{$value['id']}]", explode(',', $model->policy_ids), $value['policys'], $options = [] );

                                        $selectedPolicyIds = explode(',', $model->policy_ids);
                                        $selectedPolicydatas = json_decode($model->policy_datas, TRUE);
                                        foreach ($value['policys'] as $k => $v) {
                                          # code...
                                          $checked = in_array($v['id'], $selectedPolicyIds) ? $v['id'] : FALSE;
                                          $checkboxList = Html::checkboxList ( "RbacpRole[rbacp_policy_ids][{$value['id']}]", $checked, [$v['id'] => $v['name']] );
                                          echo Html::tag('div', $checkboxList, ['class'=>"privilege-item-{$value['id']} policy-item policy-item-{$v['id']}", 'policy_id' => $v['id'], 'privilege_id' => $value['id']]);

                                          if (count($v['data']) > 0) {
                                              $aSelected = isset($selectedPolicydatas[$v['id']]) ? $selectedPolicydatas[$v['id']] : array();
                                              echo Html::checkboxList ( "RbacpRole[rbacp_policy_datas][{$v['id']}]", $aSelected, $v['data'], ['class'=>"policy-item-data policy-item-{$v['id']} privilege-item-{$value['id']}", 'policy_id' => $v['id'], 'privilege_id' => $value['id']] );
                                          } else {
                                            # code...
                                          }

                                        }
                                        // var_dump($value['policys']);
                                    printf('</td>');
                                printf('</tr>');
                            } ?>
                       </tbody>
                  </table>
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group form-group-box">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('rbacp', '创建') : Yii::t('rbacp', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


<?php

$js = <<<JS

/*---------custom.----------------*/
/*---------for rbacp-role,start.----------------*/

$('.privilege-item input').click(function(){ //ifCreated 事件应该在插件初始化之前绑定

  var privilege_id = $(this).parents('.privilege-item').attr('privilege_id');

  if (!$(this).prop("checked")) {
    $(".privilege-item-"+privilege_id+" input").iCheck('uncheck');
  } else {
    $(".privilege-item-"+privilege_id+" input").iCheck('check');
  }
});

$('.policy-item input').click(function(){ //ifCreated 事件应该在插件初始化之前绑定
  var policy_id = $(this).parents('.policy-item').attr('policy_id');
  var privilege_id = $(this).parents('.policy-item').attr('privilege_id');

  if (!$(this).prop("checked")) {
    $(".policy-item-"+policy_id+" input").iCheck('uncheck');
  } else {
    $(".policy-item-"+policy_id+" input").iCheck('check');
    $(".privilege-item.privilege-item-"+privilege_id+" input").iCheck('check');
  }
});

$('.policy-item-data input').click(function(){ //ifCreated 事件应该在插件初始化之前绑定
  var policy_id = $(this).parents('.policy-item-data').attr('policy_id');
  var privilege_id = $(this).parents('.policy-item-data').attr('privilege_id');

  if (!$(this).prop("checked")) {
    unCheckedParent (".policy-item-data.policy-item-"+policy_id+" input", ".policy-item.policy-item-"+policy_id+" input");
  } else {
    $(".policy-item.policy-item-"+policy_id+" input").iCheck('check');
    $(".privilege-item.privilege-item-"+privilege_id+" input").iCheck('check');
  }
});

function unCheckedParent (sEachItemSelector, sUncheckedSelector) {
  var iCheckedCount = 0;
  $(sEachItemSelector).each(function(){
      if ($(this).prop("checked")) {
        iCheckedCount ++;
      } else {
        // coding
      }
  });
  // console.log(iCheckedCount);
  if (iCheckedCount === 1) {
    $(sUncheckedSelector).iCheck('uncheck');
  } else {
    // coding
  }
}

/*---------for rbacp-role,end.----------------*/


JS;


$this->registerJS($js);

?>