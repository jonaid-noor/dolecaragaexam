<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\HouseholdMember $model */

$this->title = 'Update Household Member: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Household Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="household-member-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
