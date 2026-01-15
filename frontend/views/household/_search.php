<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\HouseholdSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="household-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'father_name') ?>

    <?= $form->field($model, 'mother_name') ?>

    <?= $form->field($model, 'father_occupation') ?>

    <?= $form->field($model, 'mother_occupation') ?>

    <?php // echo $form->field($model, 'home_address') ?>

    <?php // echo $form->field($model, 'family_income') ?>

    <?php // echo $form->field($model, 'house_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
