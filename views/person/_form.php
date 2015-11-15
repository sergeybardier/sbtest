<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="person-form col-md-6">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'birth_date')->widget(\yii\jui\DatePicker::classname(),[
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'yearRange' => sprintf('1900:%s',date('Y')),
                'changeYear' => true,
            ],
            'options'=>[
                'class'=>'form-control'
            ]
        ]) ?>

        <?= $form->field($model, 'zip_code',[
            'template' => "{label}\n<i class='glyphicon glyphicon-search' style='cursor:pointer' data-toggle='collapse' data-target='#zip-search'></i>\n{input}\n{hint}\n{error}"
        ])->textInput(['maxlength' => true]) ?>

        <?=Html::tag('div',
            \app\components\widgets\GoogleAutocomplete::widget([
                'name' => 'place',
                'options'=>[
                    'class'=>'form-control',
                    'placeholder'=>Yii::t('app','Enter your location'),
                    'onkeydown'=>new \yii\web\JsExpression(<<<JS
                  return event.keyCode==13?false:true
JS
                    ),
                ]
            ])
            ,[
                'class'=>'collapse form-group',
                'id'=>'zip-search'
            ])?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), \yii\helpers\Url::toRoute(['index']),['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>


    </div>
</div>

