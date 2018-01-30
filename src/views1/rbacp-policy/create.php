<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model rbacpt\models\RbacpPolicy */

$this->title = 'Create Rbacp Policy';
$this->params['breadcrumbs'][] = ['label' => 'Rbacp Policies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$sBoxTile = $this->title;
?>
<div class="rbacp-policy-create">

    <?= $this->render('_form', [
        'model' => $model,
        'sBoxTile' => $sBoxTile,
    ]) ?>

</div>
