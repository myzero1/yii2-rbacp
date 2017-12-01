<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model custom_components\modules\myzero1\rbacp\models\RbacpUserView */

$this->title = 'Create Rbacp User View';
$this->params['breadcrumbs'][] = ['label' => 'Rbacp User Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbacp-user-view-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
