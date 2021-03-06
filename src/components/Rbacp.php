<?php
namespace myzero1\rbacp\components;

use myzero1\rbacp\components\Rbac;

/**
 * AccessConroller on before action
 * 
 * @package myzero1\rbacp\components
 */
class Rbacp extends \yii\base\Component
{
    /**
     * 对带有特殊参数的请求,进行权限判断
     *
     * 在controler中统一添加解析
     * @return void
     **/
    public static function paramPrivilege(){
        \Yii::$app->getModule('rbacp');
        if (!\Yii::$app->user->isGuest) {
            if (\myzero1\rbacp\components\Rbac::isDeveloper()) {
                return TRUE;
            } else {
                $sUri = \Yii::$app->requestedRoute;
                $iUserId = \Yii::$app->user->id;

                $roleId = Rbac::getRoleByUid($iUserId);

                $sSql = "
                    SELECT
                      rpo.rules AS rules
                    FROM
                      rbacp_role AS rro
                    INNER JOIN rbacp_privilege AS rpr ON find_in_set(rpr.id, rro.privilege_ids) > 0
                    INNER JOIN rbacp_policy AS rpo ON rpo.privilege_id = rpr.id
                    WHERE
                        rro.id = {$roleId}
                    AND rpr.url = '{$sUri}'
                    AND rpo.`status` = 1
                    AND rro.`status` = 1
                    AND rpr.`status` = 1
                    AND rpo.`type` = 4
                ";

                $aResult = \Yii::$app->db->createCommand($sSql)->queryOne();

                if ($aResult) {
                    $aRules = json_decode($aResult['rules'], TRUE);
                    $bReturn = eval($aRules['function']);
                    return $bReturn;
                } else {
                    return TRUE;
                }
            }
        } else {
            return TRUE;
        }
    }

    /**
     * 数据库读权限
     *
     * 只在需要调用的地方调用。在yii2的数据库操作函数中添加（如 find,update,delete,save...通过重写原有的库函数，给它多加一个参数privilege_policy_sku=>'app|place|index|rbacpPolicy|read|场所列表'），在command类中解析
     * @return void
     **/
    public static function readPrivilege(array $condition){
        \Yii::$app->getModule('rbacp');
        if (array_search('id', $condition)) {
            if (strpos($condition[2], 'rbacpPolicy') !== FALSE) {
                $goRbacp = TRUE;

                $aPolicySku = explode('=', $condition[2]);
                $sPolicySku = trim($aPolicySku[1]);
                // var_dump($sPolicySku);exit;
                $aResults = self::getPolicy(\Yii::$app->requestedRoute, \Yii::$app->user->id, $sPolicySku, 3);
                // var_dump($aResults);exit;
                $aResult = current($aResults);
                $sResult = $aResult['rules'];
                $aResult = json_decode($sResult, TRUE);
                $aResult = $aResult['rules'];

                return $aResult;
            }
        }
    }

