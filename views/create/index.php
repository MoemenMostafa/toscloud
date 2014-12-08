<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Service;
use app\models\Type;
use kartik\widgets\Typeahead;

/* @var $this yii\web\View */
/* @var $model app\models\Text */
/* @var $form ActiveForm */
$this->title = 'Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Create New</h1>
<h5 class='discreption'>Here you can create new legal text for a service</h5>
<div class="create-index">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-4">
        <?= $form->field($model, 'service')->widget(Typeahead::classname(), [
            'dataset' =>  [['local' => ArrayHelper::map(Service::find()->all(), 'id', 'name')]],
            'options' => ['placeholder' => 'Filter as you type ...'],
            'pluginOptions' => ['highlight'=>true],
        ]) ?>
        <?= $form->field($model, 'type_id')->dropDownList(
            ArrayHelper::map(Type::find()->all(), 'id', 'name')
        ) ?>
    </div>
    <div class="col-lg-12">
            <?= $form->field($model, 'content')->textarea(['rows'=>8]) ?>
           <!--<?= Html::label('Text',null,['class'=>"control-label"]) ?>
            <?= Html::textarea('content',null,['class'=>"form-control",'rows'=>10]) ?>-->
            <div class="help-block"></div>
           <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
 
    <?php ActiveForm::end(); ?>

</div><!-- create-index -->
