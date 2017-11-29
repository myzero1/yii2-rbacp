<?php

namespace myzero1\rbacp\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Controller;
use yii\helpers\Json;



/**
 * Class PreventMultipleSubmissionsBehavior
 * @package myzero1\pms\behaviors
 */
class CaptchaValidateBehavior extends Behavior
{

    /**
     * @return array
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction()
    {
        if (in_array(Yii::$app->request->method, ['POST'], true)) {
            $model = new \myzero1\rbacp\models\Captcha();
            $model->scenario = 'jsPhp';

            $post = Yii::$app->request->post();

            if (isset($post['Captcha']) && isset($post['Captcha']['verifyCode'])) {
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                } else {
                    unset($post['Captcha']);
                    unset($post[Yii::$app->request->csrfParam]);

                    $postJson = Json::encode($post);
                    Yii::$app->getSession()->setFlash('captcha_form_data', $postJson);
                    // $url = '/' . \Yii::$app->requestedRoute;
                    $url = \Yii::$app->request->getHostInfo() . '/' . \Yii::$app->requestedRoute;
                    \Yii::$app->response->redirect($url)->send();
                    exit;
                }
            }
        }
    }
}