    /**
     * 判断GridView中的字段是否需要显示。
     *
     * 在GridView的options中加入privilegeVerifier=>'rbacp',columus=>['duration','dct']参数。在columns参数中每个一列都要加上类名称。在GridView页面定义那一些需要验证，在GridView的类里面解析。
     GridView::widget([
                'headerRowOptions' => ['class' => 'jf-table-header'],
                'summary' => false,
                'dataProvider' => $dataProvider,
                'id' => 'duration_grid_view',
                'options' => [
                    'class'=>'jf_grid_view',
                    'rbacp_policy_sku' => 'app|place|index|rbacpPolicy|list|场所列表'
                ],
                'columns' => [
                    'duration' => [
     *
     * 包括yii\widgets\ActiveForm
        yii\widgets\ActiveForm
        yii\widgets\DetailView
     * @return void
     **/
    public static function listPrivilege($sPolicySku, $column){
        \Yii::$app->getModule('rbacp');
/*        $aRules = self::getPolicy(\Yii::$app->requestedRoute, \Yii::$app->user->id, $sPolicySku, 2);
        $aResult = current($aRules);
        $sResult = $aResult['rules'];
        $aResult = json_decode($sResult, TRUE);
        $aDisplayColumn = $aResult['display_column'];
        if (in_array($column, $aDisplayColumn)) {
            return TRUE;
        } else {
            return FALSE;
        }
*/
        $aDisplayColumn = self::getPolicyData(\Yii::$app->user->id, $sPolicySku);

        if (in_array($column, $aDisplayColumn)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 页面元素是否显示
     *
     * 主要用于所有的tag
     *
     * @param array    $tagOptions   次tag的选项
     *
     * @return bool
     **/
    public static function tagShowPrivilege($tagOptions){
        \Yii::$app->getModule('rbacp');
        if ( isset( $tagOptions['rbacp_policy_sku'] ) ) {
          $sPolicySku = trim($tagOptions['rbacp_policy_sku']); 
          $aRules = self::getPolicy(\myzero1\rbacp\helper\Helper::getShortUri(), \Yii::$app->user->id, $sPolicySku, 1);
          // var_dump($sPolicySku);
          // var_dump($aRules);exit;
          $aResult = current($aRules);
          $sResult = $aResult['rules'];
          $aResult = json_decode($sResult, TRUE);

          $bResult = '';

          if (isset($aResult['function'])) {
              if ($aResult['function'] == 'show' ) {
                  $bResult = TRUE;
              } else if ($aResult['function'] == 'show_data' ) {
                  if (isset($aResult['data'])) {
                      if (count($aResult['data']) > 0) {
                          $bResult = TRUE;
                      } else {
                          $bResult = TRUE;
                          // $bResult = FALSE;
                      }
                  } else {
                      $bResult = FALSE;
                  }
              } else {
                  $bResult = FALSE;
              }
          } else {
              $bResult = FALSE;
          }
        } else {
            $bResult = TRUE;
        }
        return $bResult;
        // var_dump('This is tagPrivilege');exit;
    }
    
    /**
     * 页面元素显示的可以选择的值的权限判断
     *
     * 主要用于dropDownList,radioList,checkboxList
     *
     * @param mixed    $selection    当前选择的值
     * @param array    $items        可以选择的选项
     * @param array    $tagOptions   次tag的选项
     *
     * @return array
     **/
    public static function tagDataPrivilege($selection, $items, $tagOptions){
        \Yii::$app->getModule('rbacp');


        if (\myzero1\rbacp\components\Rbac::isDeveloper()) {
            $aResults = $items;
        } else if ( isset( $tagOptions['rbacp_policy_sku'] ) ) {
          $sPolicySku = trim($tagOptions['rbacp_policy_sku']);
          $aRules = self::getPolicy(\Yii::$app->requestedRoute, \Yii::$app->user->id, $sPolicySku, 1);
          $aRule = current($aRules);
          $sRule = $aRule['rules'];
          $aRuleNew = json_decode($sRule, TRUE);

          $aResults = array();

          if (isset($aRuleNew['data'])) {
              if (is_array($aRuleNew['data'])) {
                  foreach ($items as $key => $value) {
                      if (in_array($key, $aRuleNew['data'])) {
                          $aResults[$key] = $value;
                      } else {
                        # code...
                      }
                  }
                  $aResults[$selection] = $items[$selection];
              } else {
                  $aResults = array();
              }
          } else {
              $aResults = array();
          }
        } else {
            $aResults = $items;
        }
        return $aResults;
        // var_dump('This is tagPrivilege');exit;
    }

    // ---------------function----------------------

    /**
     * 获取策略
     *
     * 在需要获取策略的地方调用
     * @param        string        $sUri
     * @param        int           $iUserId
     * @param        string        $sPolicySku
     * @param        int           $iType
     *
     * @return       array
     **/
    public static function getPolicy($sUri, $iUserId, $sPolicySku, $iType){
        \Yii::$app->getModule('rbacp');
    /*    $sSql = "
            SELECT
                rpo.rules AS rules
            FROM
                rbacp_privilege AS rp
            INNER JOIN rbacp_role_privilege AS rrp ON rp.id = rrp.privilege_id
            INNER JOIN rbacp_role AS rr ON rr.id = rrp.role_id
            INNER JOIN rbacp_user_view AS ruv ON ruv.id = rr.id
            INNER JOIN rbacp_policy_entitlement AS rpe ON rpe.privilege_id = rp.id
            INNER JOIN rbacp_policy AS rpo ON rpo.id = rpe.policy_id
            INNER JOIN rbacp_usercategory AS ruc ON ruc.id = rpe.usercategory_id
            WHERE
                ruv.id = {$iUserId}
            AND rp.url = '{$sUri}'
            AND rpo.sku = '{$sPolicySku}'
            AND rp.`status` = 1
            AND rrp.`status` = 1
            AND rr.`status` = 1
            AND rpe.`status` = 1
            AND rpo.`status` = 1
            AND ruc.`status` = 1
            AND rpo.`type` = {$iType}
        ";*/

        $roleId = Rbac::getRoleByUid($iUserId);

        $sSql = "
            SELECT
              rpo.rules AS rules
            FROM
              rbacp_role AS rro
            INNER JOIN rbacp_policy AS rpo  ON find_in_set(rpo.id, rro.policy_ids) > 0
            INNER JOIN rbacp_privilege AS rpr  ON find_in_set(rpr.id, rro.privilege_ids) > 0
            WHERE
                rro.id = {$roleId}
            AND rpr.url = '{$sUri}'
            AND rpo.sku = '{$sPolicySku}'
            AND rpo.`status` = 1
            AND rro.`status` = 1
            AND rpr.`status` = 1
            AND rpo.`type` = {$iType}
        ";

        /*if ($iType==3) {
            var_dump($sSql);exit;
        } else {
            # code...
        }*/

        $mResult = \Yii::$app->db->createCommand($sSql)->queryAll();
        return $mResult;
    }

    /**
     * 获取策略的数据
     *
     * 在需要获取策略数据的地方调用
     * @param        int               $iUserId
     * @param        string            $sPolicySku
     *
     * @return       array
     **/
    public static function getPolicyData($iUserId, $sPolicySku){
        \Yii::$app->getModule('rbacp');

        $roleId = Rbac::getRoleByUid($iUserId);
        
        $sSql = "
            SELECT
              rro.policy_datas AS policy_datas,
              rpo.id AS policy_id
            FROM
              rbacp_role AS rro
            INNER JOIN rbacp_policy AS rpo  ON find_in_set(rpo.id, rro.policy_ids) > 0
            WHERE
                rro.id = {$roleId}
            AND rpo.sku = '{$sPolicySku}'
            AND rro.`status` = 1
            AND rpo.`status` = 1
        ";
        // var_dump($sSql);exit;
        $mResult = \Yii::$app->db->createCommand($sSql)->queryAll();

        $aResultCurrent = current($mResult);
        $aData = json_decode($aResultCurrent['policy_datas'], TRUE);
        if (isset($aData[$aResultCurrent['policy_id']])) {
            $aResult = $aData[$aResultCurrent['policy_id']];
        } else {
            $aResult = array();
        }

        // var_dump($aResultCurrent);
        // var_dump($aData);
        // var_dump($aResult);
        // exit;

        return $aResult;
    }
}