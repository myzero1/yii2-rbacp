<?php

namespace myzero1\rbacp\controllers;

use yii\web\Controller;

/**
 * Default controller for the `captcha` module
 */
class DefaultController extends Controller
{
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

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionMigrateUp()
    {
        $model = new \myzero1\rbacp\models\UserView();
        $message = '';

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $sql = "SELECT
                        1
                    FROM
                        INFORMATION_SCHEMA. TABLES
                    WHERE
                        TABLE_NAME = 'rbacp_user_view';
                    ";

            $result = \Yii::$app->db->createCommand($sql)->queryOne();

            if ($result === false) {
                $viweSql = sprintf('CREATE VIEW `rbacp_user_view` AS SELECT %s, %s, %s FROM `user` WHERE 1 = 1;', $model->id, $model->username, $model->status);

               \Yii::$app->db->createCommand($viweSql)->execute();
            }

            //default console commands outputs to STDOUT so this needs to be declared for wep app
            if (!defined('STDOUT')) {
                define('STDOUT', fopen('/tmp/stdout', 'w'));
            }

            //migration command begin
            $migration = new \yii\console\controllers\MigrateController('migrate', \Yii::$app);
            $migration->runAction('up', ['migrationPath' => '@vendor/myzero1/yii2-rbacp/src/migrations/', 'interactive' => false]);
            //migration command end

            /**
             * open the STDOUT output file for reading
             * @var $message collects the resulting messages of the migrate command to be displayed in a view
             */
            $handle = fopen('/tmp/stdout', 'r');
            $message = '';
            while (($buffer = fgets($handle, 4096)) !== false) {
                $message.=$buffer . "<br>";
            }
            fclose($handle);
            // var_dump($message);exit;

            return $this->render('migrate-up', [
                'model' => $model,
                'message' => $message,
            ]);
        } else {
            return $this->render('migrate-up', [
                'model' => $model,
                'message' => $message,
            ]);
        }
    }

}
