<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Household $model */

$this->title = 'Update Household: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Households', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="household-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'houseHoldMembers' => $houseHoldMembers,
    ]) ?>

</div>
