	<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpRole */

$this->title = Yii::t('rbacp', '创建策略');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbacp', '策略管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$sBoxTile = Yii::t('rbacp', '创建新的策略');
?>
<div class="rbacp-policy-create">

    <?= $this->render('_form', [
        'model' => $model,
        'sBoxTile' => $sBoxTile,
    ]) ?>

</div>
