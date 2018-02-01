<?php

namespace myzero1\rbacp\controllers;

use Yii;
use myzero1\rbacp\models\RbacpRole;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RbacpRoleController implements the CRUD actions for RbacpRole model.
 */
class RbacpRoleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RbacpRole models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RbacpRole::find()->andFilterWhere(['<>', 'rbacp_role.id', 'rbacp_policy_sku=rbacp|rbacp-role|index|rbacpPolicy|read|角色列表']),
            'sort' => [
                'defaultOrder' => [
                    'updated' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RbacpRole model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RbacpRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RbacpRole();


        if ($model->load(Yii::$app->request->post())) {
            if (!is_null($model->rbacp_privilege_ids)) {
                $model->privilege_ids = implode(',', $model->twoD2OneD($model->rbacp_privilege_ids));
            } else {
                $model->privilege_ids = '';
            }

            if (!is_null($model->rbacp_policy_ids)) {
                $model->policy_ids = implode(',', $model->twoD2OneD($model->rbacp_policy_ids));
            } else {
                $model->policy_ids = '';
            }

            if (!is_null($model->rbacp_policy_datas)) {
                $model->policy_datas = json_encode($model->rbacp_policy_datas);
            } else {
                $model->policy_datas = json_encode(array());
            }

            $model->created = $model->updated = time();
            $model->author = Yii::$app->user->id;

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'aPrivilegePolicys' => $model->getPrivilegePolicy(),
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'aPrivilegePolicys' => $model->getPrivilegePolicy(),
            ]);
        }
    }

    /**
     * Updates an existing RbacpRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

// $aParam = \Yii::$app->request->get();
// $aParam['onlyContentHtml'] = TRUE;
// $sHtml = \Yii::$app->runAction('/rbacp/default/index', $aParam);
// $sHtml = \Yii::$app->runAction('/rbacp/rbacp-user-view/update', $aParam);
// $sHtml = \Yii::$app->runAction('/rbacp/rbacp-role/update', $aParam);
// echo "<pre>$sHtml</pre>";exit;


        $model = $this->findModel($id);
        $model->updated = time();

        if ($model->load(Yii::$app->request->post())) {
            if (!is_null($model->rbacp_privilege_ids)) {
                $model->privilege_ids = implode(',', $model->twoD2OneD($model->rbacp_privilege_ids));
            } else {
                $model->privilege_ids = '';
            }

            if (!is_null($model->rbacp_policy_ids)) {
                $model->policy_ids = implode(',', $model->twoD2OneD($model->rbacp_policy_ids));
            } else {
                $model->policy_ids = '';
            }

            if (!is_null($model->rbacp_policy_datas)) {
                $model->policy_datas = json_encode($model->rbacp_policy_datas);
            } else {
                $model->policy_datas = json_encode(array());
            }

            $model->updated = time();

            // var_dump($model);exit;

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'aPrivilegePolicys' => $model->getPrivilegePolicy(),
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'aPrivilegePolicys' => $model->getPrivilegePolicy(),
            ]);
        }
    }

    /**
     * Deletes an existing RbacpRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

// $connection  = Yii::$app->db;
// $sql     = "select * from hd_article where aid<".$aid." order by aid desc limit 1";
// $command = $connection->createCommand($sql);
// $res     = $command->queryAll($sql);
        $sSqlQuery = "
            SELECT
                *
            FROM
                `rbacp_userv_role`
            WHERE
                role_id = {$id}
            AND status = 1
        ";
        $mResult = Yii::$app->db->createCommand($sSqlQuery)->queryAll();
        if (count($mResult)==0) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', \Yii::t('rbacp', '有其他用户正在使用不能删除'));
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the RbacpRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RbacpRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        // if (($model = RbacpRole::findOne($id)) !== null) {
        if (($model = RbacpRole::find()->where(['id' => $id])->andFilterWhere(['<>', 'rbacp_role.id', 'rbacp_policy_sku=rbacp|rbacp-role|index|rbacpPolicy|read|角色列表'])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
