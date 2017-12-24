<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Leavelog */
/* @var $form ActiveForm */
?>
<div class="new">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'initiator_id') ?>
        <?= $form->field($model, 'leave_id') ?>
        <?= $form->field($model, 'create_time') ?>
        <?= $form->field($model, 'begin_time') ?>
        <?= $form->field($model, 'end_time') ?>
        <?= $form->field($model, 'status') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- new -->
