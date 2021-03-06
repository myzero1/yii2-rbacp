<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpRole */

$this->title = Yii::t('rbacp', '修改权限');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbacp', '权限管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$sBoxTile = Yii::t('rbacp', '修改权限：{name}', ['name' => $model->name]);
?>
<div class="rbacp-policy-update">

    <?= $this->render('_form', [
        'model' => $model,
        'sBoxTile' => $sBoxTile,
    ]) ?>

</div>
