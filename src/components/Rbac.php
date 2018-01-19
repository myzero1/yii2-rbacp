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
     * @return bool
     **/
    public static function checkAccess(){
        $sUri = sprintf('%s/%s/%s', \Yii::$app->controller->module->id, \Yii::$app->controller->id, \Yii::$app->controller->action->id);
        // var_dump($sUri);exit;
        if ( \Yii::$app->params['rbacp']['model'] == 'everyone' ) {
            return TRUE;
        } else if ( in_array($sUri, \Yii::$app->params['rbacp']['accessRules']['excludeUri']) ) {
            return TRUE;
        } else if (\myzero1\rbacp\components\Rbac::isDeveloper()) {
            return TRUE;
        } else if (in_array($sUri, \Yii::$app->params['rbacp']['accessRules']['developUri']) ) {
            return FALSE;
        } else if ( \Yii::$app->params['rbacp']['model'] == 'logined' ) {
            return !\Yii::$app->user->isGuest;
        } else {
            // rbac check
        }
        
    }

    /**
     * Checking
     *
     * @return bool
     **/
    public static function isDeveloper(){
        if (\Yii::$app->params['rbacp']['develop']==\Yii::$app->user->identity->id) {
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
                \Yii::$app->controller->redirect(\Yii::$app->params['rbacp']['loginUri']);
                \Yii::$app->response->send();
            } else {
                \Yii::$app->controller->redirect(\Yii::$app->params['rbacp']['denyCallbackUri']);
                \Yii::$app->response->send();
            }
        }
    }

    /**
     * Checking
     *
     * @return bool
     **/
    public static function checkMenu(){
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