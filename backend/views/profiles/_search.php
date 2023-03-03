<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\ProfilesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profiles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'region') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'question') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
