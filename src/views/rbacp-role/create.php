<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpRole */

$this->title = Yii::t('rbacp', '创建角色');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbacp', '角色管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$sBoxTile = Yii::t('rbacp', '创建新的角色');
?>
<div class="rbacp-role-create">

    <?= $this->render('_form', [
        'model' => $model,
        'aPrivilegePolicys' => $aPrivilegePolicys,
        'sBoxTile' => $sBoxTile,
    ]) ?>

</div>
