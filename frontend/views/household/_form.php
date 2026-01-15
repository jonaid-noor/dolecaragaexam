<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Household $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="household-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'home_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'family_income')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'house_status')->dropDownList([
        'Rent' => 'Rent',
        'Living Together' => 'Living Together',
        'with Parents or Relative' => 'with Parents or Relative',
        'Owned, Others' => 'Owned, Others',
    ], [
        'prompt' => 'Select House Status', // optional placeholder
    ]) ?>




    <br>

        <h4>Household Members</h4>

    <div id="house-hold-members">
        <?php foreach ($houseHoldMembers as $i => $member): ?>
            <div class="house-hold-member row" style="margin-bottom:10px; border:1px solid #ccc; padding:10px;">
                <?= $form->field($member, "[$i]child_name")->textInput(['maxlength' => true]) ?>
                <?= $form->field($member, "[$i]birth_date")->textInput(['maxlength' => true, 'type' => 'date']) ?>
                <?= $form->field($member, "[$i]sex")->dropDownList(['Male' => 'Male', 'Female' => 'Female'], ['prompt'=>'Select']) ?>
                <?= $form->field($member, "[$i]civil_status")->dropDownList([
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Widowed' => 'Widowed',
                    'Separated' => 'Separated'
                ], ['prompt'=>'Select']) ?>

                <button type="button" class="btn btn-danger remove-member">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" id="add-member" class="btn btn-info">Add Member</button>

    <br><br>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS
var memberIndex = {$i} + 1;
$('#add-member').on('click', function() {
    var html = `
    <div class="house-hold-member row" style="margin-bottom:10px; border:1px solid #ccc; padding:10px;">

        <div class="col-md-3">
            <label>Child Name</label>
            <input type="text" name="HouseHoldMember[\${memberIndex}][child_name]" class="form-control" placeholder="Child Name">
        </div>

        <div class="col-md-3">
            <label>Birth Date</label>
            <input type="date" name="HouseHoldMember[\${memberIndex}][birth_date]" class="form-control">
        </div>

        <div class="col-md-2">
            <label>Sex</label>
            <select name="HouseHoldMember[\${memberIndex}][sex]" class="form-control">
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Civil Status</label>
            <select name="HouseHoldMember[\${memberIndex}][civil_status]" class="form-control">
                <option value="">Select</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widowed">Widowed</option>
                <option value="Separated">Separated</option>
            </select>
        </div>

        <div class="col-md-1" style="margin-top: 32px;">
            <button type="button" class="btn btn-danger remove-member">Remove</button>
        </div>

    </div>`;
    
    $('#house-hold-members').append(html);
    memberIndex++;
});


$(document).on('click', '.remove-member', function() {
    $(this).closest('.house-hold-member').remove();
});
JS;
$this->registerJs($script);
?>