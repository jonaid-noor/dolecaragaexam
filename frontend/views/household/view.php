<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Household $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Households', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="household-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <h3>Household</h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'father_name',
            'mother_name',
            'father_occupation',
            'mother_occupation',
            'home_address',
            'family_income',
            'house_status',
        ],
    ]) ?>

    <h3>Household Members</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Child Name</th>
                <th>Birth Date</th>
                <th>Sex</th>
                <th>Civil Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($houseHoldMembers as $i => $member): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= Html::encode($member->child_name) ?></td>
                    <td><?= Html::encode($member->birth_date) ?></td>
                    <td><?= Html::encode($member->sex) ?></td>
                    <td><?= Html::encode($member->civil_status) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

