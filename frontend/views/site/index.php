<?php

use common\models\Profiles;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Profiles $model */
/** @var ActiveForm $form */
?>
<div class="site-index">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(['action' => ['add']]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'gender')->dropDownList(Profiles::getGenders(), ['prompt' => 'Выбрать пол']) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'phone') ?>
            <?= $form->field($model, 'region') ?>
            <?= $form->field($model, 'city') ?>
            <?= $form->field($model, 'rating') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'question')->textarea() ?>
            <?= $form->field($model, 'comment')->textarea() ?>
        </div>
    </div>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
