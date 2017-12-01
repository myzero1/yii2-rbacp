<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel rbacpt\models\RbacpPolicySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rbacp Policies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbacp-policy-index">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <?= Html::a('Create Rbacp Policy', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <div class="box-body">
                <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'rules',
            'scope',
            // 'sku',
            // 'type',
            // 'privilege_id',
            // 'status',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

        </div>
    </div>
</div>
