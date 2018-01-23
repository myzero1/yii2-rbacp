<?php

namespace myzero1\rbacp\helper;
/**
 * The helpers for rbacp.
 *
 * @author qinxuanwu
 *
 */
class Helper {
    /**
     * Get the module's name of rbacp.
     *
     * 调用实例：Helper::
     *
     * @param   void
     * @return  string
     **/
    public static function getRbacpModuleName(){
        foreach (\Yii::$app->modules as $key => $value) {
            if (!is_array($value)) {
                if ('myzero1\rbacp\Module' == $value::className()) {
                    return $key;
                }
            }
        }

        return 'noRbacpModule';
    }
}