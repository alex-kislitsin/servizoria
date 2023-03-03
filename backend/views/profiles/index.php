<?php

use common\models\Profiles;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\search\ProfilesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array $genders */

$this->title = 'Анкеты';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="profiles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email:email',
            'phone',
            'region',
            'city',
            [
                'attribute' => 'gender',
                'filter' => $genders,
                'value' => function (Profiles $model) use ($genders) {
                    return $genders[$model->gender] ?? '';
                }
            ],
            'question',
            'rating',
            'comment',
            [
                'attribute' => 'created_at',
                'value' => function (Profiles $model) {
                    return $model->created_at ? date('d.m.Y', strtotime($model->created_at)) : null;
                },
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'm.d.Y',
                            'separator' => ' - ',
                        ],
                    ],
                ]),
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
