<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'People');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Person'), ['create'],
            [
                'class' => !Yii::$app->user->isGuest ? "btn btn-success" : "hidden",
            ]) ?>
    </p>
    <?php \yii\widgets\Pjax::begin([
        'id'=>'person-grid'
    ])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'firstname',
            'lastname',
            [
                'attribute' => 'birth_date',
                'filter' => \yii\jui\DatePicker::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'birth_date',
                        'options' => [
                            'class' => 'form-control'
                        ],
                        'dateFormat' => 'yyyy-MM-dd',
                        'clientOptions' => [
                            'changeMonth' => true,
                            'yearRange' => sprintf('1900:%s', date('Y')),
                            'changeYear' => true,
                        ],
                    ]
                )
            ],
            'zip_code',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'visible' => !Yii::$app->user->isGuest
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end()?>

</div>
