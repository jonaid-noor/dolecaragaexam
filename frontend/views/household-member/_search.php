<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\HouseholdMemberSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="household-member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_household_id') ?>

    <?= $form->field($model, 'child_name') ?>

    <?= $form->field($model, 'birth_date') ?>

    <?= $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'civil_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
