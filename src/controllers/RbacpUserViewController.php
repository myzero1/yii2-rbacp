<?php

namespace myzero1\rbacp\controllers;

use Yii;
use myzero1\rbacp\models\RbacpUserView;
use myzero1\rbacp\models\RbacpRole;
use myzero1\rbacp\models\RbacpRelationship;
use myzero1\rbacp\models\RbacpUserViewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * RbacpUserViewController implements the CRUD actions for RbacpUserView model.
 */
class RbacpUserViewController extends Controller
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
     * Lists all RbacpUserView models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RbacpUserViewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RbacpUserView model.
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
     * Creates a new RbacpUserView model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RbacpUserView();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RbacpUserView model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oRoles = RbacpRole::find()->where(['status' => 1])->all();
        $aRoles = ArrayHelper::map($oRoles, 'id', 'name');

        if ($oRbacpRelationship = RbacpRelationship::find()->where(['id2'=>$id, 'type'=>1])->one()) {
            $model->role_id = $oRbacpRelationship->id1;
        }

        if (Yii::$app->request->isPost) {
            $nRoleId = Yii::$app->request->post()['RbacpUserView']['role_id'];

            RbacpRelationship::deleteAll(['id2'=>$id,'type'=>1]);

            if ($nRoleId) {
                $oRbacpRelationship = new RbacpRelationship();
                $oRbacpRelationship->id1 = $nRoleId;
                $oRbacpRelationship->id2 = $id;
                $oRbacpRelationship->type = 1;
                $oRbacpRelationship->save();
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'aRoles' => $aRoles
            ]);
        }
    }

    /**
     * Deletes an existing RbacpUserView model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RbacpUserView model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RbacpUserView the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RbacpUserView::find()->where(['id' => $id])->andFilterWhere(['<>', 'rbacp_user_view.id', 'rbacp_policy_sku=rbacp|rbacp-user-view|index|rbacpPolicy|read|赋予角色列表'])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
