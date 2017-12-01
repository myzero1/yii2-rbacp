<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpUserView */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rbacp User Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbacp-user-view-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created',
            'updated',
            'auth_zones',
            'role_id',
            'true_name',
            'mobile',
            'ip',
            'last_ip',
            'last_time:datetime',
        ],
    ]) ?>

</div>
