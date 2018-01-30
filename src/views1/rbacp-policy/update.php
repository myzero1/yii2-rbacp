<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model rbacpt\models\RbacpPolicy */

$this->title = 'Update Rbacp Policy: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rbacp Policies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$sBoxTile = $this->title;
?>
<div class="rbacp-policy-update">

    <?= $this->render('_form', [
        'model' => $model,
        'sBoxTile' => $sBoxTile,
    ]) ?>

</div>
