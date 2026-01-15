<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\HouseholdMember $model */

$this->title = 'Create Household Member';
$this->params['breadcrumbs'][] = ['label' => 'Household Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="household-member-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
