<?php

namespace myzero1\rbacp\controllers;

use Yii;
use myzero1\rbacp\models\RbacpPolicy;
use myzero1\rbacp\models\RbacpPolicySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RbacpPolicyController implements the CRUD actions for RbacpPolicy model.
 */
class RbacpPolicyController extends Controller
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
     * Lists all RbacpPolicy models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RbacpPolicySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RbacpPolicy model.
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
     * Creates a new RbacpPolicy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RbacpPolicy();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return \myzero1\adminlteiframe\helpers\Tool::redirectParent(['index']);
        } else {
            // var_dump($model->errors);exit;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RbacpPolicy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return \myzero1\adminlteiframe\helpers\Tool::redirectParent(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RbacpPolicy model.
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
     * Deletes an existing User2 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteSelected($z1selected)
    {
        if (empty($z1selected)) {
            return 'z1selected 不能为空。';
        } else {
            RbacpPolicy::deleteAll(['id' => explode(',', $z1selected)]); 

            return \myzero1\adminlteiframe\helpers\Tool::redirectParent(['index']);
        }
    }
    
    /**
     * Finds the RbacpPolicy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RbacpPolicy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RbacpPolicy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * redirect parent window.
     * @param array ['user/delete',['id'=>1]]
     * @return string
     */
    protected function redirectParent(array $params)
    {
        return sprintf('<script type="text/javascript">parent.location.href="%s"</script>',\yii\helpers\Url::to($params));
    }
}
