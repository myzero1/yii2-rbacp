<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\BaseArrayHelper;

\myzero1\adminlteiframe\gii\GiiAsset::register($this);
\myzero1\rbacp\assets\RbacpAsset::register($this);

/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rbacp-role-form">

        <div class="adminlteiframe-action-box user2-search">
        <?php $form = ActiveForm::begin(['id'=> 'layer-form-' . $this->context->action->id,]) ?>


            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList(
                    \myzero1\rbacp\models\RbacpActiveRecord::status(), ['prompt' => Yii::t('rbacp', '请选择状态')]
                )
            ?>
            </div>

            <div class="privilege-policy">
                  <table class="table-hover table table-bordered table-hover dataTable">
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


            <div class="form-group form-group-box">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('rbacp', '创建') : Yii::t('rbacp', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>



</div>