<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Service;
use app\models\Type;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Text */
/* @var $form ActiveForm */
$this->title = 'Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="create-index">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-4">
        <?= $form->field($model, 'service_id')->widget(Select2::classname(), [
            'data' =>  ArrayHelper::map(Service::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Filter as you type ...'],
            'pluginOptions' => ['highlight'=>true],
        ]) ?>
        <?= $form->field($model, 'type_id')->dropDownList(
            ArrayHelper::map(Type::find()->all(), 'id', 'name')
        ) ?>
    </div>
    <div class="col-md-12">
            <?= Html::label('Text',null,['class'=>"control-label"]) ?>
            <?= Html::textarea('content',null,['class'=>"form-control",'rows'=>10]) ?>
            <div class="help-block"></div>
           <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
 
    <?php ActiveForm::end(); ?>

</div><!-- create-index -->
