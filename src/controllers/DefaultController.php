<?php

namespace myzero1\rbacp\controllers;

use yii\web\Controller;

/**
 * Default controller for the `captcha` module
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return  [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => $this->module->fixedVerifyCode,
                'backColor'=> $this->module->backColor,//背景颜色
                'maxLength' => $this->module->maxLength, //最大显示个数
                'minLength' => $this->module->minLength,//最少显示个数
                'padding' => $this->module->padding,//间距
                'height'=> $this->module->height,//高度
                'width' => $this->module->width,  //宽度
                'foreColor' => $this->module->foreColor,     //字体颜色
                'offset' => $this->module->offset,        //设置字符偏移量 有效果
                'transparent' => $this->module->transparent,        //设置字符偏移量 有效果
            ],
		];
	}

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionDemo()
    {
        if (\Yii::$app->request->isPost) {
            var_dump('Captcha is validated.');exit;
        } else {
            return $this->render('demo');
        }

    }

}
