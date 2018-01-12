<?php
namespace myzero1\rbacp\components;

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
        } else if (\Yii::$app->params['rbacp']['develop']==\Yii::$app->user->identity->id) {
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
}