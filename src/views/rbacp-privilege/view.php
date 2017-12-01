<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpPrivilege */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbacp', 'Rbacp Privileges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbacp-privilege-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('rbacp', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('rbacp', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('rbacp', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'url:url',
            'status',
            'created',
            'updated',
        ],
    ]) ?>

</div>
