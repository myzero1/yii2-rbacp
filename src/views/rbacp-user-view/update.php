<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpUserView */
myzero1\adminlteiframe\gii\GiiAsset::register($this);

$this->title = Yii::t('rbacp', '修改角色');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbacp', '赋予角色'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('rbacp', '修改角色');
?>
<div class="rbacp-user-view-update">

    <?= $this->render('_form', [
        'model' => $model,
        'aRoles' => $aRoles,
    ]) ?>

</div>
