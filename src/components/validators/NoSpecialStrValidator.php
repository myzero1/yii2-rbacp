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
class NoSpecialStrValidator extends Validator
{
    /**
     * @var int     能输入的最大位数.
     */
    public $max;
    /**
     * @var int     能输入的最小位数.
     */
    public $min;
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

        //  /[ ~`!@#$%^&*()\-+={\[}\]\|:;"'<,>.?/]|\\\|[！￥%……&*（）——·【】、：；“‘《，》。？]/
        //  if(preg_match("/[ '.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$user)){
        $this->pattern = '/';
        $this->pattern .= '[ ~`!@#$%^&*()\-+={\[}\]\|:;"<,>.?\/]|';//英文下的特殊字符
        $this->pattern .= "\\\|\'|";//英文下比较特殊的特殊字符
        $this->pattern .= '[！￥%……&*（）——·【】、：；“‘《，》。？]';//中文下的特殊字符
        $this->pattern .= '/';
    }

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        $min = $this->min;
        $max = $this->max;
        $attributeLabel = $model->attributeLabels()[$attribute];
        if ($this->message === null) {
            $this->message = \Yii::t('rbacp', "{$attributeLabel}只能输入{$min}-{$max}位不包含特殊字符的字符串");
        }
        $value = $model->$attribute;
        // $iLength = mb_strlen($value);
        $iLength = strlen($value);

        if ( $iLength < $this->min ) {
            $this->addError($model, $attribute, $this->message);
        } elseif ( $iLength > $this->max) {
            $this->addError($model, $attribute, $this->message);
        } else {
            if ( preg_match($this->pattern .'u', $value) ) {
                 $this->addError($model, $attribute, $this->message);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        $min = $this->min;
        $max = $this->max;
        $attributeLabel = $model->attributeLabels()[$attribute];

        if ($this->message === null) {
            $this->message = \Yii::t('rbacp', "{$attributeLabel}只能输入{$min}-{$max}个字符且不包括除“_”外的其他特殊字符");
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

            var iLength = value.length;
            //汉字为3个字符
            var iLength = value.replace(/[\\u4E00-\\u9FFF]/g,"aaa").length;
            var pattern = $pattern;

            //console.log(iLength);

            if ( iLength < $min ) {
                messages.push($message);
            } else if ( iLength > $max ) {
                messages.push($message);
            } else {
                if ( pattern.test(value) ) {
                    messages.push($message);
                }
            }
JS;
    }
}