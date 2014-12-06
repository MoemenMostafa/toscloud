<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Text */
/* @var $form ActiveForm */
$this->title = 'Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="create-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'service_id') ?>
        <?= $form->field($model, 'type_id') ?>
        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'timestamp') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- create-index -->
