<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpRole */

\myzero1\rbacp\assets\RbacpAsset::register($this);

$this->title = Yii::t('rbacp', '修改角色');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbacp', '角色管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$sBoxTile = Yii::t('rbacp', '修改角色：{name}', ['name' => $model->name]);
?>
<div class="rbacp-role-update">

    <?= $this->render('_form', [
        'model' => $model,
        'aPrivilegePolicys' => $aPrivilegePolicys,
        'sBoxTile' => $sBoxTile,
    ]) ?>

</div>
