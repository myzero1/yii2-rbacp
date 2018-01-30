<?php

namespace myzero1\rbacp\components\validators;

use Yii;
use yii\validators\Validator;
use yii\helpers\StringHelper;
use yii\web\JsExpression;
use yii\helpers\Json;


/**
 * 验证：不包含特殊字符的字符串，现在不包含英文，中文中键盘上能输入的特殊字符，不包括下划线
 *
 *
 */
class DecimalValidator extends Validator
{
    /**
     * @var int     整数的最大位数.
     */
    public $intMax;
    /**
     * @var int     小数的最大位数.
     */
    public $decimalMax;
    /**
     * @var int     能输入的最小位数.
     */
    public $pattern;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $intMax = $this->intMax;
        $decimalMax = $this->decimalMax;
        $this->pattern = "/^\d{1,$intMax}(\.\d{1,$decimalMax}){0,1}$/u";

    }

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {

        $intMax = $this->intMax;
        $decimalMax = $this->decimalMax;
        $attributeLabel = $model->attributeLabels()[$attribute];
        if ($this->message === null) {
            $this->message = \Yii::t('rbacp', "{$attributeLabel}整数部分需要“1-{$intMax}”位，小数部分需要“0-{$decimalMax}”位");
        }
        $value = $model->$attribute;

        if ( !( preg_match("/^\d{1,$intMax}(\.\d{1,$decimalMax}){0,1}$/u", $value) ) ) {
            $this->addError($model, $attribute, $this->message);
        }

    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {

        $intMax = $this->intMax;
        $decimalMax = $this->decimalMax;
        $attributeLabel = $model->attributeLabels()[$attribute];
        if ($this->message === null) {
            $this->message = \Yii::t('rbacp', "{$attributeLabel}整数部分需要“1-{$intMax}”位，小数部分需要“0-{$decimalMax}”位");
        }
        $message = json_encode($this->message);
        $pattern = $this->pattern;

        if ($this->skipOnEmpty) {
            $skipOnEmpty = 1;
        } else {
            $skipOnEmpty = 0;
        }

        return <<<JS
            var skipOnEmpty = $skipOnEmpty;
            if(skipOnEmpty==1) {
                if (value=='') {
                    return true;
                }
            }

            var pattern = $pattern;
            if ( !pattern.test(value) ) {
                messages.push($message);
            }
JS;
    }
}