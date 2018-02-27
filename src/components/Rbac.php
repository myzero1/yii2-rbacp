<?php
namespace myzero1\rbacp\components;

use \myzero1\rbacp\models\RbacpPrivilege;

/**
 * AccessConroller on before action
 * 
 * @package myzero1\rbacp\components
 */
class Rbac extends \yii\base\Component
{
    /**
     * Checking
     *
     * @param string
     * 
     * @return bool
     **/
    public static function checkAccess($sUri=''){
        $sUri = $sUri ? $sUri : \myzero1\rbacp\helper\Helper::getShortUri();

        // var_dump($sUri);
        if ( \Yii::$app->params['rbacp']['model'] == 'everyone' ) {
            return TRUE;
        } else if ( in_array($sUri, \Yii::$app->params['rbacp']['accessRules']['excludeUri']) ) {
            return TRUE;
        } else if (\Yii::$app->user->isGuest) {
            return FALSE;
        } else {
            if (\myzero1\rbacp\components\Rbac::isDeveloper()) {
                return TRUE;
            } else if (in_array($sUri, \Yii::$app->params['rbacp']['accessRules']['developUri']) ) {
                return FALSE;
            } else {
                return self::havePrivilege($sUri, \Yii::$app->user->id);
            }
        }
    }

    /**
     * Checking
     *
     * @return bool
     **/
    public static function isDeveloper(){
        if (!\Yii::$app->user->isGuest && \Yii::$app->params['rbacp']['develop']==\Yii::$app->user->identity->id) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * Checking 
     *
     * @return void
     **/
    public static function checkAction(){
        if (self::checkAccess()) {
            return TRUE;
        } else {
            if ( \Yii::$app->user->isGuest ) {
                $sUri = \myzero1\rbacp\helper\Helper::getShortUri();
                if (\Yii::$app->params['rbacp']['loginUri'] != $sUri) {
                    \Yii::$app
                        ->getResponse()
                        ->redirect(\yii\helpers\Url::to([\Yii::$app->params['rbacp']['loginUri']]))
                        ->send();
                    exit;
                }
            } else {
                \Yii::$app
                    ->getResponse()
                    ->redirect(\yii\helpers\Url::to([\Yii::$app->params['rbacp']['denyCallbackUri']]))
                    ->send();
                exit;
            }
        }
    }

    /**
     * 获取可用的菜单项
     *
     * 在需要获取可用的菜单项的地方调用
     * @param        array               $aMenuItems
     *
     * @return       array
     **/
    public static function getMenuItems($aMenuItems){
        if (!self::isDeveloper()){
            foreach ($aMenuItems as $key => $value) {
                if (isset($value['items']) && count($value['items'])) {
                    foreach ($value['items'] as $k => $v) {
                        if (!self::checkAccess($v['url'][0])) {
                            unset($aMenuItems[$key]['items'][$k]);
                        }
                    }
                    if (count($aMenuItems[$key]['items']) == 0) {
                        unset($aMenuItems[$key]);
                    }
                } else {
                    if (!self::checkAccess($value['url'][0])) {
                        unset($aMenuItems[$key]);
                    }
                }
            }
        }

        return $aMenuItems;
    }

    /**
     * Checking
     *
     * @return bool
     **/
    public static function checkMenu(){
        self::checkAccess();
    }

    /**
     * is there the privilege
     *
     * @return void
     **/
    public static function havePrivilege($sUri, $iUserId){
        $sSql = "
            SELECT
              COUNT(*) as count
            FROM
              rbacp_privilege AS rp
            INNER JOIN rbacp_role AS rro ON find_in_set(rp.id, rro.privilege_ids) > 0
            INNER JOIN rbacp_userv_role AS rur ON rur.role_id = rro.id
            INNER JOIN rbacp_user_view AS ruv ON ruv.id = rur.userv_id
            WHERE
              ruv.id = {$iUserId}
            AND rp.url = '{$sUri}'
            AND rp.`status` = 1
            AND rro.`status` = 1
            AND rur.`status` = 1
        ";

        $aResult = \Yii::$app->db->createCommand($sSql)->queryOne();

        if ($aResult['count'] > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Find privilege
     *
     * @return bool
     **/
    public static function getPrivilegeByUid($nUid){
        RbacpPrivilege::find()
            ->where(['status' => 1])
            ->all();


        // return RbacpRole::find()
        //     ->join( 'LEFT OUTER JOIN', 
        //         'rbacp_relationship',
        //         'rbacp_relationship.id1 =rbacp_role.id'
        //     )
        //     ->join( 'LEFT OUTER JOIN', 
        //         'rbacp_user_view',
        //         '(rbacp_relationship.id2 = rbacp_user_view.id AND rbacp_relationship.type = 1)'
        //     )
        //     ->where(['rbacp_user_view.id'=>$this->id])
        //     ->one();
    }
}