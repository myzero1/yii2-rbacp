<?php
namespace myzero1\rbacp\components;

/**
 * AccessConroller on before action
 * 
 * @package myzero1\rbacp\components
 */
class Rbacp extends \yii\base\Component
{
    /**
     * Checking
     *
     * @return bool
     **/
    public static function checkAccess(){
        $sUri = sprintf('%s_%s_%s', Yii::$app->controller->module->id, Yii::$app->controller->id, Yii::$app->controller->action->id);

        if ( Yii::$app->params['rbacp']['model'] == 'everyone' ) {
            return TRUE;
        } else if ( in_array($sUri, Yii::$app->params['rbacp']['accessRules']['excludeUri']) ) {
            return TRUE;
        } else if (Yii::$app->params['rbacp']['develop']==Yii::$app->usersidentity->id) {
            return TRUE;
        } else if (in_array($sUri, Yii::$app->params['rbacp']['accessRules']['developUri']) ) {
            return FALSE;
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
        if ($this->checkAction()) {
            return TRUE;
        } else {
            # code...
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