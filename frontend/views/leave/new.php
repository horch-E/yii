<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Leavelog */
/* @var $form ActiveForm */

$this->title = '请假';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-new">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        请填写请假信息
    </p>

    <div class="row">
        <div class="new">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'leave_id')->dropDownList($leaves,['prompt'=>'请选择请假类型']) ?>
        <?= $form->field($model, 'detail')->textarea(['rows'=>4]) ?>
       <!--  <?= $form->field($model, 'begin_time') ?> -->

        <?= $form->field($model, 'begin_time')->widget(
            DatePicker::className(), [
            // inline too, not bad
            // 'inline' => true,
            'language' => 'zh-CN' , //--设置为中文
            'template' => '{addon}{input}',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);?>

        <?= $form->field($model, 'end_time')->widget(
            DatePicker::className(), [
            // inline too, not bad
            // 'inline' => true,
            'language' => 'zh-CN' , //--设置为中文
            'template' => '{addon}{input}',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);?>

        <!--  <?= $form->field($model, 'end_time') ?> -->
        <?= $form->field($model, 'vetter_id')->dropDownList($vetters,['prompt'=>'请选择审批人']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交申请', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    <?php echo $model->leave_id ;?>
    </div><!-- new -->
    </div>

</div>

